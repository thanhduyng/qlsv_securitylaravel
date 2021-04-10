<?php

namespace App\Http\Controllers;

use App\qlsv_chucnang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class QlsvChucnangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = "Danh sách chức năng";
        $chucNang = DB::table('qlsv_chucnangs')->where('deleted_at',0)->paginate(10);
        return view('admin.ChucNang.dschucnang', compact(['chucNang','title']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Thêm chuc năng";
        return view('admin.ChucNang.themchucnang',compact(['title']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        $chucNang = new qlsv_chucnang();
        $chucNang->ma = $request->ma;
        $chucNang->ten = $request->ten;
        $chucNang->url = $request->url;
        $chucNang->id_cha = $request->id_cha;
        $chucNang->deleted_at = "0";
        $chucNang->save();
        return redirect()->route('qlsv_chucnang.index')->with('message','Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\qlsv_chucnang  $qlsv_chucnang
     * @return \Illuminate\Http\Response
     */
    public function show(qlsv_chucnang $qlsv_chucnang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\qlsv_chucnang  $qlsv_chucnang
     * @return \Illuminate\Http\Response
     */
    public function edit(qlsv_chucnang $qlsv_chucnang,$id)
    {
        $title = "Sửa chức năng";
        $chucNang = qlsv_chucnang::find($id);
        return view('admin.ChucNang.updatechucnang', compact(['chucNang','title']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\qlsv_chucnang  $qlsv_chucnang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, qlsv_chucnang $qlsv_chucnang,$id)
    {
        $chucNang= qlsv_chucnang::find($id);
        $chucNang->ma = $request->ma;
        $chucNang->ten = $request->ten;
        $chucNang->url = $request->url;
        $chucNang->id_cha = $request->id_cha;
        $chucNang->save();
        return redirect('/chucnang/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\qlsv_chucnang  $qlsv_chucnang
     * @return \Illuminate\Http\Response
     */
    public function destroy(qlsv_chucnang $qlsv_chucnang,$id)
    {
        $chucNang= qlsv_chucnang::find($id);
        $chucNang->delete();
        return redirect('/chucnang/index');
    }
}
