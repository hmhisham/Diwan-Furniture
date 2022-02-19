<div class="modal" id="Payment{{ $Customer->id }}">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('Customers.store') }}" method="post" autocomplete="off">
            {{ csrf_field() }}

            <input type="hidden" name="customers_id" value="{{ $Customer->id }}" class="form-control">

            <div class="modal-content modal-content-demo">
                <div class="modal-header bg-primary text-white">
                    <h6 class="modal-title text-white">اضافة تسديد زبون</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <h5>اسم الزبون : {{ $Customer->name }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <h6>مبلغ التسديد</h6>
                                <input type="text" name="amount" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <h6>تاريخ التسديد</h6>
                                <input type="date" name="date" class="form-control">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="create_by" value="{{ Auth::user()->id }}" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success rounded-50">إضافة</button>
                    <button type="button" class="btn btn-secondary rounded-50" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </form>
    </div>
</div>