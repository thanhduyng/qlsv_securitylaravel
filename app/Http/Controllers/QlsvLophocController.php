<?php

namespace App\Http\Controllers;

use App\qlsv_giangvien;
use App\qlsv_khoahoc;
use App\qlsv_lophoc;
use App\qlsv_monhoc;
use App\qlsv_sinhvien;
use App\qlsv_sinhvienlophoc;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QlsvLophocController extends Controller
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
        $title = "Danh sách lớp học";
        $search = $request->get('search') ?? "";
        $lopHoc = DB::table('qlsv_lophocs')
            ->where('qlsv_lophocs.tenlophoc', 'like', '%' . $search . '%')
            ->where('deleted_at', 0)
            ->selectRaw('qlsv_lophocs.id, qlsv_lophocs.tenlophoc, qlsv_lophocs.id_giangvien, qlsv_lophocs.id_khoahoc, qlsv_lophocs.id_monhoc, count(qlsv_sinhvienlophocs.id_sinhvien) as soluongsv')
            ->join('qlsv_sinhvienlophocs', 'qlsv_sinhvienlophocs.id_lophoc', '=', 'qlsv_lophocs.id')
            ->groupBy('qlsv_lophocs.id')
            ->orderBy('qlsv_lophocs.created_at', 'DESC')
            ->paginate(10);
        return view('admin.LopHoc.dslophoc', compact(['lopHoc', 'title', 'search']));
    }

    public function create(Request $request)
    {
        $id = $request->id;
        if ($id > 0) {
            $title = "Cập nhập lớp học";
            $lopHoc = qlsv_lophoc::find($id);
        } else {
            $title = "Thêm mới lớp học";
            $lopHoc = new qlsv_lophoc();
        }

        $search = $request->get('search') ?? "";

        DB::enableQueryLog();
        $svlh = DB::table('qlsv_sinhvienlophocs')
            ->where('id_sinhvien', 'like', '%' . $search . '%');

        $sinhVienLopHoc = DB::table('qlsv_sinhvienlophocs')
            ->join('qlsv_sinhviens', 'qlsv_sinhviens.id', '=', 'qlsv_sinhvienlophocs.id_sinhvien')
            ->where('id_lophoc', $id)->select('qlsv_sinhviens.hovaten', 'qlsv_sinhviens.id')->pluck('hovaten', 'id');
        // dd(DB::getQueryLog());
        $giangVien = DB::table('qlsv_giangviens')->pluck('hovaten', 'id');
        $sinhVien = qlsv_sinhvien::all();
        $khoaHoc = DB::table('qlsv_khoahocs')->pluck('tenkhoahoc', 'id');
        $monHoc = DB::table('qlsv_monhocs')->pluck('tenmonhoc', 'id');
        return view('admin.LopHoc.addlophoc', compact(['svlh', 'sinhVienLopHoc', 'search', 'id', 'giangVien', 'sinhVien', 'khoaHoc', 'monHoc', 'lopHoc', 'title']));
    }

    public function search(Request $request)
    {
        $id = $request->id;
        if ($id > 0) {
            $title = "Cập nhập lớp học";
            $lopHoc = qlsv_lophoc::find($id);
        } else {
            $title = "Thêm lớp học";
            $lopHoc = new qlsv_lophoc();
        }
        $khoaHoc = DB::table('qlsv_khoahocs')->pluck('tenkhoahoc', 'id');
        $monHoc = DB::table('qlsv_monhocs')->pluck('tenmonhoc', 'id');
        $giangVien = DB::table('qlsv_giangviens')->pluck('hovaten', 'id');
        $sinhVienLopHoc = DB::table('qlsv_sinhvienlophocs')
            ->join('qlsv_sinhviens', 'qlsv_sinhviens.id', '=', 'qlsv_sinhvienlophocs.id_sinhvien')
            ->where('id_lophoc', $id)
            ->select('qlsv_sinhviens.hovaten', 'qlsv_sinhviens.id')
            ->pluck('hovaten', 'id');

        $search = $request->input('search');
        $searchkh = $request->input('searchkh');

        if ($search == "" && $searchkh != "") {
            $sinhVien = DB::table('qlsv_sinhviens')
                ->where('id_khoahoc', 'like', '%' . $searchkh . '%')
                ->get();
            return view('admin.LopHoc.addlophoc', compact(['search', 'searchkh', 'lopHoc', 'monHoc', 'giangVien', 'khoaHoc', 'id', 'sinhVienLopHoc', 'sinhVien', 'title']));
        } else {
            if ($search != "" && $searchkh != "") {
                $sinhVien = DB::table('qlsv_sinhviens')
                    ->where('hovaten', 'like', '%' . $search . '%')
                    ->where('id_khoahoc', 'like', '%' . $searchkh . '%')
                    ->get();
                return view('admin.LopHoc.addlophoc', compact(['search', 'searchkh', 'lopHoc', 'monHoc', 'giangVien', 'khoaHoc', 'id', 'sinhVienLopHoc', 'sinhVien', 'title']));
            } else {
                $sinhVien = DB::table('qlsv_sinhviens')
                    ->where('hovaten', 'like', '%' . $search . '%')
                    ->get();
                return view('admin.LopHoc.addlophoc', compact(['search', 'searchkh', 'lopHoc', 'monHoc', 'giangVien', 'khoaHoc', 'id', 'sinhVienLopHoc', 'sinhVien', 'title']));
            }
        }

        $sinhVien  = qlsv_sinhvien::where('hovaten', 'like', '%' . $search . '%')
            ->orWhere('id_khoahoc', 'like', '%' . $searchkh . '%')
            ->get();
        return view('admin.LopHoc.addlophoc', compact(['search', 'searchkh', 'lopHoc', 'monHoc', 'giangVien', 'khoaHoc', 'id', 'sinhVienLopHoc', 'sinhVien', 'title']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->id;
        if ($id > 0) {
            $lopHoc = qlsv_lophoc::find($id);
            $lopHoc->updated_at = Carbon::now();
        } else {
            $lopHoc = new qlsv_lophoc();
            $lopHoc->created_at = Carbon::now();
        }
        $lopHoc->id_giangvien = $request->id_giangvien;
        $lopHoc->id_khoahoc = $request->id_khoahoc;
        $lopHoc->tenlophoc = $request->tenlophoc;
        $lopHoc->id_monhoc = $request->id_monhoc;
        $lopHoc->nguoitao = "thanhduy";
        $lopHoc->nguoisua = "thanhduy";
        $lopHoc->deleted_at = "0";

        if ($lopHoc->save()) {
            $id_lophoc = $lopHoc->id;
            $id_sinhvien = $request->id_sinhvien;
            $sinhVienLopHoc = DB::table('qlsv_sinhvienlophocs')
                ->where('id_lophoc', $id_lophoc)->pluck('id', 'id_sinhvien');
            foreach ($id_sinhvien as $svs) {
                if (isset($sinhVienLopHoc[$svs])) {
                } else {
                    $sinhvienlophocs = new qlsv_sinhvienlophoc();
                    $sinhvienlophocs->id_lophoc = $id_lophoc;
                    $sinhvienlophocs->id_sinhvien = $svs;
                    $sinhvienlophocs->save();
                }
                unset($sinhVienLopHoc[$svs]);
            }
            foreach ($sinhVienLopHoc as $key => $value) {
                qlsv_sinhvienlophoc::deleted($value);
            }
        }
        return redirect()->route('qlsvlophoc.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\qlsv_lophoc  $qlsv_lophoc
     * @return \Illuminate\Http\Response
     */
    public function show(qlsv_lophoc $qlsv_lophoc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\qlsv_lophoc  $qlsv_lophoc
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Cập nhập lớp học";
        $lopHoc = qlsv_lophoc::find($id);
        $sinhVien = DB::table('qlsv_sinhviens')->pluck('hovaten', 'id');
        $giangVien = qlsv_giangvien::pluck('hovaten', 'id');
        $khoaHoc = qlsv_khoahoc::pluck('tenkhoahoc', 'id');
        $monHoc = qlsv_monhoc::pluck('tenmonhoc', 'id');
        return view('admin.LopHoc.sualophoc', compact(['lopHoc', 'sinhVien', 'giangVien', 'khoaHoc', 'monHoc', 'title']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\qlsv_lophoc  $qlsv_lophoc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lopHoc = qlsv_lophoc::find($id);
        $lopHocEdit = $request->all();
        $lopHoc->update(["updated_at" => Carbon::now()]);
        $lopHoc->update($lopHocEdit);
        return redirect()->route('qlsvlophoc.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\qlsv_lophoc  $qlsv_lophoc
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    {
        qlsv_lophoc::find($id)->delete($id);
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

}
