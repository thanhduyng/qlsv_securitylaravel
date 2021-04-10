<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $giangVien = DB::table('qlsv_giangviens')
            ->where('id_user', $user->id)
            ->where('deleted_at', 0)
            ->get();
        $sinhVien = DB::table('qlsv_sinhviens')
            ->where('id_user', $user->id)
            ->where('deleted_at', 0)
            ->get();
        $phongDaoTao = DB::table('qlsv_nguoidungquantris')
            ->where('id_user', $user->id)
            ->where('deleted_at', 0)
            ->get();
        if (count($giangVien) > 0) {
            return redirect()->route('giang_vien.trangchu');
        }
        if (count($sinhVien) > 0) {
            return redirect()->route('sinh_vien.index');
        } else {
            return redirect()->route('quan_tri.trangchu');
        }

        // return view('home', ['giangVien' => count($giangVien), 'sinhVien' => count($sinhVien), 'phongDaoTao' => count($phongDaoTao)]);
    }
}
