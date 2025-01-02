<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\View; // Tambahkan ini
use App\Models\Branch; // Tambahkan ini

class ShareBranches
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Bagikan semua data branches ke views
        View::share('branches', Branch::all());
        return $next($request);
    }
}
