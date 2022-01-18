@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Owl Carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <!---Internal  Multislider css-->
    <link href="{{ URL::asset('assets/plugins/multislider/multislider.css') }}" rel="stylesheet">
    <!--- Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection

@section('title')
    الوجبات
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الحاويات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    قائمة الوجبات</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if (session()->has('add'))
        <script>
            window.onload = function() {
                notif({
                    msg: " تم اضافة الوجبة بنجاح",
                    type: "success"
                });
            }
        </script>
    @endif
    @if (session()->has('add_expenses'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم اضافة مصاريف الوجبة بنجاح",
                    type: "success"
                });
            }
        </script>
    @endif

    @if (session()->has('update'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم تحديث بيانات الوجبة بنجاح",
                    type: "success"
                });
            }
        </script>
    @endif

    @if (session()->has('delete'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم حذف بيانات الوجبة بنجاح",
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
    <div class="row">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header mb-2 bg-primary text-white">
                    <div class="d-flex justify-content-between">
                        <div class="margin-tb">
                            <h4 class="content-title mb-0 my-auto">قائمة الوجبات</h4>
                        </div>
                        <div class="margin-tb">
                            @can('اضافة حاوية')
                                <a class="modal-effect btn btn-light rounded-50 btn-md" data-effect="effect-scale"
                                    data-toggle="modal" href="#AddContainer">
                                    إضافة وجبة
                                </a>
                                @include('containers.create')
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table {{-- id="example1" --}} class="table key-buttons text-md-nowrap" data-page-length='50'>
                            <thead>
                                <tr>
                                    <th class="font-small-3">#</th>
                                    <th class="font-small-3">رقم الوجبة</th>
                                    <th class="font-small-3">تاريخ الوجبة</th>
                                    <th class="font-small-3">المورد</th>
                                    <th class="font-small-3">سعر الوجبة</th>
                                    <th class="font-small-3">نوع التوريد</th>
                                    <th class="font-small-3">مصاريف خارجية</th>
                                    <th class="font-small-3">كمرك</th>
                                    <th class="font-small-3">مصاريف داخلية</th>
                                    <th class="font-small-3">الأجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Containers as $key => $Container)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $Container->cont_no }}</td>
                                        <td>{{ $Container->cont_date }}</td>
                                        <td>{{ $Container->cont_supplier }}</td>
                                        <td>{{ $Container->cont_amount }}</td>
                                        <td>{{ $Container->cont_type_supply }}</td>
                                        <td>{{ $Container->cont_out_expenses }}</td>
                                        <td>{{ $Container->cont_customs }}</td>
                                        <td>{{ $Container->cont_in_expenses }}</td>
                                        <td>
                                            <div class="d-flex my-xl-auto right-content">
                                            @can('اضافة مصاريف')
                                                <a class="modal-effect btn btn-primary btn-icon btn-sm rounded-circle" data-effect="effect-scale"
                                                    data-toggle="modal" href="#AddExpenses{{ $Container->id }}">
                                                    <i class="fas fa-dollar-sign"></i>
                                                </a>
                                            @endcan

                                            @can('تعديل حاوية')
                                                <a class="modal-effect btn btn-success btn-icon rounded-circle" data-effect="effect-scale"
                                                    data-toggle="modal" href="#EditContainer{{ $Container->id }}">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                            @endcan

                                            @can('حذف حاوية')
                                                <a class="modal-effect btn btn-danger btn-icon btn-sm rounded-circle" data-effect="effect-scale"
                                                    data-toggle="modal" href="#DeleteContainer{{ $Container->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            @endcan
                                            </div>
                                        </td>
                                    </tr>
                                    @include('containers.expenses')
                                    {{-- @include('containers.edit')
                                    @include('containers.delete') --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $Containers->links() }}
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
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();

    </script>
@endsection
