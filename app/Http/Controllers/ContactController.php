<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //admin
    public function listContact(){
        $contact = Contact::all();
        return view('contact.info_contact',compact('contact'));
    }

    public function editContactForm(Request $request){
        $idContact = $request->get('idContact');
        $contact = Contact::find($idContact);
        return view('contact.edit_contact',compact('contact'));
    }

    public function insertContact(Request $request){
        $data = $request->all();
        Validator::make($data,
        [
            'info_contact' => ['required'],
            'map_contact' => ['required']
        ],
        [
        'required' => 'Dữ liệu này trống yêu cầu thêm vào!'
        ])->validate();
        $contact = Contact::create([
            'info_contact' => $data['info_contact'],
            'map_contact' => $data['map_contact'],
        ]);
        if(isset($contact)){
            Session::put('message',"Thêm thông tin thành công!");
            return redirect()->route('contact.listContact');
        }else{
            Session::put('message',"Thêm thông tin không thành công!");
            return redirect()->route('contact.listContact');
        }
    }

    public function editContact(Request $request){
        $idContact = $request->get('idContact');
        $data = $request->all();
        Validator::make($data,
        [
            'info_contact' => ['required'],
            'map_contact' => ['required']
        ],
        [
        'required' => 'Dữ liệu này trống yêu cầu thêm vào!'
        ])->validate();
        $contact = Contact::find($idContact);
        $contact->info_contact = $data['info_contact']; 
        $contact->map_contact = $data['map_contact']; 
        $contact->save();
        if(isset($contact)){
            Session::put('message',"Sửa thông tin thành công!");
            return redirect()->route('contact.listContact');
        }else{
            Session::put('message',"Sửa thông tin không thành công!");
            return redirect()->route('contact.listContact');
        }
    }

    public function deleteContact(Request $request){
        $idContact = $request->get('idContact');
        $contact = Contact::find($idContact);
        $contact->delete();
        if(isset($contact)){
            Session::put('message',"Xoá thông tin thành công!");
            return redirect()->route('contact.listContact');
        }else{
            Session::put('message',"Xoá thông tin không thành công!");
            return redirect()->route('contact.listContact');
        }
    }

    //page
    public function contact(){
        $selectBrand = Brand::all();
        $selectCategory = Category::all();
        $contact = Contact::first();
        return view('contact.contact',compact(
            'selectBrand',
            'selectCategory',
            'contact'
        ));
    }
    
}
