<?php

namespace App\Http\Controllers;

use App\qlsv_phonghoc;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QlsvPhonghocController extends Controller
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
       
        $title = "Danh sách phòng học";
        $search = $request->get('search')??"";
        $phongHoc = DB::table('qlsv_phonghocs')
        ->where('tenphonghoc','like','%'.$search.'%')
        ->where('deleted_at',0)
        ->orderBy('created_at', 'asc')
        ->paginate(10);
        return view('admin.PhongHoc.dsphonghoc', compact(['phongHoc','title','search']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Thêm mới phòng học";
        return view('admin.PhongHoc.themphonghoc',compact(['title']));
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
        $phongHoc = new qlsv_phonghoc();
        $phongHoc->tenphonghoc = $request->tenphonghoc;
        $phongHoc->ghichu = $request->ghichu;
        $phongHoc->deleted_at = "0";
        $phongHoc->created_at = Carbon::now();
        
        $phongHoc->save();
        return redirect()->route('qlsv_phonghoc.index')->with('message','Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\qlsv_phonghoc  $qlsv_phonghoc
     * @return \Illuminate\Http\Response
     */
    public function show(qlsv_phonghoc $qlsv_phonghoc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\qlsv_phonghoc  $qlsv_phonghoc
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Cập nhập phòng học";
        $phongHoc = qlsv_phonghoc::find($id);
        return view('admin.PhongHoc.suaphonghoc', compact(['phongHoc','title']));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\qlsv_phonghoc  $qlsv_phonghoc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $phongHoc = qlsv_phonghoc::find($id);
        $phongHocSua = $request->all();
        $phongHoc->update(["updated_at" => Carbon::now()]);
        $phongHoc->update($phongHocSua);
        return redirect()->route('qlsv_phonghoc.index')->with('message','Cập nhập thành công');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\qlsv_phonghoc  $qlsv_phonghoc
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $phongHoc = DB::table('qlsv_phonghocs')->where('id',$id)->update(["deleted_at" => "1","updated_at" => Carbon::now()]);
        return redirect()->route('qlsv_phonghoc.index');
    }
}
