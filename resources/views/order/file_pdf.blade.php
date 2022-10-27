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
    </style>
    <h3 style="text-align: center;">Hoá đơn thanh toán</h3>
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
            $featureCoupon = $selectCoupon->feature_coupon;
            $discountCoupon = $selectCoupon->discount_coupon;
            $feeDelivery = $selectOrder->fee_delivery;
        @endphp
        @foreach($selectDetailOrder as $key => $do)
            @php
                $i++;   
                $total = $do->price_product_order * $do->quantity_product_order;
                $allTotal += $total;
            @endphp
        <tr>
            <td align="center" class="f-14" style="padding: 8px 10px">{{$i}}</td>
            <td align="center" class="f-14" style="padding: 8px 10px">{{$do->name_product_order}}</td>
            <td align="center" class="f-14" style="padding: 8px 10px">{{$do->quantity_product_order}}</td>
            <td align="center" class="f-14" style="padding: 8px 10px">{{number_format($do->price_product_order,0,',','.')}} ₫</td>
            <td align="center" class="f-14" style="padding: 8px 10px">{{number_format($total,0,',','.')}} ₫</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="6" class="f-14 mt-2" style="padding: 8px 10px">Tiền gốc: {{number_format($allTotal,0,',','.')}} ₫</td>
        </tr>
        <tr>
            <td colspan="6" class="f-14 mt-2" style="padding: 8px 10px">Tiền mã giảm giá: 
                {{($selectCoupon !== 0) ? ($featureCoupon == 1) ? number_format($discountCoupon,0,',','.').'₫' : number_format($discountCoupon,0,',','.').'%' : "0₫" }}
            </td>
        </tr>
        <tr>
            <td colspan="6" class="f-14 mt-2" style="padding: 8px 10px">Phí vận chuyển: 
                {{number_format($feeDelivery,0,',','.')}} ₫
            </td>
        </tr>
        <tr>
            <td colspan="6" class="f-14 mt-2" style="padding: 8px 10px">Tổng tiền: 
                {{number_format(($featureCoupon == 1) ?  $allTotal + $feeDelivery - $discountCoupon : $allTotal + $feeDelivery - ($allTotal * ($discountCoupon / 100)),0,',','.')}} ₫
            </td>
        </tr>
    </tbody>
    </table>
</body>
</html>