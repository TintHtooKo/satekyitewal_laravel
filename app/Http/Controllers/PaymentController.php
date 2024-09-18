<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    public function payment(){
        $payments = Payment::orderBy('id','desc')->paginate(3);
        return view('admin.payment.payment',compact('payments'));
    }

    // add new payment method
    public function paymentCreate(Request $request){
        $this->paymentValidate($request);
        $data = $this->paymentData($request);
        Payment::create($data);
        Alert::success('Success', 'Payment Method Added Successfully');
        return back();
    }

    // delete payment method
    public function paymentDelete($id){
        Payment::find($id)->delete();
        Alert::success('Success', 'Payment Method Deleted Successfully');
        return back();
    }

    //route to payment update page
    public function paymentUpdatePage($id){
        $payment = Payment::find($id);
        return view('admin.payment.update',compact('payment'));
    }

    // update payment method
    public function paymentUpdate($id, Request $request){
        $this->paymentValidate($request, $id); // Pass the payment id to the validation
        Payment::where('id',$id)->update([
            'account_name' => $request->paymentAccName,
            'account_number' => $request->paymentAccNo,
            'type' => $request->paymentAccMethod,
            'created_at' => Carbon::now(),
        ]);
        Alert::success('Success', 'Payment Method Updated Successfully');
        return to_route('payment');
    }


    // validate payment method
    private function paymentValidate($request, $id = null){
        $request->validate([
            'paymentAccName' => 'required',
            'paymentAccNo' => 'required|unique:payments,account_number,'.$id, // Pass the payment id to the validation when update
            'paymentAccMethod' => 'required',
        ]);
    }

    // request payment data
    private function paymentData($request){
        return [
            'account_name' => $request->paymentAccName,
            'account_number' => $request->paymentAccNo,
            'type' => $request->paymentAccMethod,
            'created_at' => Carbon::now(),
        ];
    }

}
