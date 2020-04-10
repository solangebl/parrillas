@extends('layouts.app')

@section('content')
<div class="page-header">
  <h1 class="page-title">
    Proyectos
  </h1>
</div>
<div class="row">
    <div class="col-md-12 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
				<a href="{{ route('products.create') }}"><span class="fe fe-plus"></span> Nuevo Proyecto</a>
            </div>
			<br>
            <div class="panel-body"> 
              <table class="table">
                <thead>
                  <tr> 
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($products as $product)
                  <tr>
                    <th scope="row">{{ $product->id }}</th>
                    <th scope="row">{{ $product->name }}</th>
                    <td>{!! substr($product->description,0, 100) !!}</td>
                    <td class="form-inline">
					            <a class="btn btn-info" href="{{ route('products.edit', $product->id)}}"><i class="fe fe-edit mr-2"></i>Editar </a> &nbsp;&nbsp;
                      <form action="{{ route('products.destroy', $product->id)}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger" onClick="return confirm('Seguro desea eliminar al proyecto #{{ $product->id }}?')" type="submit"><i class="fe fe-user-x mr-2"></i>Eliminar</button>
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