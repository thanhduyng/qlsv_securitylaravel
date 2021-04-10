<?php

namespace App\Http\Controllers;

use App\qlsv_lophoc;
use App\qlsv_phonghoc;
use App\qlsv_sinhvien;
use App\qlsv_thoikhoabieu;
use App\qlsv_worktask;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QlsvThoikhoabieuController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $user = auth()->user();
            $quanTri = DB::table('qlsv_nguoidungquantris')
                ->where('id_user', $user->id)
                ->get();

            if (count($quanTri) == 0) {
                exit;
            }
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $title = "Danh sách thời khoá biểu";
        $search = $request->get('search') ?? "";
        $lophoc = $request->get('lophoc') ?? "";
        $lopHoc = qlsv_lophoc::pluck('tenlophoc', 'id');
        if ($search == "" && $lophoc != "") {
            $thoiKhoaBieu = DB::table('qlsv_thoikhoabieus')
                ->where('id_lophoc', 'like', '%' . $lophoc . '%')
                ->get();
        }

        $thoiKhoaBieu = DB::table('qlsv_thoikhoabieus')
            ->where('id_lophoc', 'like', '%' . $lophoc . '%')
            ->where('deleted_at', 0)
            ->orderBy('ngayhoc', 'desc')
            ->get();
        return view('admin.ThoiKhoaBieu.dsthoikhoabieu', compact(['thoiKhoaBieu', 'title', 'lopHoc']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function creategiaovu()
    {
        $title = "Thêm mới thời khoá biểu giáo vụ";
        $phongHoc = DB::table('qlsv_phonghocs')->pluck('tenphonghoc', 'id');
        $lopHoc = DB::table('qlsv_lophocs')->pluck('tenlophoc', 'id');
        return view('admin.ThoiKhoaBieu.themthoikhoabieugiaovu', compact(['title', 'phongHoc', 'lopHoc']));
    }

    public function storegiaovu(Request $request)
    {
        $ngayhoc = $request->request->get("ngayhoc");
        $cahoc = $request->request->get("cahoc");
        $diadiemhoc = $request->request->get("diadiemhoc");
        $loinhanphongdaotao = $request->request->get("loinhanphongdaotao");
        for ($i = 0; $i < count($ngayhoc); $i++) {
            $thoiKhoaBieu = new qlsv_thoikhoabieu();
            if ($ngayhoc[$i] != null) {
                $thoiKhoaBieu->ngayhoc = $ngayhoc[$i];
                $thoiKhoaBieu->cahoc = $cahoc[$i];
                $thoiKhoaBieu->diadiemhoc = $diadiemhoc[$i];
                $thoiKhoaBieu->loinhanphongdaotao = $loinhanphongdaotao[$i];
                $thoiKhoaBieu->id_lophoc = $request->id_lophoc;
                $thoiKhoaBieu->deleted_at = "0";
                $thoiKhoaBieu->save();
            }
        }
        return redirect()->route('qlsv_thoikhoabieu.creategiaovu');
    }

    public function create()
    {
        $title = "Thêm mới thời khoá biểu";
        $phongHoc = DB::table('qlsv_phonghocs')->pluck('tenphonghoc', 'id');
        $workTask = DB::table('qlsv_worktasks')->pluck('tenworktask', 'id');
        return view('admin.ThoiKhoaBieu.themthoikhoabieu', compact(['title', 'phongHoc', 'workTask']));
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
        $thoiKhoaBieu = new qlsv_thoikhoabieu();
        $thoiKhoaBieu->buoithu = $request->buoithu;
        $thoiKhoaBieu->ngayhoc = $request->ngayhoc;
        $thoiKhoaBieu->cahoc = $request->cahoc;
        $thoiKhoaBieu->diadiemhoc = $request->diadiemhoc;
        $thoiKhoaBieu->giovao = $request->giovao;
        $thoiKhoaBieu->giobatdau = $request->giobatdau;
        $thoiKhoaBieu->danhgiagiovao = $request->danhgiagiovao;
        $thoiKhoaBieu->lydogiovao = $request->lydogiovao;
        $thoiKhoaBieu->giora = $request->giora;
        $thoiKhoaBieu->danhgiagiora = $request->danhgiagiora;
        $thoiKhoaBieu->lydogiora = $request->lydogiora;
        $thoiKhoaBieu->siso = $request->siso;
        $thoiKhoaBieu->thuchientot = $request->thuchientot;
        $thoiKhoaBieu->khonghieubai = $request->khonghieubai;
        $thoiKhoaBieu->loinhanphongdaotao = $request->loinhanphongdaotao;
        $thoiKhoaBieu->danhgiacuagiangvien = $request->danhgiacuagiangvien;
        $thoiKhoaBieu->loinhancuagiangvien = $request->loinhancuagiangvien;
        $thoiKhoaBieu->ghichu = $request->ghichu;
        $thoiKhoaBieu->id_worktask = $request->id_worktask;
        $thoiKhoaBieu->id_phonghoc = $request->id_phonghoc;

        $thoiKhoaBieu->nguoitao = "thanh";
        $thoiKhoaBieu->nguoisua = "thanh";
        $thoiKhoaBieu->deleted_at = "0";
        $thoiKhoaBieu->created_at = Carbon::now();
        $thoiKhoaBieu->save();
        return redirect()->route('qlsv_thoikhoabieu.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\qlsv_thoikhoabieu  $qlsv_thoikhoabieu
     * @return \Illuminate\Http\Response
     */
    public function show(qlsv_thoikhoabieu $qlsv_thoikhoabieu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\qlsv_thoikhoabieu  $qlsv_thoikhoabieu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Cập nhập thời khoá biểu";
        $thoiKhoaBieu = qlsv_thoikhoabieu::find($id);

        // dd($thoiKhoaBieu);
        $sinhVien = qlsv_sinhvien::pluck('hovaten', 'id');
        $workTask = qlsv_worktask::pluck('tenworktask', 'id');
        $phongHoc = qlsv_phonghoc::pluck('tenphonghoc', 'id');
        $lopHoc = qlsv_lophoc::pluck('tenlophoc', 'id');
        return view('admin.ThoiKhoaBieu.suathoikhoabieu', compact(['thoiKhoaBieu', 'sinhVien', 'lopHoc', 'workTask', 'phongHoc', 'title']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\qlsv_thoikhoabieu  $qlsv_thoikhoabieu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $thoiKhoaBieu = qlsv_thoikhoabieu::find($id);
        $thoiKhoaBieuEdit = $request->all();
        $thoiKhoaBieu->update(["updated_at" => Carbon::now()]);
        $thoiKhoaBieu->update($thoiKhoaBieuEdit);
        return redirect()->route('qlsv_thoikhoabieu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\qlsv_thoikhoabieu  $qlsv_thoikhoabieu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $thoiKhoaBieu = DB::table('qlsv_thoikhoabieus')->where('id', $id)->update(["deleted_at" => "1", "updated_at" => Carbon::now()]);
        return redirect()->route('qlsv_thoikhoabieu.index');
    }

    public function thoikhoabieu(Request $request, $id)
    {
        $title = "Danh sách lớp học";
        $search = $request->get('search') ?? "";
        $lophoc1 = qlsv_lophoc::find($id);
        $lopHoc = qlsv_lophoc::pluck('tenlophoc', 'id');
        $thoiKhoaBieu = DB::table('qlsv_thoikhoabieus')
            ->join('qlsv_lophocs', 'qlsv_thoikhoabieus.id_lophoc', '=', 'qlsv_lophocs.id')
            ->where('qlsv_lophocs.id', $id)
            ->where('qlsv_thoikhoabieus.deleted_at', 0)
            ->orderBy('qlsv_thoikhoabieus.ngayhoc', 'desc')
            ->select('qlsv_thoikhoabieus.id', 'qlsv_thoikhoabieus.id_lophoc', 'qlsv_thoikhoabieus.ngayhoc')
            ->groupBy('qlsv_thoikhoabieus.id')
            ->get();
            return view('admin.ThoiKhoaBieu.dsthoikhoabieu', compact(['lophoc1','thoiKhoaBieu','lopHoc','title','search']));
    }
}
