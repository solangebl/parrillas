@extends('layouts.app')

@section('content')
<div class="page-header">
  <h1 class="page-title">
    Productos
  </h1>
</div>
<div class="row">
    <div class="col-md-12 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
              <a href="{{ route('products.create') }}"><span class="fe fe-plus"></span> Nuevo Producto</a>
              <div class="form-inline">
                <form action="" method="POST">
                  {{ csrf_field() }}
                  <select class="form-control" name="category" id="filter-cat">
                    <option value="">Seleccione Categoría</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{$cat_id==$category->id ? 'selected' : ''}}>{!! $category->name !!}</option>
                    @endforeach
                  </select>
                  <select class="form-control" name="subcategory" id="filter-subcat">
                    <option value="">Seleccione Subcategoría</option>
                  </select>
                  <select class="form-control" name="provider" id="filter-prov">
                    <option value="">Seleccione Proveedor</option>
                    @foreach($providers as $sc)
                      <option value="{{ $sc->id }}" {{$prov_id==$sc->id ? 'selected' : ''}}>{!! $sc->name !!}</option>
                    @endforeach
                  </select>
                  <select class="form-control" name="deposit" id="filter-deposit">
                    <option value="">Seleccione Depósito</option>
                    @foreach($deposits as $sc)
                      <option value="{{ $sc->id }}" {{$deposit_id==$sc->id ? 'selected' : ''}}>{!! $sc->name !!}</option>
                    @endforeach
                  </select>
                  <button class="btn btn-default" type="button" onClick="filter()"><i class="fe fe-filter">Filtrar</i></button>
                </form>
              </div>
              <div class="clearfix"></div>
              <div class="form-inline">
                <form action="{{ route('products.priceUpdate') }}" onSubmit="return checkFilters()" method="POST">
                  {{ csrf_field() }}
                  <select class="form-control" name="category" id="p_cat">
                    <option value="">Seleccione una categoría</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{!! $category->name !!}</option>
                    @endforeach
                  </select>
                  <select class="form-control" name="subcategory" id="p_subcat">
                    <option value="">Seleccione una subcategoría</option>
                  </select>
                  <input type="number" name="perc" class="form-control" id="" min="0" max="100">
                  <button class="btn btn-default" type="submit"><i class="fe fe-dollar-sign">Actualizar Precios</i></button>
                </form>
              </div>
            </div>
			      <br>
            <div class="panel-body"> 
              <table class="table">
                <thead>
                  <tr> 
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Proveedor</th>
                    <th scope="col">Depósito</th>
                    <th scope="col">Precio Compra</th>
                    <th scope="col">Precio Venta</th>
                    <th scope="col">Precio ML</th>
                    <th scope="col">Stock</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($products as $product)
                  <tr>
                    <td scope="row">{{ $product->id }}</td>
                    <td scope="row">{{ $product->name }}</td>
                    <td scope="row">{{ !empty($product->provider) ? $product->provider->name : '' }}</td>
                    <td scope="row">{{ !empty($product->deposit) ? $product->deposit->name : '' }}</td>
                    <td scope="row">
                      <form action="{{ route('products.quickUpdate', $product->id)}}" method="post" id="buyprice-{{$product->id}}">
                        <input type="number" name="buy_price" id="" value="{{ $product->buy_price }}" size="10" style="border:none">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <button class="btn btn-link btn-quick-save" id="btn-buyprice-{{$product->id}}" type="button" onClick="product_edit('buyprice-'+ {{$product->id}})" ><i class="fe fe-check-circle"></i></button>
                      </form>
                    </td>
                    <td scope="row">
                      <form action="{{ route('products.quickUpdate', $product->id)}}" method="post" id="price-{{$product->id}}">
                        <input type="number" name="sale_price" id="" value="{{ $product->sale_price }}" size="10" style="border:none">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <button class="btn btn-link btn-quick-save" id="btn-price-{{$product->id}}" type="button" onClick="product_edit('price-'+ {{$product->id}})" ><i class="fe fe-check-circle"></i></button>
                      </form>
                    </td>
                    <td scope="row">
                      <form action="{{ route('products.quickUpdate', $product->id)}}" method="post" id="priceml-{{$product->id}}">
                        <input type="number" name="sale_price_ml" id="" value="{{ $product->sale_price_ml }}" size="10" style="border:none">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <button class="btn btn-link btn-quick-save" id="btn-priceml-{{$product->id}}" type="button" onClick="product_edit('priceml-'+ {{$product->id}})" ><i class="fe fe-check-circle"></i></button>
                      </form>
                    </td>
                    <td scope="row">
                      <form action="{{ route('products.quickUpdate', $product->id)}}" method="post" id="stock-{{$product->id}}">
                        <input type="number" name="amount" id="" value="{{ $product->amount }}" size="10" style="border:none">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <button class="btn btn-link btn-quick-save" id="btn-stock-{{$product->id}}" type="button" onClick="product_edit('stock-' + {{$product->id}} )" ><i class="fe fe-check-circle"></i></button>
                      </form>
                    </td>
                    <td class="form-inline">
					            <a class="btn btn-info" href="{{ route('products.edit', $product->id)}}"><i class="fe fe-edit mr-2"></i>Editar </a> &nbsp;&nbsp;
                      <form action="{{ route('products.destroy', $product->id)}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger" onClick="return confirm('Seguro desea eliminar el producto #{{ $product->id }}?')" type="submit"><i class="fe fe-user-x mr-2"></i>Eliminar</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
function filter() {
  var redirect = "/admin/products?s=1";
  var cat = $('#filter-cat').val();
  if(cat !== undefined && cat !== '') {
    redirect += '&category=' + cat;
  }
  var scat = $('#filter-subcat').val();
  if(scat !== undefined && scat !== '') {
    redirect += '&subcategory=' + scat;
  }
  var dep = $('#filter-deposit').val();
  if(dep !== undefined && dep !== '') {
    redirect += '&deposit=' + dep;
  }
  var provider = $('#filter-prov').val();
  if(provider !== undefined && provider !== '') {
    redirect += '&provider=' + provider;
  }

  window.location.href = redirect;
}

function checkFilters() {
  var filter = $('#p_cat').val()
  if(filter === undefined || filter === '') {
    return confirm('Confirma que desea actualizar los precios de TODOS los productos?')
  }
}

$(document).keypress(
  function(event){
    if (event.which == '13') {
      event.preventDefault();
    }
});

var categories = @json($categories);

$(document).ready(function(){
  $('#filter-cat').on('change', function(){ loadSubcats( $('#filter-cat'), $('#filter-subcat'), categories ) });
  $('#p_cat').on('change', function(){ loadSubcats( $('#p_cat'), $('#p_subcat'), categories ) });
})
</script>

@endsection