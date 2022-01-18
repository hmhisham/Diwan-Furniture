<div class="modal" id="AddExpenses{{ $Container->id }}">
    <div class="modal-dialog modal-md" role="document">
        <form action="{{ route('Expenses', $Container->id ) }}" method="post" autocomplete="off">
            {{ csrf_field() }}
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة مصاريف الوجبة</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <h4>ادخال مصاريف الوجبة : {{ $Container->cont_no }}</h4>
                    @if ($Container->cont_type_supply == 'داخلي')
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <h6>مصاريف داخلية</h6>
                                    <input type="text" name="cont_in_expenses" class="form-control">
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <h6>مصاريف خارجية</h6>
                                    <input type="text" name="cont_out_expenses" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <h6>كمرك</h6>
                                    <input type="text" name="cont_customs" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <h6>مصاريف داخلية</h6>
                                    <input type="text" name="cont_in_expenses" class="form-control">
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success rounded-50">إضافة</button>
                    <button type="button" class="btn btn-secondary rounded-50" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </form>
    </div>
</div>