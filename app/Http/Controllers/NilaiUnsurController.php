<?php

namespace App\Http\Controllers;

use App\Models\BagianLayanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Session;
use App\Models\NilaiUnsur;
use App\Models\SurveyCode;
use Illuminate\Support\Str;


class NilaiUnsurController extends Controller
{
    public function index()
    {
               error_reporting(0);

$startDate = '2024-01-01';

$endDate = '2024-10-03';

if ($_GET['tw'] == null) {
    $today = date('Y-m-d', strtotime('+1 days'));
    $endDate = $today;
} elseif ($_GET['tw'] == 1) {
    $startDate = $_GET['Tahun'] . '-01-01';
    $endDate = $_GET['Tahun'] . '-03-31';
} elseif ($_GET['tw'] == 2) {
    $startDate = $_GET['Tahun'] . '-04-01';
    $endDate = $_GET['Tahun'] . '-06-30';
} elseif ($_GET['tw'] == 3) {
    $startDate = $_GET['Tahun'] . '-01-01';
    $endDate = $_GET['Tahun'] . '-06-31';
} elseif ($_GET['tw'] == 4) {
    $startDate = $_GET['Tahun'] . '-07-01';
    $endDate = $_GET['Tahun'] . '-09-30';
} elseif ($_GET['tw'] == 5) {
    $startDate = $_GET['Tahun'] . '-01-01';
    $endDate = $_GET['Tahun'] . '-09-30';
} elseif ($_GET['tw'] == 6) {
    $startDate = $_GET['Tahun'] . '-10-01';
    $endDate = $_GET['Tahun'] . '-12-31';
} elseif ($_GET['tw'] == 7) {
    $startDate = $_GET['Tahun'] . '-01-01';
    $endDate = $_GET['Tahun'] . '-12-31';
}        

$terms = array_values(array_unique(array_filter(array_map('trim', explode(',', $_GET['bagian'])))));

$selects = DB::table('survey_responses')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('tahun', $_GET['Tahun'] ?? date('Y'))
            ->paginate(10);

        return view('NilaiUnsur.index', compact('selects'));
    }


    public function cariNilaiUnsur(Request $request)
    {
        $keyword = $request->search;
        $datas = NilaiUnsur::where('nilaiUnsur', 'like', "%" . 'like', "%" . $keyword . "%");
        return view('nilaiUnsur.index', compact('datas'));
    }

    /**
     * create
     *
     * @return mixed
     */
    public function create()
    {
        return view('Nilai.create');
    }

    /**
     * store
     *
     * @return mixed
     */
    public function store(Request $request)
     {
        // echo ("request");
        

        // return $request->jenkel['jenkel'];
        $data = new NilaiUnsur();

        $jenis_pelayanan = null;
        if (\Illuminate\Support\Facades\Schema::hasTable('bagian_layanan')) {
            $bagian = BagianLayanan::find((int) $request->bagian);
            if ($bagian) {
                $jenis_pelayanan = $bagian->kode;
            }
        }

        if (!$jenis_pelayanan) {
            if($request->bagian==1){
                $jenis_pelayanan = "organisasi";
            } else if($request->bagian==2){
                $jenis_pelayanan = "umum";
            } else if($request->bagian==3){
                $jenis_pelayanan = "pemerintahan";
            } else if($request->bagian==4){
                $jenis_pelayanan = "adbang";
            } else if($request->bagian==5){
                $jenis_pelayanan = "prokopim";
            } else if($request->bagian==6){
                $jenis_pelayanan = "kesra";
            } else if($request->bagian==7){
                $jenis_pelayanan = "pbj";
            } else if($request->bagian==8){
                $jenis_pelayanan = "ekosda";
            } else if($request->bagian==9){
                $jenis_pelayanan = "hukum";
            }
        }
        // $data->nm_kelas = $request->nm_kelas;
        // $data->ket = $request->ket;
        // $data->save();
        // return redirect()->back();

        // Duplicate checks: nik, nohp, and optional no_pendaftar (if column exists)
        if ($request->filled('nik')) {
            $exists = NilaiUnsur::where('nik', $request->nik)->first();
            if ($exists) {
                if ($request->wantsJson() || $request->ajax()) {
                    return response()->json(['exists' => true, 'field' => 'nik']);
                }
                return redirect()->back()->withInput()->with('error', 'NIK sudah digunakan');
            }
        }

        // Map incoming 'no_wa' (form) to DB column 'nohp' for backward compatibility
        if ($request->filled('no_wa')) {
            $exists = NilaiUnsur::where('nohp', $request->no_wa)->first();
            if ($exists) {
                if ($request->wantsJson() || $request->ajax()) {
                    return response()->json(['exists' => true, 'field' => 'no_wa']);
                }
                return redirect()->back()->withInput()->with('error', 'No. WA sudah digunakan');
            }
        }

        // optional registration number check if column exists in DB
        if ($request->filled('no_pendaftar') && \Illuminate\Support\Facades\Schema::hasColumn('survey_responses', 'no_pendaftar')) {
            $exists = NilaiUnsur::where('no_pendaftar', $request->no_pendaftar)->first();
            if ($exists) {
                if ($request->wantsJson() || $request->ajax()) {
                    return response()->json(['exists' => true, 'field' => 'no_pendaftar']);
                }
                return redirect()->back()->withInput()->with('error', 'Nomor pendaftaran sudah digunakan');
            }
        }

        $store = NilaiUnsur::create([
            'jenisPelayanan' => $jenis_pelayanan,
            'tahun' => (int) ($request->input('tahun') ?: date('Y')),
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'pekerjaan' => $request->pekerjaan,
            'jenkel' => $request->jenkel['jenkel'],
            'usia' => $request->usia,
            // store WhatsApp number into legacy `nohp` column
            'nohp' => $request->input('no_wa'),
            'no_wa' => $request->input('no_wa'),
            'pendidikan' => $request->pendidikan,
            'nik' => $request->nik,
            'u1' => $request->u1,
            'u2' => $request->u2,
            'u3' => $request->u3,
            'u4' => $request->u4,
            'u5' => $request->u5,
            'u6' => $request->u6,
            'u7' => $request->u7,
            'u8' => $request->u8,
            'u9' => $request->u9,
            'saran' => $request->saran,
            'id_sub_jenis' => $request->filled('jenis') ? (int) $request->jenis : null,
        ]);

        if ($store) {
            // generate a redeem group and six unique codes
            $group = Str::upper(Str::random(10));
            $store->redeem_group = $group;
            $store->save();

            // generate a single unique 6-digit numeric code (zero-padded)
            do {
                $code = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            } while (SurveyCode::where('code', $code)->exists());

            SurveyCode::create([
                'survey_response_id' => $store->id,
                'code' => $code,
            ]);

            // show thank-you page with single code (passed as array for compatibility)
            return view('survey.thankyou', ['response' => $store, 'codes' => [$code], 'group' => $group]);
        } else {
            return redirect('/terimakasih');
        }
    }

