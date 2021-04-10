<?php

namespace App\Http\Controllers\QuanTri;

use App\Http\Controllers\Controller;
use App\qlsv_lophoc;
use App\qlsv_monhoc;
use App\qlsv_sinhvienlophoc;
use App\qlsv_thongbao;
use App\qlsv_thongbaonoinguoinhans;
use App\qlsv_tudanhgiasinhvienlophoc;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManhinhQuantriController extends Controller
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

    public function viewdiemthi(Request $request)
    {
        $title = "Điểm thi";

        $search = $request->get('search') ?? "";
        $lopHoc = DB::table('qlsv_lophocs')->pluck('tenlophoc', 'id');

        DB::enableQueryLog();
        $diemThi = DB::table('qlsv_diemthis')
            ->join('qlsv_sinhvienlophocs', 'qlsv_sinhvienlophocs.id', 'qlsv_diemthis.id_sinhvienlophoc')
            ->select('qlsv_diemthis.ngaychodiem', 'qlsv_diemthis.ghichu', 'qlsv_sinhvienlophocs.id_lophoc', 'qlsv_sinhvienlophocs.id_sinhvien', 'qlsv_diemthis.diemlythuyet', 'qlsv_diemthis.diemthuchanh')
            ->get();
        return view('ManHinhQuanTri.viewdiemthi', compact(['title', 'diemThi', 'lopHoc', 'search']));
    }

    public function viewdanhgia(Request $request)
    {
        $title = "Đánh giá";

        $lopHoc = DB::table('qlsv_lophocs')->pluck('tenlophoc', 'id');

        DB::enableQueryLog();
        $danhGia = DB::table('qlsv_tudanhgiasinhvienlophocs')
            ->join('qlsv_sinhvienlophocs', 'qlsv_sinhvienlophocs.id', 'qlsv_tudanhgiasinhvienlophocs.id_sinhvienlophoc')
            ->join('qlsv_tudanhgias', 'qlsv_tudanhgias.id', 'qlsv_tudanhgiasinhvienlophocs.id_tudanhgia')
            ->orderBy('qlsv_sinhvienlophocs.id_lophoc', 'desc')
            ->select('qlsv_tudanhgias.id_monhoc', 'qlsv_tudanhgias.tieude', 'qlsv_tudanhgias.cauhoi', 'qlsv_sinhvienlophocs.id_lophoc', 'qlsv_sinhvienlophocs.id_sinhvien', 'qlsv_tudanhgiasinhvienlophocs.cautraloi')
            ->paginate(10);
        return view('ManHinhQuanTri.viewdanhgia', compact(['title', 'danhGia', 'lopHoc']));
    }

    public function searchdiemthi(Request $request)
    {
        $title = "Điểm thi";
        $lopHoc = DB::table('qlsv_lophocs')->pluck('tenlophoc', 'id');
        $searchlop = $request->input('searchlop');

        $diemThi  = qlsv_sinhvienlophoc::where('id_lophoc', 'like', '%' . $searchlop . '%')
            ->join('qlsv_diemthis', 'qlsv_diemthis.id_sinhvienlophoc', '=', 'qlsv_sinhvienlophocs.id')
            ->select('qlsv_diemthis.diemlythuyet', 'qlsv_diemthis.ghichu', 'qlsv_sinhvienlophocs.id_sinhvien', 'qlsv_sinhvienlophocs.id_lophoc', 'qlsv_diemthis.diemthuchanh')
            ->get();
        return view('ManHinhQuanTri.viewdiemthi', compact(['searchlop', 'diemThi', 'lopHoc', 'title']));
    }

    public function searchdanhgia(Request $request)
    {
        $title = "Đánh giá";
        $lopHoc = DB::table('qlsv_lophocs')->pluck('tenlophoc', 'id');
        $searchlop = $request->input('searchlop');

        $danhGia  = qlsv_tudanhgiasinhvienlophoc::where('id_lophoc', 'like', '%' . $searchlop . '%')
            ->join('qlsv_sinhvienlophocs', 'qlsv_sinhvienlophocs.id', '=', 'qlsv_tudanhgiasinhvienlophocs.id_sinhvienlophoc')
            ->join('qlsv_tudanhgias', 'qlsv_tudanhgias.id', '=', 'qlsv_tudanhgiasinhvienlophocs.id_tudanhgia')
            ->select('qlsv_tudanhgias.id_monhoc', 'qlsv_tudanhgias.tieude', 'qlsv_tudanhgias.cauhoi', 'qlsv_sinhvienlophocs.id_lophoc', 'qlsv_sinhvienlophocs.id_sinhvien', 'qlsv_tudanhgiasinhvienlophocs.cautraloi')
            ->orderBy('qlsv_sinhvienlophocs.id_sinhvien', 'desc')
            ->paginate(10);
        return view('ManHinhQuanTri.viewdanhgia', compact(['searchlop', 'danhGia', 'lopHoc', 'title']));
    }

    public function trangchu(Request $request)
    {
        $user = auth()->user();
        $quanTri = DB::table('qlsv_nguoidungquantris')
            ->where('id_user', $user->id)
            ->get()[0];

        // dd($quanTri);
        $tenQt = explode(' ', $quanTri->ten);
        $title = "Xin chào: " . $tenQt[count($tenQt) - 1];
        DB::enableQueryLog();

        return view('ManHinhQuanTri.trangchu', compact(['title']));
    }

    public function index()
    {
        $title = "Thông báo";
        $user = auth()->user();
        $thongBao = DB::table('qlsv_thongbaos')
            ->join('qlsv_thongbaonoinguoinhans', 'qlsv_thongbaos.id', '=', 'qlsv_thongbaonoinguoinhans.id_thongbao')
            ->where('qlsv_thongbaos.deleted_at', '=', '0')
            ->where('qlsv_thongbaonoinguoinhans.deleted_at', '=', '0')
            ->where('qlsv_thongbaonoinguoinhans.id_nguoinhan', '=', $user->id)
            ->orderBy('qlsv_thongbaos.id', 'desc')
            ->select('qlsv_thongbaos.id', 'qlsv_thongbaos.tieude', 'qlsv_thongbaos.noidung', 'qlsv_thongbaos.nguoitao', 'qlsv_thongbaos.created_at')
            ->get();
        return view('ManHinhQuanTri.index', compact(['title', 'thongBao']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createDaoTao()
    {
        $title = "Thêm mới thông báo";
        $thongBao = DB::table('qlsv_thongbaos')
            ->get();
        return view('ManHinhQuanTri.createDaoTao', compact(['title', 'thongBao']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sent(Request $request)
    {
        $title = "Thông báo đã gửi";
        $user = auth()->user();
        $thongBao = DB::table('qlsv_thongbaos')
            ->where('qlsv_thongbaos.deleted_at', '=', '0')
            ->where('qlsv_thongbaos.id_nguoitao', '=', $user->id)
            ->orderBy('qlsv_thongbaos.id', 'desc')
            ->select('qlsv_thongbaos.id', 'qlsv_thongbaos.tieude', 'qlsv_thongbaos.noidung', 'qlsv_thongbaos.nguoitao', 'qlsv_thongbaos.created_at')
            ->get();
        return view('ManHinhQuanTri.sentthongbao', compact(['title', 'thongBao']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\qlsv_thongbao  $qlsv_thongbao
     * @return \Illuminate\Http\Response
     */
    public function createDaoTaoGiangVien(Request $request)
    {
        $title = "Tạo thông báo";
        $giangVien = DB::table('qlsv_giangviens')
            ->orderBy('hovaten')
            ->where('deleted_at', '0')
            ->get();
        return view('ManHinhQuanTri.createDaoTaoGiangVien', compact(['title', 'giangVien']));
    }

    public function createDaoTaoSinhVien(Request $request)
    {
        $title = "Tạo thông báo";
        $search = $request->get('search') ?? "";

        $sinhVien = DB::table('qlsv_sinhviens')
            ->orderBy('hovaten')
            ->where('hovaten', 'like', '%' . $search . '%')
            ->where('deleted_at', '0')
            ->select('id_khoahoc', 'hovaten', 'id_user', 'id')
            ->get();
        $khoaHoc = DB::table('qlsv_khoahocs')->pluck('tenkhoahoc', 'id');
        return view('ManHinhQuanTri.createDaoTaoSinhVien', compact(['title', 'sinhVien', 'khoaHoc', 'search']));
    }

    public function storeDaoTaoSinhVien(Request $request)
    {
        $users = auth()->user();
        $thongBao = new qlsv_thongbao();
        $thongBao->tieude = $request->tieude;
        $thongBao->noidung = $request->noidung;
        $thongBao->id_nguoitao = $users->id;
        $thongBao->nguoitao = $users->name;
        $thongBao->deleted_at = 0;
        $thongBao->created_at = Carbon::now();
        $thongBao->save();

        $iduser = $request->id_user;
        for ($i = 0; $i < count($iduser); $i++) {
            $sinhVien = new qlsv_thongbaonoinguoinhans();
            $sinhVien->id_thongbao = $thongBao->id;
            $sinhVien->id_nguoinhan = $iduser[$i];
            $sinhVien->nguoitao = $users->name;
            $sinhVien->deleted_at = 0;
            $sinhVien->created_at = Carbon::now();
            $sinhVien->save();
        }
        return redirect('/quan_tri/sent');
    }

    public function storeDaoTaoGiangVien(Request $request)
    {
        $users = auth()->user();

        $thongBao = new qlsv_thongbao();
        $thongBao->tieude = $request->tieude;
        $thongBao->noidung = $request->noidung;

        $thongBao->id_nguoitao = $users->id;
        $thongBao->nguoitao = $users->name;
        $thongBao->deleted_at = 0;
        $thongBao->created_at = Carbon::now();
        $thongBao->save();

        $iduser = $request->id_user;
        for ($i = 0; $i < count($iduser); $i++) {
            $giangVien = new qlsv_thongbaonoinguoinhans();
            $giangVien->id_thongbao = $thongBao->id;
            $giangVien->id_nguoinhan = $iduser[$i];
            $giangVien->nguoitao = $users->name;
            $giangVien->deleted_at = 0;
            $giangVien->created_at = Carbon::now();
            $giangVien->save();
        }

        return redirect('/quan_tri/sent');
    }

    public function createDaoTaoLop(Request $request)
    {
        $title = "Tạo thông báo";
        $lopHoc = DB::table('qlsv_lophocs')
            ->orderBy('tenlophoc')
            ->where('deleted_at', '0')
            ->get();
        return view('ManHinhQuanTri.createDaoTaoLop', compact(['title', 'lopHoc']));
    }

    public function createDaoTaoKhoa(Request $request)
    {
        $title = "Tạo thông báo";
        $khoaHoc = DB::table('qlsv_khoahocs')
            ->orderBy('tenkhoahoc')
            ->where('deleted_at', '0')
            ->get();
        return view('ManHinhQuanTri.createDaoTaoKhoa', compact(['title', 'khoaHoc']));
    }

    public function storeDaoTaoLop(Request $request)
    {

        $users = auth()->user();

        $thongBao = new qlsv_thongbao();
        $thongBao->tieude = $request->tieude;
        $thongBao->noidung = $request->noidung;

        $thongBao->id_nguoitao = $users->id;
        $thongBao->nguoitao = $users->name;
        $thongBao->deleted_at = 0;
        $thongBao->created_at = Carbon::now();
        $thongBao->save();

        $idlop = $request->id;
        for ($i = 0; $i < count($idlop); $i++) {
            $danhSachSV = DB::table('qlsv_lophocs')
                ->join('qlsv_sinhvienlophocs', 'qlsv_sinhvienlophocs.id_lophoc', '=', 'qlsv_lophocs.id')
                ->join('qlsv_sinhviens', 'qlsv_sinhviens.id', '=', 'qlsv_sinhvienlophocs.id_sinhvien')
                ->where('qlsv_lophocs.deleted_at', '0')
                ->where('qlsv_sinhviens.deleted_at', '0')
                ->where('qlsv_lophocs.id', $idlop[$i])
                ->select('qlsv_sinhviens.id_user')
                ->get();
            foreach ($danhSachSV as $value) {
                $nguoiNhanSV = new qlsv_thongbaonoinguoinhans();
                $nguoiNhanSV->id_thongbao = $thongBao->id;
                $nguoiNhanSV->id_nguoinhan = $value->id_user;
                $nguoiNhanSV->nguoitao = $users->name;
                $nguoiNhanSV->deleted_at = 0;
                $nguoiNhanSV->created_at = Carbon::now();
                $nguoiNhanSV->save();
            }
        }
        return redirect('/quan_tri/sent');
    }

    public function storeDaoTaoKhoa(Request $request)
    {
        $users = auth()->user();
        $thongBao = new qlsv_thongbao();
        $thongBao->tieude = $request->tieude;
        $thongBao->noidung = $request->noidung;
        $thongBao->id_nguoitao = $users->id;
        $thongBao->nguoitao = $users->name;
        $thongBao->deleted_at = 0;
        $thongBao->created_at = Carbon::now();
        $thongBao->save();

        $idkhoa = $request->id;
        for ($i = 0; $i < count($idkhoa); $i++) {
            $danhSachSV = DB::table('qlsv_khoahocs')
                ->join('qlsv_sinhviens', 'qlsv_sinhviens.id_khoahoc', '=', 'qlsv_khoahocs.id')
                ->where('qlsv_khoahocs.deleted_at', '0')
                ->where('qlsv_sinhviens.deleted_at', '0')
                ->where('qlsv_khoahocs.id', $idkhoa[$i])
                ->select('qlsv_sinhviens.id_user')
                ->get();
            foreach ($danhSachSV as $value) {
                $nguoiNhanSV = new qlsv_thongbaonoinguoinhans();
                $nguoiNhanSV->id_thongbao = $thongBao->id;
                $nguoiNhanSV->id_nguoinhan = $value->id_user;
                $nguoiNhanSV->nguoitao = $users->name;
                $nguoiNhanSV->deleted_at = 0;
                $nguoiNhanSV->created_at = Carbon::now();
                $nguoiNhanSV->save();
            }
        }
        return redirect('/quan_tri/sent');
    }

    public function search(Request $request)
    {
        $title = "Tạo thông báo";
        $khoaHoc = DB::table('qlsv_khoahocs')->pluck('tenkhoahoc', 'id');
        $search = $request->input('search');
        $searchkh = $request->input('searchkh');

        if ($search == "" && $searchkh != "") {
            $sinhVien = DB::table('qlsv_sinhviens')
                ->where('id_khoahoc', 'like', '%' . $searchkh . '%')
                ->get();
            return view('ManHinhQuanTri.createDaoTaoSinhVien', compact(['search', 'searchkh', 'khoaHoc', 'sinhVien', 'title']));
        } else {
            if ($search != "" && $searchkh != "") {
                $sinhVien = DB::table('qlsv_sinhviens')
                    ->where('hovaten', 'like', '%' . $search . '%')
                    ->where('id_khoahoc', 'like', '%' . $searchkh . '%')
                    ->get();
                return view('ManHinhQuanTri.createDaoTaoSinhVien', compact(['search', 'searchkh', 'khoaHoc', 'sinhVien', 'title']));
            } else {
                $sinhVien = DB::table('qlsv_sinhviens')
                    ->where('hovaten', 'like', '%' . $search . '%')
                    ->get();
                return view('ManHinhQuanTri.createDaoTaoSinhVien', compact(['search', 'searchkh', 'sinhVien', 'khoaHoc', 'title']));
            }
        }

        $sinhVien  = qlsv_sinhvien::where('hovaten', 'like', '%' . $search . '%')
            ->orWhere('id_khoahoc', 'like', '%' . $searchkh . '%')
            ->get();
        return view('ManHinhQuanTri.createDaoTaoSinhVien', compact(['search', 'searchkh', 'sinhVien', 'khoaHoc', 'title']));
    }

    public function chonlophoc(Request $request)
    {
        $title = "Chọn lớp học";

        DB::enableQueryLog();
        $lopHoc = DB::table('qlsv_lophocs')
            ->join('qlsv_khoahocs', 'qlsv_khoahocs.id', '=', 'qlsv_lophocs.id_khoahoc')
            ->select('qlsv_khoahocs.tenkhoahoc', 'qlsv_lophocs.id as id_lophoc','qlsv_lophocs.tenlophoc','qlsv_lophocs.id_giangvien','qlsv_lophocs.id_monhoc')
            ->get();
        // dd(DB::getQueryLog());
        return view('ManHinhQuanTri.chonlophoc', compact(['title','lopHoc']));
    }

    public function viewsinhvienlophoc(Request $request)
    {
        $title = "Danh sách sinh viên";
        $idlop = $request->get('id_lophoc');
        $id_monhoc = $request->get('id_monhoc');

        $qlsv_lophoc = qlsv_lophoc::find($idlop);
        $lqsv_monhoc = qlsv_monhoc::find($id_monhoc);
     
        DB::enableQueryLog();
        $qlsv_sinhvienlophoc = DB::table('qlsv_lophocs')
            ->join('qlsv_sinhvienlophocs', 'qlsv_sinhvienlophocs.id_lophoc', '=', 'qlsv_lophocs.id')
            ->where('qlsv_lophocs.id_monhoc', $id_monhoc)
            ->select('qlsv_sinhvienlophocs.id_sinhvien', 'qlsv_lophocs.id_monhoc', 'qlsv_lophocs.tenlophoc')
            ->get();
        // dd(DB::getQueryLog());
        return view('ManHinhQuanTri.viewsinhvienlophoc', compact(['id_monhoc', 'title', 'idlop', 'qlsv_lophoc', 'qlsv_sinhvienlophoc']));
    }
}
