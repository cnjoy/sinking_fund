<?php

namespace App\Http\Controllers;
use App\Member;
use Illuminate\Http\Request;
use Response;
class LoansController extends Controller
{
    public function getMembers(){
    	$members = Member::all()->toArray();
    	$result['results'] = $members;
    	$data_map = function ($members){
    		return array(
    			'id' => $members['id'],
    			'text' => $members['first_name'] . ' ' . $members['last_name']);
    	};

    	$result['results'] = array_map($data_map, $members);

    	
    	return Response::json($result);
    }
}
