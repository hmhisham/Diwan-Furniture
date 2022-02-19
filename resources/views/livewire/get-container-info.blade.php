<div>
    <div class="card-header mb-2 bg-primary text-white">
        <div class="d-flex justify-content-between">
            <div class="margin-tb">
                <h4 class="content-title mb-0 my-auto">قائمة المواد</h4>
            </div>
            <div class="margin-tb">
                @can('اضافة منتج')
                    <a class="modal-effect btn btn-light rounded-50 btn-md" style="{{ $AddNewModal }}"  data-effect="effect-scale"
                        data-toggle="modal" href="#AddNewModal">
                        إضافة مادة جديدة
                    </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="row mb-2">
            <div class="col-lg-3">
                <label>رقم الوجبة</label>
                <input wire:model.defer="ContNo" wire:keyup="ContainerInfo($event.target.value)" type="text" autocomplete="off"
                    value="{{ $ContNo }}" class="form-control" aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenuContainer">
                <div class="dropdown-menu tx-13" id="MenuContainer" aria-labelledby="dropleftMenuButton" style="min-width: 200px; max-height: 320px; overflow:scroll; right: 20px !important;">
                    @foreach ($Containers as $Container)
                        <a wire:click="ContainerInfo('{{ $Container->cont_no }}')" class="dropdown-item Container" ContainerID="{{ $Container->id }}">{{ $Container->cont_no }}</a>
                    @endforeach
                </div>
                <div wire:loading>
                    <div id="global-loader">
                        <img src="{{ URL::asset('assets/img/Magnify-1s-200px.gif') }}" class="loader-img" alt="Loader">
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <label>تاريخ الوجبة</label>
                <input type="text" class="form-control" wire:model.defer="cont_date" value="{{ $ContDate }}" readonly>
            </div>
            <div class="col-lg-3">
                <label>سعر الوجبة</label>
                <input type="text" class="form-control" value="{{ $ContAmount }}" readonly>
            </div>
            <div class="col-lg-3">
                <label>المورد</label>
                <input type="text" class="form-control" name="cont_supplier"  id="cont_supplier" value="{{ $ContSupplier }}" readonly>
            </div>
        </div>

        <form wire:submit.prevent="AddToStore" autocomplete="off" class="{{ $DisplayAddToStore }}">
            {{ csrf_field() }}
            <input type="hidden" wire:model.defer="ContId" value="{{ $ContId }}">
            <div class="row mb-2">
                <div class="col-lg-3">
                    <label>الفئة</label>
                    <select class="form-control" wire:model.defer="item_category" wire:change="GetCompany($event.target.value)">
                        <option value=""></option>
                        @if($Categorys != '')
                            @foreach ($Categorys as $Category)
                                <option value="{{ $Category->item_category }}">{{ $Category->item_category }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('item_category') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="col-lg-3">
                    <label>الشركة</label>
                    <select class="form-control" wire:model.defer="item_company" wire:change="GetModel($event.target.value)">
                        <option value=""></option>
                        @if($Companys != '')
                            @foreach ($Companys as $Company)
                                <option value="{{ $Company->item_company }}">{{ $Company->item_company }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('item_company') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="col-lg-3">
                    <label>الموديل</label>
                    <select class="form-control" wire:model.defer="item_model" wire:change="GetItemsName($event.target.value)">
                        <option value=""></option>
                        @if($Models != '')
                            @foreach ($Models as $Model)
                                <option value="{{ $Model->item_model }}">{{ $Model->item_model }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('item_model') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="col-lg-3">
                    <label>أسم المادة</label>
                    <select class="form-control" wire:model.defer="item_name" wire:change="GetCode($event.target.value)">
                        <option value=""></option>
                        @if($ItemNames != '')
                            @foreach ($ItemNames as $ItemName)
                                <option value="{{ $ItemName->item_name }}">{{ $ItemName->item_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label>كود المادة</label>
                    <select class="form-control" wire:model.defer="item_code" wire:change="GetColor($event.target.value)">
                        <option value=""></option>
                        @if($ItemCodes != '')
                            @foreach ($ItemCodes as $ItemCode)
                                <option value="{{ $ItemCode->item_code }}">{{ $ItemCode->item_code }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('item_code') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="col">
                    <label>لون المادة</label>
                    <select class="form-control" wire:model.defer="item_color">
                        <option value=""></option>
                        @if($ItemColors != '')
                            @foreach ($ItemColors as $ItemColor)
                                <option value="{{ $ItemColor->item_color }}">{{ $ItemColor->item_color }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('item_color') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="col">
                    <label>الكمية</label>
                    <input type="text"  class="form-control" name="item_qty"  wire:model.defer="item_qty">
                </div>
                <div class="col {{ $item_price_display }}">
                    <label>سعر الشراء</label>
                    <input type="text" class="form-control" name="item_price" wire:model.defer="item_price">
                </div>
                <div class="col {{ $item_cost_display }}">
                    <label>الكلفة</label>
                    <input type="text" wire:model.defer="item_cost" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <label>&nbsp;</label> <br>
                    <input type="submit" value="إضافة" class="btn btn-primary btn-block" {{ $AddItem }}>
                </div>
                {{-- @if ($ContItemsFromStore != '')
                    <div class="col-lg-3">
                        <label>اخر مادة تم اضافتها</label> <br>
                        {{ $ContLastItemsFromStore }}
                    </div>
                @endif --}}
            </div>
        </form>

        <hr>

        <div class="table-responsive mt-1" style="height:600px;">
            <table {{-- id="example" --}} class="flex-table table key-buttons text-md-nowrap" data-page-length='50'>
                <thead>
                    <tr class="alert-primary">
                        <th class="font-small-3 pt-2 pb-2">#</th>
                        <th class="font-small-3">الفئة </th>
                        <th class="font-small-3">الشركة </th>
                        <th class="font-small-3">كود المادة</th>
                        <th class="font-small-3">اسم المادة</th>
                        <th class="font-small-3">النوع</th>
                        <th class="font-small-3">اللون</th>
                        <th class="font-small-3">العدد</th>
                        <th class="font-small-3">سعر الشراء</th>
                        <th class="font-small-3">التكلفة</th>
                        <th class="font-small-3">سعر البيع</th>
                        <th class="font-small-3">نسبة الربح</th>
                        <th class="font-small-3">الأجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($ContItemsFromStore != '')
                        @foreach ($ContItemsFromStore as $key => $ContItemFromStore)
                            <tr>
                                <td class="">{{ ++$key }}</td>
                                <td class="">{{ $ContItemFromStore->GetItemsDit->item_category }}</td>
                                <td class="">{{ $ContItemFromStore->GetItemsDit->item_company }}</td>
                                <td class="">{{ $ContItemFromStore->GetItemsDit->item_code }}</td>
                                <td class="">{{ $ContItemFromStore->GetItemsDit->item_name }}</td>
                                <td class="">{{ $ContItemFromStore->GetItemsDit->item_model }}</td>
                                <td class="">{{ $ContItemFromStore->GetItemsDit->item_color }}</td>
                                <td class="">{{ $ContItemFromStore->item_qty }}</td>
                                <td class="">{{ $ContItemFromStore->item_price }}</td>
                                <td class="">{{ $ContItemFromStore->item_cost }}</td>
                                <td class="">{{ $ContItemFromStore->GetItemsDit->item_sale_price }}</td>
                                <td class="">
                                    {{ number_format(($ContItemFromStore->GetItemsDit->item_sale_price - $ContItemFromStore->item_cost)/$ContItemFromStore->item_cost*100) }}%<br>
                                    {{ $ContItemFromStore->GetItemsDit->item_sale_price - $ContItemFromStore->item_cost }}
                                </td>
                                <td class="">
                                    <div class="d-flex justify-content-center">
                                        <button type="button" wire:click="DeleteFromStore({{ $ContItemFromStore->id }})" class="btn btn-danger btn-icon-md rounded-circle" data-toggle="modal" data-target="#DeleteModal">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        @if ( $ContNo == 1 )
                                            <button type="button" class="btn btn-success btn-icon-md {{-- rounded-circle --}}" data-toggle="modal" data-target="#UpdateModal{{ $ContItemFromStore->id }}">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                        @endif
                                    </div>
                                </tr>

                            <!-- Update Modal -->
                            <div wire:ignore.self class="modal fade" id="UpdateModal{{ $ContItemFromStore->id }}" tabindex="-1" role="dialog" aria-labelledby="UpdateModalModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success">
                                            <h5 class="modal-title text-white" id="exampleModalLabel">تعديل كلفة المادة</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true close-btn">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <label for="item_cost">اسم المادة</label>
                                            <input type="text"class="form-control" value="{{ $ContItemFromStore->GetItemsDit->item_name }}" disabled>

                                            <hr>
                                            <label for="item_cost">تغيير كلفة المادة</label>
                                            <br>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="item_cost">من</label>
                                                    <input type="text" class="form-control" value="{{ $ContItemFromStore->item_cost }}" disabled>
                                                </div>
                                            <div class="col">
                                                <label for="item_cost">إلى</label>
                                                <input type="text" wire:model.defer="item_cost" class="form-control" autofocus="autofocus" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">إلغاء</button>
                                            <button type="button" wire:click.prevent="UpdateConfirm({{ $ContItemFromStore->id }})" class="btn btn-success close-modal" data-dismiss="modal">تعديل</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    @else
                        <tr>
                            <td colspan="13" class="font-small-3 text-center">لا يوجد مواد في الحاوية</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Add New Modal -->
        <div wire:ignore.self class="modal fade" id="AddNewModal" tabindex="-1" role="dialog" aria-labelledby="AddNewModalModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form wire:submit.prevent="AddNewItem" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="exampleModalLabel">إضافة مادة جديدة</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true close-btn">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" wire:model.defer="ContId" value="{{ $ContId }}">
                            <div class="row mb-2">
                                <div class="col-lg-2">
                                    <label>الفئة</label>
                                    <input required="required" wire:model.defer="new_item_category" type="text" value="{{ $new_item_category }}" class="form-control" aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenuCategory">
                                    <div class="dropdown-menu tx-13" id="MenuCategory" aria-labelledby="dropleftMenuButton" style="min-width: 200px; max-height: 320px; overflow:scroll; right: 20px !important;">
                                        @if($Categorys != '')
                                            @foreach ($Categorys as $Category)
                                                <a wire:click="GetCompanyNew('{{ $Category->item_category }}')" class="dropdown-item" >{{ $Category->item_category }}</a>
                                            @endforeach
                                        @endif
                                    </div>
                                    @error('new_item_category') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-lg-2">
                                    <label>الشركة</label>
                                    <input required="required" wire:model.defer="new_item_company" type="text" value="{{ $new_item_company }}" class="form-control" aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenuCompany">
                                    <div class="dropdown-menu tx-13" id="MenuCompany" aria-labelledby="dropleftMenuButton" style="min-width: 200px; max-height: 320px; overflow:scroll; right: 20px !important;">
                                        @if($NewCompanys)
                                            @foreach ($NewCompanys as $Company)
                                                <a wire:click="GetModelNew('{{ $Company->item_company }}')" class="dropdown-item" >{{ $Company->item_company }}</a>
                                            @endforeach
                                        @endif
                                    </div>
                                    @error('new_item_company') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-lg-2">
                                    <label>الموديل</label>
                                    <input required="required" wire:model.defer="new_item_model" type="text" value="{{ $new_item_model }}" class="form-control" aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenuModel">
                                    <div class="dropdown-menu tx-13" id="MenuModel" aria-labelledby="dropleftMenuButton" style="min-width: 200px; max-height: 320px; overflow:scroll; right: 20px !important;">
                                        @if($NewModels != '')
                                            @foreach ($NewModels as $Model)
                                                <a wire:click="GetItemsNameNew('{{ $Model->item_model }}')" class="dropdown-item" >{{ $Model->item_model }}</a>
                                            @endforeach
                                        @endif
                                    </div>
                                    @error('new_item_model') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-lg-2">
                                    <label>أسم المادة</label>
                                    <input required="required" wire:model.defer="new_item_name" type="text" value="{{ $new_item_name }}" class="form-control" aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenuItemName">
                                    <div class="dropdown-menu tx-13" id="MenuItemName" aria-labelledby="dropleftMenuButton" style="min-width: 200px; max-height: 320px; overflow:scroll; right: 20px !important;">
                                        @if($NewItemNames != '')
                                            @foreach ($NewItemNames as $ItemName)
                                                <a wire:click="GetCodeNew('{{ $ItemName->item_name }}')" class="dropdown-item" >{{ $ItemName->item_name }}</a>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <label>كود المادة</label>
                                    <input required="required" wire:model.defer="new_item_code" type="text" value="{{ $new_item_code }}" class="form-control" aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenuItemCode">
                                    <div class="dropdown-menu tx-13" id="MenuItemCode" aria-labelledby="dropleftMenuButton" style="min-width: 200px; max-height: 320px; overflow:scroll; right: 20px !important;">
                                        @if($NewItemCodes != '')
                                            @foreach ($NewItemCodes as $ItemCode)
                                                <a wire:click="GetColorNew('{{ $ItemCode->item_code }}')" class="dropdown-item" >{{ $ItemCode->item_code }}</a>
                                            @endforeach
                                        @endif
                                    </div>
                                    @error('new_item_code') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-lg-2">
                                    <label>لون المادة</label>
                                    <input required="required" wire:model.defer="new_item_color" type="text" value="{{ $new_item_color }}" class="form-control" aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenuItemColor">
                                    <div class="dropdown-menu tx-13" id="MenuItemColor" aria-labelledby="dropleftMenuButton" style="min-width: 200px; max-height: 320px; overflow:scroll; right: 20px !important;">
                                        @if($NewItemColors != '')
                                            @foreach ($NewItemColors as $ItemColor)
                                                <a wire:click="ColorNew('{{ $ItemColor->item_color }}')" class="dropdown-item" >{{ $ItemColor->item_color }}</a>
                                            @endforeach
                                        @endif
                                    </div>
                                    @error('new_item_color') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <label>الكمية</label>
                                    <input type="text" wire:model.defer="new_item_qty" required="required" class="form-control">
                                </div>
                                <div class="col-lg-2 {{ $item_price_display }}">
                                    <label>سعر الشراء</label>
                                    <input type="text" wire:model.defer="new_item_price" required="required" class="form-control">
                                </div>
                                <div class="col-lg-2 {{ $item_cost_display }}">
                                    <label>الكلفة</label>
                                    <input type="text" wire:model.defer="new_item_cost" required="required" class="form-control">
                                </div>

                                <div class="col-lg-2">
                                    <label>سعر البيع</label>
                                    <input type="text" wire:model.defer="new_item_sale_price" required="required" class="form-control">
                                </div>
                                <div class="col-lg-2">
                                    <label>العدد الحرج</label>
                                    <input type="text" wire:model.defer="new_less_qty" required="required" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" wire:click="AddNewItem" value="إضافة" class="btn btn-primary close-modal">

                            <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">اغلاق</button>
                        </div>
                    </div>
                </form>
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
                        <button type="button" wire:click.prevent="DeleteConfirm({{ $deleteId }})" class="btn btn-danger close-modal" data-dismiss="modal">نعم ، احذف</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
