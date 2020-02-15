@extends('layouts.front')

@section('css')

<style>
    .main {
        width: 100%
    }

    .main .word {
        width: 50%
    }

    .main .image {
        width: 50%;
    }

    .main .image img {
        height: 400px;
    }
</style>
@endsection

@section('content')

<section id="product">
    <div class="main d-flex">
        <div class="word">
            <h2>{{$product->name}}</h2>
            <h3>{{$product->price}}元</h3>
            <button class="btn btn-danger addcart" data-productid="{{$product->id}}">加入購物車</button>
        </div>

        <div class="image">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach ($product->product_images as $image)
                    <div class="swiper-slide">
                        <img class="img-fluid" src="{{asset('/storage/'.$image->image)}}" alt="">
                    </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>

    </div>

</section>


@endsection

@section('js')
<script>
    var swiper = new Swiper('.swiper-container', {
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });

    //把產品id送到後台
    $('.addcart').click(function () {
    var product_id = $(this).data('productid');
                // or  $(this).attr("productid-id")

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: 'POST',
        url: '/add_product_to_cart',
        data: {product_id:product_id},
        success: function (res) {
            console.log(res);
            $('#TotalQuantity').text(res);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error(textStatus + " " + errorThrown);
        }
    });
});

</script>
@endsection