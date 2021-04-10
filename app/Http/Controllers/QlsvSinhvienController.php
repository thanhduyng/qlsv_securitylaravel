<?php

namespace App\Http\Controllers;

use App\qlsv_sinhvien;
use App\User;
use App\qlsv_khoahoc;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class QlsvSinhvienController extends Controller
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
        $title = "Danh sách sinh viên";
        $search = $request->get('search') ?? "";
        $khoahoc = $request->get('khoahoc') ?? "";
        $khoaHoc = qlsv_khoahoc::pluck('tenkhoahoc', 'id');
        if ($search == "" && $khoahoc != "") {
            $sinhVien = DB::table('qlsv_sinhviens')
                ->where('id_khoahoc', 'like', '%' . $khoahoc . '%')
                ->where('deleted_at', 0)
                ->paginate(10);
            return view('admin.SinhVien.danhsachSinhvien', compact(['sinhVien', 'title', 'search', 'khoaHoc']));
        } else {
            if ($search != "" && $khoahoc != "") {
                $sinhVien = DB::table('qlsv_sinhviens')->where('hovaten', 'like', '%' . $search . '%')
                    ->Where('id_khoahoc', 'like', '%' . $khoahoc . '%')
                    ->where('deleted_at', 0)->paginate(10);
                return view('admin.SinhVien.danhsachSinhvien', compact(['sinhVien', 'title', 'search', 'khoaHoc']));
            } else {
                $sinhVien = DB::table('qlsv_sinhviens')
                    ->where('hovaten', 'like', '%' . $search . '%')
                    //->orWhere('id_khoahoc','like','%'.$khoahoc.'%')
                    ->where('deleted_at', 0)->paginate(10);
                return view('admin.SinhVien.danhsachSinhvien', compact(['sinhVien', 'title', 'search', 'khoaHoc']));
            }
        }

        $sinhVien = DB::table('qlsv_sinhviens')
            ->where('hovaten', 'like', '%' . $search . '%')
            ->Where('id_khoahoc', 'like', '%' . $khoahoc . '%')
            ->where('deleted_at', 0)
            ->get();
        return view('admin.SinhVien.danhsachSinhvien', compact(['sinhVien', 'title', 'search', 'khoaHoc']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Thêm mới sinh viên";
        $khoaHoc = DB::table('qlsv_khoahocs')->pluck('tenkhoahoc', 'id');
        return view('admin.SinhVien.addSinhvien', compact(['title', 'khoaHoc']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'hovaten' => 'required',
                'diachi' => 'required',
                'id_khoahoc' => 'required',
                'sodienthoaisinhvien' => 'required',
                'sodienthoaigiadinh' => 'required',
                'password' => 'min:8|required',
                'email' => 'required'
            ],

            [
                'required' => 'Không được để trống',
                'min' => 'Không được nhỏ hơn :min ký tự',
                'max' => 'Không được lớn hơn :max',
                'integer' => 'Chỉ được nhập số'
            ]
        );

        $sinhVien = new qlsv_sinhvien();
        $User = new User();
        $User->name = $request->name;
        $User->email = $request->email;
        $User->password = Hash::make($request->password);
        $User->save();

        $sinhVien->hovaten = $request->hovaten;
        $sinhVien->diachi = $request->diachi;
        $sinhVien->gioitinh = $request->gioitinh;
        $sinhVien->sodienthoaisinhvien = $request->sodienthoaisinhvien;
        $sinhVien->sodienthoaigiadinh = $request->sodienthoaigiadinh;
        $sinhVien->ghichu = $request->ghichu;
        $sinhVien->id_user = $User->id;
        $sinhVien->id_khoahoc = $request->id_khoahoc;
        $sinhVien->deleted_at = "0";
        $sinhVien->created_at = Carbon::now();
        $sinhVien->save();

        return redirect('/sinhvien/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\qlsv_sinhvien  $qlsv_sinhvien
     * @return \Illuminate\Http\Response
     */
    public function show(qlsv_sinhvien $qlsv_sinhvien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\qlsv_sinhvien  $qlsv_sinhvien
     * @return \Illuminate\Http\Response
     */
    public function edit(qlsv_sinhvien $qlsv_sinhvien, $id)
    {
        $title = "Cập nhập sinh viên";
        $sinhVien = qlsv_sinhvien::find($id);
        $khoaHoc = qlsv_khoahoc::pluck('tenkhoahoc', 'id');
        return view('admin.SinhVien.updateSinhvien', compact(['sinhVien', 'title', 'khoaHoc']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\qlsv_sinhvien  $qlsv_sinhvien
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, qlsv_sinhvien $qlsv_sinhvien, $id)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $sinhVien = qlsv_sinhvien::find($id);
        $sinhVien->hovaten = $request->hovaten;
        $sinhVien->diachi = $request->diachi;
        $sinhVien->gioitinh = $request->gioitinh;
        $sinhVien->sodienthoaisinhvien = $request->sodienthoaisinhvien;
        $sinhVien->sodienthoaigiadinh = $request->sodienthoaigiadinh;
        $sinhVien->ghichu = $request->ghichu;
        $sinhVien->id_khoahoc = $request->id_khoahoc;
        $sinhVien->save();
        return redirect('/sinhvien/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\qlsv_sinhvien  $qlsv_sinhvien
     * @return \Illuminate\Http\Response
     */
    public function destroy(qlsv_sinhvien $qlsv_sinhvien, $id)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $sinhVien = qlsv_sinhvien::find($id);
        $sinhVien = DB::table('qlsv_sinhviens')->where('id', $id)->update(["deleted_at" => "1", "updated_at" => Carbon::now()]);
        // $sinhVien->delete();
        return redirect('/sinhvien/index');
    }
}