    /**
     * AJAX: check whether a given identifier already exists
     */
    public function checkUnique(Request $request)
    {
        $field = $request->query('field');
        $value = $request->query('value');

        if (!$field || !$value) {
            return response()->json(['error' => 'Missing parameters'], 400);
        }

        $allowed = ['nik', 'no_wa', 'no_pendaftar'];
        if (!in_array($field, $allowed, true)) {
            return response()->json(['error' => 'Invalid field'], 400);
        }

        // if checking registration number but column not present, return not found
        if ($field === 'no_pendaftar' && !\Illuminate\Support\Facades\Schema::hasColumn('survey_responses', 'no_pendaftar')) {
            return response()->json(['exists' => false]);
        }

        // if DB has `no_wa` column, check it directly; otherwise fallback to `nohp`
        if ($field === 'no_wa') {
            if (\Illuminate\Support\Facades\Schema::hasColumn('survey_responses', 'no_wa')) {
                $exists = NilaiUnsur::where('no_wa', $value)->exists();
            } else {
                $exists = NilaiUnsur::where('nohp', $value)->exists();
            }
            return response()->json(['exists' => $exists]);
        }

        $exists = NilaiUnsur::where($field, $value)->exists();

        return response()->json(['exists' => $exists]);
    }

    /**
     * edit
     *
     * @return mixed
     */
    public function edit(request $request)
    {
        // echo ($request->jenis);
        $datas = NilaiUnsur::latest()->when(request()->search, function ($data_dasars) {
            $data_dasars = $data_dasars->where('id', 'like', '%' . request()->id_nilaiUnsur . '%');
        })
            ->where('id', $_GET['id_nilaiUnsur'])
            ->get();

        return view('Nilai.detail', compact('datas'));
    }

    /**
     * destroy
     *
     * @return mixed
     */
    public function destroy($id)
    {
        $NilaiUnsur = NilaiUnsur::findOrFail($id);
        $NilaiUnsur->delete();

        if ($NilaiUnsur) {
            //redirect dengan pesan sukses
            return redirect()->route('NilaiUnsur.index')->with(['pesan' => 'Data Berhasil Dihapus!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('NilaiUnsur.index')->with(['pesan' => 'Data Gagal Dihapus!']);
        }
    }

    /**
     * update
     *
     * @return mixed
     */
    public function update(Request $request, NilaiUnsur $NilaiUnsur)
    {
        // print_r($request->post());
        $NilaiUnsur->update([
            'nm_nilaiUnsur' => $request->nm_nilaiUnsur,
            'ket' => $request->ket,
        ]);

        return redirect()->route('NilaiUnsur.index');
    }
}



