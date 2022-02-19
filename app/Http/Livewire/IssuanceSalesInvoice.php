<?php

namespace App\Http\Livewire;

use App\Cart;
use App\Items;
use App\Store;
use App\Customers;
use App\SaleInvoices;
use Livewire\Component;
use App\SaleInvoicesDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class IssuanceSalesInvoice extends Component
{
    public $item_company, $item_category, $item_model, $item_name;
    public $sale_price = 0;
    public $sale_quantity = 0;
    public $SaleSum = 0;
    public $invoice, $customers;
    public $CustomerMenu = '';
    public $item;

    protected $rules = [
        'invoice.no' => 'required',
        'invoice.date' => 'required',
        'invoice.customer' => 'required',
    ];
    protected $messages = [
        'invoice.no.required' => 'رقم الفاتورة مطلوب',
        'invoice.date.required' => 'تاريخ الفاتورة مطلوب',
        'invoice.customer.required' => 'أسم الزبون مطلوب',
    ];

    public function mount()
    {
        $invoice_amount = 0;
        $Carts = Cart::where('create_by', Auth::User()->id)->get();
        foreach ($Carts as $Cart){
            $invoice_amount += $Cart->quantity * $Cart->price;
        }

        $this->invoice['amount'] = $invoice_amount;
        $this->invoice['discount'] = 0;
        $this->invoice['real_amount'] = $invoice_amount;
        $this->invoice['amount_paid'] = 0;
        $this->invoice['remaining_amount'] = $invoice_amount;
    }

    public function render()
    {
        if(SaleInvoices::all()->count() > 0){
            $SaleInvoices = SaleInvoices::orderBy('invoice_no', 'DESC')->first();
            $this->invoice['id'] = $SaleInvoices->id + 1;
            $this->invoice['no'] = $SaleInvoices->invoice_no + 1;
        }else{
            $this->invoice['id'] = '1';
            $this->invoice['no'] = '1';
        }

        $this->invoice['date'] = date('Y-m-d');

        $item_company = Items::all();
        $Companys = collect( $item_company )->unique("item_company");

        $Categorys = [];
        $Models = [];
        $Items = [];

        //$item_category = Items::all();
        //$Categorys = collect( $item_category )->unique("item_category");

        //$item_model = Items::all();
        //$Models = collect($item_model)->unique("item_model");

        return view('livewire.issuance-sales-invoice', [
            'Customers' => Customers::all(),
            'SaleInvoices' => SaleInvoices::all(),
            'SaleInvoicesDetails' => SaleInvoicesDetails::all(),
            'Companys' => $Companys,
            'Categorys' => $Categorys,
            'Models' => $Models,
            'Items' => $Items
        ]);
    }

    public function CustomerInfo($Customer)
    {
        $Customers = Customers::find($Customer);
        $this->invoice['customer'] = $Customers->name;
        $this->invoice['phone_1'] = $Customers->phone_1;
        $this->invoice['phone_2'] = $Customers->phone_2;
        $this->invoice['address'] = $Customers->address;

        $this->CustomerMenu = '';
    }
    public function CustomerChack($value)
    {
        $this->CustomerMenu = 'show';

        if($value != ''){
            $Customer = Customers::where('name', $value)->first();
            if($Customer){
                $this->invoice['customer'] = $Customer->name;
                $this->invoice['phone_1'] = $Customer->phone_1;
                $this->invoice['phone_2'] = $Customer->phone_2;
                $this->invoice['address'] = $Customer->address;
            }else{
                $this->invoice['phone_1'] = '';
                $this->invoice['phone_2'] = '';
                $this->invoice['address'] = '';
            }
            $this->Customers = Customers::where('name','LIKE', "%{$value}%")->get();
        }else{
            $this->Customers = Customers::all();
        }
    }

    public function CustomerSelect($Castomer)
    {
        $Customers = Customers::findOrFail($Castomer);
        if($Customers){
            $this->invoice['phone_1'] = $Customers->phone_1;
            $this->invoice['phone_2'] = $Customers->phone_2;
        }else{
            $this->invoice['phone_1'] = 0;
            $this->invoice['phone_2'] = 0;
        }
    }

    public function CompanySelect($Company)
    {
        $ItemCompany = Items::find($Company);
        if($ItemCompany){
            $item_company = Items::where('item_company', $ItemCompany->item_company)->get();
            $this->Categorys = collect( $item_company )->unique("item_category");
        }else{
            $this->Categorys = '';
        }

        $this->Models = '';
        $this->Items = '';
    }
    public function CategorySelect($Category)
    {
        $ItemCompany = Items::find($this->item_company);
        $item_company = Items::where('item_company', $ItemCompany->item_company)->get();
        $this->Categorys = collect( $item_company )->unique("item_category");

        $ItemCategory = Items::find($Category);
        if($ItemCategory){
            $item_category = Items::where('item_category', $ItemCategory->item_category)->get();
            $this->Models = collect( $item_category )->unique("item_model");
        }else{
            $this->Models = '';
        }

        $this->Items = '';
    }

    public function ModelSelect($Model)
    {
        $ItemCompany = Items::find($this->item_company);
        $item_company = Items::where('item_company', $ItemCompany->item_company)->get();
        $this->Categorys = collect( $item_company )->unique("item_category");

        $ItemCategory = Items::find($this->item_category);
        $item_category = Items::where('item_category', $ItemCategory->item_category)->get();
        $this->Models = collect( $item_category )->unique("item_model");

        $ItemModel = Items::find($Model);
        if($ItemModel){
            $Items = [];
            $item_model = Items::where('item_model', $ItemModel->item_model)->get();
            foreach($item_model as $item_mode){
                $item_all_remaining = Store::where('items_id', $item_mode->id)->where('item_remaining','>',0)
                ->orderBy('containers_date', 'ASC')->sum('item_remaining');

                if($item_all_remaining > 0){
                    $Items[] = $item_mode;
                }
            }
            $this->Items = collect( $Items )->unique("item_name");
        }else{
            $this->Items = '';
        }
    }

    public function ItemSelect($ItemName)
    {
        $ItemCompany = Items::find($this->item_company);
        $item_company = Items::where('item_company', $ItemCompany->item_company)->get();
        $this->Categorys = collect( $item_company )->unique("item_category");

        $ItemCategory = Items::find($this->item_category);
        $item_category = Items::where('item_category', $ItemCategory->item_category)->get();
        $this->Models = collect( $item_category )->unique("item_model");

        $ItemModel = Items::find($this->item_model);
        $item_model = Items::where('item_model', $ItemModel->item_model)->get();
        $this->Items = collect( $item_model )->unique("item_name");

        $Item = Items::find($ItemName);
        if($Item){
            $this->sale_price = $Item->item_sale_price;
        }
    }

    public function SaleSum()
    {
        if($this->item_category == 0){
            $this->addError('item_category', 'حقل مطلوب');
        }else{
        $this->SaleSum = $this->sale_price * $this->sale_quantity;

        $ItemCompany = Items::all();
        $this->Categorys = collect( $ItemCompany )->unique("item_category");

        $ItemCategory = Items::find($this->item_category);
        $item_category = Items::where('item_category', $ItemCategory->item_category)->get();
        $this->Models = collect( $item_category )->unique("item_model");

        $ItemModel = Items::find($this->item_model);
        if($ItemModel){
            $item_model = Items::where('item_model', $ItemModel->item_model)->get();
            $this->Items = collect( $item_model )->unique("item_name");
        }else{
            $this->Items = '';
        }
    }
    }

    public function save()
    {
        $sale_quantity = $this->sale_quantity;
 
        $item_all_remaining = Store::where('items_id', $this->item_name)
            ->where('item_remaining','>',0)
                ->orderBy('containers_date', 'ASC')
                ->sum('item_remaining');

        if($item_all_remaining > 0){
            if($item_all_remaining < $sale_quantity){
                $this->dispatchBrowserEvent('alert',
                    ['type' => 'error',
                    'message' => 'لايمكن الاضافة, العدد المتوفر غير كافٍ',
                    'title' => 'إضافة مادة']
                );
                session()->flash('Error', $item_all_remaining);
            }else{
                $ItemInCart = Cart::where('items_id', $this->item_name)->where('create_by', Auth::user()->id)->first();
                if(!$ItemInCart){
                    Cart::create([
                        'items_id' => $this->item_name,
                        'price' => $this->sale_price,
                        'quantity' => $this->sale_quantity,
                        'create_by' => Auth::User()->id,
                    ]);

                    $Item_Stors = Store::where('items_id', $this->item_name)
                        ->where('item_remaining','>',0)
                        ->orderBy('containers_date', 'ASC')
                        ->orderBy('id', 'ASC')->get();

                    foreach($Item_Stors as $Item_Stor){ 
                        if($sale_quantity <= $Item_Stor->item_remaining){
                            $rem = $Item_Stor->item_remaining - $sale_quantity;  
                            Store::find($Item_Stor->id)->update(['item_remaining' => $rem]);
                            break;
                        }else{
                            Store::find($Item_Stor->id)->update(['item_remaining' => 0]);
                            $sale_quantity = $sale_quantity - $Item_Stor->item_remaining;
                        }
                    }

                    $this->dispatchBrowserEvent('alert', [
                        'type' => 'success',
                        'message' => 'تم إضافة المادة بنجاح',
                        'title' => 'إضافة مادة'
                        ]
                    );
                }else{
                    $this->dispatchBrowserEvent('alert',
                        ['type' => 'warning',
                        'message' => 'لايمكن الاضافة, المادة مسجلة مسبقاً',
                        'title' => 'إضافة مادة']
                    );
                }
            }
        }else{
            $this->addError('error_qty', 'المادة غير متوفرة في المخزن');
        }

        $this->item_company = '';
        $this->item_category = '';
        $this->item_model = '';
        $this->item_name = '';
        $this->Categorys = [];
        $this->Models = [];
        $this->Items = [];
        $this->reset('sale_price', 'sale_quantity', 'SaleSum');

        $this->mount();
        //$this->emit('refreshLivewireDatatable');
    }

    public function SaveInvoice()
    {   
        $this->validate();

        $Customer = Customers::where('name', $this->invoice['customer'])
            ->where('phone_1', $this->invoice['phone_1'])->first();
        if(!$Customer){
            $Customer = Customers::create([
                'name' => $this->invoice['customer'],
                'phone_1' => $this->invoice['phone_1'],
                'phone_2' => $this->invoice['phone_2'],
                'address' => $this->invoice['address'],
            ]);
        }
        $this->invoice['customer_id'] = $Customer->id;

        $SaleInvoices = SaleInvoices::create([
            'invoice_no' => $this->invoice['no'],
            'invoice_date' => $this->invoice['date'],
            'invoice_customer' => $this->invoice['customer_id'],
            'invoice_phone_1' => $this->invoice['phone_1'],
            'invoice_phone_2' => $this->invoice['phone_2'],
            'invoice_address' => $this->invoice['address'],
            'invoice_amount' => $this->invoice['amount'],
            'invoice_discount' => $this->invoice['discount'],
            'invoice_amount_paid' => $this->invoice['amount_paid'],
            'invoice_remaining_amount' => $this->invoice['remaining_amount'],
            'create_by' => Auth::User()->id,
        ]);
        
        $Carts = Cart::where('create_by', Auth::User()->id)->get();
        foreach ($Carts as $Cart){
            $SaleInvoicesDetails = SaleInvoicesDetails::create([
                'sale_invoices_id' => $SaleInvoices->id,
                'items_id' => $Cart->items_id,
                'sale_quantity' => $Cart->quantity,
                'sale_price' => $Cart->price
            ]);
        }

        Cart::where('create_by', Auth::user()->id)->delete();

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'تم حفظ الفاتورة بنجاح',
            'title' => 'إضافة فاتورة'
            ]
        );

        return Redirect::route('PrintInvoice', $SaleInvoices->id);
    }

    public function Amounts()
    {   
        if($this->invoice['discount'] == ''){
            $this->invoice['discount'] = 0;
        }
        if($this->invoice['amount_paid'] == ''){
            $this->invoice['amount_paid'] = 0;
        }
        
        $real_amount = $this->invoice['amount'] - $this->invoice['discount'];
        $this->invoice['real_amount'] = $real_amount;
        $this->invoice['remaining_amount'] = $real_amount - $this->invoice['amount_paid'];
    }

    public function DeleteFromInvoice($CartItemID)
    {
        $Cart = Cart::find($CartItemID);
        $CartQty = $Cart->quantity;

        $Item_Stors = Store::where('items_id', $Cart->items_id)
            ->whereColumn('item_remaining', '<', 'item_qty')
            ->orderBy('containers_date', 'DESC')
            ->orderBy('id', 'DESC')->get();

        foreach ($Item_Stors as $Item_Stor) {
            $rem_sale = $Item_Stor->item_qty - $Item_Stor->item_remaining;

            if ($CartQty <= $rem_sale) {
                $rem = $Item_Stor->item_remaining + $CartQty;
                Store::find($Item_Stor->id)->update(['item_remaining' => $rem]);
                break;
            } else {
                Store::find($Item_Stor->id)->update(['item_remaining' => $Item_Stor->item_qty]);
                $CartQty = $CartQty - $rem_sale;
            }
        }

        Cart::find($CartItemID)->delete();
        $this->mount();

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'تم حذف المادة بنجاح',
            'title' => 'إضافة مادة'
            ]
        );
    }
}
