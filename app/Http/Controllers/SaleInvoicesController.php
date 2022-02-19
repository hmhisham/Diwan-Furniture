<?php

namespace App\Http\Controllers;

use App\Items;
use App\Store;
use App\Customers;
use App\ReturnItems;
use App\SaleInvoices;
use App\SaleInvoicesDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleInvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $SaleInvoice = SaleInvoices::all();
        return view('invoices.index', [
            'SaleInvoice' => $SaleInvoice
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoices.IssuanceSalesInvoice');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $SaleInvoice = SaleInvoices::find($id);
        $SaleInvoicesDetails = SaleInvoicesDetails::where('sale_invoices_id', $SaleInvoice->id)->get();
        return view('invoices.ReturnItem', [
            'SaleInvoice' => $SaleInvoice,
            'SaleInvoicesDetails' => $SaleInvoicesDetails
        ]);
    }

    public function PrintInvoice($id)
    {   
        $SaleInvoice = SaleInvoices::find($id);
        $SaleInvoicesDetails = SaleInvoicesDetails::where('sale_invoices_id', $SaleInvoice->id)->get();
        return view('invoices.PrintInvoice', [
            'SaleInvoice' => $SaleInvoice,
            'SaleInvoicesDetails' => $SaleInvoicesDetails
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    public function Return_Item(Request $request)
    {  
        if($request->return_quantity > 0 AND $request->return_quantity <= $request->quantity){
            ReturnItems::create($request->all());

            $return_quantity = $request->return_quantity;

            $Item_Stors = Store::where('items_id', $request->items_id)
                ->whereColumn('item_remaining', '<', 'item_qty')
                ->orderBy('containers_date', 'DESC')
                ->orderBy('id', 'DESC')->get();

            foreach ($Item_Stors as $Item_Stor) {
                $rem_sale = $Item_Stor->item_qty - $Item_Stor->item_remaining;

                if ($return_quantity <= $rem_sale) {
                    $rem = $Item_Stor->item_remaining + $return_quantity;
                    Store::find($Item_Stor->id)->update(['item_remaining' => $rem]);
                    break;
                } else {
                    Store::find($Item_Stor->id)->update(['item_remaining' => $Item_Stor->item_qty]);
                    $return_quantity = $return_quantity - $rem_sale;
                }
            }
        }else{
            session()->flash('ErrorQTY', 'الكمية المراد ارجاعها غير صحيحة');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
