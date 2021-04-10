<?php

namespace App\Http\Controllers;

use App\qlsv_monhoc;
use App\qlsv_worktask;
use App\qlsv_worktaskdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QlsvWorktaskController extends Controller
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
        // $title = "Danh Sách WorkTask";
        // $worktask = DB::table("qlsv_worktasks")->where('deleted_at', 0)->paginate(2);
        // $monhoc = DB::table("qlsv_monhocs")->where('deleted_at', 0)->pluck("tenmonhoc", "id");
        // $worktaskdetail = DB::table("qlsv_worktaskdetails")->get();
        // return view("admin/WorkTask/dsworktask1", ['worktask' => $worktask, 'monhoc' => $monhoc, 'worktaskdetail' => $worktaskdetail, 'title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $monhoc = DB::table("qlsv_monhocs")->pluck("tenmonhoc", "id");
        $monhoc2 = DB::table("qlsv_monhocs")
            ->where('id', $id)
            ->where('deleted_at', 0)->get();
        $title = "Tạo WorkTask môn " . $monhoc2[0]->tenmonhoc;
        $thutu = DB::table("qlsv_worktasks")
            ->where('deleted_at', 0)
            ->where('id_monhoc', $monhoc2[0]->id)
            ->max('thutu');
        return view("admin/WorkTask/themworktask", ['monhoc' => $monhoc, 'monhoc2' => $monhoc2, 'title' => $title, 'thutu' => $thutu + 1, 'id' => $id]);
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
                'tenworktask' => 'required',


            ],

            [
                'required' => 'Không được để trống',
                'min' => 'Không được nhỏ hơn :min',
                'max' => 'Không được lớn hơn :max',
                'integer' => 'Chỉ được nhập số'
                // 'integer' => ':attribute Chỉ được nhập số'
            ]
        );
        $worktask = new qlsv_worktask();

        $worktask->tenworktask = $request->request->get("tenworktask");
        $worktask->id_monhoc = $request->request->get("id_monhoc");
        $worktask->thutu = $request->request->get("thutu");
        $worktask->nguoitao = "haubeo";
        $worktask->nguoisua = "haubeo";
        $worktask->created_at = Carbon::now();
        $worktask->deleted_at = 0;
        $worktask->save();
        $thutu = DB::table("qlsv_worktasks")
            ->where('deleted_at', 0)
            ->where('id_monhoc', $worktask->id_monhoc)
            ->max('thutu');
        $worktaskdetail = new qlsv_worktaskdetail();
        $ten = $request->request->get("ten");
        //dd($ten);

        for ($i = 0; $i < count($ten); $i++) {
            $worktaskdetail = new qlsv_worktaskdetail();
            if ($ten[$i] != null) {

                $worktaskdetail->ten = $ten[$i];
                //dd($worktask);
                $worktaskdetail->id_worktask = $worktask->id;
                $worktaskdetail->nguoitao = "haubeo";
                $worktaskdetail->nguoisua = "haubeo";
                $worktaskdetail->deleted_at = 0;
                $worktaskdetail->created_at = Carbon::now();
                //$worktaskdetail->sothutu=$i+1;
                $worktaskdetail->save();
                //dd($worktaskdetail);
                $worktaskdetail = new qlsv_worktaskdetail();
            }
        }

        return  redirect()->route('qlsv_worktask.create', ['id' => $worktask->id_monhoc, 'thutu' => $thutu]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\qlsv_worktask  $qlsv_worktask
     * @return \Illuminate\Http\Response
     */

    public function worktaskfind(qlsv_worktask $qlsv_worktask, Request $request)
    {
        $title = "Dang Sách  WorkTask ";
        $id = $request->get("id");
        if ($id == "--Chọn môn học--") {
            $id = null;
        }
        // dd($id);
        $tenworktask = $request->get("tenworktask");
        // $ten= isset($tenworktask)?$tenworktask:"";
        //dd($tenworktask);
        if (isset($id) && !(isset($tenworktask))) {

            $monhoc1 = DB::table("qlsv_monhocs")->where("id", $id)->get();
            $monhoc = DB::table("qlsv_monhocs")->pluck("tenmonhoc", "id");
            //->pluck("tenmonhoc", "id");
            //dd($monhoc1[0]->tenmonhoc);
            $title = "Dang Sách  WorkTask " . $monhoc1[0]->tenmonhoc;
            $worktask = DB::table('qlsv_worktasks')
                ->where('id_monhoc', $id)
                ->where('deleted_at', '=', 0)->paginate(2);
            $worktask->withPath('/worktask/worktaskfind?id=' . $id . '&tenworktask=');
            $worktaskdetail = DB::table("qlsv_worktaskdetails")->get();
            return view("admin/WorkTask/dsworktask1", ['worktask' => $worktask, 'monhoc' => $monhoc, 'worktaskdetail' => $worktaskdetail, 'title' => $title]);
        } else {
            if ((isset($id)) && (isset($tenworktask))) {

                $monhoc = DB::table("qlsv_monhocs")->pluck("tenmonhoc", "id");
                $monhoc1 = qlsv_monhoc::find($id);
                $worktask = DB::table('qlsv_worktasks')
                    ->where('tenworktask', 'LIKE', '%' . $tenworktask . '%')
                    ->orWhere('id_monhoc', $id)
                    ->where('deleted_at', '=', 0)->paginate(2);
                $worktask->withPath('/worktask/worktaskfind?id=' . $id . '&tenworktask=' . $tenworktask);
                $title = "Dang Sách  WorkTask theo môn " . $monhoc1->tenmonhoc;
                $worktaskdetail = DB::table("qlsv_worktaskdetails")->get();
                return view("admin/WorkTask/dsworktask", ['worktask' => $worktask, 'monhoc' => $monhoc, 'worktaskdetail' => $worktaskdetail, 'title' => $title]);
            } else {
                if (!(isset($id)) && (isset($tenworktask))) {

                    $monhoc = DB::table("qlsv_monhocs")->pluck("tenmonhoc", "id");
                    $worktask = DB::table('qlsv_worktasks')
                        ->where('tenworktask', 'like', '%' . $tenworktask . '%')

                        ->where('deleted_at', '=', 0)->paginate(2);
                    $worktask->withPath('/worktask/worktaskfind?id=&tenworktask=' . $tenworktask);
                    $title = "Dang Sách  WorkTask theo tên worktask ";
                    $worktaskdetail = DB::table("qlsv_worktaskdetails")->get();
                    return view("admin/WorkTask/dsworktask", ['worktask' => $worktask, 'monhoc' => $monhoc, 'worktaskdetail' => $worktaskdetail, 'title' => $title]);
                } else {

                    $worktask = DB::table("qlsv_worktasks")->where('deleted_at', 0)->paginate(2);
                    $monhoc = DB::table("qlsv_monhocs")->where('deleted_at', 0)->pluck("tenmonhoc", "id");
                    $worktaskdetail = DB::table("qlsv_worktaskdetails")->get();
                    return view("admin/WorkTask/dsworktask", ['worktask' => $worktask, 'monhoc' => $monhoc, 'worktaskdetail' => $worktaskdetail, 'title' => $title]);
                }
            }
        }

        //  $monhoc = qlsv_monhoc::find($id);
        $worktask = DB::table('qlsv_worktasks')

            ->where('deleted_at', '=', 0)->paginate(2);



        $monhoc = DB::table("qlsv_monhocs")->pluck("tenmonhoc", "id");
        $worktaskdetail = DB::table("qlsv_worktaskdetails")->get();
        return view("admin/WorkTask/dsworktask", ['worktask' => $worktask, 'monhoc' => $monhoc, 'worktaskdetail' => $worktaskdetail, 'title' => $title]);
    }



    public function chonmonhoc(qlsv_worktask $qlsv_worktask, Request $request)
    {

        // $id = $request->request->get("id");
        // //$monhoc=DB::table("qlsv_monhocs")->where('id',$term)->get();
        // $monhoc = qlsv_monhoc::find($id);
        // //dd($monhoc);
        // $worktask = DB::table('qlsv_worktasks')
        //     ->join('qlsv_monhocs', 'qlsv_worktasks.id_monhoc', '=', 'qlsv_monhocs.id')
        //     ->where('qlsv_monhocs.id', $id)
        //     ->where('qlsv_worktasks.deleted_at', '=', 0)
        //     ->pluck("qlsv_worktasks.tenworktask", "qlsv_worktasks.id");
        // $worktaskdetail = DB::table('qlsv_worktaskdetails')->get();
        // $title = "Danh Sách WorkTask Tìm Được";
        // // dd($worktask);
        // return view("admin/WorkTask/dsworktaskmon", ['worktask' => $worktask, 'title' => $title, 'monhoc' => $monhoc, 'worktaskdetail' => $worktaskdetail]);
    }
    public function mon(qlsv_worktask $qlsv_worktask, Request $request, $id)
    {
        $monhoc1 = qlsv_monhoc::find($id);

        $worktask = DB::table('qlsv_worktasks')
            ->join('qlsv_monhocs', 'qlsv_worktasks.id_monhoc', '=', 'qlsv_monhocs.id')
            ->where('qlsv_monhocs.id', $id)
            ->where('qlsv_worktasks.deleted_at', 0)
            ->select('qlsv_worktasks.id', 'qlsv_worktasks.id_monhoc', 'qlsv_worktasks.tenworktask', DB::raw('count(*) as user_count'))
            ->groupBy('qlsv_worktasks.id')
            ->get();

        $monhoc = DB::table("qlsv_monhocs")->pluck("tenmonhoc", "id");
        $worktaskdetail = DB::table('qlsv_worktaskdetails')->get();

        $title = "Danh Sách WorkTask  Môn  " . $monhoc1->tenmonhoc;

        return view("admin/WorkTask/dsworktask", ['worktask' => $worktask, 'title' => $title, 'monhoc' => $monhoc, 'worktaskdetail' => $worktaskdetail, 'idd' => $id]);
    }

    //public function worktaskmon(qlsv_worktask $qlsv_worktask, Request $request, $id)
    // {
    //$id =$request->request->get("id");
    //$monhoc=DB::table("qlsv_monhocs")->where('id',$term)->get();
    // $monhoc = qlsv_monhoc::find($id);
    // //dd($monhoc);
    // $worktask = DB::table('qlsv_worktasks')
    //     ->join('qlsv_monhocs', 'qlsv_worktasks.id_monhoc', '=', 'qlsv_monhocs.id')
    //     ->where('qlsv_monhocs.id', $id)

    //     ->pluck("qlsv_worktasks.tenworktask", "qlsv_worktasks.id");
    // $worktaskdetail = DB::table('qlsv_worktaskdetails')->get();
    // $title = "Danh Sách WorkTask Tìm Được";
    // // dd($worktask);
    // return view("admin/WorkTask/dsworktaskmon", ['worktask' => $worktask, 'title' => $title, 'monhoc' => $monhoc, 'worktaskdetail' => $worktaskdetail]);
    //}

    public function show(qlsv_worktask $qlsv_worktask, Request $request)
    {
        // $name = $request->name;

        // $sothutu = DB::table('qlsv_worktasks')
        //     ->join('qlsv_monhocs', 'qlsv_worktasks.id_monhoc', '=', 'qlsv_monhocs.id')
        //     ->where('qlsv_monhocs.id', $name)
        //     ->where('qlsv_worktasks.deleted_at', 0)
        //     ->where('qlsv_monhocs.deleted_at', 0)
        //     ->max('qlsv_worktasks.thutu');
        // $sothutu = $sothutu + 1;

        // return response()->json(['success' => $sothutu ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\qlsv_worktask  $qlsv_worktask
     * @return \Illuminate\Http\Response
     */
    public function edit(qlsv_worktask $qlsv_worktask, $id)
    {

        $worktask = qlsv_worktask::find($id);

        $monhoc2 = DB::table("qlsv_worktasks")
            ->join('qlsv_monhocs', 'qlsv_worktasks.id_monhoc', '=', 'qlsv_monhocs.id')
            ->where('qlsv_worktasks.id', $id)
            ->where('qlsv_monhocs.deleted_at', 0)
            ->where('qlsv_worktasks.deleted_at', 0)
            ->select('qlsv_monhocs.id', 'qlsv_monhocs.tenmonhoc')
            ->get();
        $title = "Sửa WorkTask môn " . $monhoc2[0]->tenmonhoc;
        $worktaskdetail = DB::table("qlsv_worktaskdetails")->get();
        return view("admin/WorkTask/editworktask", ['worktask' => $worktask, 'monhoc2' => $monhoc2, 'worktaskdetail' => $worktaskdetail, 'title' => $title]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\qlsv_worktask  $qlsv_worktask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, qlsv_worktask $qlsv_worktask, $id)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $validatedData = $request->validate(
            [
                'tenworktask' => 'required',


            ],

            [
                'required' => 'Không được để trống',
                'min' => 'Không được nhỏ hơn :min',
                'max' => 'Không được lớn hơn :max',
                'integer' => 'Chỉ được nhập số'
                // 'integer' => ':attribute Chỉ được nhập số'
            ]
        );
        $worktaske = qlsv_worktask::find($id);

        $worktaske->tenworktask = $request->request->get("tenworktask");
        $worktaske->thutu = $request->request->get("thutu");
        $worktaske->id_monhoc = $request->request->get("id_monhoc");
        $worktaske->updated_at = Carbon::now();
        $worktaske->save();

        $worktaskdetail = new qlsv_worktaskdetail();

        $ten = $request->request->get("ten");

        $worktaskdetail = DB::table("qlsv_worktaskdetails")->where('id_worktask', $worktaske->id)->get();

        foreach ($worktaskdetail as $wdt) {
            DB::table('qlsv_worktaskdetails')->where('id', $wdt->id)->delete();
        }
        for ($i = 0; $i < count($ten); $i++) {

            if ($ten[$i] != null) {
                $worktaskdetail = new qlsv_worktaskdetail();
                $worktaskdetail->ten = $ten[$i];
                $worktaskdetail->id_worktask = $worktaske->id;
                //$worktaskdetail->sothutu=$i+1;
                $worktaskdetail->nguoitao = "haubeo";
                $worktaskdetail->nguoisua = "haubeo";
                $worktaskdetail->updated_at = Carbon::now();
                $worktaskdetail->deleted_at = 0;
                $worktaskdetail->save();
            }
        }
        return redirect('/worktask/mon/' . $worktaske->id_monhoc);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\qlsv_worktask  $qlsv_worktask
     * @return \Illuminate\Http\Response
     */
    public function destroy(qlsv_worktask $qlsv_worktask, $id)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $worktask1 = qlsv_worktask::find($id);
        $thutu = $worktask1->thutu;
        $dsworktask = DB::table("qlsv_worktasks")
            ->where('id_monhoc', $worktask1->id_monhoc)
            ->where('deleted_at', 0)->get();
        //dd( $worktask1);
        if ($thutu == 1) {

            foreach ($dsworktask as $dsw) {
                $dsw->thutu = $dsw->thutu - 1;
                $worktask = qlsv_worktask::find($dsw->id);
                $worktask->thutu = $dsw->thutu;
                $worktask->save();
            }
        } else {
            if ($thutu == count($dsworktask)) {
            } else {

                for ($i = $thutu; $i < count($dsworktask); $i++) {
                    $dsworktask[$i]->thutu = $dsworktask[$i]->thutu - 1;
                    $worktask = qlsv_worktask::find($dsworktask[$i]->id);
                    $worktask->thutu = $dsworktask[$i]->thutu;
                    $worktask->save();
                }
            }
        }


        $worktask1->deleted_at = 1;
        $worktask1->save();
        return response()->json(['_typeMessage' => 'deleteSuccess']);
        //return redirect('/worktask/index');
    }
}
