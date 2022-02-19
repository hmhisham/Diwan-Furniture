<?php

namespace App\Http\Livewire;

use App\payment;
use App\Suppliers;
use Livewire\Component;

class PaymentInfo extends Component
{
    
    public $payment_amount,$payment_date,$payment_company,$payment_note;
    public $name,$id_suppliers,$supplier_name;
    public $PaymentId;
    public $Suppliers;

    public function SupplierInfo($name)
    {   
        if($name != ''){
            $Supplier = Suppliers::where('name', $name)->first();
            if($Supplier != ''){
                $this->id_suppliers = $Supplier->id;  
                $this->supplier_name = $Supplier->name;
            }   else{
                $this->reset();
            }
        }   else{
            $this->reset();
        }
    }

    public function render()
    {
        $this->Suppliers = Suppliers::All();
        $Payment = payment::orderBy('payment_date', 'DESC')->get();
        return view('livewire.payment-info', ['payments'=>$Payment]);
    }
    public function AddToPayment()
    {
        payment::create([
                'id_suppliers' => $this->id_suppliers,
                'payment_amount' => $this->payment_amount,
                'payment_date' => $this->payment_date,
                'payment_company' => $this->payment_company,
                'payment_note' => $this->payment_note,
                
            ]);

            $this->reset();

           // $this->AfterAddInStore();

            $this->dispatchBrowserEvent('alert',
                ['type' => 'success',
                'message' => 'تم تسجيل تسديد المبلغ بنجاح',
                'title' => 'إضافة مادة']
            );
        
           /*  $this->dispatchBrowserEvent('alert',
                ['type' => 'warning',
                'message' => 'لايمكن إضافة المادة إلى المخزن',
                'title' => 'إضافة مادة']
            );
         */
    }
    public function DeleteFromPayment($PaymentId){
        payment::find($PaymentId)->delete();
    }
    public function SendPaymentId($payment_id){
        $this->PaymentId = $payment_id;

    }
}
