<div class="modal" id="DeleteSupplier{{ $Supplier->id }}">
    <div class="modal-dialog" role="document">
        <form action="{{ route('Suppliers.destroy', $Supplier->id) }}" method="post" autocomplete="off">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف بيانات مورد</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <h6>اسم المورد</h6>
                                <h6 class="text-danger">{{ $Supplier->name }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success rounded-50">حف</button>
                    <button type="button" class="btn btn-secondary rounded-50" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </form>
    </div>
</div>