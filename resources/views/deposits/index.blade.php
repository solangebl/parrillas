@extends('layouts.app')

@section('content')
<div class="page-header">
  <h1 class="page-title">
    Depósitos
  </h1>
</div>
<div class="row">
    <div class="col-md-12 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
				<h5>Nuevo Depósito</h5>
				<form action="{{ route( 'deposits.store' ) }}" class="form-inline"  enctype="multipart/form-data" method="POST">
				{{ csrf_field() }}
					<div class='form-group'>
						<input class="form-control" type="text" name="name" placeholder="Nombre" >
					</div>&nbsp;&nbsp;
					<button class="btn btn-info" type="submit">Agregar Depósito</button>
				</form>
				<br>
				<div id="deposit-edit" style="display:none">
					<h5 id="deposit-edit-title">Editar Depósito</h5>
					<form id="deposit-edit-form" action="" class="form-inline" enctype="multipart/form-data" method="POST">
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
                  @foreach ($deposits as $deposit)
                  <tr>
                    <th scope="row">{{ $deposit->id }}</th>
                    <td>{{ $deposit->name }}</td>
                    <td class="form-inline">
                    <a class="btn btn-info" href="{{ route('deposits.edit', $deposit->id)}}"><i class="fe fe-edit mr-2"></i>Editar </a> &nbsp;&nbsp;
                      <form action="{{ route('deposits.destroy', $deposit->id)}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger" onClick="return confirm('Seguro desea eliminar al depósito {{ $deposit->name }}?')" type="submit"><i class="fe fe-user-x mr-2"></i>Eliminar</button>
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
