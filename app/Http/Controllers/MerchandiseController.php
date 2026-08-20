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

    // AJAX: check by code or group
    public function apiCheck(Request $request)
    {
        $value = $request->query('value') ?? $request->input('value');
        if (!$value) {
            return response()->json(['error' => 'missing value'], 400);
        }

        // If looks like a URL containing /survey/redeem/{group}
        if (preg_match("#/survey/redeem/([A-Za-z0-9]+)#", $value, $m)) {
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

        // Try as group directly
        $response = NilaiUnsur::where('redeem_group', $value)->first();
        if ($response) {
            $codes = SurveyCode::where('survey_response_id', $response->id)->get()->map(function($c){
                return ['code'=>$c->code, 'redeemed'=> (bool) $c->redeemed_at, 'redeemed_at' => $c->redeemed_at, 'redeemed_by' => $c->redeemed_by];
            });
            return response()->json(['exists' => true, 'type' => 'group', 'response' => $response, 'codes' => $codes]);
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

    // Show recent redemption history
    public function history()
    {
        $items = SurveyCode::whereNotNull('redeemed_at')->orderBy('redeemed_at', 'desc')->limit(200)->get();
        return view('merch.history', compact('items'));
    }
}
