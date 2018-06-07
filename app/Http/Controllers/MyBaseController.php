<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Member;
// use Auth;

class MyBaseController extends Controller
{
    protected $member;
    protected $member_payments;
    protected $member_monthly_amort;

    public function __construct()
    {
        
        $this->init();
        
    }  

    public function init()
    {
        
        $this->middleware(function ($request, $next) {
            $this->member_monthly_amort = (Auth::user()->member->shares * config('constants.amount_per_head'));
            $this->member = Auth::user()->member;
            // $this->member_payments =  Auth::user()->member->payments;
            return $next($request);
        });

    }
}