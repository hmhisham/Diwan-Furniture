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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    
@endsection

@section('title')
    كشف المخزن
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">كشف</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    مواد المخزن</span>
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
                    msg: " تم اضافة المصارف بنجاح",
                    type: "success"
                });
            }
        </script>
    @endif

    {{-- @if (session()->has('update'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم تحديث بيانات المادة بنجاح",
                    type: "success"
                });
            }
        </script>
    @endif --}}

    @if (session()->has('delete'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم حذف بيانات المصارف بنجاح",
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
                
                @livewire('store-report')
                
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
            dateFormat: 'yyyy-mm-dd'
        }).val();
    </script>

    <script>
        $(document).ready(function() {
            $('.Container').on('click', function() {
                $("#dropdownMenuContainer").val($(this).html())
            });

            $('#dropdownMenuContainer').keyup(function() {
                $("#MenuContainer .Container:contains('" + $(this).val() + "')").show();
                $("#MenuContainer .Container:not(:contains('" + $(this).val() + "'))").hide();
            });
        });
    </script>

<script>
    window.addEventListener('alert', 
        event => {
            notif({
                title: event.detail.title,
                msg: event.detail.message,
                type: event.detail.type
            });
        });
</script>

{{-- <script>
    $(document).ready(function() {
        $('input[name="cont_no"]').on('keyup', function() {
            $('#cont_date').val('')
            $('#cont_amount').val('')
            $('#cont_supplier').val('')

            var x = ''
            var cont_no = $(this).val();
            if (cont_no) {
                $.ajax({
                    url: "{{ URL::to('GetStoreItem') }}/" + cont_no,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#cont_date').val(data[0]['cont_date'])
                        $('#cont_amount').val(data[0]['cont_amount'])
                        $('#cont_supplier').val(data[0]['cont_supplier'])

                        for(var i = 0; i < data[1].length; i++){
                            var items_id = data[1][i]['items_id']
                            var j = 0
                            $.ajax({
                                url: "{{ URL::to('GetItems') }}/" + items_id,
                                type: "GET",
                                dataType: "json",
                                success: function(items) {
                                    x = x + '<tr>'
                                    x = x + '<td class="font-small-3"></td>'
                                    x = x + '<td class="font-small-3">'+items['item_code']+'</td>'
                                    x = x + '<td class="font-small-3">'+items['item_name']+'</td>'
                                    x = x + '<td class="font-small-3">'+items['item_type']+'</td>'
                                    x = x + '<td class="font-small-3">'+items['item_color']+'</td>'
                                    x = x + '<td class="font-small-3">'+ data[1][j]['item_qty'] +'</td>'
                                    x = x + '<td class="font-small-3">'+ data[1][j]['item_price'] +'</td>'
                                    x = x + '<td class="font-small-3">'+ data[1][j]['item_cost'] +'</td>'
                                    x = x + '<td class="font-small-3">'+items['item_sale_price']+'</td>'
                                    x = x + '<td class="font-small-3"></td>'
                                    x = x + '</tr>'
                                    $('#body').html(x)
                                    j++
                                },
                            });
                        }
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script> --}}
@endsection
