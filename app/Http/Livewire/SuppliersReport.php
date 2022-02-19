<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\payment;
use App\Containers;
use App\Suppliers;
use Carbon\Carbon;


class SuppliersReport extends Component
{
    public $SuppliersReport;
    public $report_infos;
    public $name,$id_suppliers,$supplier_name;

    public function SupplierInfo($name)
    {   
        if($name != ''){
            $Supplier = Suppliers::where('name', $name)->first();
            if($Supplier != ''){
                $this->SuppliersReport['supplier_id'] = $Supplier->id;   // dd($this->id_suppliers);
                $this->supplier_name = $Supplier->name;
            }   else{
                $this->reset();
            }
        }   else{
            $this->reset();
        }
    }

    public function mount()
    {
        $this->OldSum = 0;
    }

    public function render()
    {
        $this->Suppliers = Suppliers::All();
        return view('livewire.suppliers-report');
    }

    public function SuppliersReporttByDate()
    { 
        $report_infos = [];
        
        $date_from = Carbon::parse($this->SuppliersReport['date_from'])->toDateString();
        $date_to = Carbon::parse($this->SuppliersReport['date_to'])->toDateString();;
        $SumContainers = Containers::where ('cont_date','<',$date_from)
                        ->where ('cont_supplier',$this->SuppliersReport['supplier_id'])->sum('cont_amount');  
        $SumPayment = payment::where ('payment_date','<',$date_from)
                    ->where ('id_suppliers',$this->SuppliersReport['supplier_id'])->sum('payment_amount');  
        $OldSum = $SumContainers - $SumPayment; 
        $this->OldSum = $OldSum; 
       
        while ($date_from <=$date_to){
            $Containers = Containers::where ('cont_date',$date_from)
                        ->where ('cont_supplier',$this->SuppliersReport['supplier_id'])->get();
            foreach ($Containers as $Container) {
                $report_infos[] = 
                [
                   'info_date' => $date_from,
                   'container_amount' => $Container->cont_amount,
                   'Payment_amount' => 0,
                   'info_details' => "  ميلغ وجبة مواد رقم " .$Container->cont_no ,
                   'info_note' => $Container->cont_type_supply,
                ];  

            }
            $Payments = payment::where ('payment_date',$date_from)
                        ->where ('id_suppliers',$this->SuppliersReport['supplier_id'])->get();
            foreach ($Payments as $Payment) {
                $report_infos[] = 
                [
                   'info_date' => $date_from,
                   'container_amount' => 0,
                   'Payment_amount' => $Payment->payment_amount,
                   'info_details' =>  $Payment->payment_company,
                   'info_note' => $Payment->payment_note,
                ];  

            }
            $date_from = Carbon::parse($date_from)->addDay()->toDateString(); 
        } 
    
        $this->report_infos = collect($report_infos);
       // dd($report_info);
       
       
        /* $ContainersInfos = Containers::whereBetween('cont_date',[$date_from,$date_to])
        ->where('cont_supplier',$this->SuppliersReport['supplier_id'])->get(); 
        $PaymentInfos= $ContainersInfos;
        $this->PaymentInfo = $PaymentInfos;  */
        /*$ PaymentInfos = payment::whereBetween('payment_date',[$date_from,$date_to])
        ->where('id_suppliers',$this->SuppliersReport['supplier_id'])->get(); 
        $this->PaymentInfo = $PaymentInfos; */

    }
}
