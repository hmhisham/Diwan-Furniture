<div>
    <form wire:submit.prevent="save" autocomplete="off">
        <input type="hidden" wire:model.defer="invoice.id" class="form-control" readonly>
        <input type="hidden" wire:model.defer="invoice.customer_id" class="form-control" readonly>
        <div class="card card-primary">
            <div class="card-header pb-2">
                <div class="row">
                    <div class="col">
                        <label class="control-label">رقم الفاتورة</label>
                        <input type="text" wire:model.defer="invoice.no" class="form-control" readonly>
                        <div class="text-danger">@error('invoice.no') {{ $message }} @enderror</div>
                    </div>

                    <div class="col">
                        <label>تاريخ الفاتورة</label>
                        <input type="text" class="form-control fc-datepicker" wire:model.defer="invoice.date">
                        <div class="text-danger">@error('invoice.date') {{ $message }} @enderror</div>
                    </div>

                    <div class="col">
                        <label>الزبون</label>
                        <input wire:model.defer="invoice.customer" wire:keyup="CustomerChack($event.target.value)" type="text"
                            class="form-control" id="Customer" aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenuCustomer">
                        <div class="dropdown-menu tx-13 {{ $CustomerMenu }}" id="MenuCustomer" aria-labelledby="dropleftMenuButton" style="min-width: 200px; max-height: 320px; overflow:scroll; right: 20px !important;">
                            @if ($Customers)
                                @foreach ($Customers as $key => $Customer)
                                    <a wire:click="CustomerInfo({{ $Customer->id }})" class="dropdown-item CustomerName">{{ $Customer->name }}</a>
                                @endforeach
                            @endif
                        </div>
                        <div class="text-danger">@error('invoice.customer') {{ $message }} @enderror</div>
                    </div>

                    <div class="col">
                        <label class="control-label">رقم الهاتف 1</label>
                        <input type="text" wire:model.defer="invoice.phone_1" class="form-control">
                        <div class="text-danger">@error('invoice.phone_1') {{ $message }} @enderror</div>
                    </div>

                    <div class="col">
                        <label class="control-label">رقم الهاتف 2</label>
                        <input type="text" class="form-control" wire:model.defer="invoice.phone_2">
                        <div class="text-danger">@error('invoice.phone_2') {{ $message }} @enderror</div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col">
                        <label class="control-label">عنوان الزبون</label>
                        <textarea wire:model.defer="invoice.address" class="form-control"></textarea>
                        <div class="text-danger">@error('invoice.address') {{ $message }} @enderror</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive mt-1">
            @if (count($errors) > 0)
                <div class="alert alert-solid-danger mg-b-0">
                    <strong class="font-medium-2">لايمكن الاضافة!</strong> <br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session()->has('Error'))
                <div class="alert alert-solid-danger mg-b-0" role="alert"> 
                    <button aria-label="Close" class="close" data-bs-dismiss="alert" type="button"> 
                        <span aria-hidden="true">×</span>
                    </button> 
                    <strong class="font-medium-2">لايمكن الاضافة!</strong> <br>
                    العدد المتوفر غير كافٍ. 
                </div>
            @endif

            <table class="table key-buttons text-md-nowrap mt-2" data-page-length='50'>
                <thead>
                    <tr class="bg-primary">
                        <th class="font-small-3 text-white p-1">#</th>
                        <th class="font-small-3 text-white p-1 wd-15p">الشركة</th>
                        <th class="font-small-3 text-white p-1 wd-15p">النوع</th>
                        <th class="font-small-3 text-white p-1 wd-15p">الموديل</th>
                        <th class="font-small-3 text-white p-1 wd-15p">المادة</th>
                        <th class="font-small-3 text-white p-1 wd-15p">السعر</th>
                        <th class="font-small-3 text-white p-1 wd-15p">العدد</th>
                        <th class="font-small-3 text-white p-1 wd-15p">الأجراءات</th>
                        <th class="font-small-3 text-white p-1 wd-15p"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-secondary tx-white">
                        <td class=""></td>
                        <td class="">
                            <select class="form-control" wire:model="item_company" wire:change="CompanySelect($event.target.value)" required>
                                <option value=""></option>
                                @if ($Companys)
                                    @foreach ($Companys as $Company)
                                        <option value="{{ $Company->id }}">{{ $Company->item_company }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="">@error('item_company') {{ $message }} @enderror</div>
                        </td>
                        <td class="">
                            <select class="form-control" wire:model="item_category" wire:change="CategorySelect($event.target.value)" required>
                                <option value="0"></option>
                                @if ($Categorys)
                                    @foreach ($Categorys as $Category)
                                        <option value="{{ $Category->id }}">{{ $Category->item_category }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="">@error('item_category') {{ $message }} @enderror</div>
                        </td>
                        <td class="">
                            <select class="form-control" wire:model="item_model" wire:change="ModelSelect($event.target.value)" required>
                                <option value=""></option>
                                @if ($Models)
                                    @foreach ($Models as $Model)
                                        <option value="{{ $Model->id }}">{{ $Model->item_model }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="">@error('item_model') {{ $message }} @enderror</div>
                        </td>
                        <td class="">
                            <select class="form-control" wire:model.defer="item_name" wire:change="ItemSelect($event.target.value)" required>
                                <option value=""></option>
                                @if ($Items)
                                    @foreach ($Items as $Item)
                                        <option value="{{ $Item->id }}">{{ $Item->item_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="">@error('item_name') {{ $message }} @enderror</div>
                        </td>
                        <td class="">
                            <input type="text" class="form-control" wire:model="sale_price" wire:keyup="SaleSum">
                            <div class="">@error('sale_price') {{ $message }} @enderror</div>
                        </td>
                        <td class="">
                            <input type="text" class="form-control" wire:model="sale_quantity" wire:keyup="SaleSum">
                            <div class="">@error('sale_quantity') {{ $message }} @enderror</div>
                        </td>
                        <td class="h2">{{ $SaleSum }}</td>
                        <td class="">
                            <button type="submit" class="btn btn-primary btn-icon rounded-circle font-medium-3">
                                <i class="fas fa-plus"></i>
                            </button>
                        </td>
                    </tr>

                    @php
                        $CartItems = App\Cart::where('create_by', Auth::User()->id)->get();
                        $background = '';
                    @endphp
                    @if ($CartItems != '')
                        @foreach ($CartItems as $key => $CartItem)
                            @php
                                if (fmod($key, 2) != 0){
                                    $background = 'background-color:#ccc;';
                                }else{
                                    $background = '';
                                }
                            @endphp
                            <tr style="{{ $background }}">
                                <td class="">{{ ++$key }}</td>
                                <td class="">{{ $CartItem->GetItem->item_company }}</td>
                                <td class="">{{ $CartItem->GetItem->item_category }}</td>
                                <td class="">{{ $CartItem->GetItem->item_model }}</td>
                                <td class="">{{ $CartItem->GetItem->item_name }}</td>
                                <td class="">{{ $CartItem->price }}</td>
                                <td class="">{{ $CartItem->quantity }}</td>
                                <td class="">
                                    <button type="button" wire:click="DeleteFromInvoice({{ $CartItem->id }})" class="btn btn-danger btn-sm rounded-50" data-toggle="modal" data-target="#DeleteModal">حذف</button>
                                </td>
                                <td class=""></td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="font-small-3 text-center">لا يوجد مواد في الفاتورة</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        @if ($CartItems != '')
            <div class="card card-primary">
                <div class="card-header pb-2">
                    <div class="row">
                        <div class="col">
                            <label>مجموع الفاتورة</label>
                            <input type="text" class="form-control" wire:model.defer="invoice.amount" readonly>
                        </div>
                        <div class="col">
                            <label>الخصم</label>
                            <input type="text" class="form-control" wire:model.defer="invoice.discount" wire:keyup="Amounts">
                        </div>
                        <div class="col">
                            <label>المبلغ الصافي</label>
                            <input type="text" class="form-control" wire:model.defer="invoice.real_amount" readonly>
                        </div>
                        <div class="col">
                            <label>المبلغ الواصل</label>
                            <input type="text" class="form-control" wire:model.defer="invoice.amount_paid" wire:keyup="Amounts">
                        </div>
                        <div class="col">
                            <label>المبلغ الباقي</label>
                            <input type="text" class="form-control" wire:model.defer="invoice.remaining_amount" readonly>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
    <div class="row">
        <button wire:click="SaveInvoice" class="btn btn-primary rounded-50">حفظ الفاتورة</button>
    </div>
</div>
