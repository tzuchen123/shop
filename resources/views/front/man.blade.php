@extends('layouts.front')

@section('css')
<link href="{{ asset('css/index.css') }}" rel="stylesheet">
<style>
    #banner .img {
        background-image: url("/images/manbanner.jpg");
        width: 100%;
        height: 60vh;
        background-position: center;
        background-size: cover;
    }

    .card img {
        height: 300px;
    }

    a {
        text-decoration: none;
        color: black
    }
</style>

@endsection

@section('content')

<section id="banner">
    <div class="img"></div>
</section>

<section id="products">
    <div class="row">
        @foreach ($products as $product)
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

</script>

@endsection
