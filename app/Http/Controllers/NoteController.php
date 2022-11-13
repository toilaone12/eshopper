<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\DetailImport;
use App\Model\Note;
use App\Model\StatisticNote;
use App\Model\Supplier;
use App\Model\WareHouse;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
session_start();
class NoteController extends Controller
{
    //
    public function listNote(){
        $note = Note::join('supplier as s','s.id_supplier','note.id_supplier')->get();
        return view('note.list_note',compact(
            'note'
        ));
    }
    public function detailNote(Request $request){
        $codeNote = $request->get('codeNote');
        $note = Note::join('supplier as s','s.id_supplier','note.id_supplier')->where('code_note',$codeNote)->first();
        $detailNote = DetailImport::where('code_note',$codeNote)->get();
        return view('note.detail_note',compact(
            'note',
            'detailNote'
        ));
    }
    public function importFormNote(){
        $supplier = Supplier::all();
        return view('note.import_note',compact(
            'supplier'
        ));
    }
    public function importNote(Request $request){
        $data = $request->all();
        Validator::make($data,[
            'name_note' => ['required'],
            'quantity_all_product' => ['required'],
        ])->validate();
        $codeNote = substr(md5(microtime()),rand(0,26),5); 
        $note = [
            'code_note' => $codeNote,
            'id_supplier' => $data['id_supplier'],
            'name_note' => $data['name_note'],
            'quantity_all' => $data['quantity_all_product'],
            'status_note' => 0,
        ];
        Session::put('note',$note);
        return view('note.import_detail_note');
    }
    public function importDetailNote(Request $request){
        $data = $request->all();
        $note = Session::get('note');
        $codeNote = $note['code_note'];
        $nameNote = $note['name_note'];
        $nameProduct = $data['nameProduct'];
        $quantityProduct = $data['quantityProduct'];
        $priceProduct = $data['priceProduct'];
        if(isset($note)){
            $createNote = Note::create($note);
            if($createNote){
                $quantityAll = 0;
                $totalAll = 0;
                $date_order = date("Y-m-d");
                foreach($nameProduct as $keyName => $p){
                    foreach($quantityProduct as $keyQuantity => $q){
                        if($keyName == $keyQuantity){
                            foreach($priceProduct as $keyPrice => $pr){
                                if($keyQuantity == $keyPrice){
                                    $quantityAll += $q;
                                    $totalAll += ($q * $pr);
                                    DetailImport::create([
                                        'code_note' => $codeNote,
                                        'name_product' => $p,
                                        'quantity_product' => $q,
                                        'price_product' => $pr,
                                    ]);
                                    Session::forget('note');
                                    Session::flush();
                                }
                            }
                        }
                    }
                }
                $statistic = StatisticNote::where('date_statistic_note',$date_order)
                ->where('type_statistic_note',0)->get();
                if(count($statistic) == 1){
                    $quantityStatistic = $statistic[0]->quantity_statistic_note;
                    $totalStatistic = $statistic[0]->price_statistic_note;
                    $quantityAll += $quantityStatistic;
                    // print_r($allQuantity);
                    $totalAll += $totalStatistic;
                    // echo $quantityStatistic;
                    $statistic->toQuery()->update([
                        'type_statistic_note' => 0,
                        'quantity_statistic_note' => $quantityAll,
                        'price_statistic_note' => $totalAll,
                        'date_statistic_note' => $date_order,
                    ]);
                }else{
                    StatisticNote::create([
                        'type_statistic_note' => 0,
                        'quantity_statistic_note' => $quantityAll,
                        'price_statistic_note' => $totalAll,
                        'date_statistic_note' => $date_order,
                    ]);
                    // print_r($quantityAll."-".$priceAll);
                }
            }else{
                return redirect()->route('note.listNote')->with("Thêm phiếu hàng '.$nameNote.' thất bại");
            }
        }else{
            return redirect()->back();
        }
    }
    public function printPDF($codeNote){
        $selectNote = Note::join('supplier as s','s.id_supplier','note.id_supplier')->where('code_note',$codeNote)->first();
        $selectDetailNote = DetailImport::where('code_note',$codeNote)->get();
        $nameNote = $selectNote->name_supplier;
        $pdf = Pdf::loadView('note.export_pdf',compact(
            'selectNote',
            'selectDetailNote'
        ));
        return $pdf->download('Hóa đơn của nhà cung cấp '.$nameNote.'.pdf');
    }
    public function exportToWarehouse(Request $request){
        $codeNote = $request->get('codeNote');
        $selectDetailNote = DetailImport::where('code_note',$codeNote)->get();
        if($selectDetailNote){
            foreach($selectDetailNote as $keyNote => $detailNote){
                $nameProduct = $detailNote->name_product;
                $quantityProduct = $detailNote->quantity_product;
                $priceProduct = $detailNote->price_product;
                $quantityAll = '';
                $wareHouse = WareHouse::where('name_product_warehouse',$nameProduct)->get();
                // dd($wareHouse);
                $date_order = date("Y-m-d");
                $statistic = StatisticNote::where('date_statistic_note',$date_order)->where('type_statistic_note',1)->get();
                // print_r(count($statistic).'</br>');
                if(count($statistic) == 1){
                    $quantityStatistic = $statistic[0]->quantity_statistic_note;
                    $totalStatistic = $statistic[0]->price_statistic_note;
                    $quantityAll = $quantityProduct + $quantityStatistic;
                    // print_r($allQuantity);
                    $totalAll = ($quantityProduct*$priceProduct) + $totalStatistic;
                    // echo $quantityStatistic;
                    $statistic->toQuery()->update([
                        'type_statistic_note' => 1,
                        'quantity_statistic_note' => $quantityAll,
                        'price_statistic_note' => $totalAll,
                        'date_statistic_note' => $date_order,
                    ]);
                    // echo "vao day</br>";
                }else{
                    $quantityAll = $quantityProduct;
                    $totalAll = $priceProduct * $quantityAll;
                    $arrayStatistic = array(
                        'type_statistic_note' => 1,
                        'quantity_statistic_note' => $quantityAll,
                        'price_statistic_note' => $totalAll,
                        'date_statistic_note' => $date_order,
                    );
                    StatisticNote::create($arrayStatistic);
                    // echo "vao day ne</br>";
                }
                if(count($wareHouse) == 1){
                    $quantityWareHouse = $wareHouse[0]->quantity_product_warehouse;
                    $quantityAll = $quantityProduct + $quantityWareHouse;
                    $wareHouse->name_product_warehouse = $nameProduct;
                    $wareHouse->quantity_product_warehouse = $quantityAll;
                    $wareHouse->price_product_warehouse = $priceProduct;
                    $wareHouse->toQuery()->update([
                        'name_product_warehouse' => $nameProduct,
                        'quantity_product_warehouse' => $quantityAll,
                        'price_product_warehouse' => $priceProduct,
                    ]);
                }else{
                    $quantityAll = $quantityProduct;
                    $createWareHouse = WareHouse::create([
                        'name_product_warehouse' => $nameProduct,
                        'quantity_product_warehouse' => $quantityAll,
                        'price_product_warehouse' => $priceProduct,
                    ]);
                }
            }
            $selectNote = Note::where('code_note',$codeNote)->first();
            $selectNote->status_note = 0;
            $selectNote->save();
            return redirect()->back();
        }
    }
}
