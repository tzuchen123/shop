@extends('layouts.front')

@section('css')
<style>
.breadcrumb{

    background-color: white;
}

</style>
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb" >
        <li class="breadcrumb-item"><a href="/user_info/orders">訂單資料</a></li>
        <li class="breadcrumb-item active" aria-current="page"> <a href="/user_info/user_information">會員資料</a></li>
    </ol>
</nav>

<div class="main">

    <div class="container" id="information">
        <h2>user_info-information</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">姓名</th>
                    <th scope="col">email</th>
                    <th scope="col">修改email</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td><button></button></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
@endsection

@section('js')
<script>


</script>

@endsection
