<div class="d-flex justify-content-between align-items-stretch flex-wrap productos">
    @if(count($products) == 0)
    <p>No se encontraron productos</p>
    @else
    @foreach($products as $product)
    <article>
        <a href="{{ route('product.view', $product->id) }}">
            <img src="{{ asset('storage/products/'. $product->id . '/thumbnail/' .$product->thumbnail) }}" class="img-fluid" alt="" />
            <div class="seccion">{!! $product->category->name !!}</div>
            <h2>{!! $product->name !!}</h2>
            <div class="precio">$ {{ $product->sale_price }}</div>
        </a>
        <div class="wa">
            <a href="">
                <i class="fab fa-whatsapp"></i> <span>HACÉ TU CONSULTA</span>
            </a>
        </div>
    </article>
    @endforeach
    @endif
</div>