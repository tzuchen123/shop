@extends('layouts.front')
@section('css')


@endsection


@section('content')
<div class="container">
    <div class="content">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">產品名稱</th>
                    <th scope="col">金額</th>
                    <th scope="col">數量</th>
                    <th scope="col">小計</th>
                    <th scope="col">刪除</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($content as $content)
                <tr>
                    <td> {{ $content->name}}</td>
                    <td> {{ $content->price}}</td>
                    <td>
                        <input type="text" class="quantity" name="quantity" value=" {{ $content->quantity}}"
                            data-productid="{{ $content->id}}">
                    </td>
                    <td>{{ $content->price * $content->quantity}}</td>
                    <td><button class="btn-danger btm-sm" data-productid="{{ $content->id}}">x</button></td>

                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <div class="total">
        <h2>總共金額:{{ $total}}</h2>
    </div>
    <button>確認結帳</button>

</div>

@endsection


@section('js')

<script>
    $('.btn-danger').on('click', function() {
//抓產品id送到後端
var product_id = $(this).data("productid")
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  $.ajax({
    url: '/ajex_delete_item_in_cart',                 // url位置
    type: 'post',                                    // post/get
    data: { product_id: product_id,},                // 輸入的資料
    error: function (jqXHR, textStatus, errorThrown) {                         // 錯誤後執行的函數
        console.error(textStatus + " " + errorThrown);
    },
    success: function (res) {        
        console.log(res)               // 成功後要執行的函數
        document.location.reload(true);             //重整頁面
    }
});


});

//當inpuu有變化的時候，抓到它，送到後端
$('.quantity').on('change', function() {
//把新的數量存起來
var new_quantity = $(this).val();
//抓產品id
var product_id = $(this).data("productid")
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

  $.ajax({
    url: 'ajex_new_quantity',                        // url位置
    type: 'post',                                    // post/get
    data: { product_id: product_id,
            new_quantity: new_quantity   },         // 輸入的資料
    error: function (jqXHR, textStatus, errorThrown) {                         // 錯誤後執行的函數
        console.error(textStatus + " " + errorThrown);
    },
    success: function (res) {        
        console.log(res)               // 成功後要執行的函數
        document.location.reload(true);              //重整頁面
    }
});


});




</script>

@endsection