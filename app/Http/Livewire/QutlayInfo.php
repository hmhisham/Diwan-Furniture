<?php

namespace App\Http\Livewire;

use App\Qutlay;
use Livewire\Component;


class QutlayInfo extends Component
{
    public $qutlays_amount,$qutlays_type,$qutlays_date,$qutlays_by,$qutlays_note,$qutlays_exchange_rate;
    public $Qutlay;
    public $QutlayId;

    public function mount()
    {
        $this->Qutlay = Qutlay::orderBy('qutlays_date', 'DESC')->get();
        if($this->Qutlay->count() > 0){
            $this->qutlays_exchange_rate = $this->Qutlay->first()->qutlays_exchange_rate;
        }else{
            $this->qutlays_exchange_rate = 0;
        }
    }

   public function render()
    {
        /* $Qutlay = Qutlay::orderBy('qutlays_date', 'DESC')->get();
        if($Qutlay->count() > 0){
            $this->qutlays_exchange_rate = $Qutlay->first()->qutlays_exchange_rate;
        }else{
            $this->qutlays_exchange_rate = 0;
        }
        
        return view('livewire.qutlay-info', ['Qutlay'=>$Qutlay]); */
        return view('livewire.qutlay-info');
    }

    public function AddToQutlay()
    {   
        Qutlay::create([
            'qutlays_amount' => str_replace(",", "", number_format($this->qutlays_amount / $this->qutlays_exchange_rate,2)),
            'qutlays_amount_IQ' => str_replace(",", "", $this->qutlays_amount),
            'qutlays_type' => $this->qutlays_type,
            'qutlays_date' => $this->qutlays_date,
            'qutlays_by' => $this->qutlays_by,
            'qutlays_note' => $this->qutlays_note,
            'qutlays_exchange_rate' => $this->qutlays_exchange_rate,
        ]);

        $this->resetExcept('qutlays_exchange_rate');
        $this->Qutlay = Qutlay::orderBy('qutlays_date', 'DESC')->get();

        $this->dispatchBrowserEvent(
            'alert',
            [
                'type' => 'success',
                'message' => 'تم إضافة المصاريف  بنجاح',
                'title' => 'إضافة مصاريف'
            ]
        );
    }

    public function SendQutlayId($qutlay_id){
        $this->QutlayId = $qutlay_id;
    }
    public function DeleteFromQutlay($QutlayId){
        Qutlay::find($QutlayId)->delete();

        $this->Qutlay = Qutlay::orderBy('qutlays_date', 'DESC')->get();

        $this->dispatchBrowserEvent('alert',[
            'type' => 'success',
            'message' => 'تم حذف بيانات المصاريف بنجاح',
            'title' => 'حذف مصاريف'
        ]);
    }
}
