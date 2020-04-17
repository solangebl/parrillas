@extends('layouts.app')

@section('content')
<div class="page-header">
  <h1 class="page-title">
    Proveedores
  </h1>
</div>
<div class="row">
    <div class="col-md-12 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
				<h5>Nuevo Proveedor</h5>
				<form action="{{ route( 'providers.store' ) }}" class="form-inline"  enctype="multipart/form-data" method="POST">
				{{ csrf_field() }}
					<div class='form-group'>
						<input class="form-control" type="text" name="name" placeholder="Nombre" >
					</div>&nbsp;&nbsp;
					<button class="btn btn-info" type="submit">Agregar Proveedor</button>
				</form>
				<br>
				<div id="provider-edit" style="display:none">
					<h5 id="provider-edit-title">Editar Proveedor</h5>
					<form id="provider-edit-form" action="" class="form-inline" enctype="multipart/form-data" method="POST">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
						<div class='form-group'>
							<input class="form-control" id="edit-name" type="text" name="name" placeholder="Nombre" >
						</div>&nbsp;&nbsp;
						<button class="btn btn-info" type="submit">Guardar</button>
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
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($providers as $provider)
                  <tr>
                    <th scope="row">{{ $provider->id }}</th>
                    <td>{{ $provider->name }}</td>
                    <td class="form-inline">
                    <a class="btn btn-info" href="{{ route('providers.edit', $provider->id)}}"><i class="fe fe-edit mr-2"></i>Editar </a> &nbsp;&nbsp;
                      @if(count($provider->products)==0)
                      <form action="{{ route('providers.destroy', $provider->id)}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger" onClick="return confirm('Seguro desea eliminar al providere {{ $provider->name }}?')" type="submit"><i class="fe fe-user-x mr-2"></i>Eliminar</button>
                      </form>
                      @endif
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
