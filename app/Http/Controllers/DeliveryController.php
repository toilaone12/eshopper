<?php

namespace App\Http\Controllers;

use App\Model\Brand;
use App\Model\Category;
use App\Model\Commune;
use App\Model\Delivery;
use App\Model\District;
use App\Model\Order;
use App\Model\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DeliveryController extends Controller
{
    //
    public function listDelivery(){
        $delivery = Delivery::join('commune as c','c.id_commune','feeship.commune_feeship')
                    ->join('district as d','d.id_district','c.id_district')
                    ->join('province as p','p.id_province','d.id_province')
                    ->get();
        return view('delivery.list_delivery',compact('delivery'));
    }

    public function insertFromDelivery(){
        $province = Province::all();
        return view('delivery.insert_delivery',compact(
            'province'
        ));
    }

    public function editFormDelivery(Request $request){
        $id = $request->get('idDelivery');
        $province = Province::all();
        $delivery = Delivery::join('commune as c','c.id_commune','feeship.commune_feeship')
                    ->join('district as d','d.id_district','c.id_district')
                    ->join('province as p','p.id_province','d.id_province')
                    ->find($id);
        return view('delivery.edit_delivery',compact(
            'province',
            'delivery'
        ));
    }

    public function selectDelivery(Request $request){
        $data = $request->all();
        $name = $data['name'];
        $idDistrict = $data['district'];
        // DB::enableQueryLog();
        if(isset($name)){
            $output = "";
            if($name == 'province'){
                $selectDistrict = District::where('id_province',$idDistrict)->get();
                $output = $output."<option value='' class='f-14'>Quận / Huyện</option>";
                foreach($selectDistrict as $key => $district){
                    $output = $output.'<option value="'.$district->id_district.'" class="f-14">'.$district->name_district.'</option>';
                }
            }else{
                $selectCommune = Commune::where('id_district',$idDistrict)->get();
                $output = $output."<option value='' class='f-14'>Phường / Xã</option>";
                foreach($selectCommune as $key => $commune){
                    $output = $output.'<option value="'.$commune->id_commune.'" class="f-14">'.$commune->name_commune.'</option>';
                }
            }
        }  
        // $query = DB::getQueryLog();
        // print_r($selectCommune);
        echo $output;
    }
    public function insertDelivery(Request $request){
        $data = $request->all();
        Validator::make($data,[
            'province_feeship' => ['required','string'],
            'district_feeship' => ['required','string'],
            'commune_feeship' => ['required','string'],
            'fee_ship' => ['required','integer'],
        ])->validate();
        $db = array(
            'province_feeship' => $data['province_feeship'],
            'district_feeship' => $data['district_feeship'],
            'commune_feeship' => $data['commune_feeship'],
            'price_feeship' => $data['fee_ship'],
        );
        $delivery = Delivery::create($db);
        if($delivery){
            Session::put('message','Thêm phí vận chuyển thành công');
            return redirect()->route('delivery.listDelivery');
        }else{
            Session::put('message','Thêm phí vận chuyển thất bại');
            return redirect()->route('delivery.listDelivery');
        }
    }
    public function editDelivery(Request $request){
        $data = $request->all();
        $id = $request->get('idDelivery');
        Validator::make($data,[
            'province_feeship' => ['required','string'],
            'district_feeship' => ['required','string'],
            'commune_feeship' => ['required','string'],
            'fee_ship' => ['required','integer'],
        ])->validate();
        // dd($id);
        // DB::enableQueryLog();
        $delivery = Delivery::find($id);
        $delivery->province_feeship = $data['province_feeship'];
        $delivery->district_feeship = $data['district_feeship'];
        $delivery->commune_feeship = $data['commune_feeship'];
        $delivery->price_feeship = $data['fee_ship'];
        $delivery->save();
        if($delivery){
            Session::put('message','Sửa phí vận chuyển thành công');
            return redirect()->route('delivery.listDelivery');
        }else{
            Session::put('message','Sửa phí vận chuyển thất bại');
            return redirect()->route('delivery.listDelivery');
        }
        // $q = DB::getQueryLog();
        // print_r($data['idDelivery']);
    }
    public function deleteDelivery($idDelivery){
        $deleteDelivery = Delivery::where('id_feeship',$idDelivery)->delete();
        if($deleteDelivery){
            Session::put('message','Xoá phí vận chuyển thành công');
            return redirect()->route('delivery.listDelivery');
        }else{
            Session::put('message','Xoá phí vận chuyển thất bại');
            return redirect()->route('delivery.listDelivery');
        }
    }
    public function checkDelivery(){
        $selectCategory = Category::all();
        $selectBrand = Brand::take(6)->get();
        return view('delivery.check_delivery',compact(
            'selectCategory',
            'selectBrand'
        ));
    }
    public function filterDelivery(Request $request){
        $data = $request->all();
        $phoneOrder = $data['phone_order'];
        $codeOrder = $data['code_order'];
        Validator::make($data,[
            'phone_order' => ['required'],
            'code_order' => ['required']
        ],
        [
            'required' => "Thông tin bị thiếu yêu cầu điền vào"
        ])->validate();
        $filterDelivery = Order::join('order_detail as od','od.code_order','order.code_order')
        ->join('color as c','c.id_color','order.color_product_order')
        ->where('phone_order',$phoneOrder)->where('code_order',$codeOrder)->first();
        $selectCategory = Category::all();
        $selectBrand = Brand::take(6)->get();
        return view('delivery.history_order',compact(
            'filterDelivery',
            'selectCategory',
            'selectBrand'
        ));
    }
    
}
