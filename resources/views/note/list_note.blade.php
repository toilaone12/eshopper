@extends('dashboard')
@section('content')
<!-- Topbar -->
<div class="form-group">
    <p class="text-success">
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
<table id="table_id" class="table">
    <thead>
        <tr align="center">
            <th>STT</th>
            <th>Mã phiếu hàng</th>
            <th>Tên nhà cung cấp</th>
            <th>Tên phiếu hàng</th>
            <th>Số lượng tất cả</th>
            <th>Tình trạng phiếu hàng</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @php
        $i = 0;
        @endphp
        @foreach($note as $key => $n)
        @php
        $i++
        @endphp
        <tr >
            <td>{{$i}}</td>
            <td>{{$n->code_note}}</td>
            <td>{{$n->name_supplier}}</td>
            <td>{{$n->name_note}}</td>
            <td>{{$n->quantity_all}}</td>
            <td width="200" class="{{($n->status_note == 0) ? 'bg-info' : 'bg-success'}} text-white">
                {{($n->status_note == 0) ? 'Chưa xuất hàng về kho' : "Đã xuất hàng về kho"}}
            </td>
            <td align="center">
                <a href="{{route('note.detailNote',['codeNote'=>$n->code_note])}}" class="btn btn-info">
                    <i class="fa-solid fa-circle-info text-white"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection