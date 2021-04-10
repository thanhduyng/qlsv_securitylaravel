<?php

namespace App\Http\Controllers;

use App\qlsv_sinhvienlophoc;
use App\qlsv_tudanhgia;
use App\qlsv_tudanhgiasinhvienlophoc;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QlsvTudanhgiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = " Danh sách Tự đánh giá";
        $search = $request->get('search') ?? "";
        $qlsv_monhoc = DB::table('qlsv_monhocs')->pluck('tenmonhoc', 'id');

        $qlsv_tudanhgia = DB::table('qlsv_tudanhgias')
            ->where('id_monhoc', 'like', '%' . $search . '%')
            ->where("deleted_at", 0)
            ->get();
        return view('admin/TuDanhGia/listtudanhgia', compact([
            'title', 'search'
        ]), [
            'qlsv_monhoc' => $qlsv_monhoc,
            'qlsv_tudanhgia' => $qlsv_tudanhgia
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Thêm mới Tự đánh giá";
        $qlsv_monhoc = DB::table('qlsv_monhocs')->pluck('tenmonhoc', 'id');
        return view('admin/TuDanhGia/themtudanhgia', compact([
            'title',
            'qlsv_monhoc'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $data  = new qlsv_tudanhgia();
        $data->id_monhoc = $request->id_monhoc;
        $data->tieude = $request->tieude;
        $data->cauhoi = $request->cauhoi;
        $data->thutu = $request->thutu;
        $data->soluongcautraloi = $request->soluongcautraloi;
        $data->deleted_at = "0";
        $data->created_at =  Carbon::now();
        $data->save();

        // $danhGiasvlh = new qlsv_tudanhgiasinhvienlophoc();
        // $danhGiasvlh->id_tudanhgia = $data->id;
        // $danhGiasvlh->save();
        return redirect('/tudanhgia/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\qlsv_tudanhgia  $qlsv_tudanhgia
     * @return \Illuminate\Http\Response
     */
    public function show(qlsv_tudanhgia $qlsv_tudanhgia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\qlsv_tudanhgia  $qlsv_tudanhgia
     * @return \Illuminate\Http\Response
     */
    public function edit(qlsv_tudanhgia $qlsv_tudanhgia, $id)
    {
        $title = "Cập nhập đánh giá";
        $qlsv_tudanhgia = qlsv_tudanhgia::find($id);
        $qlsv_monhoc = DB::table('qlsv_monhocs')->pluck('tenmonhoc', 'id');
        return view('admin/TuDanhGia/edittudanhgia', compact([
            'title',
            'qlsv_monhoc',
            'qlsv_tudanhgia'
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\qlsv_tudanhgia  $qlsv_tudanhgia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, qlsv_tudanhgia $qlsv_tudanhgia)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $data = qlsv_tudanhgia::find($request->id);
        $data->id_monhoc = $request->id_monhoc;
        $data->cauhoi = $request->cauhoi;
        $data->tieude = $request->tieude;
        $data->thutu = $request->thutu;
        $data->soluongcautraloi = $request->soluongcautraloi;
        $data->update(["updated_at" => Carbon::now()]);
        $data->save();
        return redirect('/tudanhgia/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\qlsv_tudanhgia  $qlsv_tudanhgia
     * @return \Illuminate\Http\Response
     */
    public function destroy(qlsv_tudanhgia $qlsv_tudanhgia, $id)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $qlsv_tudanhgia = DB::table('qlsv_tudanhgias')->where('id', $id)->update(["deleted_at" => "1", "updated_at" => Carbon::now()]);
        return response()->json(['_typeMessage' => 'deleteSuccess']);
    }
}
