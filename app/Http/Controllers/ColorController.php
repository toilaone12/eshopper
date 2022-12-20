<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Color;
use App\Model\DetailImport;
use App\Model\ProductColor;
use App\Model\WareHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    //
    public function listColor(){
        $color = Color::all();
        return view('color.list_color',compact('color'));
    }
    public function insertColor(Request $request){
        $data = $request->all();
        Validator::make($data,[
            'name_color' => ['required']
        ])->validate();
        $color = Color::create([
            'name_color' => $data['name_color']
        ]);
        if($color){
            Session::put('message','Thêm màu sắc thành công!');
            return redirect()->route('color.listColor');
        }else{
            Session::put('message','Thêm màu sắc thất bại!');
            return redirect()->route('color.listColor');
        }
    }
    public function deleteColor(Request $request){
        $idColor = $request->get('idColor');
        $color = Color::find($idColor)->delete();
        DetailImport::where('id_color',$idColor)->delete();
        WareHouse::where('id_color',$idColor)->delete();
        ProductColor::where('id_color',$idColor)->delete();
        if($color){
            Session::put('message','Xóa màu sắc thành công!');
            return redirect()->route('color.listColor');
        }else{
            Session::put('message','Xóa màu sắc thất bại!');
            return redirect()->route('color.listColor');
        }
    }
    public function updateColor(Request $request){
        $data = $request->all();
        // print_r($data);
        $idColor = $data['idColor'];
        $nameColor = $data['nameColor'];
        $color = Color::find($idColor);
        $color->name_color = $nameColor;
        $color->save();
        if($color){
            Session::put('message','Sửa màu sắc thành công!');
            return redirect()->route('color.listColor');
        }else{
            Session::put('message','Sửa màu sắc thất bại!');
            return redirect()->route('color.listColor');
        }
    }
}
