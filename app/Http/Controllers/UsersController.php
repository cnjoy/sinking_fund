<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Member;
use App\Payment;
use App\Loan;
use App\MemberPaymentDate;
use App\PaymentDate;
use App\ViewMember;
use Response;
use Illuminate\Support\Facades\Auth;

class UsersController extends MyBaseController
{

	public function updateMemberPayment() 
    {
        $input = Input::all();
        $user_id = 0;

        if( !empty($input['row_user_id']) ) {
            $exp = explode('_', $input['row_user_id']);
            $user_id = sizeof($exp) > 1 ? $exp[1] : 0;
        }
        $user = User::find($user_id);
        $data['paymentable_id'] = $user_id;
        $data['paymentable_type'] = 'App\Member';
        $data['amount'] =    $member->amount_due;
        $data['month_day'] = $input['month_day'];
        
        $condition = $data;
        if( $input['remove'] ) {
            unset($condition['amount']);
            Payment::whereArray($condition )->delete();
            
        }else {
            Payment::updateOrCreate($condition, $data );
        }

        $result = array('id' => $user_id );

        return Response::json($result);
       


    }
}

}