@extends('layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
    @section('title')
        الصلاحيات المستخدمين
    @stop
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> /
                    صلاحيات المستخدمين</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')


@if (session()->has('add'))
    <div class="alert alert-success">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>تم بنجاح</strong>
        <h5>{{ session()->get('add') }}</h5>
    </div>
    <script>
        window.onload = function() {
            notif({
                msg: "تم إنشاء الصلاحية بنجاح",
                type: "success"
            });
        }
    </script>
@endif

@if (session()->has('update'))
    <div class="alert alert-success">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>تم بنجاح</strong>
        <h5>{{ session()->get('update') }}</h5>
    </div>
    <script>
        window.onload = function() {
            notif({
                msg: "تم تعديل الصلاحية بنجاح",
                type: "success"
            });
        }
    </script>
@endif

@if (session()->has('delete'))
    <div class="alert alert-success">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>تم بنجاح</strong>
        <h5>{{ session()->get('delete') }}</h5>
    </div>
    <script>
        window.onload = function() {
            notif({
                msg: "تم حذف الصلاحية بنجاح",
                type: "success"
            });
        }
    </script>
@endif

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

<!-- row -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header mb-2 bg-primary text-white">
                <div class="d-flex justify-content-between">
                    <div class="margin-tb">
                        <h4 class="content-title mb-0 my-auto">صلاحيات المستخدمين</h4>
                    </div>
                    <div class="margin-tb">
                        @can('اضافة صلاحية')
                            <a class="modal-effect btn btn-light rounded-50 btn-md" data-effect="effect-scale"
                                data-toggle="modal" href="#Add-Permission">
                                إنشاء صلاحية
                            </a>
                            @include('permissions.create')
                        @endcan
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mg-b-0 text-md-nowrap table-hover ">
                        <thead>
                            <tr>
                                <th class='font-small-4'>#</th>
                                <th class='font-small-4'>أسم الصلاحية</th>
                                <th class='font-small-4 text-center'>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Permissions as $key => $Permission)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $Permission->name }}</td>
                                    <td class='text-center'>
                                        {{-- @can('عرض صلاحية')
                                            <a class="btn btn-success btn-sm"
                                                href="{{ route('permission.show', $Permission->id) }}">عرض</a>
                                        @endcan --}}
                                        
                                        @can('تعديل صلاحية')
                                            <a class="modal-effect btn btn-success rounded-50 btn-sm" data-effect="effect-scale"
                                                data-toggle="modal" href="#Edit-Permission{{ $Permission->id }}">
                                                تعديل
                                            </a>
                                        @endcan

                                       @can('حذف صلاحية')
                                            <a class="modal-effect btn btn-danger rounded-50 btn-sm" data-effect="effect-scale"
                                                data-toggle="modal" href="#Delete-Permission{{ $Permission->id }}">
                                                حذف
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                                @include('permissions.edit')
                                @include('permissions.delete')
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <hr>
                {{ $Permissions->links() }}
            </div>
        </div>
    </div>
    <!--/div-->
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
