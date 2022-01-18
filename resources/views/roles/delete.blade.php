<div class="modal fade effect-scale" id="Delete-Role{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف الدور</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('roles.destroy', $role->id) }}" id="formValidate" method="POST" autocomplete="off">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mg-b-20">
                            <div class="card-body">
                                <div class="main-content-label mg-b-5">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <p>اسم الدور : <span class="text-danger">{{ $role->name }}</span></p>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                        <button type="submit" class="btn btn-main-primary rounded-50">حذف</button>
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