<div>
    <div class="card-header mb-2 bg-primary text-white">
        <div class="d-flex justify-content-between">
            <div class="margin-tb">
                <h4 class="content-title mb-0 my-auto">قائمة المواد</h4>
            </div>
            <div class="margin-tb">
                @can('اضافة منتج')
                    <button wire:click="AddNew" class="btn btn-light rounded-50 btn-md">
                        اضافة منتج جديد
                    </button>
                    {{-- <a class="modal-effect btn btn-light rounded-50 btn-md" data-effect="effect-scale"
                        data-toggle="modal" href="#AddNewModal">
                        إضافة مادة جديدة
                    </a> --}}
                    {{-- @include('items.create') --}}
                @endcan
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="row mb-2">
            <div class="col-lg-3">
                <label>رقم الوجبة</label>
                <input wire:model="ContNo" wire:keydown.enter="ContainerInfo($event.target.value)" type="text" 
                    value="{{ $ContNo }}" class="form-control" aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenuContainer">
                <div class="dropdown-menu tx-13" id="MenuContainer" aria-labelledby="dropleftMenuButton" style="min-width: 200px; max-height: 320px; overflow:scroll; right: 20px !important;">
                    @foreach ($Containers as $Container)
                        <a wire:click="ContainerInfo({{ $Container->cont_no }})" class="dropdown-item Container" ContainerID="{{ $Container->id }}">{{ $Container->cont_no }}</a>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-3">
                <label>تاريخ الوجبة</label>
                <input type="text" class="form-control" name="cont_date"  id="cont_date" value="{{ $ContDate }}">
            </div>
            <div class="col-lg-3">
                <label>سعر الوجبة</label>
                <input type="text" class="form-control" name="cont_amount"  id="cont_amount" value="{{ $ContAmount }}">
            </div>
            <div class="col-lg-3">
                <label>المورد</label>
                <input type="text" class="form-control" name="cont_supplier"  id="cont_supplier" value="{{ $ContSupplier }}">
            </div>
        </div>

        <form wire:submit.prevent="AddToStore" autocomplete="off" class="{{ $DisplayAddToStore }}">
            {{ csrf_field() }}
            <input type="hidden" wire:model="ContId" value="{{ $ContId }}">
            <div class="row mb-2">
                <div class="col-lg-2">
                    <label>الفئة</label>
                    <select class="form-control" wire:model="item_category" wire:change="GetCompany($event.target.value)">
                        <option value=""></option>
                        @if($Categorys != '')
                            @foreach ($Categorys as $Category)
                                <option value="{{ $Category->item_category }}">{{ $Category->item_category }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('item_category') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="col-lg-2">
                    <label>الشركة</label>
                    <select class="form-control" wire:model="item_company" wire:change="GetModel($event.target.value)">
                        <option value=""></option>
                        @if($Companys != '')
                            @foreach ($Companys as $Company)
                                <option value="{{ $Company->item_company }}">{{ $Company->item_company }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('item_company') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="col-lg-2">
                    <label>الموديل</label>
                    <select class="form-control" wire:model="item_model" wire:change="GetItemsName($event.target.value)">
                        <option value=""></option>
                        @if($Models != '')
                            @foreach ($Models as $Model)
                                <option value="{{ $Model->item_model }}">{{ $Model->item_model }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('item_model') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="col-lg-2">
                    <label>أسم المادة</label>
                    <select class="form-control" wire:model="item_name" wire:change="GetCode($event.target.value)">
                        <option value=""></option>
                        @if($ItemNames != '')
                            @foreach ($ItemNames as $ItemName)
                                <option value="{{ $ItemName->item_name }}">{{ $ItemName->item_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-lg-2">
                    <label>كود المادة</label>
                    <select class="form-control" wire:model="item_code" wire:change="GetColor($event.target.value)">
                        <option value=""></option>
                        @if($ItemCodes != '')
                            @foreach ($ItemCodes as $ItemCode)
                                <option value="{{ $ItemCode->item_code }}">{{ $ItemCode->item_code }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('item_code') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="col-lg-2">
                    <label>لون المادة</label>
                    <select class="form-control" wire:model="item_color">
                        <option value=""></option>
                        @if($ItemColors != '')
                            @foreach ($ItemColors as $ItemColor)
                                <option value="{{ $ItemColor->item_color }}">{{ $ItemColor->item_color }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('item_color') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2">
                    <label>الكمية</label>
                    <input type="text" class="form-control" name="item_qty"  wire:model="item_qty">
                </div>
                <div class="col-lg-2">
                    <label>سعر الشراء</label>
                    <input type="text" class="form-control" name="item_price"  wire:model="item_price">
                </div>
                <div class="col-lg-2">
                    <label>&nbsp;</label> <br>
                    <input type="submit" value="إضافة" class="btn btn-primary" {{ $AddItem }}>
                </div>
            </div>
        </form>

       <form wire:submit.prevent="AddNewItem" autocomplete="off" class="{{ $DisplayAddNewItem }}">
            {{ csrf_field() }}
            <input type="hidden" wire:model="ContId" value="{{ $ContId }}">
            <div class="row mb-2">
                <div class="col-lg-2">
                    <label>الفئة</label>
                    <input wire:model="new_item_category" type="text" value="{{ $new_item_category }}" class="form-control"
                        aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenuCategory">
                    <div class="dropdown-menu tx-13" id="MenuCategory" aria-labelledby="dropleftMenuButton"
                        style="min-width: 200px; max-height: 320px; overflow:scroll; right: 20px !important;">
                        @foreach ($Categorys as $Category)
                            <a wire:click="GetCompany('{{ $Category->item_category }}')" class="dropdown-item Container">{{
                                $Category->item_category }}</a>
                        @endforeach
                    </div>
                    @error('new_item_category') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="col-lg-2">
                    <label>الشركة</label>
                    {{ $Companys }}
                    <select class="form-control" wire:model="new_item_company"{{--  wire:change="GetModel($event.target.value)" --}}>
                        <option value=""></option>
                        @if($Companys != '')
                            @foreach ($Companys as $Company)
                                <option value="{{ $Company->item_company }}">{{ $Company->item_company }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('new_item_company') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
        </form>
        <hr>

        <div class="table-responsive mt-1">
            <table class="table key-buttons text-md-nowrap mt-2" data-page-length='50'>
                <thead>
                    <tr>
                        <th class="font-small-3">#</th>
                        <th class="font-small-3">كود المادة</th>
                        <th class="font-small-3">اسم المادة</th>
                        <th class="font-small-3">النوع</th>
                        <th class="font-small-3">اللون</th>
                        <th class="font-small-3">العدد</th>
                        <th class="font-small-3">سعر الشراء</th>
                        <th class="font-small-3">التكلفة</th>
                        <th class="font-small-3">سعر البيع</th>
                        <th class="font-small-3">الأجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($ContItemsFromStore != '')
                        @foreach ($ContItemsFromStore as $key => $ContItemFromStore)
                            <tr>
                                <td class="">{{ ++$key }}</td>
                                <td class="">{{ $ContItemFromStore->GetItemsDit->item_code }}</td>
                                <td class="">{{ $ContItemFromStore->GetItemsDit->item_name }}</td>
                                <td class="">{{ $ContItemFromStore->GetItemsDit->item_model }}</td>
                                <td class="">{{ $ContItemFromStore->GetItemsDit->item_color }}</td>
                                <td class="">{{ $ContItemFromStore->item_qty }}</td>
                                <td class="">{{ $ContItemFromStore->item_price }}</td>
                                <td class="">{{ $ContItemFromStore->item_cost }}</td>
                                <td class="">{{ $ContItemFromStore->GetItemsDit->item_sale_price }}</td>
                                <td class="">
                                    <button type="button" wire:click="DeleteFromStore({{ $ContItemFromStore->id }})" class="btn btn-danger btn-sm rounded-50" data-toggle="modal" data-target="#DeleteModal">حذف</button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="font-small-3 text-center">لا يوجد مواد في الحاوية</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Add New Modal -->
        <div wire:ignore.self class="modal fade" id="AddNewModal" tabindex="-1" role="dialog" aria-labelledby="AddNewModalModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="exampleModalLabel">إضافة مادة جديدة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="AddNewItem" autocomplete="off">
                            {{ csrf_field() }}
                            <input type="hidden" wire:model="ContId" value="{{ $ContId }}">
                            <div class="row mb-2">
                                <div class="col-lg-2">
                                    <label>الفئة</label>
                                    {{-- <input wire:model="new_item_category" type="text" value="{{ $new_item_category }}" class="form-control" aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenuContainer">
                                    <div class="dropdown-menu tx-13" id="MenuContainer" aria-labelledby="dropleftMenuButton" style="min-width: 200px; max-height: 320px; overflow:scroll; right: 20px !important;">
                                        @foreach ($Categorys as $Category)
                                            <a wire:click="GetCompany('{{ $Category->item_category }}')" class="dropdown-item Container" >{{ $Category->item_category }}</a>
                                        @endforeach
                                    </div> --}}


                                    {{-- <select class="form-control" wire:model="new_item_category" wire:change="GetCompany($event.target.value)">
                                        <option value=""></option>
                                        @if($Categorys != '')
                                            @foreach ($Categorys as $Category)
                                                <option value="{{ $Category->item_category }}">{{ $Category->item_category }}</option>
                                            @endforeach
                                        @endif
                                    </select> --}}
                                    @error('new_item_category') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-lg-2">
                                    <label>الشركة</label>
                                    {{ $Companys }}
                                    <select class="form-control" wire:model="new_item_company" wire:change="GetModel($event.target.value)">
                                        <option value=""></option>
                                        @if($Companys != '')
                                            @foreach ($Companys as $Company)
                                                <option value="{{ $Company->item_company }}">{{ $Company->item_company }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('new_item_company') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-lg-2">
                                    <label>الموديل</label>
                                    <select class="form-control" wire:model="new_item_model" wire:change="GetItemsName($event.target.value)">
                                        <option value=""></option>
                                        @if($Models != '')
                                            @foreach ($Models as $Model)
                                                <option value="{{ $Model->item_model }}">{{ $Model->item_model }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('new_item_model') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-lg-2">
                                    <label>أسم المادة</label>
                                    <select class="form-control" wire:model="new_item_name" wire:change="GetCode($event.target.value)">
                                        <option value=""></option>
                                        @if($ItemNames != '')
                                            @foreach ($ItemNames as $ItemName)
                                                <option value="{{ $ItemName->item_name }}">{{ $ItemName->item_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <label>كود المادة</label>
                                    <select class="form-control" wire:model="new_item_code" wire:change="GetColor($event.target.value)">
                                        <option value=""></option>
                                        @if($ItemCodes != '')
                                            @foreach ($ItemCodes as $ItemCode)
                                                <option value="{{ $ItemCode->item_code }}">{{ $ItemCode->item_code }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('new_item_code') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-lg-2">
                                    <label>لون المادة</label>
                                    <select class="form-control" wire:model="new_item_color">
                                        <option value=""></option>
                                        @if($ItemColors != '')
                                            @foreach ($ItemColors as $ItemColor)
                                                <option value="{{ $ItemColor->item_color }}">{{ $ItemColor->item_color }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('new_item_color') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <label>الكمية</label>
                                    <input type="text" class="form-control" wire:model="new_item_qty">
                                </div>
                                <div class="col-lg-2">
                                    <label>سعر الشراء</label>
                                    <input type="text" class="form-control" wire:model="new_item_price">
                                </div>
                                {{-- <div class="col-lg-2">
                                    <label>&nbsp;</label> <br>
                                    <input type="submit" value="إضافة" class="btn btn-primary" {{ $AddItem }}>
                                </div> --}}
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">إلغاء</button>
                        <button type="submit" {{-- wire:click.prevent="DeleteConfirm()" --}} class="btn btn-primary close-modal" data-dismiss="modal">اضف مادة جديدة</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div wire:ignore.self class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-white" id="exampleModalLabel">تأكيد حذف</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>هل أنت متأكد من أنك تريد الحذف؟</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">إلغاء</button>
                        <button type="button" wire:click.prevent="DeleteConfirm()" class="btn btn-danger close-modal" data-dismiss="modal">نعم ، احذف</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
