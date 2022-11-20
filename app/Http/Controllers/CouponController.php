<?php

namespace App\Http\Controllers;

use App\Model\Coupon;
use App\Model\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    //
    public function listCoupon(){
        $selectCoupon = Coupon::all();
        return view('coupon.list_coupon',compact('selectCoupon'));
    }
    public function insertFromCoupon(){
        return view('coupon.insert_coupon');
    }
    public function insertCoupon(Request $request){
        $data = $request->all();
        Validator::make($data,[
            'name_coupon' => ['required','string'],
            'code_coupon' => ['required','unique:coupon','min:6','max:12'],
            'quantity_coupon' => ['required','integer','min:1'],
            'feature_coupon' => ['required'],
            'discount_coupon' => ['required'],
            'time_coupon' => ['required'],
        ])->validate();
        $db = array(
            'name_coupon' => $data['name_coupon'],
            'code_coupon' => $data['code_coupon'],
            'quantity_coupon' => $data['quantity_coupon'],
            'feature_coupon' => $data['feature_coupon'],
            'discount_coupon' => $data['discount_coupon'],
            'time_coupon' => $data['time_coupon'],
        );
        $insertCoupon = Coupon::create($db);
        if($insertCoupon){
            Session::put('message','Thêm mã giảm giá thành công!');
            return redirect()->route('coupon.listCoupon');
        }else{
            Session::put('message','Thêm mã giảm giá không thành công!');
            return redirect()->route('coupon.listCoupon');
        }
    }
    public function editFromCoupon($idCoupon){
        $selectCoupon = Coupon::where('id_coupon',$idCoupon)->first();
        return view('coupon.edit_coupon',compact('selectCoupon'));
    }
    public function editCoupon(Request $request, $idCoupon){
        $data = $request->all();
        $coupon = Coupon::find($idCoupon);
        // dd($data['time_coupon']);
        Validator::make($data,[
            'name_coupon' => ['required','string'],
            'code_coupon' => ['required','min:6','max:12'],
            'quantity_coupon' => ['required','integer','min:1'],
            'feature_coupon' => ['required'],
            'discount_coupon' => ['required'],
            'time_coupon' => ['required'],
        ])->validate();
        $coupon->name_coupon = $data['name_coupon'];
        $coupon->code_coupon = $data['code_coupon'];
        $coupon->quantity_coupon = $data['quantity_coupon'];
        $coupon->feature_coupon = $data['feature_coupon'];
        $coupon->discount_coupon = $data['discount_coupon'];
        $coupon->time_coupon = $data['time_coupon'];
        $coupon->save();
        if($coupon){
            Session::put('message','Sửa mã giảm giá thành công!');
            return redirect()->route('coupon.listCoupon');
        }else{
            Session::put('message','Sửa mã giảm giá không thành công!');
            return redirect()->route('coupon.listCoupon');
        }
    }
    public function deleteCoupon($idCoupon){
        $deleteCoupon = Coupon::where('id_coupon',$idCoupon)->delete();
        if($deleteCoupon){
            Session::put('message','Xóa mã giảm giá thành công!');
            return redirect()->route('coupon.listCoupon');
        }else{
            Session::put('message','Xóa mã giảm giá không thành công!');
            return redirect()->route('coupon.listCoupon');
        }
    }
    public function uploadCustomerVip(Request $request){
        $data = $request->all();
        $idCoupon = $data['arrayId'];
        $customer = Customer::where('vip_customer',1)->get();
        $dataCustomer = [];
        $titleMail = 'Mã khuyến mãi của EShopper';
        $contentMail = '';
        $dataCoupon = array();
        foreach($customer as $keyCustomer => $person){
            foreach($idCoupon as $keyCoupon => $c){
                $coupon = Coupon::find($c);
                $dateCoupon = date("d-m-Y",strtotime($coupon->created_at));
                $dateExpireCoupon = date("d-m-Y",strtotime($coupon->time_coupon));
                $contentMail = "Mã khuyến mãi từ ngày ".$dateCoupon." đến ngày ".$dateExpireCoupon;
                $dataCustomer['emailCustomer'][] = $person->email_customer;
                $dataCoupon = [
                    'nameCustomer' => $person->name_customer,
                    'contentMail' => $contentMail,
                    'nameCoupon' => $coupon->name_coupon,
                    'codeCoupon' => $coupon->code_coupon,
                    'quantityCoupon' => $coupon->quantity_coupon
                ];
                // print_r($dataCoupon);
                Mail::send('coupon.email_coupon',$dataCoupon,function($message) use ($titleMail,$dataCustomer){
                    $message->to($dataCustomer['emailCustomer'])->subject($titleMail);
                    $message->from($dataCustomer['emailCustomer'],$titleMail);
                });
            }
        }
    }
    public function uploadCustomerNormal(Request $request){
        $data = $request->all();
        $idCoupon = $data['arrayId'];
        $customer = Customer::where('vip_customer',0)->get();
        $dataCustomer = [];
        $titleMail = 'Mã khuyến mãi của EShopper';
        $contentMail = '';
        $dataCoupon = array();
        foreach($customer as $keyCustomer => $person){
            foreach($idCoupon as $keyCoupon => $c){
                $coupon = Coupon::find($c);
                $dateCoupon = date("d-m-Y",strtotime($coupon->created_at));
                $dateExpireCoupon = date("d-m-Y",strtotime($coupon->time_coupon));
                $contentMail = "Mã khuyến mãi từ ngày ".$dateCoupon." đến ngày ".$dateExpireCoupon;
                $dataCustomer['emailCustomer'][] = $person->email_customer;
                $dataCoupon = [
                    'nameCustomer' => $person->name_customer,
                    'contentMail' => $contentMail,
                    'nameCoupon' => $coupon->name_coupon,
                    'codeCoupon' => $coupon->code_coupon,
                    'quantityCoupon' => $coupon->quantity_coupon
                ];
                // print_r($dataCoupon);
                Mail::send('coupon.email_coupon',$dataCoupon,function($message) use ($titleMail,$dataCustomer){
                    $message->to($dataCustomer['emailCustomer'])->subject($titleMail);
                    $message->from($dataCustomer['emailCustomer'],$titleMail);
                });
            }
        }
    }
}
