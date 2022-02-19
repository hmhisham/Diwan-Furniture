<?php

namespace App\Http\Livewire;
use App\Items;
use App\store_report;
use Livewire\Component;

class StoreReport extends Component
{
    public function mount()
    {
        $store_report = store_report::where('item_remaining', '>',0)->orderBy('items_id')->get();
       
        $items_id = collect( $store_report )->unique("items_id");
        
        $this->store_info = $items_id;
    }

    public function render()
    {
        return view('livewire.store-report');
    }
}
