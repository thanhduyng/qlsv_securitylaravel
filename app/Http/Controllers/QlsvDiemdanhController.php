<?php

namespace App\Http\Controllers;

use App\qlsv_diemdanh;
use App\qlsv_lophoc;
use App\qlsv_sinhvien;
use App\qlsv_sinhvienlophoc;
use App\qlsv_thoikhoabieu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QlsvDiemdanhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = "Danh sách điểm danh";
        $search = $request->get('search') ?? "";
        $id_thoikhoabieu = $request->get('id_thoikhoabieu');
        $diemDanh = DB::table('qlsv_diemdanhs')->where('deleted_at', 0)->paginate(10);
        return view('admin.DiemDanh.dsdiemdanh', compact(['diemDanh', 'title']));
    }

    public function view(Request $request)
    {
        $title = "add điểm danh";
        $diemDanh = DB::select('SELECT sv.id_lophoc, sv.id_sinhvien, dd.id, dd.ngaydiemdanh, dd.denlop, dd.thuchanh, dd.kienthuc 
        FROM qlsv_diemdanhs as dd
        inner join qlsv_sinhvienlophocs as sv
        on dd.id_sinhvienlophoc = sv.id
        where sv.id_lophoc = 4');

        return view('admin.DiemDanh.viewdiemdanh', compact(['diemDanh', 'title']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showForm()
    {
        $title = "Thêm điểm danh";
        $lopHoc = qlsv_lophoc::all();
        // $sinhVien=qlsv_sinhvien::all();
        $sinhVien = DB::table('qlsv_sinhviens')->pluck('hovaten', 'id');
        return view('diemdanh', compact('lopHoc', 'title', 'sinhVien'));
    }

    public function add(Request $request)
    {
        $title = "Thêm điểm danh";
        $idlop = $request->get('id_lophoc');
        $id_thoikhoabieu = $request->get('id_thoikhoabieu');
        DB::enableQueryLog();
        $qlsv_sinhvienlophoc = DB::table('qlsv_sinhvienlophocs')
            ->join('qlsv_sinhviens', 'qlsv_sinhviens.id', '=', 'qlsv_sinhvienlophocs.id_sinhvien')
            ->leftJoin('qlsv_diemdanhs', function ($join) use ($id_thoikhoabieu) {
                $join->on('qlsv_diemdanhs.id_sinhvienlophoc', '=', 'qlsv_sinhvienlophocs.id')->on('qlsv_diemdanhs.id_thoikhoabieu', '=', DB::raw($id_thoikhoabieu));
            })
            ->where('qlsv_sinhvienlophocs.id_lophoc', $idlop)
            ->where('qlsv_sinhviens.deleted_at', 0)
            ->select('qlsv_sinhvienlophocs.id as id_svlh',  'qlsv_sinhviens.hovaten', 'qlsv_diemdanhs.*')
            ->get();

        // dd($qlsv_sinhvienlophoc);
        dd(DB::getQueryLog());
        $thoiKhoaBieu = DB::table('qlsv_thoikhoabieus')->pluck('ngayhoc', 'id');
        $qlsv_lophoc = qlsv_lophoc::find($idlop);
        // dd($qlsv_lophoc);

        return view('admin.DiemDanh.adddiemdanh', compact(
            ['idlop', 'thoiKhoaBieu', 'qlsv_sinhvienlophoc', 'qlsv_lophoc', 'title', 'id_thoikhoabieu']
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_sinhvienlophocs = $request['id_sinhvienlophoc'];

        $ngayhoc =  $request['ngayhoc'];

        $ghichu =  '';

        $idlop = $request['idlop'];

        for ($i = 0; $i < count($id_sinhvienlophocs); $i++) {
            $diemdanh = DB::table('qlsv_diemdanhs')
                ->where('id_sinhvienlophoc', '=', $id_sinhvienlophocs[$i])
                ->where('id_thoikhoabieu', '=', $ngayhoc)
                ->get();
            // dd($diemdanh);
            if (count($diemdanh) == 1) {
                $data = qlsv_diemdanh::find($diemdanh[0]->id);
                $data->denlop = $request[$id_sinhvienlophocs[$i] . '_denlop'] ?? 0;
                $data->kienthuc = $request[$id_sinhvienlophocs[$i] . '_kienthuc'] ?? 0;
                $data->thuchanh = $request[$id_sinhvienlophocs[$i] . '_thuchanh'] ?? 0;
                $data->ghichu = $ghichu;
                $data->id_thoikhoabieu = $ngayhoc;
                $data->save();
            } else {
                $data = new qlsv_diemdanh();
                $data->id_sinhvienlophoc = $id_sinhvienlophocs[$i];
                $data->denlop = $request[$id_sinhvienlophocs[$i] . '_denlop'] ?? 0;
                $data->kienthuc = $request[$id_sinhvienlophocs[$i] . '_kienthuc'] ?? 0;
                $data->thuchanh = $request[$id_sinhvienlophocs[$i] . '_thuchanh'] ?? 0;
                $data->ghichu = $ghichu;
                $data->id_thoikhoabieu = $ngayhoc;
                $data->save();
            }
        }

        return redirect()->route('qlsv_giangvien.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\qlsv_diemdanh  $qlsv_diemdanh
     * @return \Illuminate\Http\Response
     */
    public function show(qlsv_diemdanh $qlsv_diemdanh)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\qlsv_diemdanh  $qlsv_diemdanh
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Sửa điểm danh";
        $diemDanh = qlsv_diemdanh::find($id);
        $sinhVien = qlsv_sinhvien::all();
        $svLopHoc = DB::table('qlsv_sinhvienlophocs')->pluck('id_lophoc', 'id');
        $sinhVienLopHocs = qlsv_sinhvienlophoc::where('id', $id)->pluck('id_sinhvien', 'id');
        return view('admin.DiemDanh.suadiemdanh', compact(['diemDanh', 'sinhVien', 'title', 'svLopHoc', 'sinhVienLopHocs']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\qlsv_diemdanh  $qlsv_diemdanh
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $diemDanh = qlsv_diemdanh::find($id);
        $diemDanhEdit = $request->all();
        $diemDanh->update(["updated_at" => Carbon::now()]);
        $diemDanh->update($diemDanhEdit);
        return redirect()->route('qlsv_diemdanh.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\qlsv_diemdanh  $qlsv_diemdanh
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $diemDanh = DB::table('qlsv_diemdanhs')->where('id', $id)->update(["deleted_at" => "1", "updated_at" => Carbon::now()]);
        return redirect()->route('qlsv_diemdanh.index');
    }
}
