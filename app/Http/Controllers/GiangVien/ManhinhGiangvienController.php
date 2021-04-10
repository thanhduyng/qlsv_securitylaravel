<?php

namespace App\Http\Controllers\GiangVien;

use App\Http\Controllers\Controller;
use App\qlsv_diemdanh;
use App\qlsv_diemthi;
use App\qlsv_giangvien;
use App\qlsv_lophoc;
use App\qlsv_phonghoc;
use App\qlsv_thoikhoabieu;
use App\qlsv_thongbao;
use App\qlsv_thongbaonoinguoinhans;
use App\qlsv_worktask;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManhinhGiangvienController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $user = auth()->user();
            $giangVien = DB::table('qlsv_giangviens')
                ->where('id_user', $user->id)
                ->get();

            if (count($giangVien) == 0) {
                exit;
            }

            return $next($request);
        });
    }

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
        return view('ManHinhGiangVien.sentthongbao', compact(['title', 'thongBao']));
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
        return view('ManHinhGiangVien.index', compact(['title', 'thongBao']));
    }


    public function createGiangVienLop(Request $request)
    {
        $user = auth()->user();
        $giangVien = DB::table('qlsv_giangviens')
            ->where('id_user', $user->id)
            ->get()[0];

        $title = "Tạo thông báo";
        $lopHoc = DB::table('qlsv_lophocs')
            ->join('qlsv_giangviens', 'qlsv_giangviens.id', '=', 'qlsv_lophocs.id_giangvien')
            ->orderBy('qlsv_lophocs.tenlophoc')
            ->where('qlsv_lophocs.deleted_at', '0')
            ->where('qlsv_lophocs.id_giangvien', $giangVien->id)
            ->select('qlsv_lophocs.tenlophoc', 'qlsv_lophocs.id_giangvien', 'qlsv_lophocs.id')
            ->get();
        return view('ManHinhGiangVien.createGiangVienLop', compact(['title', 'lopHoc']));
    }

    public function storeGiangVienLop(Request $request)
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
        return redirect('/giang_vien/sent');
    }


    public function trangchu(Request $request)
    {
        $user = auth()->user();
        $giangVien = DB::table('qlsv_giangviens')
            ->where('id_user', $user->id)
            ->get()[0];

        // dd($giangVien);
        $tenGv = explode(' ', $giangVien->hovaten);
        $title = "Xin chào Thầy/Cô: " . $tenGv[count($tenGv) - 1];

        $lopHoc = DB::table('qlsv_lophocs')
        ->where('id_giangvien', $giangVien->id)
        ->orderByDesc('id')
        ->select('qlsv_lophocs.*')
        ->get();
        return view('ManHinhGiangVien.trangchu', compact(['title','lopHoc']));
    }

    public function tranglophoc(Request $request)
    {
        $user = auth()->user();
        $giangVien = DB::table('qlsv_giangviens')
            ->where('id_user', $user->id)
            ->get()[0];

        // dd($giangVien);
        $tenGv = explode(' ', $giangVien->hovaten);
        $title = "Xin chào Thầy/Cô: " . $tenGv[count($tenGv) - 1];
        DB::enableQueryLog();
        $lopHoc = DB::table('qlsv_lophocs')
            ->where('id_giangvien', $giangVien->id)
            ->orderByDesc('id')
            ->select(
                'qlsv_lophocs.*',
                DB::raw('(select id from qlsv_thoikhoabieus 
                where qlsv_thoikhoabieus.id_lophoc = qlsv_lophocs.id order by case when ngayhoc >= \'' . Carbon::now()->format("Y-m-d") .
                    '\' then 0 else 1 end,case when ngayhoc <= \'' . Carbon::now()->format("Y-m-d") .
                    ' 23:59:59\' then 0 else 1 end desc, id limit 1) as id_thoikhoabieu ')
            )
            ->get();
        // dd(DB::getQueryLog());
        // dd($lopHoc);
        return view('ManHinhGiangVien.tranglophoc', compact(['title', 'lopHoc']));
    }

    public function viewdiemdanh(Request $request)
    {
        $title = "Điểm Danh";
        $idlop = $request->get('id_lophoc');
        $id_thoikhoabieu = $request->get('id_thoikhoabieu');
        $findThoiKhoaBieu = qlsv_thoikhoabieu::find($id_thoikhoabieu);
        if ($idlop != $findThoiKhoaBieu->id_lophoc) {
            exit;
        }
        DB::enableQueryLog();
        $qlsv_sinhvienlophoc = DB::table('qlsv_sinhvienlophocs')
            ->join('qlsv_sinhviens', 'qlsv_sinhviens.id', '=', 'qlsv_sinhvienlophocs.id_sinhvien')
            ->leftJoin('qlsv_diemdanhs', function ($join) use ($id_thoikhoabieu) {
                $join->on('qlsv_diemdanhs.id_sinhvienlophoc', '=', 'qlsv_sinhvienlophocs.id')
                    ->on('qlsv_diemdanhs.id_thoikhoabieu', '=', DB::raw($id_thoikhoabieu));
            })
            ->where('qlsv_sinhvienlophocs.id_lophoc', $idlop)
            ->where('qlsv_sinhviens.deleted_at', 0)
            ->select('qlsv_sinhvienlophocs.id as id_svlh',  'qlsv_sinhviens.hovaten', 'qlsv_diemdanhs.*')
            ->get();
        // dd($qlsv_sinhvienlophoc);
        // dd(DB::getQueryLog());

        $thoiKhoaBieu = DB::table('qlsv_thoikhoabieus')->where('id_lophoc', $idlop)
            ->select(DB::raw("concat(ngayhoc ,' - ' , case when cahoc=1 then 'Sáng' when cahoc=2 then 'Chiều' when cahoc=3 then 'Tối' end) as ngayhoc, id"))
            ->pluck('ngayhoc', 'id');
        // dd($thoiKhoaBieu);

        $isSubmit = 0;
        $ngayhoc = qlsv_thoikhoabieu::find($id_thoikhoabieu)->ngayhoc;
        if ($ngayhoc <> date("Y-m-d")) {
            $isSubmit = 1;
        }

        $qlsv_lophoc = qlsv_lophoc::find($idlop);
        $user = auth()->user();
        $giangVien = DB::table('qlsv_giangviens')
            ->where('id_user', $user->id)
            ->get()[0];
        if ($qlsv_lophoc->id_giangvien != $giangVien->id) {
            exit;
        }
        // dd($thoiKhoaBieu);
        //dd(DB::getQueryLog());
        return view('ManHinhGiangVien.viewdiemdanh', compact(
            ['idlop', 'thoiKhoaBieu', 'qlsv_sinhvienlophoc', 'qlsv_lophoc', 'title', 'id_thoikhoabieu', 'isSubmit']
        ));
    }

    public function viewnhatky(Request $request)
    {
        $user = auth()->user();
        $giangVien = DB::table('qlsv_giangviens')
            ->where('id_user', $user->id)
            ->get()[0];

        $title = "Nhật Ký Lên Lớp";
        $idlop = $request->get('id_lophoc');
        $qlsv_lophoc = qlsv_lophoc::find($idlop);
        $id_thoikhoabieu = $request->get('id_thoikhoabieu');

        $findThoiKhoaBieu = qlsv_thoikhoabieu::find($id_thoikhoabieu);
        if ($idlop != $findThoiKhoaBieu->id_lophoc) {
            exit;
        }

        $qlsv_lophoc = qlsv_lophoc::find($idlop);
        $phongHoc = qlsv_phonghoc::pluck('tenphonghoc', 'id');
        $workTask = qlsv_worktask::pluck('tenworktask', 'id');

        DB::enableQueryLog();
        $thoiKhoaBieuall = DB::table('qlsv_thoikhoabieus')->where('id_lophoc', $idlop)
            ->select(DB::raw("concat(ngayhoc ,' - ' , case when cahoc=1 then 'Sáng' when cahoc=2 then 'Chiều' when cahoc=3 then 'Tối' end) as ngayhoc, id"))
            ->pluck('ngayhoc', 'id');

        if ($qlsv_lophoc->id_giangvien != $giangVien->id) {
            exit;
        }

        $isSubmit = 0;
        $ngayhoc = qlsv_thoikhoabieu::find($id_thoikhoabieu)->ngayhoc;
        if ($ngayhoc <> date("Y-m-d")) {
            $isSubmit = 1;
        }

        // dd(DB::getQueryLog());
        $thoiKhoaBieu = qlsv_thoikhoabieu::find($id_thoikhoabieu);
        return view('ManHinhGiangVien.viewnhatky', compact(
            ['idlop', 'isSubmit', 'title', 'qlsv_lophoc', 'phongHoc', 'id_thoikhoabieu', 'workTask', 'thoiKhoaBieu', 'thoiKhoaBieuall']
        ));
    }

    public function viewdiemthi(Request $request)
    {
        $user = auth()->user();
        $giangVien = DB::table('qlsv_giangviens')
            ->where('id_user', $user->id)
            ->get()[0];

        $title = "Điểm Thi";
        $idlop = $request->get('id_lophoc');
        $qlsv_lophoc = qlsv_lophoc::find($idlop);
        $id_thoikhoabieu = $request->get('id_thoikhoabieu');
        $thoiKhoaBieu = qlsv_thoikhoabieu::find($id_thoikhoabieu);

        $findThoiKhoaBieu = qlsv_thoikhoabieu::find($id_thoikhoabieu);
        if ($idlop != $findThoiKhoaBieu->id_lophoc) {
            exit;
        }

        $qlsv_sinhvienlophoc = DB::table('qlsv_sinhvienlophocs')
            ->join('qlsv_sinhviens', 'qlsv_sinhviens.id', '=', 'qlsv_sinhvienlophocs.id_sinhvien')
            ->leftJoin('qlsv_diemthis', 'qlsv_diemthis.id_sinhvienlophoc', '=', 'qlsv_sinhvienlophocs.id')
            ->where('qlsv_sinhvienlophocs.id_lophoc', $idlop)
            ->where('qlsv_sinhviens.deleted_at', 0)
            ->select('qlsv_sinhviens.hovaten', 'qlsv_sinhvienlophocs.id', 'qlsv_diemthis.ghichu', 'qlsv_diemthis.diemthuchanh', 'qlsv_diemthis.diemlythuyet')
            ->get();
        // dd($qlsv_sinhvienlophoc);
        // $qlsv_lophoc = qlsv_lophoc::find($idlop);
        // $qlsv_lophoc = DB::table('qlsv_lophocs')->pluck('tenlophoc', 'id');
        $qlsv_kieuthi = DB::table('qlsv_kieuthis')->pluck('kieuthi', 'id');

        if ($qlsv_lophoc->id_giangvien != $giangVien->id) {
            exit;
        }

        return view('ManHinhGiangVien.viewdiemthi', compact(
            ['idlop', 'title', 'qlsv_lophoc', 'id_thoikhoabieu', 'thoiKhoaBieu', 'qlsv_sinhvienlophoc', 'qlsv_lophoc', 'qlsv_kieuthi']
        ));
    }

    public function storediemdanh(Request $request)
    {
        $id_sinhvienlophocs = $request['id_sinhvienlophoc'];

        // dd($id_sinhvienlophocs);
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

        return redirect()->route('giang_vien.tranglophoc');
    }
    public function storediemthi(Request $request)
    {
        $id_sinhvienlophocs =    $request['id_sinhvienlophoc'];
        //  dd($id_sinhvienlophocs);
        $diemlythuyets =  $request['diemlythuyet'];
        $diemthuchanhs =  $request['diemthuchanh'];
        $ghichu =  $request['ghichu'];
        $idlop = $request['idlop'];

        for ($i = 0; $i < count($id_sinhvienlophocs); $i++) {
            $diemthi = DB::table('qlsv_diemthis')
                ->where('id_sinhvienlophoc', '=', $id_sinhvienlophocs[$i])->get();
            //dd($diemthi);
            if (count($diemthi) == 1) {
                $data = qlsv_diemthi::find($diemthi[0]->id);
                $data->diemlythuyet = $diemlythuyets[$i];
                $data->diemthuchanh = $diemthuchanhs[$i];
                $data->ngaychodiem = Carbon::now("Asia/Ho_Chi_Minh");
                $data->ghichu = $ghichu[$i];
                $data->save();
            } else {
                $data = new qlsv_diemthi();
                $data->id_sinhvienlophoc = $id_sinhvienlophocs[$i];
                $data->diemlythuyet = $diemlythuyets[$i];
                $data->diemthuchanh = $diemthuchanhs[$i];
                $data->ghichu = $ghichu[$i];
                $data->ngaychodiem = Carbon::now("Asia/Ho_Chi_Minh");
                $data->id_kieuthi = 1;
                $data->deleted_at = 0;
                $data->save();
            }
        }
        return redirect()->route('giang_vien.tranglophoc');
    }

    public function storenhatky(Request $request)
    {
        $id_thoikhoabieu = $request['id_thoikhoabieu'];
        $ghichu = $request['ghichu'];
        $id_phonghoc = $request['id_phonghoc'];
        $id_worktask = $request['id_worktask'];

        $giovao = $request['giovao'];
        $giobatdau = $request['giobatdau'];
        $danhgiagiovao = $request['danhgiagiovao'];
        $lydogiovao = $request['lydogiovao'];

        $giora = $request['giora'];
        $danhgiagiora = $request['danhgiagiora'];
        $lydogiora = $request['lydogiora'];

        $danhgiacuagiangvien = $request['danhgiacuagiangvien'];
        $loinhancuagiangvien = $request['loinhancuagiangvien'];
        $siso = $request['siso'];
        $buoithu = $request['buoithu'];
        $thuchientot = $request['thuchientot'];
        $khonglamduoc = $request['khonglamduoc'];

        for ($i = 0; $i < count($id_thoikhoabieu); $i++) {

            $nhatKy = DB::table('qlsv_thoikhoabieus')
                ->where('id', '=', $id_thoikhoabieu[$i])
                ->get();
            // dd($nhatKy);
            if (count($nhatKy) == 1) {
                DB::enableQueryLog();
                $data = qlsv_thoikhoabieu::find($nhatKy[0]->id);
                // dd(DB::getQueryLog());
                $data->id_phonghoc = $id_phonghoc;
                $data->id_worktask = $id_worktask;
                $data->ghichu = $ghichu;

                $data->giovao = $giovao;
                $data->giobatdau = $giobatdau;
                $data->danhgiagiovao = $danhgiagiovao ?? 0;
                $data->lydogiovao = $lydogiovao ?? 0;

                $data->giora = $giora;
                $data->danhgiagiora = $danhgiagiora ?? 0;
                $data->lydogiora = $lydogiora ?? 0;

                $data->danhgiacuagiangvien = $danhgiacuagiangvien;
                $data->loinhancuagiangvien = $loinhancuagiangvien;
                $data->siso = $siso;
                $data->buoithu = $buoithu;
                $data->thuchientot = $thuchientot;
                $data->khonglamduoc = $khonglamduoc;
                $data->save();
            } else {
                $data = new qlsv_thoikhoabieu();
                $data->id_sinhvienlophoc = $id_thoikhoabieu[$i];
                $data->ghichu = $ghichu;
                $data->id_phonghoc = $id_phonghoc;
                $data->id_worktask = $id_worktask;

                $data->giovao = $giovao;
                $data->giobatdau = $giobatdau;
                $data->danhgiagiovao = $danhgiagiovao ?? 0;
                $data->lydogiovao = $lydogiovao ?? 0;

                $data->giora = $giora;
                $data->danhgiagiora = $danhgiagiora ?? 0;
                $data->lydogiora = $lydogiora ?? 0;

                $data->danhgiacuagiangvien = $danhgiacuagiangvien;
                $data->loinhancuagiangvien = $loinhancuagiangvien;
                $data->siso = $siso;
                $data->buoithu = $buoithu;
                $data->thuchientot = $thuchientot;
                $data->khonglamduoc = $khonglamduoc;
                $data->save();
            }
        }
        return redirect()->route('giang_vien.tranglophoc');
    }

    public function viewxinnghisv(Request $request){
        $title = "Thông báo xin nghỉ phép";
        $idlop = $request->get('id_lophoc');

        $xinNghiSV = DB::table('qlsv_xinnghis')
        ->join('qlsv_sinhvienlophocs','qlsv_sinhvienlophocs.id','=','qlsv_xinnghis.id_sinhvienlophoc')
        ->join('qlsv_thoikhoabieus','qlsv_thoikhoabieus.id','=','qlsv_xinnghis.id_thoikhoabieu')
        ->where('qlsv_sinhvienlophocs.id_lophoc',$idlop)
        ->orderBy('qlsv_thoikhoabieus.ngayhoc','desc')
        ->select('qlsv_xinnghis.noidung','qlsv_xinnghis.lydo','qlsv_sinhvienlophocs.id_sinhvien',
        'qlsv_sinhvienlophocs.id_lophoc','qlsv_thoikhoabieus.ngayhoc','qlsv_thoikhoabieus.cahoc')
        ->get();
        return view('ManHinhGiangVien.viewxinnghisv',compact(['title','xinNghiSV']));
    }
}
