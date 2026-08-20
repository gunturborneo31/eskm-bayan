<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NilaiUnsur;

class SurveyCode extends Model
{
    use HasFactory;

    protected $table = 'survey_codes';

    protected $fillable = [
        'survey_response_id',
        'code',
        'redeemed_at',
        'redeemed_by',
    ];

    public function response()
    {
        return $this->belongsTo(NilaiUnsur::class, 'survey_response_id');
    }
}
