<div>
    <div class="card-header mb-2 bg-primary text-white">
        <div class="d-flex justify-content-between">
            <div class="margin-tb">
                <h4 class="content-title mb-0 my-auto"> كشف مواد المخزن</h4>
            </div>
            {{-- -------------------- --}}
            @section('page-header')
				<!-- breadcrumb -->
				{{-- <div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Tables</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Data Tables</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
						</div>
						<div class="mb-3 mb-xl-0">
							<div class="btn-group dropdown">
								<button type="button" class="btn btn-primary">14 Aug 2019</button>
								<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
									<a class="dropdown-item" href="#">2015</a>
									<a class="dropdown-item" href="#">2016</a>
									<a class="dropdown-item" href="#">2017</a>
									<a class="dropdown-item" href="#">2018</a>
								</div>
							</div>
						</div>
					</div>
				</div> --}}
				<!-- breadcrumb -->
            @endsection
            @section('content')
				<!-- row opened -->
				<div class="row row-sm">
					<!--div-->
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table key-buttons text-md-nowrap" data-page-length='50'>
                                        <thead>
                                            <tr class="alert-primary">
                                                <th class="font-small-3 pt-2 pb-2">#</th>
                                                <th class="font-small-3">اسم المادة</th>
                                                <th class="font-small-3">الشركة</th>
                                                <th class="font-small-3">الفئة</th>
                                                <th class="font-small-3">الموديل</th>
                                                <th class="font-small-3">الكود</th>
                                                <th class="font-small-3">اللون</th>
                                                <th class="font-small-3">الكمية المتوفرة</th>
                                                <th class="font-small-3">العدد الحرج </th>
                                            {{--  <th class="font-small-3">  معروض </th>
                                            --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @if ($store_info!='' )
                                                @foreach ($store_info as $key => $StoreInfo)
                                                    <tr>
                                                        <td class="">{{ ++$key }}</td>
                                                        <td class="">{{ $StoreInfo->GetItemsDit->item_name }}</td>
                                                        <td class="">{{ $StoreInfo->GetItemsDit->item_company }}</td>
                                                        <td class="">{{ $StoreInfo->GetItemsDit->item_category }}</td>
                                                        <td class="">{{ $StoreInfo->GetItemsDit->item_model }}</td>
                                                        <td class="">{{ $StoreInfo->GetItemsDit->item_code }}</td>
                                                        <td class="">{{ $StoreInfo->GetItemsDit->item_color }}</td>
                                                        @php
                                                            $rem = App\Store::where ('items_id',$StoreInfo->items_id)->sum('item_remaining');
                                                        @endphp
                                                        <td class="{{ $rem <= $StoreInfo->GetItemsDit->less_qty ? 'bg-danger text-white' : '' }}">{{ $rem }}</td>
                                                        <td class="">{{ $StoreInfo->GetItemsDit->less_qty }}</td> 
                                                  </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="10" class="font-small-3 text-center"> لا يوجد مواد في المخزن</td>
                                                </tr>
                                            @endif
                                        </tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--/div-->
                </div>
            @endsection
        </div>
    </div>
</div>
    


