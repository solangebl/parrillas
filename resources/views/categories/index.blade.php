@extends('layouts.app')

@section('content')
<div class="page-header">
  <h1 class="page-title">
    Categorías
  </h1>
</div>
<div class="row">
    <div class="col-md-12 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
				<h5>Nueva Categoría</h5>
				<form action="{{ route( 'categories.store' ) }}" class="form-inline" method="POST">
					{{ csrf_field() }}
					<div class='form-group'>
					<input class="form-control" type="text" name="name" placeholder="Nombre" >
					</div>
					<button class="btn btn-info" type="submit">Agregar Categoría</button>
				</form>
				<br>
				<div id="category-edit" style="display:none">
					<h5 id="category-edit-title">Editar Categoría </h5>
					<form id="category-edit-form" action="" class="form-inline" method="POST">
						{{ csrf_field() }}
						{{method_field('PUT')}}
						<div class='form-group'>
						<input class="form-control" id="edit-name" type="text" name="name" placeholder="Nombre" >
						</div>&nbsp;&nbsp;
						<button class="btn btn-info" type="submit">Guardar</button>
					</form>
				</div>
            </div>
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
                  @foreach ($categories as $category)
                  <tr id="category-view-{{$category->id}}">
                    <th scope="row">{{ $category->id }}</th>
                    <td>{{ $category->name }}</td>
                    <td class="form-inline">
                      <button class="btn btn-info" onClick="showEditForm('{{ route('categories.update', $category->id) }}','{{$category->name}}' )"><i class="fe fe-cloud-lightning mr-2"></i>Edición Rápida </button> &nbsp;&nbsp;
                      <a class="btn btn-info" href="{{ route('categories.edit', $category->id) }}"><i class="fe fe-edit mr-2"></i>Editar </a> &nbsp;&nbsp;
                      @if(count($category->products)==0)
                      <form action="{{ route('categories.destroy', $category->id)}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger btn-small" onClick="return confirm('Seguro desea eliminar la categoría {{ $category->name }}? Si tiene productos asociados, éstos serán eliminados también')" type="submit"><i class="fe fe-trash-2 mr-2"></i>Eliminar</button>
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

@section('script')
<script>

function showEditForm(route, es) {
	$('#category-edit-form').attr('action', route);
	$('#category-edit-title').text('Editar Categoría '+ es);
	$('#edit-name').val(es);
	$('#category-edit').show();
}

</script>
@endsection