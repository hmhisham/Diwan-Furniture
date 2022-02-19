<div class="modal" id="AddContainer">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('Containers.store') }}" method="post" autocomplete="off">
            {{ csrf_field() }}
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة وجبة</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <h6>رقم الوجبة</h6>
                                <input type="text" name="cont_no" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <h6>تاريخ الوجبة</h6>
                                <input class="form-control fc-datepicker" name="cont_date" placeholder="YYYY-MM-DD"
                                    type="date" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <h6>سعر الوجبة</h6>
                                <input type="text" name="cont_amount" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <h6>أسم المورد</h6>
                                <select name="cont_supplier" class="form-control">
                                    @foreach ($Suppliers as $Supplier)
                                        <option value="{{ $Supplier->id }}">{{ $Supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <h6>نوع التوريد</h6>
                                <select name="cont_type_supply" class="form-control">
                                    <option value="داخلي">داخلي</option>
                                    <option value="خارجي">خارجي</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success rounded-50">إضافة</button>
                    <button type="button" class="btn btn-secondary rounded-50" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </form>
    </div>
</div>
