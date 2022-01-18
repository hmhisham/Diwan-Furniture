@extends('layouts.master')
@section('css')
    <!-- Internal Nice-select css  -->
    <link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
    @section('title')
        تعديل مستخدم
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل
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
                        <h4 class="content-title mb-0 my-auto">تعديل مستخدم</h4>
                    </div>
                    <div class="margin-tb">
                        @can('اضافة الدور')
                            <a class="btn btn-light btn-md rounded-50" href="{{ route('users.index') }}">رجوع</a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="card-body">

                {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                    <div class="">
                        <div class="row mg-b-20">
                            <div class="parsley-input col-md-6" id="fnWrapper">
                                <label>اسم المستخدم: <span class="tx-danger">*</span></label>
                                {!! Form::text('name', null, array('class' => 'form-control','required')) !!}
                            </div>

                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>البريد الالكتروني: <span class="tx-danger">*</span></label>
                                {!! Form::text('email', null, array('class' => 'form-control','required')) !!}
                            </div>
                        </div>
                    </div>

                <div class="row mg-b-20">
                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                        <label>كلمة المرور: </label>
                        {!! Form::password('password', array('class' => 'form-control')) !!}
                    </div>

                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                        <label> تاكيد كلمة المرور: </label>
                        {!! Form::password('confirm-password', array('class' => 'form-control')) !!}
                    </div>
                </div>

                @role('owner')
                    <div class="row mg-b-20">
                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label class="form-label">حالة المستخدم</label>
                            <select name="Status" id="select-beast" class="form-control  nice-select  custom-select">
                                <option {{ $user->Status == 'مفعل'?'selected':'' }} value="مفعل">مفعل</option>
                                <option {{ $user->Status == 'غير مفعل'?'selected':'' }} value="غير مفعل">غير مفعل</option>
                            </select>
                        </div>
                    
                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <div class="form-group">
                                <strong>دور / ادوار المستخدم</strong>
                                {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple'))
                                !!}
                            </div>
                        </div>
                    </div>
                @endrole

                <div class="mg-t-30 text-center">
                    <button class="btn btn-main-primary pd-x-20 rounded-50" type="submit">تحديث</button>
                </div>
                {!! Form::close() !!}
            </div>
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
@endsection