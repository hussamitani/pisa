<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\Project;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectToProjectPanel
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $userHasProjects = Project::query()->exists();

            if (! $userHasProjects) {
                return redirect('/projects');
            }
        }

        return $next($request);
    }
}
