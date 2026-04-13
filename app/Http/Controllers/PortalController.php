<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
use App\Models\NilaiUnsur;


class PortalController extends Controller
{
    public function index()
    {
        return view('portal.index');
    }

    public function slug($id)
    {
        return view('portal.slug');
    }
}
