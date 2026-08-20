<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NilaiUnsur;
use App\Models\SurveyCode;

class SurveyCodeController extends Controller
{
    public function show($group)
    {
        $response = NilaiUnsur::where('redeem_group', $group)->first();
        if (!$response) {
            abort(404, 'Kode tidak ditemukan');
        }

        $codes = SurveyCode::where('survey_response_id', $response->id)->get();

        return view('survey.redeem', ['response' => $response, 'codes' => $codes, 'group' => $group]);
    }

    /**
     * Mark a single code as redeemed (AJAX POST)
     */
    public function redeem(Request $request, $group)
    {
        $code = $request->input('code');
        if (!$code) {
            return response()->json(['error' => 'code required'], 400);
        }

        $response = NilaiUnsur::where('redeem_group', $group)->first();
        if (!$response) {
            return response()->json(['error' => 'group not found'], 404);
        }

        $surveyCode = SurveyCode::where('survey_response_id', $response->id)->where('code', $code)->first();
        if (!$surveyCode) {
            return response()->json(['error' => 'code not found'], 404);
        }

        if ($surveyCode->redeemed_at) {
            return response()->json(['ok' => false, 'message' => 'already_redeemed', 'redeemed_at' => $surveyCode->redeemed_at, 'redeemed_by' => $surveyCode->redeemed_by]);
        }

        $surveyCode->redeemed_at = now();
        // record merch user if available
        $surveyCode->redeemed_by = $request->session()->get('merch_user') ?? null;
        $surveyCode->save();

        return response()->json(['ok' => true, 'message' => 'redeemed', 'redeemed_at' => $surveyCode->redeemed_at, 'redeemed_by' => $surveyCode->redeemed_by]);
    }
}
