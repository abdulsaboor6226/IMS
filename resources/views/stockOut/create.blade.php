@extends('layouts.master')
@section('content')
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Stock Out Create</h4>
                    <form class="form-sample" action="{{route('stock-out.store')}}" method="POST">
                        @csrf
                        <p class="card-description">
                            Personal info
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Diary No</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="diary_no" value="{{old('diary_no')}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="date" value="{{old('date')}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Branch</label>
                                    <div class="col-sm-9">
                                        <select class="js-example-basic-single w-100" required name="branch_id_fk">
                                            <option readonly="">Select Option</option>
                                            @foreach($branches as $key =>$value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Applicant Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="applicant_name" value="{{old('date')}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Forwarded By</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="forwarded_by" value="{{old('date')}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Received By</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="received_by" value="{{old('date')}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Received Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="received_date" value="{{old('date')}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Approved By</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="approved_by" value="{{old('date')}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Approved Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="approved_date" value="{{old('date')}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Product</label>
                                    <div class="col-sm-9">
                                        <select class="js-example-basic-single w-100" required name="product_id_fk">
                                            <option readonly="">Select Option</option>
                                            @foreach($products as $key =>$value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Brand</label>
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
                                    <label class="col-sm-3 col-form-label">Stock In Quantity</label>
                                    <div class="col-sm-9">
                                        <input type="number"  value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Stock Out Quantity</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="stock_out_qty" value="{{old('unit_quantity')}}" class="form-control">
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
