@extends('layouts.app')
<style>
ul{
list-style:none;
font-size: 20px;　　　　　 /* 設定文字大小 */
}

</style>

@section('css')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <span>orders - content</span>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">訂單資料</div>
                <div class="card-body">
                    <ul>
                        @foreach ($order_items as $item)
                        <li style="line-height:24px letter-spacing: 3px;">{{$item->product->name}} x {{$item->quantity}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-header">訂購人資料</div>
               <div class="card-body">
                    <ul>
                        <li style="line-height:24px letter-spacing: 3px;">訂購人姓名: {{$receiver_info->order->receive_name}}</li>
                        <li style="line-height:24px letter-spacing: 3px;">訂購人手機: {{$receiver_info->order->receive_mobile}}</li>
                        <li style="line-height:24px letter-spacing: 3px;">訂購人信箱: {{$receiver_info->order->receive_email}}</li>
                        <li style="line-height:24px letter-spacing: 3px;">發票種類: {{$receiver_info->order->receipt}}</li>
                        <li style="line-height:24px letter-spacing: 3px;">總價: {{$receiver_info->order->total_price}}</li>
                        <li style="line-height:24px letter-spacing: 3px;">訂單狀況: {{$receiver_info->order->status}}</li>
                        <li style="line-height:24px letter-spacing: 3px;">訂購會員: {{$receiver_info->order->user->name}}</li>
                    </ul>
                </div>
            </div>

          
        </div>
    </div>
    
</div>
@endsection


@section('js')
<script>
</script>
@endsection