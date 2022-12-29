@extends('layouts.master')
@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-end mb-2 mr-3">
                    <a type="button" class="btn btn-primary btn-icon-text mr-3" href="{{ route('stock-out.create') }}"><i class="ti-plus btn-icon-prepend"></i>Add Stock Out</a>
                </div>
            </div>
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h4 class="card-title">Filters</h4>
                        </div>
                        <div class="">
                        <span class="badge">
                            <a data-toggle="collapse" href="#stockOut" class="text-primary" aria-expanded="false" aria-controls="filter">
                                <i class="fas fa-filter"></i>
                            </a>
                        </span>
                        </div>
                    </div>
                    <form action="{{ route('stock-out.index') }}" method="GET">
                        <div class="collapse {{ request()->all() ? 'show' : ' ' }}" id="stockOut">
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="number" class="form-control mb-2 mr-sm-2" name="diary_no"
                                           value="{{ request()->input('diary_no') }}" id="diary_no" placeholder="Diary No">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" class="form-control mb-2 mr-sm-2" name="date"
                                           value="{{ request()->input('date') }}" id="Date" placeholder="Date">
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control mr-sm-2 js-example-basic-single" name="branch_id_fk">
                                        <option value=""> Select Branch Option &nbsp &nbsp</option>
                                        @foreach($branches as $key =>$value)
                                            <option {{ request()->input('branch_id_fk') == $key ? 'Selected' : '' }} value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control mb-2 mr-sm-2" name="applicant_name"
                                           value="{{ request()->input('applicant_name') }}" id="applicant_name" placeholder="Applicant Name">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control mb-2 mr-sm-2" name="forwarded_by"
                                           value="{{ request()->input('forwarded_by') }}" id="forwarded_by" placeholder="Forwarded By">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control mb-2 mr-sm-2" name="received_by"
                                           value="{{ request()->input('received_by') }}" id="received_by" placeholder="Received By">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" class="form-control mb-2 mr-sm-2" name="received_date"
                                           value="{{ request()->input('received_date') }}" id="received_date" placeholder="Received Date">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control mb-2 mr-sm-2" name="approved_by"
                                           value="{{ request()->input('approved_by') }}" id="approved_by" placeholder="Approved By">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" class="form-control mb-2 mr-sm-2" name="approved_date"
                                           value="{{ request()->input('approved_date') }}" id="approved_date" placeholder="Approved Date">
                                </div>
                                <input type="hidden" id="export" value="" name="stockOutFilterApply">
                                <div class="col-md-3">
                                    <select class="form-control mr-sm-2 js-example-basic-single" name="product_id_fk">
                                        <option value=""> Select Product Type &nbsp &nbsp &nbsp</option>
                                        @foreach($productTypes as $key =>$value)
                                            <option {{ request()->input('product_id_fk') == $key ? 'Selected' : '' }} value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control mr-sm-2 js-example-basic-single" name="brand_id_fk">
                                        <option value=""> Select Brand Option &nbsp &nbsp &nbsp </option>
                                        @foreach($brands as $key =>$value)
                                            <option {{ request()->input('brand_id_fk') == $key ? 'Selected' : '' }} value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-2">
                                <button class="btn btn-primary mr-2" type="submit"><i class="icon-search"></i>Search</button>
                                <a class="btn btn-primary mr-2" href="{{ route('stock-out.index') }}"><i class="mdi mdi-flask-empty-outline"></i>Reset</a>
                                <button class="btn btn-primary mr-2" onClick="exportStock()" type="submit"><i class="mdi mdi-file-excel"></i> Export Stock Out</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h4 class="card-title">Stock Out</h4>
                            <p class="card-description">
                            </p>
                        </div>
                        <div class="">
                            <p class="text-right"> Total Record {{ $totalStockOuts }}</p>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Diary No</th>
                                    <th>Date</th>
                                    <th>Branch</th>
                                    <th>Applicant Name</th>
                                    <th>Forwarded By</th>
                                    <th>Received By</th>
                                    <th>Received Date</th>
                                    <th>Approved By</th>
                                    <th>Approved Date</th>
                                    <th>Product</th>
                                    <th>Brand</th>
                                    <th>Stock Out Qty</th>
                                    <th>Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stockOuts as $key => $stockOut)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$stockOut->diary_no}}</td>
                                        <td>{{$stockOut->date}}</td>
                                        <td>{{$stockOut->branch->name}}</td>
                                        <td>{{$stockOut->applicant_name}}</td>
                                        <td>{{$stockOut->forwarded_by}}</td>
                                        <td>{{$stockOut->received_by}}</td>
                                        <td>{{$stockOut->received_date}}</td>
                                        <td>{{$stockOut->approved_by}}</td>
                                        <td>{{$stockOut->approved_date}}</td>
                                        <td>{{$stockOut->product->name}}</td>
                                        <td>{{$stockOut->brand->name}}</td>
                                        <td>{{$stockOut->stock_out_qty}}</td>
{{--                                        <td><label class="badge badge-{{$stockOut->status->meta['color']}}">{{$stockOut->status->value}}</label></td>--}}
                                        <td>{{$stockOut->created_at->diffForHumans()}}</td>
{{--                                        <td class="text-right">--}}
{{--                                            <div class="dropdown">--}}
{{--                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"--}}
{{--                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                                    <i class="text-primary fas fa-ellipsis-v"></i>--}}
{{--                                                </a>--}}
{{--                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" style="">--}}
{{--                                                    @can('user.edit')--}}
{{--                                                        <a class="dropdown-item" href="{{ route('stock-out.edit', $stockOut->id) }}"><i--}}
{{--                                                                class="far fa-edit m-2"> Edit</i>--}}
{{--                                                        </a>--}}
{{--                                                    @endcan--}}
{{--                                                    --}}{{-- <a class="dropdown-item" href="{{ route('user.show', $user->id) }}">--}}
{{--                                                        <i class="fa fa-eye m-2" aria-hidden="true"> Show</i>--}}
{{--                                                    </a> --}}
{{--                                                    @can('user.delete')--}}
{{--                                                        <a class="dropdown-item" onclick='swal({--}}
{{--                                                                title: "Are you sure?",--}}
{{--                                                                text: "Your will not be able to recover this imaginary file!",--}}
{{--                                                                type: "warning",--}}
{{--                                                                showCancelButton: true,--}}
{{--                                                                confirmButtonClass: "btn-danger",--}}
{{--                                                                confirmButtonText: "Yes, delete it!",--}}
{{--                                                                closeOnConfirm: false--}}
{{--                                                                },--}}
{{--                                                                function(){--}}
{{--                                                                document.getElementById("delete-job-{{ $stockOut->id }}").submit();--}}
{{--                                                                swal("Deleted!", "Your imaginary file has been deleted.", "success");--}}
{{--                                                                });' onclick="event.preventDefault();">--}}
{{--                                                            <i class="fas fa-trash-alt m-2"> Delete</i>--}}
{{--                                                        </a>--}}
{{--                                                    @endcan--}}
{{--                                                </div>--}}
{{--                                                <form id="delete-job-{{ $stockOut->id }}"--}}
{{--                                                      action="{{ route('product.destroy', $stockOut->id) }}" method="POST"--}}
{{--                                                      style="display: none;">--}}
{{--                                                    @method('DELETE')--}}
{{--                                                    @csrf--}}
{{--                                                </form>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$stockOuts->links()}}
                </div>
            </div>
        </div>
@endsection
