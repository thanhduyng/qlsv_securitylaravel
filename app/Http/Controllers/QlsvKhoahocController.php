<?php

namespace App\Http\Controllers;

use App\qlsv_khoahoc;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Session;
use \Validator;

class QlsvKhoahocController extends Controller
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
        $title = "Danh sách khoá học";
        $search = $request->get('search') ?? "";
        DB::enableQueryLog();
        $khoaHoc = DB::table('qlsv_khoahocs')
            ->where('qlsv_khoahocs.tenkhoahoc', 'like', '%' . $search . '%')
            ->where('qlsv_khoahocs.deleted_at', 0)
            ->select("qlsv_khoahocs.*",
            DB::raw("
                (select count(*) from qlsv_sinhvienlophocs svlh 
                inner join qlsv_lophocs lh on svlh.id_lophoc=lh.id where lh.id_khoahoc=qlsv_khoahocs.id) as soluongsv,
                ( select count(*) from qlsv_lophocs lh
                where lh.id_khoahoc = qlsv_khoahocs.id ) as soluonglop
            ") 
            )
            ->orderBy('qlsv_khoahocs.created_at', 'DESC')
            ->paginate(10);
        //   dd($khoaHoc);
        // dd(DB::getQueryLog());
        return view('admin.KhoaHoc.dskhoahoc', compact(['khoaHoc', 'title', 'search']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Thêm mới khoá học";
        return view('admin.KhoaHoc.themkhoahoc', compact(['title']));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        // $validatedData = $request->validate(
        //     [
        //         'tenkhoahoc' => 'required'
        //     ],

        //     [
        //         'required' => 'Không được để trống',
        //         'min' => 'Không được nhỏ hơn :min',
        //         'max' => 'Không được lớn hơn :max',
        //         'integer' => 'Chỉ được nhập số'
        //         // 'integer' => ':attribute Chỉ được nhập số'
        //     ]
        // );
        $khoaHoc = new qlsv_khoahoc();
        $khoaHoc->tenkhoahoc = $request->tenkhoahoc;
        $khoaHoc->ghichu = $request->ghichu;
        $user = auth()->user();
        $khoaHoc->nguoitao = $user->name;
        $khoaHoc->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $khoaHoc->deleted_at = "0";
        $khoaHoc->save();
        return redirect()->route('qlsv_khoahoc.index')->with('message', 'Thêm thành công');
    }

   

    /**
     * Display the specified resource.
     *
     * @param  \App\qlsv_khoahoc  $qlsv_khoahoc
     * @return \Illuminate\Http\Response
     */
    public function show(qlsv_khoahoc $qlsv_khoahoc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\qlsv_khoahoc  $qlsv_khoahoc
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Cập nhập khoá học";
        $khoaHoc = qlsv_khoahoc::find($id);
        return view('admin.KhoaHoc.suakhoahoc', compact(['khoaHoc', 'title']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\qlsv_khoahoc  $qlsv_khoahoc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      
        // $validatedData = $request->validate(
        //     [
        //         'tenkhoahoc' => 'required'
        //     ],

        //     [
        //         'required' => 'Không được để trống',
        //         'min' => 'Không được nhỏ hơn :min',
        //         'max' => 'Không được lớn hơn :max',
        //         'integer' => 'Chỉ được nhập số'
        //         // 'integer' => ':attribute Chỉ được nhập số'
        //     ]
        // );
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $khoaHoc = qlsv_khoahoc::find($id);
        $khoaHocSua = $request->all();
        $user = auth()->user();
        $khoaHoc->nguoisua = $user->name;
        $khoaHoc->update(["updated_at" => Carbon::now()]);  
        $khoaHoc->update($khoaHocSua);
        return redirect()->route('qlsv_khoahoc.index')->with('message', 'Cập nhập thành công');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\qlsv_khoahoc  $qlsv_khoahoc
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $khoaHoc = DB::table('qlsv_khoahocs')->where('id', $id)->update(["deleted_at" => "1", "updated_at" => Carbon::now()]);

        Session::flash("message", $khoaHoc ? "xoá thành công" : "xoá thất bại");
        return response()->json(['status' => 'xoá thành công']);
    }
}
