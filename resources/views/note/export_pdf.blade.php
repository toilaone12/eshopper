<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn</title>
    <link href="{{asset('backend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <script src="https://kit.fontawesome.com/8c040fba7a.js" crossorigin="anonymous"></script>
    <!-- Custom styles for this template-->
    <link href="{{asset('backend/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/css/sb-admin-2.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<style>
    body{
        font-family: Dejavu Sans;
    }
    .table{
        width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
        border-collapse: collapse;
    }
    .table th{
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }
    .table-bordered{
        border: 1px solid #dee2e6;
    }
    .f-14{
        font-size: 14px;
    }
    .f-12{
        font-size: 12px;
    }
    .table-bordered th,
    .table-bordered td{
        border: 1px solid #dee2e6;
    }
    .mt-2{
        margin-top: 8px;
    }
    .mb-2{
        margin-bottom: 8px;
    }
</style>
<h3 style="text-align: center;">Phiếu xuất hàng</h3>
<div class="f-14 mb-2">Tên nhà cung cấp: {{$selectNote->name_supplier}}</div>
<div class="f-14 mb-2">Họ tên người nhận hàng: EShopper</div>
<div class="f-14 mb-2">Địa chỉ: Triều Khúc, Thanh Trì, Hà Nội</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th class="f-12">STT</th>
            <th class="f-12">Tên sản phẩm</th>
            <th class="f-12">Số lượng</th>
            <th class="f-12">Đơn giá</th>
            <th class="f-12">Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
            $allTotal = 0;
        @endphp
        @foreach($selectDetailNote as $key => $detail)
            @php
                $i++;   
                $total = $detail->price_product * $detail->quantity_product;
                $allTotal += $total;
            @endphp
        <tr>
            <td align="center" class="f-14" style="padding: 8px 10px">{{$i}}</td>
            <td align="center" class="f-14" style="padding: 8px 10px">{{$detail->name_product}}</td>
            <td align="center" class="f-14" style="padding: 8px 10px">{{$detail->quantity_product}}</td>
            <td align="center" class="f-14" style="padding: 8px 10px">{{number_format($detail->price_product,0,',','.')}} ₫</td>
            <td align="center" class="f-14" style="padding: 8px 10px">{{number_format($total,0,',','.')}} ₫</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="6" class="f-14 mt-2" style="padding: 8px 10px">Tổng tiền: {{number_format($allTotal,0,',','.')}} ₫</td>
        </tr>
    </tbody>
</table>
<div class="row">
    <div class="col-lg-4">

    </div>
</div>
</body>
</html>