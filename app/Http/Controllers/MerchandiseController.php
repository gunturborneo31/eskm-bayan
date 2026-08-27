<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\SurveyCode;
use App\Models\NilaiUnsur;
use App\Models\MerchUser;

class MerchandiseController extends Controller
{
    public function showLogin()
    {
        return view('merch.login');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        // Try DB-backed merch users first
        $muser = MerchUser::where('username', $username)->first();
        if ($muser && \Hash::check($password, $muser->password)){
            $request->session()->put('merch_user', $muser->username);
            $request->session()->put('merch_name', $muser->name);
            return redirect('/merch/check');
        }

        // Fallback to config-based users
        $users = Config::get('merch.users', []);
        if (isset($users[$username]) && $users[$username] === $password) {
            $request->session()->put('merch_user', $username);
            $request->session()->put('merch_name', $username);
            return redirect('/merch/check');
        }

        return redirect('/merch/login')->withErrors(['login' => 'Username atau password salah']);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('merch_user');
        return redirect('/merch/login');
    }

    public function checkView()
    {
        return view('merch.check');
    }

    public function drawView()
    {
        $participants = NilaiUnsur::query()
            ->select(['id', 'nama', 'nohp'])
            ->whereNotNull('nama')
            ->where('nama', '!=', '')
            ->orderBy('id')
            ->get()
            ->map(function (NilaiUnsur $participant) {
                $phone = preg_replace('/\D+/', '', (string) $participant->nohp);

                return [
                    'id' => $participant->id,
                    'name' => $participant->nama,
                    'phone' => $phone !== '' ? str_repeat('*', max(0, strlen($phone) - 4)) . substr($phone, -4) : '-',
                ];
            });

        return view('merch.draw', compact('participants'));
    }

    // AJAX: check by code or group
    public function apiCheck(Request $request)
    {
        $value = trim((string) ($request->query('value') ?? $request->input('value')));
        if ($value === '') {
            return response()->json(['error' => 'missing value'], 400);
        }

        // URL format: https://.../survey/redeem/{group}
        if (preg_match("#/survey/redeem/([A-Za-z0-9]+)#i", $value, $m)) {
            $group = $m[1];
            $response = NilaiUnsur::where('redeem_group', $group)->first();
            if (! $response) {
                return response()->json(['exists' => false]);
            }

            $codes = SurveyCode::where('survey_response_id', $response->id)->get()->map(function($c){
                return ['code'=>$c->code, 'redeemed'=> (bool) $c->redeemed_at, 'redeemed_at' => $c->redeemed_at, 'redeemed_by' => $c->redeemed_by];
            });

            return response()->json(['exists' => true, 'type' => 'group', 'response' => $response, 'codes' => $codes]);
        }

        // Group value directly
        $response = NilaiUnsur::where('redeem_group', $value)->first();
        if ($response) {
            $codes = SurveyCode::where('survey_response_id', $response->id)->get()->map(function($c){
                return ['code'=>$c->code, 'redeemed'=> (bool) $c->redeemed_at, 'redeemed_at' => $c->redeemed_at, 'redeemed_by' => $c->redeemed_by];
            });
            return response()->json(['exists' => true, 'type' => 'group', 'response' => $response, 'codes' => $codes]);
        }

        // Actual single QR/code lookup
        $codeModel = SurveyCode::where('code', $value)->first();
        if ($codeModel) {
            $response = $codeModel->response()->first();
            return response()->json([
                'exists' => true,
                'type' => 'code',
                'code' => $codeModel->code,
                'redeemed' => (bool) $codeModel->redeemed_at,
                'response' => $response ? $response->toArray() : null,
            ]);
        }

        return response()->json(['exists' => false]);
    }

    // AJAX: mark a specific code as redeemed (by merch user in session)
    public function apiRedeem(Request $request)
    {
        $code = $request->input('code');
        if (! $code) {
            return response()->json(['error' => 'empty_code'], 400);
        }

        $surveyCode = SurveyCode::where('code', $code)->first();
        if (! $surveyCode) {
            return response()->json(['error' => 'code_not_found'], 404);
        }

        if ($surveyCode->redeemed_at) {
            return response()->json(['ok' => false, 'message' => 'already_redeemed', 'redeemed_at' => $surveyCode->redeemed_at, 'redeemed_by' => $surveyCode->redeemed_by]);
        }

        $surveyCode->redeemed_at = now();
        $surveyCode->redeemed_by = $request->session()->get('merch_user');
        $surveyCode->save();

        return response()->json(['ok' => true, 'message' => 'redeemed', 'redeemed_at' => $surveyCode->redeemed_at, 'redeemed_by' => $surveyCode->redeemed_by]);
    }

