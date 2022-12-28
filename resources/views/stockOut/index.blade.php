@extends('layouts.master')
@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-end mb-2 mr-3">
                    <a type="button" class="btn btn-primary btn-icon-text mr-3" href="{{ route('stock-out.create') }}"><i class="ti-plus btn-icon-prepend"></i>Add Stock Out</a>
                </div>
            </div>
        </div>
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Filters</h4>
                    <form class="form-inline filter-form" action="{{route('stock-out.index')}}" method="GET">
                        <label class="sr-only" for="inlineFormInputName2">Name</label>
                        <input type="text" class="form-control mb-2 mr-sm-2" name="name" value="{{request()->input('name')}}" id="inlineFormInputName2" placeholder="Name">
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
