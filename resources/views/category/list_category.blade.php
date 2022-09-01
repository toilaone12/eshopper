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
        <th scope="col">Mã danh mục</th>
        <th scope="col">Tên danh mục</th>
        <th rowspan="2" scope="col">Chức năng</th>
    </tr>
</thead>
@foreach($selectList as $key => $c)
<tbody>
    <tr align="center">
        <th scope="row">{{$c->id_category}}</th>
        <td>{{$c->name_category}}</td>
        <td>
            
        </td>
    </tr>
</tbody>
@endforeach
</table>

@endsection