<?php

namespace App\Http\Livewire;

use App\Items;
use App\Store;
use App\Containers;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class GetContainerInfo extends Component
{
    public $NewCategorys, $Categorys, $ContId , $ContNo, $ContDate, $ContAmount, $ContSupplier = '';
    public $cont_date = '';

    public $Companys, $Models, $ItemNames, $ItemCodes, $ItemColors = '';
    public $item_category, $item_company, $item_model, $item_name, $item_code, $item_color, $item_qty, $item_price, $item_cost;

    public $NewCompanys, $NewModels, $NewItemNames, $NewItemCodes, $NewItemColors = '';
    public $new_item_category, $new_item_company, $new_item_model, $new_item_name, $new_item_code, $new_item_color, $new_item_qty, $new_item_price, $new_item_cost;

    public $ContItemsFromStore;
    public $item_cost_display = 'hidden';
    public $item_price_display = '';
    public $DisplayAddNewItem = 'hidden';
    public $AddNewModal = 'display:none';
    public $AddItem = 'disabled';
    public $deleteId;
    public $DisplayAddToStore, $new_item_sale_price, $new_less_qty= '';

    public function mount()
    {
        $this->Containers = Containers::all();

        $item_category = Items::all();
        $this->Categorys = collect( $item_category )->unique("item_category");


        //$this->NewCategorys = collect( $item_category )->unique("item_category");

        /* $Items = Items::where('item_category', $this->item_category)->get();
        $this->Companys = collect($Items)->unique("item_company");

        $Items = Items::where('item_category', $this->new_item_category)->get();
        $this->Companys = collect($Items)->unique("item_company");
        $this->NewCompanys = collect($Items)->unique("item_company");

        $Items = Items::where('item_category', $this->item_category)
            ->where('item_company', $this->item_company)->get();
        $this->Models = collect($Items)->unique("item_model");

        $Items = Items::where('item_category', $this->new_item_category)
            ->where('item_company', $this->new_item_company)->get();
        $this->Models = collect($Items)->unique("item_model");
        $this->NewModels = collect($Items)->unique("item_model");

        $Items = Items::where('item_category', $this->item_category)
            ->where('item_company', $this->item_company)
            ->where('item_model', $this->item_model)->get();
        $this->ItemNames = collect($Items)->unique("item_name");

        $Items = Items::where('item_category', $this->new_item_category)
            ->where('item_company', $this->new_item_company)
            ->where('item_model', $this->new_item_model)->get();
        $this->ItemNames = collect($Items)->unique("item_name");
        $this->NewItemNames = collect($Items)->unique("item_name");

        $Items = Items::where('item_category', $this->item_category)
            ->where('item_company', $this->item_company)
            ->where('item_model', $this->item_model)
            ->where('item_name', $this->item_name)->get();
        $this->ItemCodes = collect($Items)->unique("item_code");

        $Items = Items::where('item_category', $this->new_item_category)
            ->where('item_company', $this->new_item_company)
            ->where('item_model', $this->new_item_model)
            ->where('item_name', $this->new_item_name)->get();
        $this->NewItemCodes = collect($Items)->unique("item_code");

        $Items = Items::where('item_category', $this->item_category)
            ->where('item_company', $this->item_company)
            ->where('item_model', $this->item_model)
            ->where('item_name', $this->item_name)
            ->where('item_name', $this->item_name)->get();
        $this->ItemColors = collect($Items)->unique("item_color");

        $Items = Items::where('item_category', $this->new_item_category)
            ->where('item_company', $this->new_item_company)
            ->where('item_model', $this->new_item_model)
            ->where('item_name', $this->new_item_name)
            ->where('item_name', $this->new_item_name)->get();
        $this->NewItemColors = collect($Items)->unique("item_color"); */
    }
    public function render()
    {
        return view('livewire.get-container-info');
    }

   public function ContainerInfo($ContNo)
    {
        $this->ResetForm();

        if($ContNo != ''){
            $Container = Containers::where('cont_no', $ContNo)->first();
            if($Container){
                $this->ContId = $Container->id;
                $this->ContNo = $Container->cont_no;
                $this->cont_date = $Container->cont_date;
                $this->ContAmount = $Container->cont_amount;
                $this->ContSupplier = $Container->GetSupplier->name;

                $this->ContItemsFromStore = $Container->GetItemsFromStore;

                if($ContNo == 1){
                    $this->item_cost_display = '';
                    $this->item_price_display = 'hidden';
                }

                $this->AddNewModal = '';
                $this->AddItem = '';
            }else{
                $this->dispatchBrowserEvent('alert', [
                    'type' => 'error',
                    'message' => 'يجب كتابة رقم وجبة موجودة',
                    'title' => 'إضافة مادة'
                ]);
            }
        }
    }

    public function GetCompany($Category)
    {
        $Items = Items::all();
        $this->Categorys = collect( $Items )->unique("item_category");

        if($Category != ''){
            $Items = Items::where('item_category', $Category)->get();
            $this->Companys = collect( $Items )->unique("item_company");
        }else{
            $this->reset('Companys', 'Models', 'ItemNames', 'ItemCodes', 'ItemColors');
        }

        $this->reset('Models', 'ItemNames', 'ItemCodes', 'ItemColors');
    }
    public function GetCompanyNew($Category)
    {
        $this->new_item_category = $Category;

        $Items = Items::all();
        $this->NewCategorys = collect( $Items )->unique("item_category");

        if($Category != ''){
            $Items = Items::where('item_category', $Category)->get();
            $this->NewCompanys = collect( $Items )->unique("item_company");
        }else{
            $this->reset('Companys', 'Models', 'ItemNames', 'ItemCodes', 'ItemColors');
        }

        $this->reset('Categorys', 'Models', 'ItemNames', 'ItemCodes', 'ItemColors');
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

    public function GetModelNew($Company)
    {
        $this->new_item_company = $Company;

        $Items = Items::all();
        $this->NewCategorys = collect( $Items )->unique("item_category");

        $Items = Items::where('item_category', $this->new_item_category)->get();
        $this->NewCompanys = collect( $Items )->unique("item_company");

        $Items = Items::where('item_category', $this->new_item_category)
                        ->where('item_company', $Company)->get();
        $this->NewModels = collect( $Items )->unique("item_model");

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
    public function GetItemsNameNew($Models)
    {
        $this->new_item_model = $Models;

        $Items = Items::all();
        $this->NewCategorys = collect( $Items )->unique("item_category");

        $Items = Items::where('item_category', $this->new_item_category)->get();
        $this->NewCompanys = collect( $Items )->unique("item_company");

        $Items = Items::where('item_category', $this->new_item_category)
                        ->where('item_company', $this->new_item_company)->get();
        $this->NewModels = collect( $Items )->unique("item_model");

        $Items = Items::where('item_category', $this->new_item_category)
                        ->where('item_company', $this->new_item_company)
                        ->where('item_model', $Models)->get();
        $this->NewItemNames = collect( $Items )->unique("item_name");

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
    public function GetCodeNew($ItemName)
    {
        $this->new_item_name = $ItemName;

        $Items = Items::all();
        $this->NewCategorys = collect( $Items )->unique("item_category");

        $Items = Items::where('item_category', $this->new_item_category)->get();
        $this->NewCompanys = collect( $Items )->unique("item_company");

        $Items = Items::where('item_category', $this->new_item_category)
                        ->where('item_company', $this->new_item_company)->get();
        $this->NewModels = collect( $Items )->unique("item_model");

        $Items = Items::where('item_category', $this->new_item_category)
                        ->where('item_company', $this->new_item_company)
                        ->where('item_model', $this->new_item_model)->get();
        $this->NewItemNames = collect( $Items )->unique("item_name");

        $Items = Items::where('item_category', $this->new_item_category)
                        ->where('item_company', $this->new_item_company)
                        ->where('item_model', $this->new_item_model)
                        ->where('item_name', $ItemName)->get();
        $this->NewItemCodes = collect( $Items )->unique("item_code");

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
    public function GetColorNew($ItemCode)
    {
        $this->new_item_code = $ItemCode;

        $Items = Items::all();
        $this->NewCategorys = collect( $Items )->unique("item_category");

        $Items = Items::where('item_category', $this->new_item_category)->get();
        $this->NewCompanys = collect( $Items )->unique("item_company");

        $Items = Items::where('item_category', $this->new_item_category)
                        ->where('item_company', $this->new_item_company)->get();
        $this->NewModels = collect( $Items )->unique("item_model");

        $Items = Items::where('item_category', $this->new_item_category)
                        ->where('item_company', $this->new_item_company)
                        ->where('item_model', $this->new_item_model)->get();
        $this->NewItemNames = collect( $Items )->unique("item_name");

        $Items = Items::where('item_category', $this->new_item_category)
                        ->where('item_company', $this->new_item_company)
                        ->where('item_model', $this->new_item_model)
                        ->where('item_name', $this->new_item_name)->get();
        $this->NewItemCodes = collect( $Items )->unique("item_code");

        $Items = Items::where('item_category', $this->new_item_category)
                        ->where('item_company', $this->new_item_company)
                        ->where('item_model', $this->new_item_model)
                        ->where('item_name', $this->new_item_name)
                        ->where('item_code', $ItemCode)->get();
        $this->NewItemColors = collect( $Items )->unique("item_color");
    }
    public function ColorNew($ItemColor)
    {
        $this->new_item_color = $ItemColor;

        $Items = Items::all();
        $this->NewCategorys = collect( $Items )->unique("item_category");

        $Items = Items::where('item_category', $this->new_item_category)->get();
        $this->NewCompanys = collect( $Items )->unique("item_company");

        $Items = Items::where('item_category', $this->new_item_category)
                        ->where('item_company', $this->new_item_company)->get();
        $this->NewModels = collect( $Items )->unique("item_model");

        $Items = Items::where('item_category', $this->new_item_category)
                        ->where('item_company', $this->new_item_company)
                        ->where('item_model', $this->new_item_model)->get();
        $this->NewItemNames = collect( $Items )->unique("item_name");

        $Items = Items::where('item_category', $this->new_item_category)
                        ->where('item_company', $this->new_item_company)
                        ->where('item_model', $this->new_item_model)
                        ->where('item_name', $this->new_item_name)->get();
        $this->NewItemCodes = collect( $Items )->unique("item_code");

        $Items = Items::where('item_category', $this->new_item_category)
                        ->where('item_company', $this->new_item_company)
                        ->where('item_model', $this->new_item_model)
                        ->where('item_name', $this->new_item_name)
                        ->where('item_code', $this->new_item_code)->get();
        $this->NewItemColors = collect( $Items )->unique("item_color");
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

        $Store = Store::where('items_id', $Items->id)
            ->where('containers_id', $this->ContId)
            ->first();

        if($Store == ''){
            $Container = Containers::findOrFail($this->ContId);

            $cont_amount = $Container->cont_amount;
            $cont_out_expenses = $Container->cont_out_expenses + $Container->cont_customs;
            $cont_in_expenses = $Container->cont_in_expenses;
            $extra_percent = $Container->extra_percent/100;

            if($this->ContNo == 1){
                $item_cost = $this->item_cost;
            }   else{
                $item_cost = ($this->item_price / $cont_amount) * ($cont_out_expenses + $cont_out_expenses * $extra_percent + $cont_in_expenses) + ($this->item_price + $this->item_price * $extra_percent);
            }

            $item_price = $this->item_price;
            if($item_price == ''){
                $item_price = 0;
            }

            Store::create([
                'items_id' => $Items->id,
                'containers_id' => $this->ContId,
                'containers_date' => $this->cont_date,
                'item_qty' => $this->item_qty,
                'item_remaining' => $this->item_qty,
                'item_price' => $item_price,
                'item_cost' => $item_cost,
            ]);

            $this->SetForm();

            $this->dispatchBrowserEvent('alert',
                ['type' => 'success',
                'message' => 'تم إضافة المادة إلى المخزن بنجاح',
                'title' => 'إضافة مادة']
            );
        }   else{
            $this->SetForm();

            $this->dispatchBrowserEvent('alert',
                ['type' => 'warning',
                'message' => 'لايمكن إضافة المادة إلى المخزن',
                'title' => 'إضافة مادة']
            );
        }
    }

    public function AddNewItem()
    {
        $Items = Items::where('item_category', $this->new_item_category)
                        ->where('item_company', $this->new_item_company)
                        ->where('item_model', $this->new_item_model)
                        ->where('item_name', $this->new_item_name)
                        ->where('item_code', $this->new_item_code)
                        ->where('item_color', $this->new_item_color)
                        ->first();

        if($Items == ''){
            $Item = Items::create([
                'item_category' => $this->new_item_category,
                'item_company' => $this->new_item_company,
                'item_model' => $this->new_item_model,
                'item_code' => $this->new_item_code,
                'item_name' => $this->new_item_name,
                'item_color' => $this->new_item_color,
                'item_sale_price' => $this->new_item_sale_price,
                'less_qty' => $this->new_less_qty,
                'create_by' => Auth::User()->id,
            ]);

            $Container = Containers::find($this->ContId);

            $cont_amount = $Container->cont_amount;
            $cont_out_expenses = $Container->cont_out_expenses + $Container->cont_customs;
            $cont_in_expenses = $Container->cont_in_expenses;
            $extra_percent = $Container->extra_percent/100;

            if($this->ContNo == 1){
                $item_cost = $this->new_item_cost;
            }   else{
                $item_cost = ($this->new_item_price / $cont_amount) * ($cont_out_expenses + $cont_out_expenses * $extra_percent + $cont_in_expenses) + ($this->new_item_price + $this->new_item_price * $extra_percent);
            }

            $item_price = $this->new_item_price;
            if($item_price == ''){
                $item_price = 0;
            }

            Store::create([
                'items_id' => $Item->id,
                'containers_id' => $this->ContId,
                'containers_date' => $this->cont_date,
                'item_qty' => $this->new_item_qty,
                'item_remaining' => $this->new_item_qty,
                'item_price' => $item_price,
                'item_cost' => $item_cost,
            ]);

            $this->SetForm();

            $this->dispatchBrowserEvent('alert',
                ['type' => 'success',
                'message' => 'تم إضافة المادة بنجاح',
                'title' => 'إضافة مادة']
            );
        }   else{
                $this->SetForm();

                $this->dispatchBrowserEvent('alert',
                    ['type' => 'warning',
                    'message' => 'لايمكن الاضافة, المادة مسجلة مسبقاً',
                    'title' => 'إضافة مادة']
                );
            }
    }

    public function DeleteFromStore($ItemId)
    {
        $this->SetForm();
        $this->deleteId = $ItemId;
    }

    public function DeleteConfirm($deleteId)
    {
        Store::find($deleteId)->delete();

        $this->SetForm();

        $this->dispatchBrowserEvent('alert',
                ['type' => 'success',
                'message' => 'تم حذف المادة من المخزن بنجاح',
                'title' => 'حذف مادة']
            );
    }

    public function UpdateConfirm($ItemFromStoreID)
    {
        $ItemFromStore = Store::find($ItemFromStoreID);

        $ItemFromStore->update([
            'item_cost' => $this->item_cost
        ]);
        
        $this->SetForm();

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'تم تعديل كلفة المادة بنجاح',
            'title' => 'تعديل مادة'
        ]);
    }

    public function ResetForm()
    {
        $this->resetExcept('Containers', 'Categorys', 'ContNo');

        $this->Containers = Containers::all();

        $item_category = Items::all();
        $this->Categorys = collect( $item_category )->unique("item_category");
    }
    public function SetForm()
    {
        $this->resetExcept('Containers', 'Categorys', 'ContNo','ContId', 'cont_date', 'ContAmount', 'ContSupplier', 'AddNewModal', 'AddItem');
        if($this->ContNo == 1){
            $this->item_cost_display = '';
            $this->item_price_display = 'hidden';
        }
        $this->Containers = Containers::all();

        $item_category = Items::all();
        $this->Categorys = collect( $item_category )->unique("item_category");

        $Container = Containers::where('id', $this->ContId)->first();
        if ($Container) {
            $this->ContItemsFromStore = $Container->GetItemsFromStore;
        }
    }
}
