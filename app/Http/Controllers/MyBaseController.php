<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Member;
use View;
// use Auth;

class MyBaseController extends Controller
{
    // protected $member;
    // protected $member_payments;
    // protected $member_monthly_amort;

    public function __construct()
    {
        
        $this->init();
        
    }  

    public function init()
    {
        $this->middleware(function ($request, $next) {
            $member = Auth::user()->member;
            $member->monthly_due =  ($member->shares * config('constants.amount_per_head'));
            View::share('member', Auth::user()->member);
            return $next($request);
        });

    }
}