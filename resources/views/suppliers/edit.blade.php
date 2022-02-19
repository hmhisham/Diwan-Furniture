<div class="modal" id="EditSupplier{{ $Supplier->id }}">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('Suppliers.update', $Supplier->id) }}" method="post" autocomplete="off">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">تعديل بيانات مورد</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <h6>اسم المورد</h6>
                                <input type="text" name="name" value="{{ $Supplier->name }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <h6>البريد الألكتروني</h6>
                                <input type="text" name="email"  value="{{ $Supplier->email }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <h6>رقم الهاتف</h6>
                                <input type="text" name="phone"  value="{{ $Supplier->phone }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <h6>العنوان</h6>
                                <input type="text" name="address"  value="{{ $Supplier->address }}" class="form-control">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success rounded-50">تعديل</button>
                    <button type="button" class="btn btn-secondary rounded-50" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </form>
    </div>
</div>