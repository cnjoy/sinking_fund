<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use Yajra\Datatables\Datatables;

class DatatablesController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return view('pages.members');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function membersData()
    {
        return Datatables::of(Member::query())->make(true);
    }

    public function test()
    {
    	echo '<pre>';
    	// $member =  Member::contributions;
    	$member = App\Member::find(1);
        print_r($member);
    }

}
