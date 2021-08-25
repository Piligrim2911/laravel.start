<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use View;

class DashboardController extends Controller
{
    protected $template;
    protected $user;

    public function __construct()
    {
        $this->middleware(function($request, $next) {
            $this->user = Auth::user();
            $this->template = 'templates.dashboard.' . config('settings.dashboard_theme');
            View::share('user', $this->user);
            return $next($request);
        });
    }
}
