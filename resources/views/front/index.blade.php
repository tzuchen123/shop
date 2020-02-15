@extends('layouts.front')

@section('css')
<link href="{{ asset('css/index.css') }}" rel="stylesheet">
<STYle>
 .card img {
        height: 300px;
    }

</STYle>
@endsection




@section('content')

<section id="banner">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide img1"></div>
            <div class="swiper-slide img2"></div>
            <div class="swiper-slide img3"></div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>

<section id="woman">
    <div class="row">
        @foreach ($woman_products as $product)
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card" style="width: 18rem;">
                <a href="/product_detail/{{$product->id}}">
                    <div class="card-body">
                        <img src="{{asset('/storage/'.$product->image)}}" class="card-img-top" alt="image">
                        <div class="text">
                            <div>{{$product->name}}</div>
                            <div>{{$product->price}}元</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>

</section>
<section id="man">
    <div class="row">
        @foreach ($man_products as $product)
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card" style="width: 18rem;">
                <a href="/product_detail/{{$product->id}}">
                    <div class="card-body">
                        <img src="{{asset('/storage/'.$product->image)}}" class="card-img-top" alt="image">
                        <div class="text">
                            <div>{{$product->name}}</div>
                            <div>{{$product->price}}元</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</section>
<section id="kid">
    <div class="row">
        @foreach ($kid_products as $product)
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card" style="width: 18rem;">
                <a href="/product_detail/{{$product->id}}">
                    <div class="card-body">
                        <img src="{{asset('/storage/'.$product->image)}}" class="card-img-top" alt="image">
                        <div class="text">
                            <div>{{$product->name}}</div>
                            <div>{{$product->price}}元</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</section>
<section id="accessories">
    <div class="row">
        @foreach ($accessories_products as $product)
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card" style="width: 18rem;">
                <a href="/product_detail/{{$product->id}}">
                    <div class="card-body">
                        <img src="{{asset('/storage/'.$product->image)}}" class="card-img-top" alt="image">
                        <div class="text">
                            <div>{{$product->name}}</div>
                            <div>{{$product->price}}元</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
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

</script>

@endsection
