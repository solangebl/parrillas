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
            </div>
			<br>
            <div class="panel-body"> 
              <table class="table">
                <thead>
                  <tr> 
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Precio Venta</th>
                    <th scope="col">Stock</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($products as $product)
                  <tr>
                    <td scope="row">{{ $product->id }}</td>
                    <td scope="row">{{ $product->name }}</td>
                    <td>{!! substr($product->description,0, 100) !!}</td>
                    <td scope="row">
                      <form action="{{ route('products.quickUpdate', $product->id)}}" method="post" id="price-{{$product->id}}">
                        <input type="number" name="sale_price" id="" value="{{ $product->sale_price }}" size="10" style="border:none">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <button class="btn btn-link" id="btn-price-{{$product->id}}" type="button" onClick="product_edit('price-'+ {{$product->id}})" ><i class="fe fe-check-circle"></i></button>
                      </form>
                    </td>
                    <td scope="row">
                      <form action="{{ route('products.quickUpdate', $product->id)}}" method="post" id="stock-{{$product->id}}">
                        <input type="number" name="amount" id="" value="{{ $product->amount }}" size="10" style="border:none">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <button class="btn btn-link" id="btn-stock-{{$product->id}}" type="button" onClick="product_edit('stock-' + {{$product->id}} )" ><i class="fe fe-check-circle"></i></button>
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
$(document).keypress(
  function(event){
    if (event.which == '13') {
      event.preventDefault();
    }
});
</script>

@endsection