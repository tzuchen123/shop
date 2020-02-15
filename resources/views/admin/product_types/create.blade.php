@extends('layouts.app')

@section('css')
<style>

</style>
@endsection

@section('content')
<div class="container">
    <h2>news-create</h2>

    {{-- post跟後面的東西很重要不然不會傳資料 --}}
    <form method="post" action="/admin/product_types/store" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label for="type_name" class="col-sm-2 col-form-label">typename</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="type_name" name="type_name" required>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">SEND</button>
            </div>
        </div>
    </form>
</div>


@endsection




@section('js')
<script>


</script>

@endsection
