@extends('dashboard')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Thống kê sản phẩm</h1>
    <form action="" method="post" class="form-group">
        <div class="row">
            <div class="col-lg-2">
                <input type="text" name="" class="form-control" placeholder="Từ ngày" id="datepicker1">
            </div>
            <div class="col-lg-2">
                <input type="text" name="" class="form-control" placeholder="Đến ngày" id="datepicker2">
            </div>
            <div class="col-lg-2">
                <input type="button" name="" class="btn btn-info f-14 text-white filter-date" value="Lọc kết quả">
            </div>
        </div>
    </form>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thống kê đơn hàng</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <div id="areaChart"></div>
                    </div>
                    <hr>
                    Styling for the area chart can be found in the
                    <code>/js/demo/chart-area-demo.js</code> file.
                </div>
            </div>

            <!-- Bar Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="myBarChart"></canvas>
                    </div>
                    <hr>
                    Styling for the bar chart can be found in the
                    <code>/js/demo/chart-bar-demo.js</code> file.
                </div>
            </div>

        </div>

        <!-- Donut Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Donut Chart</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <hr>
                    Styling for the donut chart can be found in the
                    <code>/js/demo/chart-pie-demo.js</code> file.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection