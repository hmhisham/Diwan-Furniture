<?php

namespace App\Http\Livewire;

use App\Items;
use App\Store;
use App\Containers;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class GetContainerInfo extends Component
{
    public $Categorys, $ContId , $ContNo, $ContDate, $ContAmount, $ContSupplier = '';

    public $Companys, $Models, $ItemNames, $ItemCodes, $ItemColors = '';
    public $item_category, $item_company, $item_model, $item_name, $item_code, $item_color, $item_qty, $item_price;
    public $new_item_category, $new_item_company, $new_item_model, $new_item_name, $new_item_code, $new_item_color, $new_item_qty, $new_item_price;
    public $ContItemsFromStore;
    public $AddItem = 'disabled';
    public $DisplayAddToStore = '';
    public $DisplayAddNewItem = 'hidden';

    public function AddNew()
    {
        $this->DisplayAddToStore = 'hidden';
        $this->DisplayAddNewItem = '';
    }

    public function render()
    {
        $Containers = Containers::all();

        $item_category = Items::all();
        $Categorys = collect( $item_category )->unique("item_category");
        $this->Categorys = collect( $item_category )->unique("item_category");

        $Items = Items::where('item_category', $this->item_category)->get();
        $this->Companys = collect($Items)->unique("item_company");

        $Items = Items::where('item_category', $this->item_category)
            ->where('item_company', $this->item_company)->get();
        $this->Models = collect($Items)->unique("item_model");

        $Items = Items::where('item_category', $this->item_category)
            ->where('item_company', $this->item_company)
            ->where('item_model', $this->item_model)->get();
        $this->ItemNames = collect($Items)->unique("item_name");

        $Items = Items::where('item_category', $this->item_category)
            ->where('item_company', $this->item_company)
            ->where('item_model', $this->item_model)
            ->where('item_name', $this->item_name)->get();
        $this->ItemCodes = collect($Items)->unique("item_code");

        $Items = Items::where('item_category', $this->item_category)
            ->where('item_company', $this->item_company)
            ->where('item_model', $this->item_model)
            ->where('item_name', $this->item_name)
            ->where('item_name', $this->item_name)->get();
        $this->ItemColors = collect($Items)->unique("item_color");

        return view('livewire.get-container-info',[
            'Containers' => $Containers,
            'Categorys' => $Categorys,
        ]);
    }

    public function ContainerInfo($ContNo)
    {
        if($ContNo != ''){
            $Container = Containers::where('cont_no', $ContNo)->first();
            if($Container != ''){
                $this->ContId = $Container->id;
                $this->ContNo = $Container->cont_no;
                $this->ContDate = $Container->cont_date;
                $this->ContAmount = $Container->cont_amount;
                $this->ContSupplier = $Container->GetSupplier->name;

                $this->ContItemsFromStore = $Container->GetItemsFromStore;
                $this->AddItem = '';

                $this->AfterAddInStore();

            }   else{
                $this->reset();
            }
        }   else{
            $this->reset();
        }
    }

    public function GetCompany($Category)
    {   
        $this->new_item_category = $Category;

        $Items = Items::all();
        $this->Categorys = collect( $Items )->unique("item_category");

        $Items = Items::where('item_category', $Category)->get();
        $this->Companys = collect( $Items )->unique("item_company");

        $this->reset('Models', 'ItemNames', 'ItemCodes', 'ItemColors');
    }

    public function GetModel($Company)
    {
        $Items = Items::all();
        $this->Categorys = collect( $Items )->unique("item_category");

        $Items = Items::where('item_category', $this->item_category)->get();
        $this->Companys = collect( $Items )->unique("item_company");

        $Items = Items::where('item_category', $this->item_category)
                        ->where('item_company', $Company)->get();
        $this->Models = collect( $Items )->unique("item_model");

        $this->reset('ItemNames', 'ItemCodes', 'ItemColors');
    }

    public function GetItemsName($Models)
    {
        $Items = Items::all();
        $this->Categorys = collect( $Items )->unique("item_category");

        $Items = Items::where('item_category', $this->item_category)->get();
        $this->Companys = collect( $Items )->unique("item_company");

        $Items = Items::where('item_category', $this->item_category)
                        ->where('item_company', $this->item_company)->get();
        $this->Models = collect( $Items )->unique("item_model");

        $Items = Items::where('item_category', $this->item_category)
                        ->where('item_company', $this->item_company)
                        ->where('item_model', $Models)->get();
        $this->ItemNames = collect( $Items )->unique("item_name");

        $this->reset('ItemCodes', 'ItemColors');
    }

    public function GetCode($ItemName)
    {
        $Items = Items::all();
        $this->Categorys = collect( $Items )->unique("item_category");

        $Items = Items::where('item_category', $this->item_category)->get();
        $this->Companys = collect( $Items )->unique("item_company");

        $Items = Items::where('item_category', $this->item_category)
                        ->where('item_company', $this->item_company)->get();
        $this->Models = collect( $Items )->unique("item_model");

        $Items = Items::where('item_category', $this->item_category)
                        ->where('item_company', $this->item_company)
                        ->where('item_model', $this->item_model)->get();
        $this->ItemNames = collect( $Items )->unique("item_name");

        $Items = Items::where('item_category', $this->item_category)
                        ->where('item_company', $this->item_company)
                        ->where('item_model', $this->item_model)
                        ->where('item_name', $ItemName)->get();
        $this->ItemCodes = collect( $Items )->unique("item_code");

        $this->reset('ItemColors');
    }

    public function GetColor($ItemCode)
    {
        $Items = Items::all();
        $this->Categorys = collect( $Items )->unique("item_category");

        $Items = Items::where('item_category', $this->item_category)->get();
        $this->Companys = collect( $Items )->unique("item_company");

        $Items = Items::where('item_category', $this->item_category)
                        ->where('item_company', $this->item_company)->get();
        $this->Models = collect( $Items )->unique("item_model");

        $Items = Items::where('item_category', $this->item_category)
                        ->where('item_company', $this->item_company)
                        ->where('item_model', $this->item_model)->get();
        $this->ItemNames = collect( $Items )->unique("item_name");

        $Items = Items::where('item_category', $this->item_category)
                        ->where('item_company', $this->item_company)
                        ->where('item_model', $this->item_model)
                        ->where('item_name', $this->item_name)->get();
        $this->ItemCodes = collect( $Items )->unique("item_code");

        $Items = Items::where('item_category', $this->item_category)
                        ->where('item_company', $this->item_company)
                        ->where('item_model', $this->item_model)
                        ->where('item_name', $this->item_name)
                        ->where('item_code', $ItemCode)->get();
        $this->ItemColors = collect( $Items )->unique("item_color");
    }

    public function AddToStore()
    {
        $Items = Items::where('item_category', $this->item_category)
                        ->where('item_company', $this->item_company)
                        ->where('item_model', $this->item_model)
                        ->where('item_name', $this->item_name)
                        ->where('item_code', $this->item_code)
                        ->where('item_color', $this->item_color)
                        ->first();

        if($Items != ''){
            $item_cost = 0;
            Store::create([
                'items_id' => $Items->id,
                'containers_id' => $this->ContId,
                'item_qty' => $this->item_qty,
                'item_remaining' => $this->item_qty,
                'item_price' => $this->item_price,
                'item_cost' => $item_cost,
            ]);

            $this->resetExcept('ContNo', 'ContDate', 'ContAmount', 'ContSupplier');

            $this->AfterAddInStore();

            $this->dispatchBrowserEvent('alert', 
                ['type' => 'success',  
                'message' => 'تم إضافة المادة إلى المخزن بنجاح', 
                'title' => 'إضافة مادة']
            );
        }
    }

    public function AddNewItem()
    {
        $Items = Items::where('item_category', $this->item_category)
                        ->where('item_company', $this->item_company)
                        ->where('item_model', $this->item_model)
                        ->where('item_name', $this->item_name)
                        ->where('item_code', $this->item_code)
                        ->where('item_color', $this->item_color)
                        ->first();

        if($Items == ''){
            $item_cost = 0;
            $Item = Items::create([
                'item_category' => $this->item_category,
                'item_company' => $this->item_company,
                'item_model' => $this->item_model,
                'item_code' => $this->item_code,
                'item_name' => $this->item_name,
                'item_color' => $this->item_color,
                'item_sale_price' => $this->item_sale_price,
                'less_qty' => $this->less_qty,
                'create_by ' => Auth::User()->id,
            ]);

            Store::create([
                'items_id' => $Item->id,
                'containers_id' => $this->ContId,
                'item_qty' => $this->item_qty,
                'item_remaining' => $this->item_qty,
                'item_price' => $this->item_price,
                'item_cost' => $item_cost,
            ]);

            $this->resetExcept('ContNo', 'ContDate', 'ContAmount', 'ContSupplier');

            $this->AfterAddInStore();

            $this->dispatchBrowserEvent('alert', 
                ['type' => 'success',  
                'message' => 'تم إضافة المادة بنجاح', 
                'title' => 'إضافة مادة']
            );
        }
    }

    public function DeleteFromStore($ItemId)
    {
        $this->deleteId = $ItemId;
    }

    public function DeleteConfirm()
    {
        Store::find($this->deleteId)->delete();

        $this->AfterAddInStore();

        $this->dispatchBrowserEvent('alert', 
                ['type' => 'success',  
                'message' => 'تم حذف المادة من المخزن بنجاح', 
                'title' => 'حذف مادة']
            );
    }

    public function AfterAddInStore()
    {
        if ($this->ContNo != '') {
            $Container = Containers::where('cont_no', $this->ContNo)->first();
            if ($Container != '') {
                $this->ContId = $Container->id;
                $this->ContNo = $Container->cont_no;
                $this->ContDate = $Container->cont_date;
                $this->ContAmount = $Container->cont_amount;
                $this->ContSupplier = $Container->GetSupplier->name;

                $this->ContItemsFromStore = $Container->GetItemsFromStore;

                $Items = Items::all();
                $this->Categorys = collect( $Items )->unique("item_category");

                $Items = Items::where('item_category', $this->item_category)->get();
                $this->Companys = collect($Items)->unique("item_company");

                $Items = Items::where('item_category', $this->item_category)
                    ->where('item_company', $this->item_company)->get();
                $this->Models = collect($Items)->unique("item_model");

                $Items = Items::where('item_category', $this->item_category)
                    ->where('item_company', $this->item_company)
                    ->where('item_model', $this->item_model)->get();
                $this->ItemNames = collect($Items)->unique("item_name");

                $Items = Items::where('item_category', $this->item_category)
                    ->where('item_company', $this->item_company)
                    ->where('item_model', $this->item_model)
                    ->where('item_name', $this->item_name)->get();
                $this->ItemCodes = collect($Items)->unique("item_code");

                $Items = Items::where('item_category', $this->item_category)
                    ->where('item_company', $this->item_company)
                    ->where('item_model', $this->item_model)
                    ->where('item_name', $this->item_name)
                    ->where('item_code', $this->item_code)->get();
                $this->ItemColors = collect($Items)->unique("item_color");
            } else {
                $this->reset();
            }
        } else {
            $this->reset();
        }
    }
}
