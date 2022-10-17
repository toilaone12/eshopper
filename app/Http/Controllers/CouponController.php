<?php

namespace App\Http\Controllers;

use App\Model\Coupon;
use Illuminate\Http\Request;
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
}
