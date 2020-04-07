@extends('layouts.front')

@section('content')

<div class="volanta">
    <a href="">{!! $product->category !!}</a> / {!! $product->subcategory !!}
</div>

<div class="detalleProducto">
    <div class="row">
        <div class="col-12 col-lg-6">

            <div id="carouselFicha" class="carousel slide mb-4" data-ride="carousel">
                <div class="carousel-inner">
                    @foreac($product->images as $image)
                    <div class="carousel-item active">
                        <a href="" data-toggle="modal" data-target="#modalAmpliarPic">
                            <img src="/img/producto-demo.jpg" class="img-fluid" alt="" />
                        </a>
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselFicha" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>
                <a class="carousel-control-next" href="#carouselFicha" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Siguiente</span>
                </a>
            </div>
            <script>
                $('.carousel').carousel({
                    interval: 2000
                })
            </script>

        </div>
        <div class="col-12 col-lg-6">
            <div class="seccion">{!! $product->category !!}</div>
            <h1>{!! $product->name !!}</h1>
            <hr />
            <div class="precio">$ {!! $product->sale_price !!}</div>
            <div class="wa">
                <a href="">
                    <i class="fab fa-whatsapp"></i> <span>HACÉ TU CONSULTA</span>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
                {!! $product->description !!}
        </div>
    </div>
</div>
@endsection