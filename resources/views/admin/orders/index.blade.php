@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<style>


</style>
@endsection

@section('content')
<div class="container">
    <h2>orders-index</h2>
    <a class="btn btn-primary" href="/admin/orders/">全部訂單</a>
    <a class="btn btn-primary" href="/admin/orders/select/new_order">未完成交易訂單</a>
    <a class="btn btn-primary" href="/admin/orders/select/payment_done">已完成付款</a>
    <a class="btn btn-primary" href="/admin/orders/select/ship_done">已出貨</a>
    <hr>

    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>訂單編號</th>
                <th>訂購人姓名</th>
                <th>訂購人手機號碼</th>
                <th>價錢</th>
                <th>訂單狀態</th>
                <th width="200">功能</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{$order->order_no}}</td>
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

                <td>
                    <a class="btn btn-success btn-sm" href="/admin/orders/content/{{$order->id}}">訂單內容</a>

                    @if($order->status == "payment_done")
                    <a class="btn btn-primary btn-sm" href="#" data-orderid="{{$order->id}}">改為已出貨</a>
                    <form class="ship-form" data-orderid="{{$order->id}}"
                        action="/admin/orders/changeStatus/{{$order->id}}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @endif

                    <a class="btn btn-danger btn-sm" href="#" data-orderid="{{$order->id}}">刪除訂單</a>
                    <form class="destroy-form" data-orderid="{{$order->id}}"
                        action="/admin/orders/destroy/{{$order->id}}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </td>

            </tr>
            @endforeach
        </tbody>

    </table>
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

    $('#example').on('click','.btn-primary',function(){
            event.preventDefault();
            var r = confirm("確認商品已送出嗎?將狀態改為已出貨");
            if (r == true) {
                var order_id = $(this).data("orderid");
                $(`.ship-form[data-orderid="${order_id}"]`).submit();
            }
        });

        $('#example').on('click','.btn-danger',function(){
            event.preventDefault();
            var r = confirm("你確定要刪除此項目嗎?");
            if (r == true) {
                var order_id = $(this).data("orderid");
                $(`.destroy-form[data-orderid="${order_id}"]`).submit();
            }
        });

});





</script>

@endsection
