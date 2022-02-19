<div class="modal" id="EditCustomer{{ $Customer->id }}">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('Customers.update', $Customer->id) }}" method="post" autocomplete="off">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">تعديل بيانات الزبون</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <h6>اسم الزبون</h6>
                                <input type="text" name="name" value="{{ $Customer->name }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <h6>رقم الهاتف 1</h6>
                                <input type="text" name="phone_1"  value="{{ $Customer->phone_1 }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <h6>رقم الهاتف 2</h6>
                                <input type="text" name="phone_2"  value="{{ $Customer->phone_2 }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <h6>العنوان</h6>
                                <input type="text" name="address"  value="{{ $Customer->address }}" class="form-control">
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