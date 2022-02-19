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
    الزبائن
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الزبائن</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    قائمة الزبائن</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if (session()->has('AddCustomers'))
        <script>
            window.onload = function() {
                notif({
                    msg: " تم اضافة الزبون بنجاح",
                    type: "success"
                });
            }
        </script>
    @endif
    @if (session()->has('AddPayment'))
        <script>
            window.onload = function() {
                notif({
                    msg: " تم اضافة التسديد بنجاح",
                    type: "success"
                });
            }
        </script>
    @endif

    @if (session()->has('UpdateCustomers'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم تحديث بيانات الزبون بنجاح",
                    type: "success"
                });
            }
        </script>
    @endif
    @if (session()->has('UpdatePayment'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم تحديث تسديد الزبون بنجاح",
                    type: "success"
                });
            }
        </script>
    @endif

    @if (session()->has('DeleteCustomers'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم حذف بيانات الزبون بنجاح",
                    type: "success"
                });
            }
        </script>
    @endif
    @if (session()->has('DeletePayment'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم حذف تسديد الزبون بنجاح",
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
                            <h4 class="content-title mb-0 my-auto">قائمة الزبائن</h4>
                        </div>
                        <div class="margin-tb">
                            @can('اضافة زبون')
                                <a class="modal-effect btn btn-light rounded-50 btn-md" data-effect="effect-scale"
                                    data-toggle="modal" href="#AddSuppliers">
                                    إضافة زبون
                                </a>
                                @include('customers.create')
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table {{-- id="example" --}} class="table key-buttons text-md-nowrap" data-page-length='50'>
                            <thead>
                                <tr class="alert-primary">
                                    <th class="font-small-3 pt-2 pb-2">#</th>
                                    <th class="font-small-3">اسم الزبون</th>
                                    <th class="font-small-3">رقم الهاتف</th>
                                    <th class="font-small-3">رقم الهاتف</th>
                                    <th class="font-small-3">العنوان</th>
                                    <th class="font-small-3">اخر تسديد</th>
                                    <th class="font-small-3">المبلغ المطلوب</th>
                                    <th class="font-small-3">الأجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($Customers as $Customer)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $Customer->name }}</td>
                                        <td>{{ $Customer->phone_1 }}</td>
                                        <td>{{ $Customer->phone_2 }}</td>
                                        <td>{{ $Customer->address }}</td>
                                        <td>
                                            @php
                                                $lastPayment = App\CustomersPayments::where('customers_id', $Customer->id)->latest()->first();
                                            @endphp
                                            @if ($lastPayment)
                                                {{ $Customer->GetCustomerPayments->last()->amount }} <br>
                                                {{ $Customer->GetCustomerPayments->last()->date }}
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $invoice_remaining_amount = App\SaleInvoices::where('invoice_customer', $Customer->id)->get();
                                            @endphp
                                            {{ number_format($invoice_remaining_amount->sum('invoice_remaining_amount') - $Customer->GetCustomerPayments->sum('amount')) }}
                                        </td>
                                        <td>
                                            <div class="d-flex my-xl-auto right-content">
                                                @can('تسديد زبون')
                                                    <a class="modal-effect btn btn-primary btn-icon btn-sm rounded-circle" data-effect="effect-scale"
                                                        data-toggle="modal" href="#Payment{{ $Customer->id }}">
                                                        <i class="fas fa-dollar-sign"></i>
                                                    </a>
                                                @endcan

                                                @can('تعديل زبون')
                                                    <a class="modal-effect btn btn-success btn-icon btn-sm rounded-circle" data-effect="effect-scale"
                                                        data-toggle="modal" href="#EditCustomer{{ $Customer->id }}">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                @endcan
                                            <div>

                                            {{-- @can('حذف زبون')
                                                <a class="modal-effect btn btn-danger rounded-50 btn-sm" data-effect="effect-scale"
                                                    data-toggle="modal" href="#DeleteSupplier{{ $Customer->id }}">
                                                    حذف
                                                </a>
                                            @endcan --}}
                                        </td>
                                    </tr>
                                    @include('customers.payment')
                                    @include('customers.edit')
                                    {{-- @include('customers.delete') --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    {{ $Customers->links() }}
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
@endsection
