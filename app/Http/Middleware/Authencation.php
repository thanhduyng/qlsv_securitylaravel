<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\REQUEST;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

class phanquyen
{
    public function handle($request, Closure $next)
    {
        $chucnang = DB::table('chucnangs')
            ->Where('route', Route::currentRouteName())
            ->first();

        if (isset($chucnang->id)) {
            $quyen = DB::table('nguoidungchucnang')
                ->Where('nguoidungid', Auth::user()->id)
                ->Where('chucnangid', $chucnang->id)
                ->first();
            if ($quyen && $quyen->nguoidungid == Auth::user()->id) {
                return $next($request);
            } else {
                return redirect('khongcoquyen');
            }
        }else{
            return redirect('khongcoquyen');
        }
    }
}
