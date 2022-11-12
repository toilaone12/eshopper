<?php

namespace App\Http\Controllers;

use App\Model\Commune;
use App\Model\Delivery;
use App\Model\District;
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
        // DB::enableQueryLog();
        $delivery = Delivery::find($data['idDelivery']);
        $delivery->price_feeship = $data['feeDelivery'];
        $delivery->save();
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
    public function calculatorDelivery(Request $request){
        $data = $request->all();
        $province = $data['province'];
        Session::get('fee');
        if($province == 1){
            $delivery = Delivery::where('province_feeship',$province)->get();
        }else{
            $delivery = Delivery::where('province_feeship',$province)->get();
        }
        foreach($delivery as $key => $d){
            $priceDelivery = $d->price_feeship;
        }
        Session::put('fee',$priceDelivery);
        Session::save();
        echo "return";
    }

}
