<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\DetailImport;
use App\Model\Note;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Product;
use App\Model\Statistic;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class StatisticController extends Controller
{
    //
    public function listStatistic(){
        return view('statistic.statistic_product');
    }
    public function showStatistic(Request $request){
        $data = $request->all();
        $dateNow = Carbon::now()->toDateString();
        $filter = Carbon::now()->subMonth(30)->toDateString();
        // echo $dateNow;
        $statistic = Statistic::whereBetween('date_statistic',[$filter,$dateNow])->get();
        foreach($statistic as $key => $s){
            
            $productData[] = array(
                'quantity' => $s->quantity_statistic,
                'price' => $s->price_statistic,
                'date' => date('d-m-Y',strtotime($s->date_statistic)),
            );
        }
        echo json_encode($productData);
    }
    public function filterDate(Request $request){
        $data = $request->all();
        $fromDate = $data['fromDate'];
        $toDate = $data['toDate'];
        $statistic = Statistic::whereBetween('date_statistic',[$fromDate,$toDate])->get();
        foreach($statistic as $key => $s){
            
            $productData[] = array(
                'quantity' => $s->quantity_statistic,
                'price' => $s->price_statistic,
                'date' => date('d-m-Y',strtotime($s->date_statistic)),
            );
        }
        echo json_encode($productData);
    }
    public function filterSelect(Request $request){
        $data = $request->all();
        $choose = $data['choose'];
        $dateNow = Carbon::now()->toDateString();
        $filter = '';
        if($choose == '7d'){
            $filter = Carbon::now()->subDay(7)->toDateString(); // lop xu ly datetime
        }else if($choose == '3m'){
            $filter = Carbon::now()->subMonth(3)->toDateString(); // lop xu ly datetime
        }else if($choose == '6m'){
            $filter = Carbon::now()->subMonth(6)->toDateString(); // lop xu ly datetime
        }else if($choose == '9m'){
            $filter = Carbon::now()->subMonth(9)->toDateString(); // lop xu ly datetime
        }else if($choose == '1y'){
            $filter = Carbon::now()->subYear(1)->toDateString(); // lop xu ly datetime
        }
        // echo $dateNow;
        $statistic = Statistic::whereBetween('date_statistic',[$filter,$dateNow])->get();
        foreach($statistic as $key => $s){
            
            $productData[] = array(
                'quantity' => $s->quantity_statistic,
                'price' => $s->price_statistic,
                'date' => date('d-m-Y',strtotime($s->date_statistic)),
            );
        }
        echo json_encode($productData);
    }
}
