@extends('layouts.master')
@section('content')
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">StockOut Edit</h4>
                    <form class="form-sample" action="{{route('stock-out.update',$stockOut->id)}}" method="POST">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Diary No</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="diary_no" value="{{old('diary_no',$stockOut->diary_no)}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="date" value="{{old('date',$stockOut->date)}}" class="form-control">
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
                                                <option {{$stockOut->branch_id_fk == $key ? "selected": ""}} value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Applicant Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="applicant_name" value="{{old('applicant_name',$stockOut->applicant_name)}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Forwarded By</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="forwarded_by" value="{{old('forwarded_by',$stockOut->forwarded_by)}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Received By</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="received_by" value="{{old('received_by',$stockOut->received_by)}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Received Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="received_date" value="{{old('received_date',$stockOut->received_date)}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Approved By</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="approved_by" value="{{old('approved_by',$stockOut->approved_by)}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Approved Date</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="approved_date" value="{{old('approved_date',$stockOut->approved_date)}}" class="form-control">
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
                                                <option {{$stockOut->product_id_fk == $key ? "selected": ""}} value="{{$key}}">{{$value}}</option>
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
                                                <option {{$stockOut->brand_id_fk == $key ? "selected": ""}} value="{{$key}}">{{$value}}</option>
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
                                        <input type="number" disabled value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Stock Out Quantity</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="stock_out_qty" value="{{old('stock_out_qty',$stockOut->stock_out_qty)}}" class="form-control">
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
