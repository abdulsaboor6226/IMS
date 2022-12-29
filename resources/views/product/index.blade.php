@extends('layouts.master')
@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-end mb-2 mr-3">
                    <a type="button" class="btn btn-primary btn-icon-text mr-3" href="{{ route('product.create') }}"><i class="ti-plus btn-icon-prepend"></i>Add Product</a>
                    <a type="button" class="btn btn-primary btn-icon-text mr-3" href="{{ route('brand.create') }}"><i class="ti-plus btn-icon-prepend"></i>Add Brand</a>
                    <a type="button" class="btn btn-primary btn-icon-text" href="{{ route('user.create') }}"><i class="ti-plus btn-icon-prepend"></i>Add Vendor</a>
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
                            <a data-toggle="collapse" href="#product" class="text-primary" aria-expanded="false" aria-controls="filter">
                                <i class="fas fa-filter"></i>
                            </a>
                        </span>
                        </div>
                    </div>
                    <form action="{{ route('product.index') }}" method="GET">
                        <div class="collapse {{ request()->all() ? 'show' : ' ' }}" id="product">
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="date" class="form-control mb-2 mr-sm-2" name="stock_date"
                                           value="{{ request()->input('stock_date') }}" id="Name">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control mb-2 mr-sm-2" name="name"
                                           value="{{ request()->input('name') }}" id="name" placeholder="Product Name">
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control mb-2 mr-sm-2" required name="product_type_id_fk">
                                        <option readonly="">Select Product Type Option</option>
                                        @foreach($productTypes as $key =>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control mb-2 mr-sm-2" required name="brand_type_id_fk">
                                        <option readonly="">Select Brand Option</option>
                                        @foreach($brands as $key =>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control mb-2 mr-sm-2" required name="vendor_type_id_fk">
                                        <option readonly="">Select Vendor Option</option>
                                        @foreach($vendors as $key =>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-2">
                                <button class="badge badge-outline-primary mr-2" type="submit"><i
                                        class="icon-search"></i></button>
                                <a class="badge badge-outline-primary" href="{{ route('product.index') }}"><i
                                        class="mdi mdi-flask-empty-outline"></i></a>
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
                            <h4 class="card-title">Product</h4>
                            <p class="card-description">
                            </p>
                        </div>
                        <div class="">
                            <p class="text-right"> Total Record {{ $totalProducts }}</p>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Stock Enter Date</th>
                                    <th>Product Name</th>
                                    <th>Product Type</th>
                                    <th>Brand</th>
                                    <th>Vendor</th>
                                    <th>Unit Price</th>
                                    <th>Quantity</th>
                                    <th>Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $key => $product)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$product->stock_date}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->productType->name}}</td>
                                        <td>{{$product->brand->name}}</td>
                                        <td>{{$product->vendor->name}}</td>
                                        <td>{{$product->unit_price}}</td>
                                        <td>{{$product->unit_quantity}}</td>
{{--                                        <td><label class="badge badge-{{$product->status->meta['color']}}">{{$product->status->value}}</label></td>--}}
                                        <td>{{$product->created_at->diffForHumans()}}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="text-primary fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" style="">
                                                    @can('user.edit')
                                                        <a class="dropdown-item" href="{{ route('product.edit', $product->id) }}"><i
                                                                class="far fa-edit m-2"> Edit</i>
                                                        </a>
                                                    @endcan
                                                    {{-- <a class="dropdown-item" href="{{ route('user.show', $user->id) }}">
                                                        <i class="fa fa-eye m-2" aria-hidden="true"> Show</i>
                                                    </a> --}}
                                                    @can('user.delete')
                                                        <a class="dropdown-item" onclick='swal({
                                                                title: "Are you sure?",
                                                                text: "Your will not be able to recover this imaginary file!",
                                                                type: "warning",
                                                                showCancelButton: true,
                                                                confirmButtonClass: "btn-danger",
                                                                confirmButtonText: "Yes, delete it!",
                                                                closeOnConfirm: false
                                                                },
                                                                function(){
                                                                document.getElementById("delete-job-{{ $product->id }}").submit();
                                                                swal("Deleted!", "Your imaginary file has been deleted.", "success");
                                                                });' onclick="event.preventDefault();">
                                                            <i class="fas fa-trash-alt m-2"> Delete</i>
                                                        </a>
                                                    @endcan
                                                </div>
                                                <form id="delete-job-{{ $product->id }}"
                                                      action="{{ route('product.destroy', $product->id) }}" method="POST"
                                                      style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$products->links()}}
                </div>
            </div>
        </div>
@endsection
