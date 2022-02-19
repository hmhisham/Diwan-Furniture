<div>
     <div class="card-header mb-2 bg-primary text-white">
         <div class="d-flex justify-content-between">
             <div class="margin-tb">
                 <h4 class="content-title mb-0 my-auto"> كشف المصاريف</h4>
             </div>
             
         </div>
     </div>
     <div class="card-body">
         <form wire:submit.prevent="ReportByDate" autocomplete="off" class="">
             <div class="row mb-2">
                 <div class="col-lg-3">
                     <label> من تاريخ</label>
                     <input type="date" required class="form-control  "   wire:model.defer="QutlayReport.date_from" >

                </div>
                 <div class="col-lg-3">
                     <label> الى تاريخ</label>
                     <input type="date" required class="form-control" wire:model.defer="QutlayReport.date_to">
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
    <div class="card">
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-md-nowrap" id="example1">
                 <thead>
                     <tr>
                         <th class="font-small-3">#</th>
                         <th class="font-small-3"> الميلغ</th>
                         <th class="font-small-3"> الغرض من الصرف</th>
                         <th class="font-small-3"> التاريخ</th>
                         <th class="font-small-3"> صرف من قبل</th>
                         <th class="font-small-3"> الملاحظات</th>
                         <th class="font-small-3"> سعر الصرف</th>
                         
                     </tr>
                 </thead>
                 <tbody>
                     @if ($QutlaysInfo!='' )
                     
                         @foreach ($QutlaysInfo as $key => $QutlayInfo)
                             <tr>
                                 <td class="">{{ $key }}</td>
                                 <td class="">{{ $QutlayInfo->qutlays_amount }}</td>
                                 <td class="">{{ $QutlayInfo->qutlays_type }}</td>
                                 <td class="">{{ $QutlayInfo->qutlays_date }}</td>
                                 <td class="">{{ $QutlayInfo->qutlays_by }}</td>
                                 <td class="">{{ $QutlayInfo->qutlays_note }}</td>
                                 <td class="">{{ $QutlayInfo->qutlays_exchange_rate }}</td>
                                 
                           </tr>
                         @endforeach
                     @else
                         <tr>
                             <td colspan="10" class="font-small-3 text-center">لا يوجد مصارف في هذا التاريخ</td>
                         </tr>
                         
                     @endif
                 </tbody>
             </table>
            </div>
        </div><!-- bd -->
    </div><!-- bd -->
</div>
 
         <!-- Add New Modal -->
         
 
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
 