<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    //admin
    // public function listReview(){
    //     $listComment = Review::join('product as p','p.id','comment.id_product')->get();
    //     return view('comment.list_comment',compact('listComment'));
    // }
    //page
    public function review(Request $request){
        $data = $request->all();
        $db = array();
        $db['id_product'] = $data['id_product'];
        $db['name_review'] = $data['name_review'];
        $db['content_review'] = $data['content_review'];
        $db['rating'] = $data['index'];
        $comment = Review::create($db);
        if($comment){
            $product = Product::find($data['id_product']);
            if($product){
                $product->number_reviews += 1;
                $product->save();
                echo "done";
            }
        }
    }
}
