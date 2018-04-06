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

    public function __construct()
    {
        $this->init();
    }  

    public function init()
    {
         $this->middleware(function ($request, $next) {
            $this->member = Auth::user()->member;
            // $this->member_payments =  Auth::user()->member->payments;
            return $next($request);
        });

    }
}