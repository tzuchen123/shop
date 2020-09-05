@extends('layouts.app')

@section('css')
<meta name="_token" content="{{ csrf_token() }}" />

<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
<style>
    #previous_image {
        position: relative;
        width: 300px;

    }

    .btnx {
        position: absolute;
        top: 5px;
        right: 5px
    }

    .prepare_delete {
        opacity: 0.5;
    }
</style>
@endsection

@section('content')

<div class="container">
    <h2>products-edit</h2>

    {{-- post跟後面的東西很重要不然不會傳資料 --}}
    <form method="post" action="/admin/products/update/{{$product->id}}" enctype="multipart/form-data" runat="server">

        @csrf
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}" >
            </div>
        </div>

        <div class="form-group row">
            <label for="price" class="col-sm-2 col-form-label">產品價錢</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="price" name="price" value="{{$product->price}}" >
            </div>
        </div>

        <div class="form-group row">
            <label for="type_id" class="col-sm-2 col-form-label">typename</label>
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
            <label for="image" class="col-sm-2 col-form-label">主要照片</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="image" name="image" >
                <img id="preview_pic" src="{{asset('/storage/'.$product->image)}}" />
            </div>
        </div>

        <div class="form-group row">
            <label for="old_images" class="col-sm-2 col-form-label">old_images</label>
            <div class="col-sm-10">
                <small>點選變暗刪除，再點選一次復原</small>
                <div id="old_images" class="d-flex" style="width:100%; height: 300px; overflow:scroll;">
                    @foreach ($product->product_images as $image)
                    <div id="old_image" width="300px">
                        <img src="{{asset('/storage/'.$image->image)}}" alt="pic" height="400px" width="300px"
                            data-imageid="{{$image->id}}">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <input type="text" class="form-control d-none" id="delete" name="delete" multiple >

        <div class="form-group row">
            <label for="new_images" class="col-sm-2 col-form-label">new_images</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="new_images" name="images[]" required multiple>
                <div id="preview_images" class="d-flex" style="width:100%; height: 300px; overflow:scroll;">

                </div>
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


$("#new_images").change(function(){
//   $("#preview_images").html(""); // 清除預覽
//   $("#previous_images" ).addClass( "d-none" );
  readURLs(this);
});

function readURLs(input){

  if (input.files && input.files.length >= 0) {
    for(var i = 0; i < input.files.length; i ++){
      var reader = new FileReader();
      reader.onload = function (e) {
        var img = $("<img width='300' height='600'>").attr('src', e.target.result);
        $("#preview_images").append(img);

      }
      reader.readAsDataURL(input.files[i]);
    }
  }else{
     var noPictures = $("<p>目前沒有圖片</p>");
     $("#preview_progressbarTW_imgs").append(noPictures);
  }
}

//把input value(string) 變成陣列
var delete_String = $("#delete").val()
var delete_Array = delete_String.split(',');

//刪掉空的
var delete_Array = delete_Array.filter(function(v){return v!==''});

$("img").click(function(){

//變暗
$(this).toggleClass("prepare_delete") ;

//抓到image_id
var image_id = $(this).data('imageid');

if (delete_Array.includes(image_id)) {
    //沒有加進去
    delete_Array = jQuery.grep(delete_Array, function(value) {
    return value != image_id;
});
}else{
    //有刪掉
    delete_Array.push(image_id);
}
//轉回string，丟到input
var x = delete_Array.toString();
$("#delete").val(x);

});


</script>






@endsection
