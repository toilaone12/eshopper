@extends('dashboard')
@section('content')
<!-- Topbar -->
<div class="form-group">
    <c class="text-success">
        <?php
            use Illuminate\Support\Facades\Session;
            $message = Session::get('message');
            if(isset($message)){
                // echo "<script>alert('$message');</script>";
                echo $message;
                Session::put('message','');
            }
        ?>
    </p>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách bình luận</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="table_id" class="table">
                <thead>
                    <tr align="center">
                        <th>Mã ID</th>
                        <th>Tên người gửi</th>
                        <th>Câu hỏi</th>
                        <th>Ngày gửi</th>
                        <th>Sản phẩm bình luận</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listComment as $key => $c)
                        @if($c->name_comment !== "Quản trị viên")
                        <tr>
                            @csrf
                            <td width="100">{{$c->id_comment}}</td>
                            <td width="300">{{$c->name_comment}}</td>
                            <td class="d-inline-block" width="450">
                                <span class="mb-2">
                                    <span class="text-danger">Câu hỏi:</span> {{$c->comment}}
                                </span>
                                <ul class="mb-2" style="padding-left: 0 !important">
                                    @foreach($listComment as $key => $c_reply)
                                    @if($c->id_comment == $c_reply->reply_comment)
                                    <li class="text-success list-group-item" >{{$c_reply->name_comment}}: <span class="text-dark">{{$c_reply->comment}}</span></li> 
                                    @endif
                                    @endforeach
                                </ul>
                                @if(Auth::check())
                                @if(Auth::user()->id_role == 1)
                                <textarea name="" id="" cols="30" rows="3" class="md-textarea form-control mb-2 answer-question-{{$c->id_comment}}"></textarea>
                                <button class="btn btn-primary f-14 button-answer" data-comment-id="{{$c->id_comment}}" data-product-id="{{$c->id_product}}">
                                    Trả lời bình luận
                                </button>
                                @endif
                                @endif
                            </td>
                            <td width="200">{{$c->created_at}}</td>
                            <td>{{$c->name_product}}</td>
                            @if(Auth::check())
                            @if(Auth::user()->id_role == 1)
                            <td>
                                <a href="" class="btn btn-success mb-2">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="" class="btn btn-danger">
                                    <i class="fa-solid fa-rectangle-xmark"></i>
                                </a>
                            </td>
                            @endif
                            @endif
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection