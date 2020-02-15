@extends('layouts.front')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<style>
.breadcrumb{
   
    background-color: white;
}

</style>

@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/user_info/orders">訂單資料</a></li>
        <li class="breadcrumb-item active" aria-current="page"> <a href="/user_info/user_information">會員資料</a></li>
    </ol>
</nav>

<div class="main">
    <div class="container" id="information">
        <h2>user_info-orders</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">訂單編號</th>
                    <th>訂購人姓名</th>
                    <th>訂購人手機號碼</th>
                    <th>價錢</th>
                    <th>訂單狀態</th>
                </tr>
            </thead>
            @foreach ($orders as $order)
            <tbody>
                <tr>
                    <th scope="row">{{$order->order_no}}</th>
                    <td>{{$order->receive_name}}</td>
                    <td>{{$order->receive_mobile}}</td>
                    <td>{{$order->total_price}}</td>
                    <td>
                        @if($order->status == "new_order")
                        <span class="badge badge-warning">未付款</span>
                        @elseif($order->status == "payment_done")
                        <span class="badge badge-primary">已付款</span>
                        @elseif($order->status == "ship_done")
                        <span class="badge badge-success">已出貨</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    {{-- <th scope="row">{{$order->order_no}}</th> --}}
                    <td colspan="5">
                        <p>
                        <button class="btn btn-primary" data-id="{{$order->order_no}}">
                                訂單詳情
                        </button>
                        </p>
                        <div class="d-none" id="{{$order->order_no}}">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">產品名稱</th>
                                        <th scope="col">個數</th>
                                        <th scope="col">單價</th>
                                    </tr>
                                </thead>
                                @foreach ($order->orderItems as $item)
                                <tbody>
                                    <tr>
                                        <td>{{$item->product->name}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>{{$item->product->price}}</td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </td>

                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
</div>

@endsection

@section('js')
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
    $('#example').DataTable({
        "order": [1,"dasc"]
    });
});

$('.btn-primary ').on('click', function() {
   var order_no = $(this).data("id");
   $(` #${order_no}   `).toggleClass("d-none")
});

</script>

@endsection
