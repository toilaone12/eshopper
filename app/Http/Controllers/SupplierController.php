<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    //
    public function listSupplier(){
        $supplier = Supplier::all();
        return view('supplier.list_supplier',compact('supplier'));
    }
    public function insertFormSupplier(){
        return view('supplier.insert_supplier');
    }
    public function insertSupplier(Request $request){
        $data = $request->all();
        Validator::make($data,[
            'name_supplier' => ['required','string','unique:supplier'],
            'address_supplier' => ['required'],
        ])->validate();
        $supplier = Supplier::create([
            'name_supplier' => $data['name_supplier'],
            'address_supplier' => $data['address_supplier'],
        ]);
        if($supplier){
            return redirect()->route('supplier.listSupplier')->with('message',"Thêm nhà cung cấp ".$data["name_supplier"]." thành công");
        }else{
            return redirect()->route('supplier.listSupplier')->with('message',"Thêm nhà cung cấp ".$data["name_supplier"]." thất bại");
        }
    }
    public function editFormSupplier(Request $request){
        $supplier = Supplier::find($request['id_supplier']);
        return view('supplier.edit_supplier',compact('supplier'));
    }
    public function editSupplier(Request $request,$idSupplier){
        $data = $request->all();
        Validator::make($data,[
            'name_supplier' => ['required','string','unique:supplier'],
            'address_supplier' => ['required'],
            ])->validate();
        $supplier = Supplier::find($idSupplier);
        $supplier->name_supplier = $data['name_supplier'];
        $supplier->address_supplier = $data['address_supplier'];
        $supplier->save();
        if($supplier){
            return redirect()->route('supplier.listSupplier')->with('message',"Sửa nhà cung cấp ".$data["name_supplier"]." thành công");
        }else{
            return redirect()->route('supplier.listSupplier')->with('message',"Sửa nhà cung cấp ".$data["name_supplier"]." thất bại");
        }
    }
    public function deleteSupplier(Request $request){
        $data = $request->all();
        $choose = $data['choose'];
        $supplier = '';
        foreach($choose as $key => $c){
            $supplier = Supplier::where('id_supplier',$c)->delete();
        }
    }
}
