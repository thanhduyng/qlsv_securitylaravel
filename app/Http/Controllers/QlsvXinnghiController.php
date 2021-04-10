<?php

namespace App\Http\Controllers;

use App\qlsv_xinnghi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QlsvXinnghiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Danh sách xin nghỉ";
        $xinNghi = DB::table('qlsv_xinnghis')->get();
        return view('admin.XinNghi.danhsachxinnghi', compact(['xinNghi','title']));
    }

    public function xinnghi(Request $request)
    {
        $title = "Xin nghỉ theo lớp";
        $user = auth()->user();
        $sinhVien = DB::table('qlsv_sinhviens')
            ->where('id_user', $user->id)
            ->get()[0];
        DB::enableQueryLog();
        $lopHoc = DB::table('qlsv_sinhvienlophocs')
            ->where('id_sinhvien', $sinhVien->id)
            ->orderByDesc('id')
            ->select(
                'qlsv_sinhvienlophocs.*',
                DB::raw('(select id from qlsv_thoikhoabieus 
            where qlsv_thoikhoabieus.id_lophoc = qlsv_sinhvienlophocs.id_lophoc order by case when ngayhoc >= \'' . Carbon::now()->format("Y-m-d") .
                    '\' then 0 else 1 end,case when ngayhoc <= \'' . Carbon::now()->format("Y-m-d") .
                    ' 23:59:59\' then 0 else 1 end desc, id limit 1) as id_thoikhoabieu ')
            )
            ->get();
        // dd(DB::getQueryLog());
        return view('admin.XinNghi.xinnghi', compact(['title', 'user', 'sinhVien', 'lopHoc']));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Xin nghỉ học";
        return view('admin.XinNghi.themxinnghi', compact(['title']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\qlsv_xinnghi  $qlsv_xinnghi
     * @return \Illuminate\Http\Response
     */
    public function show(qlsv_xinnghi $qlsv_xinnghi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\qlsv_xinnghi  $qlsv_xinnghi
     * @return \Illuminate\Http\Response
     */
    public function edit(qlsv_xinnghi $qlsv_xinnghi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\qlsv_xinnghi  $qlsv_xinnghi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, qlsv_xinnghi $qlsv_xinnghi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\qlsv_xinnghi  $qlsv_xinnghi
     * @return \Illuminate\Http\Response
     */
    public function destroy(qlsv_xinnghi $qlsv_xinnghi)
    {
        //
    }
}
