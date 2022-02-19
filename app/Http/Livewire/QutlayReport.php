<?php

namespace App\Http\Livewire;

use App\Qutlay;
use Livewire\Component;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;


class QutlayReport extends Component
{
    public $QutlayReport ,$date_from;

    public function mount()
    
    {
        /* $QutlayInfo = Qutlay::orderBy('qutlays_date', 'DESC')->get();
        $this->QutlaysInfo = $QutlayInfo; */
        
        $QutlayInfo = Qutlay::all(); 
        $this->QutlaysInfo = $QutlayInfo;
        
/*        return view('livewire.qutlay-report' , ['QutlaysInfo'=>$QutlayInfo] ); 
 */    }
   public function render()
    {
        
       return view('livewire.qutlay-report'); 
    }
    public function ReportByDate()
    
    { 
           
 $date_from = Carbon::parse($this->QutlayReport['date_from'])->toDateString();
 $date_to = Carbon::parse($this->QutlayReport['date_to'])->toDateString();
       // dd($date_from);
        $QutlayInfo = Qutlay::whereBetween('qutlays_date',[$date_from,$date_to])->get(); 

         $this->QutlaysInfo = $QutlayInfo;

        
        
         /* $QutlayInfo = Qutlay::where('qutlays_date','>=', $this->QutlayReport['date_from'])
        ->where('qutlays_date','<=', $this->QutlayReport['date_to'])->get();  */
        /* $QutlayInfo = Qutlay::orderBy('id', 'DESC')->get();*/
    }
    
   
}


















