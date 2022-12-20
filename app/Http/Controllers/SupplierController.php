<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\DetailImport;
use App\Model\Note;
use App\Model\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Sabberworm\CSS\Property\Import;

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
            'phone_supplier' => ['required','regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/'],
            'address_supplier' => ['required'],
        ])->validate();
        $supplier = Supplier::create([
            'name_supplier' => $data['name_supplier'],
            'phone_supplier' => $data['phone_supplier'],
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
            'name_supplier' => ['required','string'],
            'phone_supplier' => ['required','regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/'],
            'address_supplier' => ['required'],
            ])->validate();
        $supplier = Supplier::find($idSupplier);
        $supplier->name_supplier = $data['name_supplier'];
        $supplier->phone_supplier = $data['phone_supplier'];
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
            $note = Note::where('id_supplier',$c)->first();
            // foreach($note as $key => $n){
            $deleteNote = Note::where('id_supplier',$c)->delete();
            $codeNote = $note->code_note;
            // delete();
            DetailImport::where('code_note',$codeNote)->delete();
            // }
        }
    }
}
