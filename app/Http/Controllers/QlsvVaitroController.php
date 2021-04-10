<?php

namespace App\Http\Controllers;

use App\qlsv_chucnang;
use App\qlsv_vaitro;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use stdClass;

class QlsvVaitroController extends Controller
{
    private $qlsv_vaitro;
    private $qlsv_chucnang;
    public function __construct(qlsv_chucnang $qlsv_chucnang, qlsv_vaitro $qlsv_vaitro)
    {
        $this->qlsv_vaitro = $qlsv_vaitro;
        $this->qlsv_chucnang = $qlsv_chucnang;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = "Danh sách vai trò";
        $vaiTro = $this->qlsv_vaitro->select('id','ma','ten')->where('deleted_at',0)->get();
        // dd($vaiTro);
        return view('admin.VaiTro.dsvaitro', compact(['vaiTro', 'title']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Thêm vai trò";
        // $chucNang = $this->qlsv_chucnang->all();
        $chucnangs = $this->qlsv_chucnang->all();

        $renderLi = function ($chucNang, $child = "") {
            return
                $child
                ?   '<li class="nav-item" style="list-style: none;">
                       <div class="nav-link dropdown-toggle auto-icon bg-black" href="#chucNang-id-' . $chucNang->id . '" data-toggle="collapse">'
                . $chucNang->ten . '</div>' . $child . '</li>'
                :   '<li class="nav-item" style="list-style: none;">
                        <div class="nav-link" href="' . $chucNang->url . '">'
                . $chucNang->ten . '</div>' . $child . '</li>';
        };
    
        $renderUl = function ($child, $chucNangParent, $isParent = false) {
            return $isParent
                ?   $child
                :   '<ul class="collapse" id="chucNang-id-' . $chucNangParent->id . '">' . $child . '</ul>';
        };

        $chucNangConvert = new stdClass();
        $chucNangConvert->id = -1;

        $chucNangConvert->childs = $chucnangs->filter(function ($chucNang) use ($chucnangs) {
            $idcha = $chucNang->id_cha;
            if (!$idcha) return true;
            if ($idcha < 0 || $chucNang->id == $idcha) return true;
            $chucNangParent = $chucnangs[$chucnangs->search(function ($chucNang) use ($idcha) {
                return $chucNang->id == $idcha;
            })];
            if ($chucNangParent) {
                if (!isset($chucNangParent->childs)) $chucNangParent->childs = collect([]);
                $chucNangParent->childs->push($chucNang);
            }
            return false;
        });

        $renderRecursive = function ($recursive, $chucNang) use ($renderLi, $renderUl) {
            $isParent = $chucNang->id === -1;

            return $renderUl($chucNang->childs
                ->reduce(function ($acc, $chucNang) use ($renderLi, $recursive, $isParent) {
                    $childs = "";
                    if (isset($chucNang->childs)) {
                        if ($chucNang->childs->count() === 0) return $acc;
                        $childs = $recursive($recursive, $chucNang);
                    }
                    return $acc . $renderLi($chucNang, $childs, $isParent);
                }, ""), $chucNang, $isParent);
        };
        $cn = $renderRecursive($renderRecursive, $chucNangConvert);
        return view('admin.VaiTro.themvaitro', compact(['title', 'cn']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $vaitroCreate = $this->qlsv_vaitro->create([
                'ma' => $request->ma,
                'ten' => $request->ten
            ]);

            $chucNang = $request->chucnang;
            foreach ($chucNang as $chucNangId) {
                DB::table('qlsv_vaitrovachucnangs')->insert([
                    'id_vaitro' => $vaitroCreate->id,
                    'id_chucnang' => $chucNangId
                ]);
            }
            DB::commit();
            return redirect()->route('qlsv_vaitro.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Loi:' . $exception->getMessage() . $exception->getLine());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\qlsv_vaitro  $qlsv_vaitro
     * @return \Illuminate\Http\Response
     */
    public function show(qlsv_vaitro $qlsv_vaitro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\qlsv_vaitro  $qlsv_vaitro
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Cập nhập vai trò";
        $vaiTro = qlsv_vaitro::find($id);
        $listRowOfChucnang = DB::table('qlsv_vaitrovachucnangs')->where('id_vaitro',  $id)->pluck('id_chucnang');
        $qlsv_chucnangs = $this->qlsv_chucnang->all();
        return view('admin.VaiTro.suavaitro', compact(['qlsv_chucnangs', 'vaiTro', 'listRowOfChucnang','title']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\qlsv_vaitro  $qlsv_vaitro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $this->qlsv_vaitro->where('id', $id)->update([
                'ma' => $request->ma,
                'ten' => $request->ten
            ]);

            DB::table('qlsv_vaitrovachucnangs')->where('id_vaitro', $id)->delete();
            $vaiTroCreate = $this->qlsv_vaitro->find($id);
            
            // $vaiTroCreate->qlsv_chucnangs()->attach($request->chucnangs);

             $qlsv_chucnangs = $request->chucnangs;
            foreach($qlsv_chucnangs as $chucNangId){
                DB::table('qlsv_vaitrovachucnangs')->insert([
                    'id_vaitro' => $vaiTroCreate->id,
                    'id_chucnang' => $chucNangId
                ]);
            }
            DB::commit();
            return redirect()->route('qlsv_vaitro.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Loi:'.$exception->getMessage() . $exception->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\qlsv_vaitro  $qlsv_vaitro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $vaiTro = DB::table('qlsv_vaitros')->where('id', $id)->update(["deleted_at" => "1", "updated_at" => Carbon::now()]);
        return redirect()->route('qlsv_vaitro.index');
    }
}
