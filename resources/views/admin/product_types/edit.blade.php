@extends('layouts.app')

@section('css')
<style>

</style>
@endsection

@section('content')
<div class="container">
    <h2>types-edit</h2>

    {{-- post跟後面的東西很重要不然不會傳資料 --}}
    {{-- 代表按下去開始送資料，不要用Get，因為資料會出現在網址 --}}
    <form method="post" action="/admin/product_types/update/{{$type->id}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label for="typename" class="col-sm-2 col-form-label">typename</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="typename" value="{{$type->typename}}" name="typename">
            </div>
        </div>


        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">EDIT</button>
            </div>
        </div>
    </form>
</div>


@endsection




@section('js')
<script>


</script>

@endsection
