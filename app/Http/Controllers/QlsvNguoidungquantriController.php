<?php

namespace App\Http\Controllers;

use App\qlsv_nguoidungquantri;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class QlsvNguoidungquantriController extends Controller
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
        $title = "Danh sách quản trị";
        $search = $request->get('search') ?? "";
        $quanTri = DB::table('qlsv_nguoidungquantris')->where('ten', 'like', '%' . $search . '%')->where("deleted_at", 0)->paginate(10);
        return view('admin.QuanTri.dsquangtri', compact(['quanTri', 'title', 'search']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Thêm mới quản trị";
        return view('admin.QuanTri.themquantri', compact(['title']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $quanTri = new qlsv_nguoidungquantri();
        $User = new User();
        $User->name = $request->name;
        $User->email = $request->email;

        $request->validate(
            [
                'name' => 'required|string|max:100',
                'email' => 'required|unique:users|email|ends_with:@gmail.com',

            ]
        );
        $User->password = Hash::make($request->password);
        $User->save();
        $quanTri->ten = $request->ten;
        $quanTri->diachi = $request->diachi;
        $quanTri->gioitinh = $request->gioitinh;
        $quanTri->sodienthoai = $request->sodienthoai;
        $quanTri->id_user = $User->id;
        $quanTri->deleted_at = "0";
        $quanTri->created_at = Carbon::now("Asia/Ho_Chi_Minh");
        $quanTri->save();
        return redirect('/quantri/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\qlsv_nguoidungquantri  $qlsv_nguoidungquantri
     * @return \Illuminate\Http\Response
     */
    public function show(qlsv_nguoidungquantri $qlsv_nguoidungquantri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\qlsv_nguoidungquantri  $qlsv_nguoidungquantri
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Cập nhập quản trị";
        $quanTri = qlsv_nguoidungquantri::find($id);
        return view('admin.QuanTri.suaquantri', compact(['quanTri', 'title']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\qlsv_nguoidungquantri  $qlsv_nguoidungquantri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $quanTri = qlsv_nguoidungquantri::find($id);
        $quanTriEdit = $request->all();
        $quanTri->update(["updated_at" => Carbon::now()]);
        $quanTri->update($quanTriEdit);
        return redirect('/quantri/index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\qlsv_nguoidungquantri  $qlsv_nguoidungquantri
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $quanTri = DB::table('qlsv_nguoidungquantris')
        ->where('id',$id)
        ->update(["deleted_at" => "1","updated_at" => Carbon::now()]);
        return redirect()->route('qlsv_quantri.index');
    }
}
