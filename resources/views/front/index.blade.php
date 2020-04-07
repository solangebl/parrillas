@extends('layouts.front')

@section('content')
<div id="carouselHome" class="carousel slide mb-4" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <a href="">
                <img class="img-fluid" src="/img/home/carousel_slide01.jpg" alt="" />
            </a>
        </div>
        <div class="carousel-item">
            <a href="">
                <img class="img-fluid" src="/img/home/carousel_slide02.jpg" alt="" />
            </a>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselHome" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
    </a>
    <a class="carousel-control-next" href="#carouselHome" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Siguiente</span>
    </a>
</div>
<script>
    $('.carousel').carousel({
        interval: 2000
    })
</script>
@include('parts.products-list')

@endsection