<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\REQUEST;
use Illuminate\Support\Facades\Route;

class Ghilog
{
    public function handle($request, Closure $next)
    {
      $stdout = fopen('php://stdout', 'w');
      fwrite($stdout,"Start " . Route::currentRouteName() ." " . date("Y-m-d H:i:s")."\n");

      $r = $next($request);

      fwrite($stdout,"End " . Route::currentRouteName() ." "  . date("Y-m-d H:i:s")."\n");

      // trả về không có quyền
        return redirect('khongcoquyen');
    }
}
