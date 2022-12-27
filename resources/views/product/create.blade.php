@extends('layouts.master')
@section('content')
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Product Create</h4>
                    <form class="form-sample" action="{{route('product.store')}}" method="POST">
                        @csrf
                        <p class="card-description">
                            Personal info
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="stock_date" value="{{old('stock_date')}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Product Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" value="{{old('name')}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Product Type</label>
                                    <div class="col-sm-9">
                                        <select class="js-example-basic-single w-100" required name="product_type_id_fk">
                                            <option readonly="">Select Option</option>
                                            @foreach($productTypes as $key =>$value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Brand Name</label>
                                    <div class="col-sm-9">
                                        <select class="js-example-basic-single w-100" required name="brand_id_fk">
                                            <option readonly="">Select Option</option>
                                            @foreach($brands as $key =>$value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Vendor Name</label>
                                    <div class="col-sm-9">
                                        <select class="js-example-basic-single w-100" required name="vendor_id_fk">
                                            <option readonly="">Select Option</option>
                                            @foreach($vendors as $value)
                                                <option value="{{$value->id}}">{{$value->name}} - {{$value->phone}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Unit Price</label>
                                    <div class="col-sm-9">
                                        <input type="number" min="0.00" step="0.01" name="unit_price" value="{{old('unit_price')}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Unit Quantity</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="unit_quantity" value="{{old('unit_quantity')}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="{{route('product.index')}}" class="btn btn-light">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

@endsection
