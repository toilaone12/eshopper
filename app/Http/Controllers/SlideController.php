<?php

namespace App\Http\Controllers;

use App\Model\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SlideController extends Controller
{
    //
    public function listSlide(){
        $selectSlide = Slide::all();
        return view('slide.list_slide',compact('selectSlide'));
    }
    public function formInsertSlide(){
        return view('slide.insert_slide');
    }
    public function insertSlide(Request $request){
        $data = $request->all();
        $image = $request->file('image_slide');
        if($image){
            Validator::make($data,[
                'name_slide' => ['required','unique:slide'],
                'image_slide' => ['image'],
            ])->validate();
            $sizeImage = $image->getSize();
            if($sizeImage < 2000000){
                $imageName = $image->getClientOriginalName();
                $imageCurrent = current(explode('.',$imageName));
                $imageNew = $imageCurrent.'.'.$image->extension();
                if($image->move('images/slide',$imageNew)){
                    $db = array();
                    $db['image_slide'] = $imageNew;
                    $db['name_slide'] = $data['name_slide'];
                    $insert_slide = Slide::create($db);
                    if($insert_slide){
                        Session::put('message','Thêm ảnh quảng cáo thành công!');
                        return redirect()->route('slide.listSlide');
                    }
                }else{
                    Session::put('errors','Không thêm được dữ liệu ảnh!');
                    return redirect()->route('slide.insertFormSlide');
                }
            }else{
                Session::put('errors','Quá kích thước cho phép!');
                return redirect()->route('slide.insertFormSlide');
            }
        }else{
            return redirect()->back();
        }
    }
    public function formEditSlide($idSlide){
        $selectSlideId = Slide::find($idSlide);
        return view('slide.edit_slide',compact('selectSlideId'));
    }
    public function editSlide(Request $request, $idSlide){
        $data = $request->all();
        $image = $request->file('image_slide');
        $slide = Slide::find($idSlide);
        if($image){
            Validator::make($data,[
                'name_slide' => ['required'],
                'image_slide' => ['image'],
            ])->validate();
            $sizeImage = $image->getSize();
            if($sizeImage < 2000000){
                $imageName = $image->getClientOriginalName();
                $imageCurrent = current(explode('.',$imageName));
                $imageNew = $imageCurrent.'.'.$image->extension();
                if($image->move('images/slide',$imageNew)){
                    $slide->image_slide = $imageNew;
                    $slide->name_slide = $data['name_slide'];
                    $edit_slide = $slide->save();
                    if($edit_slide){
                        Session::put('message','Sửa ảnh quảng cáo thành công!');
                        return redirect()->route('slide.listSlide');
                    }
                }else{
                    Session::put('message','Không thêm được dữ liệu ảnh!');
                    return redirect()->route('slide.editFormSlide');
                }
            }else{
                Session::put('message','Quá kích thước cho phép!');
                return redirect()->route('slide.editFormSlide');
            }
        }else{
            $slide->name_slide = $data['name_slide'];
            $edit_slide = $slide->save();
            if($edit_slide){
                Session::put('message','Sửa ảnh quảng cáo thành công!');
                return redirect()->route('slide.listSlide');
            }
        }
    }
    public function deleteSlide($idSlide){
        $deleteSlide = Slide::where('id_slide',$idSlide)->delete();
        if($deleteSlide){
            Session::put('message','Xóa ảnh quảng cáo thành công!');
            return redirect()->route('slide.listSlide');
        }else{
            Session::put('message','Xóa ảnh quảng cáo không thành công!');
            return redirect()->route('slide.listSlide');
        }
    }
}
