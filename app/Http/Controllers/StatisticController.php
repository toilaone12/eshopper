<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\DetailImport;
use App\Model\Note;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Product;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    //
    public function listStatistic(){
        return view('statistic.statistic_product');
    }
    public function filterDate(Request $request){
        $data = $request->all();
        $fromDate = $data['fromDate'];
        $toDate = $data['toDate'];
        $product = DetailImport::whereBetween('updated_at',[$fromDate,$toDate])->get();
        foreach($product as $key => $p){
            
            $productData[] = array(
                'quantity' => $p->quantity_product,
                'name' => $p->name_product,
                'date' => date('d-m-Y',strtotime($p->updated_at)),
            );
        }
        echo json_encode($productData);
    }
}