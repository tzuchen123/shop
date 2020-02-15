@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<style>
    #create_btn {

        margin: 20px 0;
    }

    .create {
        margin: 10px 0;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">accounts - Index</div>

                <div class="card-body">
                    <a class="btn btn-success" href="/admin/accounts/create">新增帳號</a>
                    <hr>

                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>使用者名稱(name)</th>
                                <th>Email</th>
                                <th>權限(role)</th>
                                <th width="120">功能</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accounts as $account)
                            <tr>
                                <td>{{ $account->name}}</td>
                                <td>{{ $account->email}}</td>
                                <td>{{ $account->role}}</td>
                                <td>
                                    <a class="btn btn-danger btn-sm" href="#" id="{{$account->id}}">刪除</a>

                                    <form class="destroy-form" id="{{$account->id}}"
                                        action="/admin/accounts/destroy/{{$account->id}}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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

$('#example').on('click','.btn-danger',function(){
    event.preventDefault();
    var r = confirm("你確定要刪除此項目嗎?");
    if (r == true) {
    var id = $(this).attr("id");
        console.log(id)
    $(`.destroy-form[id="${id}"]`).submit();
    }
});


</script>

@endsection
