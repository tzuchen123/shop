@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<style>


</style>
@endsection

@section('content')
<div class="container">
    <h2>products-index</h2>
    <span>
        <a class="btn btn-success btn-sm" href="/admin/products/create">新增</a>
    </span>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>產品名(name)</th>
                <th>類別(typename)</th>
                <th>價錢(price)</th>
                <th>主要照片(image in table products)</th>
                <th>輪播照片(images in table product_images)</th>
                <th width="200">功能(tool)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{$product->name}}</td>
                <td>{{$product->product_type->typename}}</td>
                <td>{{$product->price}}</td>
                <td>
                    <img src="{{asset('/storage/'.$product->image)}}" alt="image" height="400px" width="300px">
                </td>
                <td>
                    @foreach ($product->product_images as $image)
                    <img src="{{asset('/storage/'.$image->image)}}" alt="image" height="400px" width="300px">
                    @endforeach

                </td>
                <td>
                    <a class="btn btn-success btn-sm" href="/admin/products/edit/{{ $product->id}}">編輯</a>

                    <a class="btn btn-danger btn-sm" href="#" id="{{$product->id}}">刪除</a>
                    <form class="destroy-form" id="{{$product->id}}" action="/admin/products/destroy/{{$product->id}}"
                        method="POST" style="display: none;">
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
});

$('#example').on('click','.btn-danger',function(){
    event.preventDefault();
    var r = confirm("你確定要刪除此項目嗎?");
    if (r == true) {

    //如果用用data-*寫，.data(*)抓資料
    // var itemid = $(this).data("itemid");

    //jquery語法:$()，代表選取上面元素，等於 var xxx = document.queryseletor("yyy")
    //$(this)代表被點到的東西，因為有好幾個按鈕
    //.attr(""):返回被被元素的属性值，把點到按鈕的id丟到變數id

    var id = $(this).attr("id");

    //按鈕與表單要互相對應，點到"按鈕"要送出相對的"表單"
    //用樣板文字送出.destroy-form中id是變數id的表單
    // $().submit:送出表單
    $(`.destroy-form[id="${id}"]`).submit();
    }
});


</script>

@endsection
