<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Support\Facades\Artisan;
class CacheKiller implements Middleware
{
    public function handle($request, Closure $next)
    {
        Artisan::call('view:clear');
        return $next($request);
    }
}