@extends('layouts.app')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
<style>

</style>
@endsection

@section('content')
<div class="container">
  <h2>products-create</h2>

  {{-- post跟後面的東西很重要不然不會傳資料 --}}
  <form method="post" action="/admin/products/store" enctype="multipart/form-data" runat="server">
    @csrf
    <div class="form-group row">
      <label for="name" class="col-sm-2 col-form-label">產品名稱</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="price" class="col-sm-2 col-form-label">產品價錢</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="price" name="price" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="type_id" class="col-sm-2 col-form-label">類別名稱</label>
      <div class="col-sm-10">
        <select class="form-control" id="type_id" name="type_id">
          @foreach ($types as $type)
          <option value={{$type->id}}>{{$type->typename}}</option>
          {{-- value代表要存在欄位裡面的值 --}}
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-group row">
      {{-- 存在table products  --}}
      <label for="image" class="col-sm-2 col-form-label">主要圖片</label>
      <div class="col-sm-10">
        <input type="file" class="form-control" id="image" name="image" required>
        <img id="preview_pic" src="#" style="max-weight:80vw; max-height:80vh"/>
      </div>
    </div>

    <div class="form-group row">
      {{-- 存在table product_images --}}
      <label for="images" class="col-sm-2 col-form-label">輪播照片</label>
      <div class="col-sm-10">
        <input type="file" class="form-control" id="images" name="images[]" required multiple>
        <div id="preview_images" style="width:100%; height: 300px; overflow:scroll;">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
<script>
  $("#image").change(function(){
      //當檔案改變後，做一些事
     readURL(this);   // this代表<input id="pic">
   });

   function readURL(input){
  if(input.files && input.files[0]){
    var reader = new FileReader();
    reader.onload = function (e) {
       $("#preview_pic").attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}


$("#images").change(function(){
  $("#preview_images").html(""); // 清除預覽
  readURLs(this);
});

function readURLs(input){
  if (input.files && input.files.length >= 0) {
    for(var i = 0; i < input.files.length; i ++){
      var reader = new FileReader();
      reader.onload = function (e) {
        var img = $("<img width='300' height='200'>").attr('src', e.target.result);
        $("#preview_images").append(img);
      }
      reader.readAsDataURL(input.files[i]);
    }
  }else{
     var noPictures = $("<p>目前沒有圖片</p>");
     $("#preview_progressbarTW_imgs").append(noPictures);
  }
}

</script>

@endsection