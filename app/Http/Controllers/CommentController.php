<?php

namespace App\Http\Controllers;

use App\Model\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //admin
    public function listComment(){
        $listComment = Comment::join('product as p','p.id','comment.id_product')->get();
        return view('comment.list_comment',compact('listComment'));
    }
    public function replyComment(Request $request){
        $data = $request->all();
        $db = array();
        $db['reply_comment'] = $data['id_comment'];
        $db['name_comment'] = "Quản trị viên";
        $db['id_product'] = $data['id_product'];
        $db['comment'] = $data['reply_comment'];
        $reply = Comment::create($db);
        if($reply){
            echo "done";
        }
    }
    //page
    public function comment(Request $request){
        $data = $request->all();
        $db = array();
        $db['id_product'] = $data['id_product'];
        $db['name_comment'] = $data['name_comment'];
        $db['comment'] = $data['answer_comment'];
        // dd($data);
        $comment = Comment::create($db);
        if($comment){
            echo "done";
        }
    }
}
