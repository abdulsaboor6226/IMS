<table class="table table-hover">
    <thead>
    <tr>
        <th>Sr.No</th>
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
    @foreach($stockOut as $key => $stockOut)
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
            <td>{{$stockOut->created_at}}</td>
    @endforeach
    </tbody>
</table>
