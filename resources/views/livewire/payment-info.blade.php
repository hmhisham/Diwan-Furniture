<div>
    <div class="card-header mb-2 bg-primary text-white">
        <div class="d-flex justify-content-between">
            <div class="margin-tb">
                <h4 class=""> قائمة تسديدات الموردين</h4>
            </div>
            <div class="margin-tb">
                <a class="modal-effect btn btn-light rounded-50 btn-md" data-effect="effect-scale" data-toggle="modal" href="#AddPayment">
                    إضافة تسديد
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive mt-1">
            <table {{-- id="example" --}} class="table key-buttons text-md-nowrap" data-page-length='50'>
                <thead>
                    <tr class="alert-primary">
                        <th class="font-small-3 pt-2 pb-2">#</th>
                        <th class="font-small-3">المورد</th>
                        <th class="font-small-3">المبلغ</th>
                        <th class="font-small-3"> التاريخ</th>
                        <th class="font-small-3"> شركة الحوالة</th>
                        <th class="font-small-3"> الملاحظات</th>
                        <th class="font-small-3"> اجراءات </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($payments!='' )
                        @foreach ($payments as $key => $payment)
                            <tr>
                                <td class="">{{ ++$key }}</td>
                                <td class="">{{ $payment->Getsupplier->name }}</td>
                                <td class="">{{ number_format($payment->payment_amount) }}</td>
                                <td class="">{{ $payment->payment_date }}</td>
                                <td class="">{{ $payment->payment_company }}</td>
                                <td class="">{{ $payment->payment_note }}</td>
                                <td class="">
                                    <button type="button" wire:click.prevent="SendPaymentId({{ $payment->id }})"  class="btn btn-danger btn-sm rounded-50" data-toggle="modal" data-target="#DeleteModal">حذف</button>
                                </td>
                          </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="font-small-3 text-center">لا يوجد تسديد في هذا التاريخ</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Add New Modal -->
        <div wire:ignore.self class="modal fade" id="AddPayment" tabindex="-1" role="dialog" aria-labelledby="DeleteModalModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form {{-- wire:submit.prevent="AddToPayment" --}} autocomplete="off" class="">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="exampleModalLabel">إضافة تسديد مورد</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true close-btn">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-2">
                                <div class="col-lg-3">
                                    <label> اسم المورد</label>
                                    <input type="hidden" class="form-control" wire:model="id_suppliers">
                        
                                    <input wire:model="supplier_name" required wire:keydown.enter="SupplierInfo($event.target.value)"
                                        type="text" class="form-control" aria-expanded="false" aria-haspopup="true" data-toggle="dropdown"
                                        id="dropdownMenuContainer">
                                    <div class="dropdown-menu tx-13" id="MenuContainer" aria-labelledby="dropleftMenuButton"
                                        style="min-width: 200px; max-height: 320px; overflow:scroll; right: 20px !important;">
                                        @foreach ($Suppliers as $Supplier)
                                        <a wire:click="SupplierInfo('{{ $Supplier->name }}')" class="dropdown-item Container">{{ $Supplier->name
                                            }}</a>
                                        @endforeach
                                    </div>
                                </div>
                        
                                <div class="col-lg-3">
                                    <label> المبلغ</label>
                                    <input type="text" required class="form-control" wire:model="payment_amount" name="payment_amount"
                                        id="payment_amount">
                                </div>
                                <div class="col-lg-3">
                                    <label>التاريخ</label>
                                    <input type="date" required class="form-control" wire:model="payment_date" name="payment_date"
                                        id="payment_date">
                                </div>
                                <div class="col-lg-3">
                                    <label> شركة الحوالة </label>
                                    <input type="text" required class="form-control" wire:model="payment_company" name="payment_company"
                                        id="payment_company">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-lg-12">
                                    <label> ملاحظات</label>
                                    <input type="text" class="form-control" wire:model="payment_note" name="payment_note" id="payment_note">
                                </div>
                            </div>
                        
                                {{-- <div class="col-lg-2">
                                    <label>&nbsp;</label> <br>
                                    <input type="submit" value="إضافة" class="btn btn-primary">
                                </div> --}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">إلغاء</button>
                            <button type="submit" wire:click="AddToPayment" class="btn btn-primary close-modal" data-dismiss="modal">اضافة التسديد</button>
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
                        <button type="button" wire:click.prevent="DeleteFromPayment({{ $PaymentId }})" class="btn btn-danger close-modal" data-dismiss="modal">نعم ، احذف</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
