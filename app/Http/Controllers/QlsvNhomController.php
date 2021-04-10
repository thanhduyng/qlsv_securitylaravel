<?php

namespace App\Http\Controllers;
use App\qlsv_nhom;
use App\qlsv_nhomvavaitro;
use App\qlsv_vaitro;
use App\qlsv_nhomvavaitros;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QlsvNhomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = "Danh sách Nhóm";
        $search = $request->get('search') ?? "";
        $nhom = DB::table('qlsv_lophocs')->where('ten', 'like', '%' . $search . '%')->where('deleted_at', 0)->paginate(10);
        return view('admin.Nhom.dsnhom', compact(['nhom', 'title', 'search']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Thêm nhóm";
        $vaiTro = DB::table('qlsv_vaitros')->pluck('ten', 'id');
        return view('admin.Nhom.themnhom', compact(['vaiTro','title']));
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
        $nhom = new qlsv_nhom();
        $nhom->ma = $request->ma;
        $nhom->ten= $request->ten;
        $nhom->id_vaitro = $request->id_vaitro;
        $nhom->created_at = Carbon::now();

        if ($nhom->save()) {
            $id_nhom = $nhom->id;
            $id_vaitro = $request->input('vaitros');
            foreach ($id_vaitro as $svs) {
                $nhomvavaitros = new qlsv_nhomvavaitro();
                $nhomvavaitros->id_nhom = $id_nhom;
                $nhomvavaitros->id_vaitro = $svs;
                $nhomvavaitros->save();
            }
        }
        return redirect()->route('qlsv_nhom.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\qlsv_nhom  $qlsv_nhom
     * @return \Illuminate\Http\Response
     */
    public function show(qlsv_nhom $qlsv_nhom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\qlsv_nhom  $qlsv_nhom
     * @return \Illuminate\Http\Response
     */
    public function edit(qlsv_nhom $qlsv_nhom,$id)
    {
        $title = "Sửa Nhóm";
        $nhom = qlsv_nhom::find($id);
        $vaiTro = qlsv_vaitro::pluck('ten', 'id');
        return view('admin.Nhom.updatenhom', compact(['nhom', 'vaiTro','title']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\qlsv_nhom  $qlsv_nhom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, qlsv_nhom $qlsv_nhom,$id)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $nhom= qlsv_nhom::find($id);
        $nhomEdit = $request->all();
        $nhom->update(["updated_at" => Carbon::now()]);
        $nhom->update($nhomEdit);
        return redirect()->route('qlsv_nhom.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\qlsv_nhom  $qlsv_nhom
     * @return \Illuminate\Http\Response
     */
    public function destroy(qlsv_nhom $qlsv_nhom,$id)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $nhom = DB::table('qlsv_nhoms')->where('id', $id)->update(["deleted_at" => "1", "updated_at" => Carbon::now()]);
        return redirect()->route('qlsv_nhom.index');
    }
}
