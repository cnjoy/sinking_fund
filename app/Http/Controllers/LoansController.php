<?php

namespace App\Http\Controllers;
use App\Member;
use App\Lender;
use App\Loan;
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
    public function add(Request $request){
        // print_r($request->all());
        $lender = new Lender();
        $lender->first_name = $request->first_name;
        $lender->last_name = $request->last_name;
        $lender->is_member = 1;
        $lender->save();
        // echo $lender->id;

        $loan = new Loan();
        $loan->lender_id = $lender->id;
        $loan->member_id = $request->guaranter;
        $loan->total_amount = $request->amount;
        $loan->terms_to_pay = $request->terms;
        $loan->save();
        return redirect('/apply-loan');

    }
}
