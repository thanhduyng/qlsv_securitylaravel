<?php

namespace App\Http\Controllers;

use App\Http\Requests\thongbao;
use App\qlsv_monhoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class QlsvMonhocController extends Controller
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
    public function index()
    {
        Auth::routes();
        $user = Auth::user();
       
        //dd($us);
        $monhoc = DB::table("qlsv_monhocs")->where('deleted_at', 0)->paginate(10);
        $monhoc1 = DB::table("qlsv_monhocs")->where('deleted_at', 0)->get();
        $title = "Danh Sách Môn Học";
        if (Auth::check()) {
            // The user is logged in...
           // dd($monhoc);
        }else{
          
        }
        return view("admin/MonHoc/dsmonhoc", ['monhoc' => $monhoc, 'monhoc1' => $monhoc1, 'title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Đăng ký môn học";
        return view('admin/MonHoc/themmonhoc', ['title' => $title]);
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
      
        $monhoc = new qlsv_monhoc();
        $monhoc->tenmonhoc = $request->tenmonhoc;
        $monhoc->ghichu = $request->ghichu;

        $monhoc->nguoitao = "haubeo";
        $monhoc->nguoisua = "haubeo";
        $monhoc->deleted_at = 0;
        $monhoc->created_at = Carbon::now();
        $monhoc->save();

        return redirect('/monhoc/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\qlsv_monhoc  $qlsv_monhoc
     * @return \Illuminate\Http\Response
     */

    public function search(qlsv_monhoc $qlsv_monhoc, Request $request)
    {
        $id = $request->request->get("id");
        $term = $request->request->get("tenmonhoc");
        $title = " Môn Học Tìm Được";
        if (isset($id) && !isset($term)) {
            $monhoc = DB::table('qlsv_monhocs')
                ->where('id', $id)
                ->where('deleted_at', '=', 0)
                ->paginate(2);
            $title = "Môn Học " . $monhoc[0]->tenmonhoc;
            $monhoc1 = DB::table("qlsv_monhocs")->where('deleted_at', 0)->get();
            $monhoc->withPath('/find?id=' . $id . '&tenmonhoc=');
            return view("admin/MonHoc/dsmonhoc", ['monhoc' => $monhoc, 'monhoc1' => $monhoc1, 'title' => $title]);
        } else {
            if (isset($id) && isset($term)) {
                $monhoc = DB::table('qlsv_monhocs')
                    ->where('id', $id)
                    ->orWhere('tenmonhoc', 'LIKE', '%' . $term . '%')
                    ->where('deleted_at', '=', 0)
                    ->paginate(2);

                $monhoc1 = DB::table("qlsv_monhocs")->where('deleted_at', 0)->get();
                $monhoc->withPath('/find?id=' . $id . '&tenmonhoc=' . $term);
                return view("admin/MonHoc/dsmonhoc", ['monhoc' => $monhoc, 'monhoc1' => $monhoc1, 'title' => $title]);
            } else {
                if (!isset($id) && isset($term)) {
                    $monhoc = DB::table('qlsv_monhocs')
                        ->where('tenmonhoc', 'LIKE', '%' . $term . '%')
                        ->where('deleted_at', '=', 0)
                        ->paginate(2);
                    $title = " Môn Học theo tên ";
                    $monhoc1 = DB::table("qlsv_monhocs")->where('deleted_at', 0)->get();
                    $monhoc->withPath('/find?id=&tenmonhoc=' . $term);
                    return view("admin/MonHoc/dsmonhoc", ['monhoc' => $monhoc, 'monhoc1' => $monhoc1, 'title' => $title]);
                } else {
                    $monhoc = DB::table('qlsv_monhocs')
                        ->where('deleted_at', '=', 0)
                        ->paginate(2);
                    $monhoc1 = DB::table("qlsv_monhocs")->where('deleted_at', 0)->get();
                   // $monhoc->withPath('/find?id=&tenmonhoc=');
                    return view("admin/MonHoc/dsmonhoc", ['monhoc' => $monhoc, 'monhoc1' => $monhoc1, 'title' => $title]);
                }
            }
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\qlsv_monhoc  $qlsv_monhoc
     * @return \Illuminate\Http\Response
     */
    public function edit(qlsv_monhoc $qlsv_monhoc, $id)
    {
        $title = "Cập nhập Môn Học";
        $monhoc = qlsv_monhoc::find($id);
        return view("admin/MonHoc/suamonhoc", ['monhoc' => $monhoc, 'title' => $title]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\qlsv_monhoc  $qlsv_monhoc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, qlsv_monhoc $qlsv_monhoc, $id)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
       
        $monhoc = qlsv_monhoc::find($id);
        $monhoc->tenmonhoc = $request->request->get("tenmonhoc");
        $monhoc->ghichu = $request->request->get("ghichu");
        $monhoc->updated_at = Carbon::now();
        $monhoc->save();

        return redirect('/monhoc/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\qlsv_monhoc  $qlsv_monhoc
     * @return \Illuminate\Http\Response
     */
    public function destroy(qlsv_monhoc $qlsv_monhoc, $id)
    {
        $monhoc = qlsv_monhoc::find($id);

        $monhoc->deleted_at = 1;
        $monhoc->save();

        return response()->json(['_typeMessage' => 'deleteSuccess']);
    }
}
