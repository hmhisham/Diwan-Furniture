<div class="modal fade" id="ReturnItemModel{{ $SaleInvoicesDetail->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('Return_Item') }}" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ارجاع مادة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                
                    {{ csrf_field() }}
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">الكمية المرجعة سابقاً</div>
                        <div class="col">{{ App\ReturnItems::where('sale_invoices_id', $SaleInvoice->id)->where('items_id', $SaleInvoicesDetail->items_id)->sum('return_quantity')}}</div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">اقصى عدد يمكن ارجاعه</div>
                        <div class="col">{{ $SaleInvoicesDetail->sale_quantity - App\ReturnItems::where('sale_invoices_id', $SaleInvoice->id)->where('items_id', $SaleInvoicesDetail->items_id)->sum('return_quantity')}}</div>
                    </div>
                    <div class="row col mt-2">
                        <h5>الكمية المراد ارجاعها</h5>
                        <input type="text" name="return_quantity" class="form-control" value="{{ $SaleInvoicesDetail->sale_quantity - App\ReturnItems::where('sale_invoices_id', $SaleInvoice->id)->where('items_id', $SaleInvoicesDetail->items_id)->sum('return_quantity')}}">
                    </div>
                    <input type="hidden" name="quantity" class="form-control" value="{{ $SaleInvoicesDetail->sale_quantity - App\ReturnItems::where('sale_invoices_id', $SaleInvoice->id)->where('items_id', $SaleInvoicesDetail->items_id)->sum('return_quantity')}}">
                    <input type="hidden" name="sale_invoices_id" class="form-control" value="{{ $SaleInvoice->id }}">
                    <input type="hidden" name="items_id" class="form-control" value="{{ $SaleInvoicesDetail->items_id }}">
                    <input type="hidden" name="create_by" class="form-control" value="{{Auth::user()->id }}">

                    <div class="row col mt-2 tx-15">
                        هل انت متاكد من عملية الارجاع ؟
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">تاكيد</button>
                </div>
            </div>
        </form>
    </div>
</div>