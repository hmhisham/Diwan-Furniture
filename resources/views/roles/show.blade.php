@extends('layouts.master')
@section('css')
    <!--Internal  Font Awesome -->
    <link href="{{URL::asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <!--Internal  treeview -->
    <link href="{{URL::asset('assets/plugins/treeview/treeview-rtl.css')}}" rel="stylesheet" type="text/css" />

    @section('title')
        عرض الدور
    @stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الادوار</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عرض
                الدور</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12">
        <div class="card mg-b-20">
            <div class="card-header mb-2 bg-primary text-white">
                <div class="d-flex justify-content-between">
                    <div class="margin-tb">
                        <h4 class="content-title mb-0 my-auto">عرض صلاحيات {{ $role->name }}</h4>
                    </div>
                    <div class="margin-tb">
                        <a class="btn btn-light btn-md rounded-50" href="{{ route('roles.index') }}">رجوع</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- col -->
                    <div class="col-lg-4">
                        <ul id="treeview1" class="tree">
                            <li>
                                <a href="#">{{ $role->name }}</a>
                                <ul>
                                    @if(!empty($rolePermissions))
                                        @foreach($rolePermissions as $v)
                                            <li>{{ $v->name }}</li>
                                        @endforeach
                                    @endif
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /col -->
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
<script src="{{URL::asset('assets/plugins/treeview/treeview.js')}}"></script>

@endsection