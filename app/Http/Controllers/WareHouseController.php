<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\WareHouse;
use Illuminate\Http\Request;

class WareHouseController extends Controller
{
    //
    public function listWareHouse(){
        $wareHouse = WareHouse::all();
        return view('warehouse.list_warehouse',compact('wareHouse'));
    }
}
