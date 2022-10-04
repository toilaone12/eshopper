<?php

namespace App\Http\Controllers;

use App\Model\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function comment(Request $request){
        $data = $request->all();
        $db = array();
        $db['id_product'] = $data['id_product'];
        $db['name_comment'] = $data['name_comment'];
        $db['answer_comment'] = $data['answer_comment'];
        // dd($data);
        $comment = Comment::create($db);
        if($comment){
            echo "done";
        }
    }
}
