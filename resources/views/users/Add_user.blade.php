@extends('layouts.master')
@section('css')
    <!-- Internal Nice-select css  -->
    <link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css')}}" rel="stylesheet" />


    @section('title')
        اضافة مستخدم
    @stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ اضافة
                مستخدم</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>خطا</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-header mb-2 bg-primary text-white">
                <div class="d-flex justify-content-between">
                    <div class="margin-tb">
                        <h4 class="content-title mb-0 my-auto">اضافة مستخدم</h4>
                    </div>
                    <div class="margin-tb">
                        <a class="btn btn-light btn-md rounded-50" href="{{ route('users.index') }}">رجوع</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="parsley-style-1" id="selectForm2" autocomplete="off" name="selectForm2"
                    action="{{route('users.store','test')}}" method="post">
                    {{csrf_field()}}

                    <div class="">
                        <div class="row mg-b-20">
                            <div class="parsley-input col-md-6" id="fnWrapper">
                                <label>اسم المستخدم: <span class="tx-danger">*</span></label>
                                <input type="text"  name="name" class="form-control  mg-b-20" required=""
                                    data-parsley-class-handler="#lnWrapper">
                            </div>

                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>البريد الالكتروني: <span class="tx-danger">*</span></label>
                                <input type="email" name="email" class="form-control mg-b-20" required=""
                                    data-parsley-class-handler="#lnWrapper">
                            </div>
                        </div>
                    </div>

                    <div class="row mg-b-20">
                        <div class="parsley-input col-md-3 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>كلمة المرور: <span class="tx-danger">*</span></label>
                            <input type="password" name="password" class="form-control mg-b-20" required=""
                                data-parsley-class-handler="#lnWrapper">
                        </div>

                        <div class="parsley-input col-md-3 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label> تاكيد كلمة المرور: <span class="tx-danger">*</span></label>
                            <input type="password" name="confirm-password" class="form-control mg-b-20" required=""
                                data-parsley-class-handler="#lnWrapper">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">حالة المستخدم</label>
                            <select name="Status" id="select-beast" class="form-control  nice-select  custom-select">
                                <option value="مفعل">مفعل</option>
                                <option value="غير مفعل">غير مفعل</option>
                            </select>
                        </div>

                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label class="form-label"> دور / ادوار المستخدم</label>
                                <select name="roles_name" class="form-control" multiple>
                                    @foreach ($Roles as $Role)
                                        @if (Auth::User()->hasRole('owner') OR ($Role->name != 'owner'))
                                            <option value="{{ $Role->id }}">{{ $Role->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button class="btn btn-main-primary pd-x-20 rounded-50" type="submit">تاكيد</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')

    <!-- Internal Nice-select js-->
    <script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>

    <!--Internal  Parsley.min js -->
    <script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
    <!-- Internal Form-validation js -->
    <script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js')}}"></script>
    <script src="{{URL::asset('assets/js/select2.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>

@endsection
