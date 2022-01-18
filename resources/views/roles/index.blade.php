@extends('layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
    @section('title')
        أدوار المستخدمين
    @stop
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> /
                    أدوار المستخدمين</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

@if (session()->has('Add'))
    <script>
        window.onload = function() {
            notif({
                msg: " تم اضافة الدور بنجاح",
                type: "success"
            });
        }
    </script>
@endif

@if (session()->has('update'))
    <script>
        window.onload = function() {
            notif({
                msg: " تم تحديث بيانات الدور بنجاح",
                type: "success"
            });
        }
    </script>
@endif

@if (session()->has('delete'))
    <script>
        window.onload = function() {
            notif({
                msg: " تم حذف الدور بنجاح",
                type: "error"
            });
        }
    </script>
@endif

<!-- row -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header mb-2 bg-primary text-white">
                <div class="d-flex justify-content-between">
                    <div class="margin-tb">
                        <h4 class="content-title mb-0 my-auto">أدوار المستخدمين</h4>
                    </div>
                    <div class="margin-tb">
                        @can('اضافة الدور')
                            <a class="btn btn-light btn-md rounded-50" href="{{ route('roles.create') }}">اضافة دور</a>
                        @endcan
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mg-b-0 text-md-nowrap table-hover ">
                        <thead>
                            <tr>
                                <th class="font-small-3">#</th>
                                <th class="font-small-3">أسم الدور</th>
                                <th class="font-small-3">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $key => $role)
                                @if (Auth::User()->hasRole('owner') OR  $role->name != 'owner')
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @can('عرض الدور')
                                                <a class="btn btn-primary btn-sm rounded-50"
                                                    href="{{ route('roles.show', $role->id) }}">عرض</a>
                                            @endcan
                                            
                                            @can('تعديل الدور')
                                                @if (Auth::User()->hasRole('owner|مدير') )
                                                    <a class="btn btn-success btn-sm rounded-50"
                                                        href="{{ route('roles.edit', $role->id) }}">تعديل</a>
                                                @endif
                                            @endcan

                                            @if ( $role->name != 'owner' And !in_array($role->name, Auth::User()->getRoleNames()->toArray()) )
                                                @can('حذف الدور')
                                                    <a class="modal-effect btn btn-danger rounded-50 btn-sm" data-effect="effect-scale"
                                                        data-toggle="modal" href="#Delete-Role{{ $role->id }}">
                                                        حذف
                                                    </a>
                                                @endcan
                                            @endif
                                        </td>
                                    </tr>
                                    @include('roles.delete')
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
