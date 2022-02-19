<div>
    <div class="card-header mb-2 bg-primary text-white">
        <div class="d-flex justify-content-between">
            <div class="margin-tb">
                <h4 class="content-title mb-0 my-auto"> المصاريف</h4>
            </div>

        </div>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="AddToQutlay" autocomplete="off" class="">
            <div class="row mb-2">
                <div class="col-lg-3">
                    <label>المبلغ بالدينار</label>
                    <input type="text" required  class="form-control"  wire:model.defer="qutlays_amount"  name="qutlays_amount"  id="qutlays_amount"  >
                </div>
                <div class="col-lg-3">
                    <label> الغرض من الصرف</label>
                    <input type="text" required class="form-control" wire:model.defer="qutlays_type"  name="qutlays_type"  id="qutlays_type">
                </div>
                <div class="col-lg-3">
                    <label>التاريخ</label>
                    <input type="date" required class="form-control" wire:model.defer="qutlays_date" >
                </div>
                <div class="col-lg-3">
                    <label>دفع من قبل</label>
                    <input type="text"required class="form-control"wire:model.defer="qutlays_by"   name="qutlays_by"  id="qutlays_by" >
                </div>
                <div class="col-lg-3">
                    <label>ملاحظات</label>
                    <input type="text" class="form-control" wire:model.defer="qutlays_note" name="qutlays_note"  id="qutlays_note" >
                </div>
                <div class="col-lg-3">
                    <label>سعر الصرف</label>
                    <input type="text" required class="form-control"wire:model.defer="qutlays_exchange_rate"  name="qutlays_exchange_rate"  id="qutlays_exchange_rate" value="">
                </div>
                <div class="col-lg-2">
                    <label>&nbsp;</label> <br>
                    <input type="submit" value="إضافة" class="btn btn-primary">
                </div>
                <div class="col-lg-2">
                    <div wire:loading>
                        <span id="">
                            <img src="{{ URL::asset('assets/img/loadding/Bars-1s-200px.gif') }}" style="width:50%" alt="Loader">
                        </span>
                    </div>
                </div>
            </div>
        </form>

        <hr>

        <div class="table-responsive mt-1">
            <table class="table key-buttons text-md-nowrap mt-2" data-page-length='50'>
                <thead>
                    <tr>
                        <th class="font-small-3">#</th>
                        <th class="font-small-3"> الميلغ</th>
                        <th class="font-small-3"> الغرض من الصرف</th>
                        <th class="font-small-3"> التاريخ</th>
                        <th class="font-small-3"> صرف من قبل</th>
                        <th class="font-small-3"> الملاحظات</th>
                        <th class="font-small-3"> سعر الصرف</th>
                        <th class="font-small-3"> اجراءات </th>

                    </tr>
                </thead>
                <tbody>
                    @if ($Qutlay!='' )
                        @foreach ($Qutlay as $key => $Qutlay_new)
                            <tr>
                                <td class="">{{ $key }}</td>
                                <td class="">
                                    <span class="text-danger">{{ number_format($Qutlay_new->qutlays_amount_IQ) }} IQ</span><br>
                                    <span class="text-success">{{ number_format($Qutlay_new->qutlays_amount,2) }} $</span>
                                </td>
                                <td class="">{{ $Qutlay_new->qutlays_type }}</td>
                                <td class="">{{ $Qutlay_new->qutlays_date }}</td>
                                <td class="">{{ $Qutlay_new->qutlays_by }}</td>
                                <td class="">{{ $Qutlay_new->qutlays_note }}</td>
                                <td class="">{{ $Qutlay_new->qutlays_exchange_rate }}</td>
                                <td class="">
                                    <button type="button"  wire:click.prevent="SendQutlayId({{ $Qutlay_new->id }})"  class="btn btn-danger btn-sm rounded-50" data-toggle="modal" data-target="#DeleteModal">حذف</button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="font-small-3 text-center">لا يوجد مصاريف</td>
                        </tr>

                    @endif
                </tbody>
            </table>
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
                        <button type="button"  wire:click.prevent="DeleteFromQutlay({{ $QutlayId }})" class="btn btn-danger close-modal" data-dismiss="modal">نعم احذف</button>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
