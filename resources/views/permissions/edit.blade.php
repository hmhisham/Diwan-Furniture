<div class="modal fade effect-scale" id="Edit-Permission{{ $Permission->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تعديل الصلاحية</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('permission.update', $Permission->id) }}" id="formValidate" method="POST" autocomplete="off">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mg-b-20">
                            <div class="card-body">
                                <div class="main-content-label mg-b-5">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <p>اسم الصلاحية :</p>
                                            <input type="text" name="name" value="{{ $Permission->name }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                        <button type="submit" class="btn btn-main-primary rounded-50">تعديل</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>