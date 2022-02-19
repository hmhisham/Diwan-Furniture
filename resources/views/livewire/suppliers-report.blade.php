<div>
    <div class="card-header mb-2 bg-primary text-white">
        <div class="d-flex justify-content-between">
            <div class="margin-tb">
                <h4 class="content-title mb-0 my-auto"> كشف حساب المورد</h4>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="SuppliersReporttByDate" autocomplete="off" class="">
            <div class="row mb-2">
                <div class="col-lg-3">
                    <label> اسم المورد</label>
                    <input type="hidden" class="form-control" wire:model.defer="SuppliersReport.supplier_id">

                    <input wire:model="supplier_name" required wire:keydown.enter="SupplierInfo($event.target.value)"
                        type="text" class="form-control" aria-expanded="false" aria-haspopup="true"
                        data-toggle="dropdown" id="dropdownMenuContainer">
                    <div class="dropdown-menu tx-13" id="MenuContainer" aria-labelledby="dropleftMenuButton"
                        style="min-width: 200px; max-height: 320px; overflow:scroll; right: 20px !important;">
                        @foreach ($Suppliers as $Supplier)
                        <a wire:click="SupplierInfo('{{ $Supplier->name }}')" class="dropdown-item Container">{{
                            $Supplier->name }}</a>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-3">
                    <label> من تاريخ</label>
                    <input type="date" required class="form-control  " wire:model.defer="SuppliersReport.date_from">
                </div>
                <div class="col-lg-3">
                    <label> الى تاريخ</label>
                    <input type="date" required class="form-control" wire:model.defer="SuppliersReport.date_to">
                </div>

                <div class="col-lg-2">
                    <label>&nbsp;</label> <br>
                    <input type="submit" value="عرض" class="btn btn-primary">
                </div>
            </div>
        </form>

        <hr>

        {{-- ------------------------------------------------------ --}}
        <div class="col-xl-12">
            <table {{-- id="example" --}} class="table key-buttons text-md-nowrap" data-page-length='50'>
                <thead>
                    <tr class="alert-primary">
                        <th class="font-small-3 pt-2 pb-2">#</th>
                        <th class="font-small-3"> التاريخ</th>
                        <th class="font-small-3"> الطلب السايق </th>
                        <th class="font-small-3"> الطلب </th>
                        <th class="font-small-3"> التسديد </th>
                        <th class="font-small-3"> الباقي </th>
                        <th class="font-small-3"> التفاصيل</th>
                        <th class="font-small-3"> الملاحظات</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class=""></td>
                        <td class=""></td>
                        <td class="">{{ number_format($OldSum) }}</td>
                        <td class=""></td>
                        <td class=""></td>
                        <td class=""></td>
                        <td class="">طلب سابق</td>
                        <td class=""></td>
                    </tr>
                    @php
                        $sum = $OldSum;
                    @endphp
                    @if ($report_infos )
                        @foreach ($report_infos as $key => $report_info)
                            <tr>
                                <td class="">{{ ++$key }}</td>
                                <td class="">{{ $report_info['info_date'] }}</td>
                                <td class="">{{ number_format($sum) }}</td>
                                <td class="">{{ number_format($report_info['container_amount']) }}</td>
                                <td class="">{{ number_format($report_info['Payment_amount']) }}</td>
                                @php
                                    $sum = $sum + $report_info['container_amount'] -$report_info['Payment_amount'];
                                @endphp
                                <td class="">{{ number_format($sum) }}</td>
                                <td class="">{{ $report_info['info_details'] }}</td>
                                <td class="">{{ $report_info['info_note'] }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="font-small-3 text-center">لا يوجد حسايات في هذا التاريخ</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>


        <!-- Add New Modal -->


        <!-- Delete Modal -->
        <div wire:ignore.self class="modal fade" id="DeleteModal" tabindex="-1" role="dialog"
            aria-labelledby="DeleteModalModalLabel" aria-hidden="true">
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
                        <button type="button" wire:click.prevent="DeleteConfirm()" class="btn btn-danger close-modal"
                            data-dismiss="modal">نعم ، احذف</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>