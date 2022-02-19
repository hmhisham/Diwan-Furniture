@extends('layouts.master')
@section('css')
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }
    </style>
@endsection
@section('title')
    معاينه طباعة الفاتورة
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    معاينة طباعة الفاتورة</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <img src="{{ URL::asset('assets/img/logo/logo_ar.jpeg') }}" class="logo-1" alt="logo" width="60%">
                            </div>
                            <div class="col text-center">
                                <h3>مجموعة شركات ديوان</h3>
                                <h5>للأثاث التركي والامريكي</h5>
                            </div>
                            <div class="col text-left">
                                <img src="{{ URL::asset('assets/img/logo/logo_en.jpeg') }}" class="logo-1" alt="logo" width="60%">
                            </div>
                        </div>
                        <div class="mg-t-20 d-flex justify-content-between">
                            <div class="">
                                <label class="tx-gray-600">السيد :</label>
                                <div class="billed-to">
                                    <h6>{{ $SaleInvoice->GetCustomer->name }}</h6>
                                    <p>
                                        {{ $SaleInvoice->GetCustomer->address }}<br>
                                        {{ $SaleInvoice->GetCustomer->phone_1 }}<br>
                                        {{ $SaleInvoice->GetCustomer->phone_2 }}
                                    </p>
                                </div>
                            </div>
                            <div class="">
                                <label class="tx-gray-600">معلومات الفاتورة</label>
                                <p class="">
                                    <span>رقم الفاتورة : </span>
                                    <span>{{ $SaleInvoice->invoice_no }}</span>
                                </p>
                                <p {{-- class="invoice-info-row" --}}>
                                    <span>تاريخ الفاتورة : </span>
                                    <span>{{ $SaleInvoice->invoice_date }}</span>
                                </p>
                            </div>
                        </div>

                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr class="bg-primary">
                                        <th class="text-white font-medium-1">#</th>
                                        <th class="text-white font-medium-1">الشركة</th>
                                        <th class="text-white font-medium-1">النوع</th>
                                        <th class="text-white font-medium-1">الموديل</th>
                                        <th class="text-white font-medium-1">المادة</th>
                                        <th class="text-white font-medium-1">السعر</th>
                                        <th class="text-white font-medium-1">العدد</th>
                                        <th class="text-white font-medium-1">المبلغ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($SaleInvoicesDetails as $key => $SaleInvoicesDetail)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td class="tx-12">{{ $SaleInvoicesDetail->GetItemsInfo->item_company }}</td>
                                            <td class="tx-12">{{ $SaleInvoicesDetail->GetItemsInfo->item_category }}</td>
                                            <td class="tx-12">{{ $SaleInvoicesDetail->GetItemsInfo->item_model }}</td>
                                            <td class="tx-12">{{ $SaleInvoicesDetail->GetItemsInfo->item_name }}, الرمز:{{ $SaleInvoicesDetail->GetItemsInfo->item_code }}, اللون:{{ $SaleInvoicesDetail->GetItemsInfo->item_color }}</td>
                                            <td class="tx-right">{{ number_format($SaleInvoicesDetail->sale_price, 2) }}</td>
                                            <td class="tx-right">{{ $SaleInvoicesDetail->sale_quantity }}</td>
                                            <td class="tx-right">{{ number_format($SaleInvoicesDetail->sale_price * $SaleInvoicesDetail->sale_quantity, 2) }}</td>
                                        </tr>
                                    @endforeach

                                    <tr class="">
                                        <td class="valign-middle" colspan="6" rowspan="6"></td>
                                        <td class="tx-right"></td>
                                        <td class="tx-right" colspan="2"></td>
                                    </tr>

                                    <tr class="bg-primary">
                                        <td class="text-white tx-right">الاجمالي</td>
                                        <td class="text-white tx-right" colspan="2"> {{ number_format($SaleInvoice->invoice_amount, 2) }}</td>
                                    </tr>
                                    <tr class="bg-primary">
                                        <td class="tx-right text-white">الخصم</td>
                                        <td class="tx-right text-white" colspan="2">{{ number_format($SaleInvoice->invoice_discount, 2) }}</td>
                                    </tr>
                                    <tr class="bg-primary">
                                        <td class="tx-right text-white">صافي المبلغ</td>
                                        <td class="tx-right text-white" colspan="2">{{ number_format($SaleInvoice->invoice_amount - $SaleInvoice->invoice_discount, 2) }}</td>
                                    </tr>
                                    <tr class="bg-primary">
                                        <td class="tx-right text-white">المبلغ المدفوع</td>
                                        <td class="tx-right text-white" colspan="2">{{ number_format($SaleInvoice->invoice_amount_paid, 2) }}</td>
                                    </tr>
                                    <tr class="bg-primary">
                                        <td class="tx-right bg-danger text-white">المبلغ المتبقي</td>
                                        <td class="tx-right bg-danger text-white" colspan="2">{{ number_format($SaleInvoice->invoice_remaining_amount, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr class="mg-b-40">
                        <div class="d-flex justify-content-around">
                            <div>
                                <h6>مصدر الفاتورة</h6>
                                <h6>{{ Auth::user()->name }}</h6>
                            </div>

                            <div>
                                <h6>توقيع المحاسب</h6>
                            </div>
                        </div>

                        <hr class="mg-b-40">
                        <div class="row">
                            <div class="col">
                                <h5>شكراً لثقتكم بنا</h5>
                                <hr class="mg-b-40">
                                <h6>زبائننا الكرام</h6>
                                <h6>1. خدمة النقل والشد مجاناً داخل المدينة</h6>
                                <h6>2. المباع لايرجع ولا يستبدل</h6>
                                <h6>3. يحق للزبون تبديل أو إلغاء عقد الشراء خلال خمسة ايام من تاريخ الشراء في حالة ان الاثاث لم يجهز للزبون</h6>
                                <h6>4. في حالة التجهيز لبيت الزبون لا يحق للزبون إلغاء أو ارجاع الاثاث</h6>
                                <h6>5. الشركة غير مسؤولة عن خزن الاثاث المباع في حالة طلب الزبون خزنه لدينا في حال توفر مكان للخزن</h6>
                                <h6>رقم الهاتف: 07702250249 - 078022265898 - موقع الشراء شارع الوفود - مقابل متنزه الخورة</h6>
                            </div>
                        </div>

                        <button class="btn btn-danger float-left mt-3 mr-2" id="print_Button" onclick="printDiv()">
                            <i class="mdi mdi-printer ml-1"></i>طباعة
                        </button>
                        <a href="{{ Route('SaleInvoices.index') }}" id="print_Button" class="btn btn-primary float-left mt-3 mr-2">
                            قائمة الفواتير
                        </a>
                        <a href="{{ Route('SaleInvoices.create') }}" id="print_Button" class="btn btn-success float-left mt-3 mr-2">
                            اصدار فاتورة بيع
                        </a>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>

    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
@endsection
