<?php

namespace App\Http\Controllers\SinhVien;

use App\Http\Controllers\Controller;
use App\qlsv_lophoc;
use App\qlsv_sinhvien;
use App\qlsv_sinhvienlophoc;
use App\qlsv_thoikhoabieu;
use App\qlsv_tudanhgia;
use App\qlsv_tudanhgiasinhvienlophoc;
use App\qlsv_xinnghi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManhinhSinhvienController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $user = auth()->user();
            $sinhVien = DB::table('qlsv_sinhviens')
                ->where('id_user', $user->id)
                ->get();

            if (count($sinhVien) == 0) {
                exit;
            }

            return $next($request);
        });
    }


    public function index(Request $request)
    {
        $user = auth()->user();
        $sinhVien = DB::table('qlsv_sinhviens')
            ->where('id_user', $user->id)
            ->get()[0];
        // $tenSv = explode(' ', $sinhVien->hovaten);
        // $title = "Xin chào " . $tenSv[count($tenSv) - 1];
        $title = "Xin chào: " . $sinhVien->hovaten;

        return view('ManHinhSinhVien.index', compact(['title']));
    }

    public function trangthongbao()
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
        return view('ManHinhSinhVien.trangthongbao', compact(['title', 'thongBao']));
    }

    public function trangchu(Request $request)
    {
        $user = auth()->user();
        $sinhVien = DB::table('qlsv_sinhviens')
            ->where('id_user', $user->id)
            ->get()[0];
        // $tenSv = explode(' ', $sinhVien->hovaten);
        // dd($tenSv);
        // $title = "Xin chào " . $tenSv[count($tenSv) - 1];
        $title = "Xin chào: " . $sinhVien->hovaten;
        // dd($title);
        // dd($sinhVien);
        DB::enableQueryLog();
        $lopHoc = DB::table('qlsv_sinhvienlophocs')
            ->where('id_sinhvien', $sinhVien->id)
            ->orderByDesc('id')
            ->groupBy('qlsv_sinhvienlophocs.id_lophoc')
            ->select(
                'qlsv_lophocs.id_monhoc',
                'qlsv_sinhvienlophocs.*',
                DB::raw('(select id from qlsv_thoikhoabieus 
            where qlsv_thoikhoabieus.id_lophoc = qlsv_sinhvienlophocs.id_lophoc order by case when ngayhoc >= \'' .
                    Carbon::now()->format("Y-m-d") .
                    '\' then 0 else 1 end,case when ngayhoc <= \'' . Carbon::now()->format("Y-m-d") .
                    ' 23:59:59\' then 0 else 1 end desc, id limit 1) as id_thoikhoabieu ')
            )
            ->join('qlsv_lophocs', 'qlsv_lophocs.id', '=', 'qlsv_sinhvienlophocs.id_lophoc')
            ->get();
        // dd(DB::getQueryLog());
        // dd($lopHoc);
        return view('ManHinhSinhVien.trangchu', compact(['title', 'lopHoc', 'sinhVien']));
    }


    public function viewdiemthi(Request $request)
    {
        $user = auth()->user();
        $sinhVien = DB::table('qlsv_sinhviens')
            ->where('id_user', $user->id)
            ->get()[0];

        $title = "Điểm Thi";
        $idlop = $request->get('id_lophoc');

        $qlsv_lophoc = qlsv_lophoc::find($idlop);
        $id_thoikhoabieu = $request->get('id_thoikhoabieu');
        $thoiKhoaBieu = qlsv_thoikhoabieu::find($id_thoikhoabieu);
        $findThoiKhoaBieu = qlsv_thoikhoabieu::find($id_thoikhoabieu);
        DB::enableQueryLog();

        $qlsv_sinhvienlophoc = DB::table('qlsv_sinhvienlophocs')
            ->join('qlsv_sinhviens', 'qlsv_sinhviens.id', '=', 'qlsv_sinhvienlophocs.id_sinhvien')
            ->leftJoin('qlsv_diemthis', 'qlsv_diemthis.id_sinhvienlophoc', '=', 'qlsv_sinhvienlophocs.id')
            ->where('qlsv_sinhvienlophocs.id_lophoc', $idlop)
            ->where('qlsv_sinhviens.deleted_at', 0)
            ->select('qlsv_sinhviens.hovaten', 'qlsv_sinhvienlophocs.id', 'qlsv_diemthis.diemthuchanh', 'qlsv_diemthis.diemlythuyet')
            ->get();
        // dd(DB::getQueryLog());

        // dd($qlsv_sinhvienlophoc);
        return view('ManHinhSinhVien.viewdiemthi', compact(
            ['title', 'idlop', 'qlsv_lophoc', 'thoiKhoaBieu', 'id_thoikhoabieu', 'findThoiKhoaBieu', 'qlsv_sinhvienlophoc']
        ));
    }

    public function viewdanhgia(Request $request)
    {
        $user = auth()->user();
        $sinhVien = DB::table('qlsv_sinhviens')
            ->where('id_user', $user->id)
            ->get()[0];

        $title = "Tự đánh giá";
        $idlop = $request->get('id_lophoc');
        $idsinhvien = $request->get('id_sinhvien');
        $idmonhoc = $request->get('id_monhoc');

        $qlsv_sinhvien = qlsv_sinhvien::find($idsinhvien);
        $qlsv_lophoc = qlsv_lophoc::find($idlop);

        DB::enableQueryLog();
        $qlsv_tudanhgiasinhvienlophocs = DB::table('qlsv_tudanhgias')
            // ->leftJoin('qlsv_tudanhgiasinhvienlophocs','qlsv_tudanhgiasinhvienlophocs.id_tudanhgia','=','qlsv_tudanhgias.id')
            ->where('qlsv_tudanhgias.id_monhoc', $idmonhoc)
            ->select('qlsv_tudanhgias.id as id_tdg', 'qlsv_tudanhgias.tieude', 'qlsv_tudanhgias.cauhoi')
            ->get();
        // dd(DB::getQueryLog());

        return view('ManHinhSinhVien.viewdanhgia', compact(['qlsv_sinhvien', 'idlop', 'title', 'qlsv_lophoc', 'qlsv_tudanhgiasinhvienlophocs']));
    }

    public function viewdiemdanh(Request $request)
    {
        $user = auth()->user();
        $title = "Nhật ký điểm danh";
        $idlop = $request->get('id_lophoc');
        $idsinhvien = $request->get('id_sinhvien');
        $id_thoikhoabieu = $request->get('id_thoikhoabieu');
        $findThoiKhoaBieu = qlsv_thoikhoabieu::find($id_thoikhoabieu);
        $qlsv_lophoc = qlsv_lophoc::find($idlop);

        DB::enableQueryLog();
        $qlsv_sinhvienlophoc = DB::table('qlsv_diemdanhs')
            ->select('qlsv_sinhvienlophocs.id_sinhvien', 'qlsv_diemdanhs.denlop', 'qlsv_thoikhoabieus.id_Lophoc', 'qlsv_thoikhoabieus.id', 'qlsv_thoikhoabieus.ngayhoc')
            ->join('qlsv_thoikhoabieus', 'qlsv_thoikhoabieus.id', '=', 'qlsv_diemdanhs.id_thoikhoabieu')
            ->leftJoin('qlsv_sinhvienlophocs', 'qlsv_sinhvienlophocs.id', '=', 'qlsv_diemdanhs.id_sinhvienlophoc')
            ->where('qlsv_sinhvienlophocs.id_sinhvien', $idsinhvien)
            ->where('qlsv_sinhvienlophocs.id_lophoc', $idlop)
            ->get();
        // dd(DB::getQueryLog());

        $vang = DB::table('qlsv_diemdanhs')
            ->selectRaw('count(qlsv_thoikhoabieus.cahoc) as vang')
            ->join('qlsv_thoikhoabieus', 'qlsv_thoikhoabieus.id', '=', 'qlsv_diemdanhs.id_thoikhoabieu')
            ->leftJoin('qlsv_sinhvienlophocs', 'qlsv_sinhvienlophocs.id', '=', 'qlsv_diemdanhs.id_sinhvienlophoc')
            ->where('qlsv_sinhvienlophocs.id_sinhvien', $idsinhvien)
            ->where('qlsv_sinhvienlophocs.id_lophoc', $idlop)
            ->where('qlsv_diemdanhs.denlop', '>', 1)
            ->get();

        // dd(DB::getQueryLog());
        return view('ManHinhSinhVien.viewdiemdanh', compact(['vang', 'findThoiKhoaBieu', 'id_thoikhoabieu', 'title', 'idlop', 'qlsv_lophoc', 'qlsv_sinhvienlophoc']));
    }

    public function chonlop(Request $request)
    {
        $title = "Xin nghỉ phép";
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
        return view('ManHinhSinhVien.chonlop', compact(['title', 'user', 'lopHoc']));
    }

    public function viewxinnghi(Request $request)
    {
        $user = auth()->user();
        $title = "Xin nghỉ phép";
        $idlop = $request->get('id_lophoc');
        $idsinhvien = $request->get('id_sinhvien');
        $qlsv_lophoc = qlsv_lophoc::find($idlop);
        $qlsv_sinhvien = qlsv_sinhvien::find($idsinhvien);

        $id_thoikhoabieu = $request->get('id_thoikhoabieu');
        $findThoiKhoaBieu = qlsv_thoikhoabieu::find($id_thoikhoabieu);
        if ($idlop != $findThoiKhoaBieu->id_lophoc) {
            exit;
        }

        $thoiKhoaBieu = DB::table('qlsv_thoikhoabieus')->where('id_lophoc', $idlop)
            ->select(DB::raw("concat(ngayhoc ,' - ' , case when cahoc=1 then 'Sáng' when cahoc=2 then 'Chiều' when cahoc=3 then 'Tối' end) as ngayhoc, id"))
            ->pluck('ngayhoc', 'id');

        DB::enableQueryLog();
        $qlsv_sinhvienlophoc = DB::table('qlsv_xinnghis')
            ->select('qlsv_sinhvienlophocs.id_sinhvien', 'qlsv_sinhvienlophocs.id_Lophoc', 'qlsv_xinnghis.id_sinhvienlophoc')
            ->join('qlsv_sinhvienlophocs', 'qlsv_sinhvienlophocs.id', '=', 'qlsv_xinnghis.id_sinhvienlophoc')
            ->where('qlsv_sinhvienlophocs.id_sinhvien', $idsinhvien)
            ->where('qlsv_sinhvienlophocs.id_lophoc', $idlop)
            ->get();
        // dd(DB::getQueryLog());
        return view('ManHinhSinhVien.viewxinnghi', compact(['id_thoikhoabieu', 'qlsv_sinhvien', 'title', 'idlop', 'qlsv_lophoc', 'qlsv_sinhvienlophoc', 'thoiKhoaBieu']));
    }

    public function storexinnghi(Request $request)
    {
        $idlop = $request->get('id_lophoc');
        $idsinhvien = $request->get('id_sinhvien');

        $ngayhoc =  $request['ngayhoc'];

        $sinhVienLopHoc = DB::table('qlsv_sinhvienlophocs')
            ->where('id_lophoc', $idlop)
            ->where('id_sinhvien', $idsinhvien)
            ->get()[0];

        $xinNghi = DB::table('qlsv_xinnghis')
            ->where('id_sinhvienlophoc', '=', $sinhVienLopHoc->id)
            ->where('id_thoikhoabieu', '=', $ngayhoc)
            ->get();

        $xinNghi = new qlsv_xinnghi();
        $xinNghi->id_thoikhoabieu = $ngayhoc;
        $xinNghi->noidung = $request->noidung;
        $xinNghi->lydo = $request->lydo;
        $xinNghi->id_sinhvienlophoc = $sinhVienLopHoc->id;
        $user = auth()->user();
        $xinNghi->nguoitao = $user->name;
        $xinNghi->created_at = Carbon::now("Asia/Ho_Chi_Minh");
        $xinNghi->deleted_at = "0";
        $xinNghi->save();
        return redirect()->route('sinh_vien.index');
    }

    public function storedanhgia(Request $request)
    {
        $idlop = $request->get('id_lophoc');
        $idsinhvien = $request->get('id_sinhvien');

        $sinhVienLopHoc = DB::table('qlsv_sinhvienlophocs')
            ->where('id_lophoc', $idlop)
            ->where('id_sinhvien', $idsinhvien)
            ->get()[0];

        $cautraloi = $request->request->get("cautraloi");
        $id_tudanhgia = $request->request->get("id_tudanhgia");
        for ($i = 0; $i < count($id_tudanhgia); $i++) {
            $tudanhgiasvlh = new qlsv_tudanhgiasinhvienlophoc();
            if ($id_tudanhgia[$i] != null) {
                $tudanhgiasvlh->cautraloi = $cautraloi[$i];
                $tudanhgiasvlh->id_tudanhgia = $id_tudanhgia[$i];
                $tudanhgiasvlh->id_sinhvienlophoc = $sinhVienLopHoc->id;
                $user = auth()->user();
                $tudanhgiasvlh->nguoitao = $user->name;
                $tudanhgiasvlh->created_at = Carbon::now("Asia/Ho_Chi_Minh");
                $tudanhgiasvlh->deleted_at = "0";
                $tudanhgiasvlh->save();
            }
        }
        return redirect()->route('sinh_vien.trangchu');
    }
}