    // Return simple stats for dashboard (redeemed / surveyed)
    public function apiStats(Request $request)
    {
        $redeemed = \App\Models\SurveyCode::whereNotNull('redeemed_at')->count();
        $surveyed = NilaiUnsur::count();

        return response()->json([
            'redeemed' => $redeemed,
            'surveyed' => $surveyed,
        ]);
    }

    // Paginated list for either redeemed codes or survey responses
    public function apiList(Request $request)
    {
        $type = $request->query('type', 'redeemed');
        $perPage = (int) $request->query('per_page', 10);
        $q = trim((string) $request->query('q', ''));

        if ($type === 'redeemed') {
            $query = \App\Models\SurveyCode::whereNotNull('redeemed_at')->with('response')->orderBy('redeemed_at', 'desc');
            if ($q !== '') {
                $query->where(function($sub) use ($q) {
                    $sub->where('code', 'like', "%$q%");
                });
            }

            $p = $query->paginate($perPage)->appends($request->query());
            $collection = collect($p->items())->map(function($item){
                return [
                    'code' => $item->code,
                    'redeemed_at' => $item->redeemed_at,
                    'redeemed_by' => $item->redeemed_by,
                    'response' => $item->response ? [
                        'id' => $item->response->id,
                        'nama' => $item->response->nama,
                        'nik' => $item->response->nik,
                        'no_wa' => $item->response->no_wa ?? $item->response->nohp ?? null,
                        'no_peserta' => $item->response->no_peserta ?? null,
                        'surveyed_at' => $item->response->created_at ?? null,
                    ] : null,
                ];
            })->values()->all();

            return response()->json([
                'total' => $p->total(),
                'per_page' => $p->perPage(),
                'current_page' => $p->currentPage(),
                'last_page' => $p->lastPage(),
                'data' => $collection,
            ]);
        }

        // default: survey list
        $query = NilaiUnsur::orderBy('created_at', 'desc');
        if ($q !== '') {
            $query->where(function($sub) use ($q) {
                $sub->where('nama', 'like', "%$q%")
                    ->orWhere('nik', 'like', "%$q%")
                    ->orWhere('no_wa', 'like', "%$q%")
                    ->orWhere('nohp', 'like', "%$q%");
            });
        }

        $p = $query->paginate($perPage)->appends($request->query());
        $items = $p->items();
        $ids = array_map(fn($it) => $it->id, $items);
        $codesGrouped = [];
        if (!empty($ids)) {
            $codes = SurveyCode::whereIn('survey_response_id', $ids)->get();
            $codesGrouped = $codes->groupBy('survey_response_id')->map(function($col){
                return $col->map(fn($c)=> ['code'=>$c->code, 'redeemed_at'=>$c->redeemed_at])->values()->all();
            })->all();
        }

        $collection = collect($items)->map(function($item) use ($codesGrouped){
            return [
                'id' => $item->id,
                'nama' => $item->nama,
                'nik' => $item->nik,
                'no_wa' => $item->no_wa ?? $item->nohp ?? null,
                'no_peserta' => $item->no_peserta ?? null,
                'surveyed_at' => $item->created_at ?? null,
                'codes' => $codesGrouped[$item->id] ?? [],
            ];
        })->values()->all();

        return response()->json([
            'total' => $p->total(),
            'per_page' => $p->perPage(),
            'current_page' => $p->currentPage(),
            'last_page' => $p->lastPage(),
            'data' => $collection,
        ]);
    }

    // Detail endpoint: by code or survey_id
    public function apiDetail(Request $request)
    {
        $code = $request->query('code');
        $id = $request->query('id');

        if ($code) {
            $sc = \App\Models\SurveyCode::where('code', $code)->with('response')->first();
            if (! $sc) return response()->json(['error' => 'not_found'], 404);
            return response()->json([
                'type' => 'code',
                'code' => $sc->code,
                'redeemed_at' => $sc->redeemed_at,
                'redeemed_by' => $sc->redeemed_by,
                'response' => $sc->response,
            ]);
        }

        if ($id) {
            $r = NilaiUnsur::find($id);
            if (! $r) return response()->json(['error' => 'not_found'], 404);
            $codes = \App\Models\SurveyCode::where('survey_response_id', $r->id)->get();
            return response()->json([
                'type' => 'response',
                'response' => $r,
                'codes' => $codes,
            ]);
        }

        return response()->json(['error' => 'missing_param'], 400);
    }

    // Show recent redemption history
    public function history()
    {
        $items = SurveyCode::whereNotNull('redeemed_at')->orderBy('redeemed_at', 'desc')->limit(200)->get();
        return view('merch.history', compact('items'));
    }
}
