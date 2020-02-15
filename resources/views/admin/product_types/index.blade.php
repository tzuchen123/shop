@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<style>
    #create_btn {

        margin: 20px 0;
    }

    .create {
        margin-bottom: 30px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <h2>types-index</h2>

    <span>
        <a class="btn btn-warning" id="create_btn">開合新增欄位</a>
    </span>

    <div class="create d-none">
        <form method="post" action="/admin/product_types/store" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="typename" class="col-sm-2 col-form-label">typename</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="typename" name="typename" required>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary btn-sm btn">SEND</button>
                </div>
            </div>
        </form>
    </div>

    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>

                <th>種類(typename)</th>
                <th>功能(tool)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
            <tr>

                <td>{{$type->typename}}</td>
                <td><a class="btn btn-success btn-sm" href="/admin/product_types/edit/{{ $type->id}}">編輯</a>

                    <a class="btn btn-danger btn-sm" href="#" id="{{$type->id}}">刪除</a>

                    <form class="destroy-form" id="{{$type->id}}" action="/admin/product_types/destroy/{{$type->id}}"
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

$('#create_btn').on('click', function() {
    $(".create").toggleClass("d-none")
    });


</script>

@endsection
