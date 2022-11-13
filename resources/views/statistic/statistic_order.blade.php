@extends('dashboard')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-8">
            <!-- Content Row -->
            <p class="f-20 text-gray-800 mb-2">Thống kê phiếu nhập hàng (Trong vòng 1 tháng gần đây)</p>
            <div class="row">
                <div class="col-xl-12 col-lg-7">
                    <!-- Area Chart -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Thống kê đơn hàng</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-area">
                                <div id="importNoteChart"></div>
                            </div>
                            <hr>
                            Styling for the area chart can be found in the
                            <code>/js/demo/chart-area-demo.js</code> file.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mt-5">
            <div class="bg-white border border-info rounded w-100 py-3 px-3">
                <p class="f-20 text-gray-800 mb-2">Lọc thống kê theo thời gian</p>
                <form action="" method="post" class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <input type="text" name="" class="form-control" placeholder="Từ ngày" id="datepicker3">
                        </div>
                        <div class="col-lg-4">
                            <input type="text" name="" class="form-control" placeholder="Đến ngày" id="datepicker4">
                        </div>
                        <div class="col-lg-2">
                            <input type="button" name="" class="btn btn-info f-14 text-white filter-date-import" value="Lọc kết quả">
                        </div>
                    </div>
                </form>
                <div class="row mb-3">
                    <div class="col-lg-8">
                        <select name="" id="" class="form-select text-secondary choose-statistic-import">
                            <option class="f-16 text-secondary" value="">Lọc theo ngày-tháng-năm</option>
                            <option class="f-16 text-secondary" value="7d">7 ngày gần đây</option>
                            <option class="f-16 text-secondary" value="3m">3 tháng gần đây</option>
                            <option class="f-16 text-secondary" value="6m">6 tháng gần đây</option>
                            <option class="f-16 text-secondary" value="9m">9 tháng gần đây</option>
                            <option class="f-16 text-secondary" value="1y">1 năm gần đây</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <!-- Content Row -->
            <p class="f-20 text-gray-800 mb-2">Thống kê phiếu xuất hàng (Trong vòng 1 tháng gần đây)</p>
            <div class="row">
                <div class="col-xl-12 col-lg-7">
                    <!-- Area Chart -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Thống kê đơn hàng</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-area">
                                <div id="exportNoteChart"></div>
                            </div>
                            <hr>
                            Styling for the area chart can be found in the
                            <code>/js/demo/chart-area-demo.js</code> file.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mt-5">
            <div class="bg-white border border-info rounded w-100 py-3 px-3">
                <p class="f-20 text-gray-800 mb-2">Lọc thống kê theo thời gian</p>
                <form action="" method="post" class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <input type="text" name="" class="form-control" placeholder="Từ ngày" id="datepicker1">
                        </div>
                        <div class="col-lg-4">
                            <input type="text" name="" class="form-control" placeholder="Đến ngày" id="datepicker2">
                        </div>
                        <div class="col-lg-2">
                            <input type="button" name="" class="btn btn-info f-14 text-white filter-date-export" value="Lọc kết quả">
                        </div>
                    </div>
                </form>
                <div class="row mb-3">
                    <div class="col-lg-8">
                        <select name="" id="" class="form-select text-secondary choose-statistic-export">
                            <option class="f-16 text-secondary" value="">Lọc theo ngày-tháng-năm</option>
                            <option class="f-16 text-secondary" value="7d">7 ngày gần đây</option>
                            <option class="f-16 text-secondary" value="3m">3 tháng gần đây</option>
                            <option class="f-16 text-secondary" value="6m">6 tháng gần đây</option>
                            <option class="f-16 text-secondary" value="9m">9 tháng gần đây</option>
                            <option class="f-16 text-secondary" value="1y">1 năm gần đây</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection