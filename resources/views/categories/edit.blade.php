@extends('layouts.app')

@section('content')

<div class="page-header">
  <h1 class="page-title">
    Categorías - {!! $category->name !!}
  </h1>
</div>
<div class="row">
    <div class="col-md-12 col-md-offset-1">
        <!--div class="panel panel-default"-->
        @include('parts.errors')
        <div class="panel-body">
        <form action="{{ route('categories.update', $category->id) }}" class="needs-validation" novalidate method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <fieldset>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                        <input type="hidden" class="form-control" name="reload" value="1">
                    </div>
                </div>  
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="subcategory" value="" placeholder="Nueva Subcategoría">
                    </div>
                </div>  
            </div>
            <br><br>
            
            <button type="submit" class="btn btn-primary">
            <i class="fe fe-file-plus mr-2"></i> Guardar
            </button>
            <a class="btn btn-danger" href="{{ route('categories.index') }}"><i class="fe fe-rewind mr-2"></i> Cancelar</a>
        </fieldset>
        </form>
        <hr>
        <div class="row">
            <div class="col-sm-6">
            <h3>Subcategorías</h3> 
            <ul class="list-group">
                @foreach($category->subcategories as $sc)
                <li class="list-group-item justify-content-between">
                    {!! $sc->name !!} <br>
                <button class="btn btn-info" onClick="showEditForm('{{ route('categories.updateSubcat', $sc->id) }}','{{$sc->name}}' )"><i class="fe fe-cloud-lightning mr-2"></i>Editar </button> &nbsp;&nbsp;
                    @if(count($sc->products)==0)
                    <form class="form-inline" action="{{ route('categories.destroySubcat', $sc->id)}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger" onClick="return confirm('Seguro desea eliminar la subcategoría {{ $sc->name }}? Si tiene productos asociados, éstos serán eliminados también')" type="submit"><i class="fe fe-trash-2 mr-2"></i></button>
                    </form>
                    @endif
                </li>
                @endforeach
            </ul>
            </div>
            <div class="col-sm-6">
                <div id="subcategory-edit" style="display:none">
                    <h5 id="subcategory-edit-title">Editar Subcategoría </h5>
                    <form id="subcategory-edit-form" action="" class="form-inline" method="POST">
                        {{ csrf_field() }}
                        {{method_field('PUT')}}
                        <div class='form-group'>
                        <input class="form-control" id="edit-name" type="text" name="name" placeholder="Nombre" >
                        </div>&nbsp;&nbsp;
                        <button class="btn btn-info" type="submit">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
        <!--/div-->
      </div>
</div>

@endsection

@section('script')
<script>

function showEditForm(route, es) {
	$('#subcategory-edit-form').attr('action', route);
	$('#subcategory-edit-title').text('Editar Subcategoría '+ es);
	$('#edit-name').val(es);
	$('#subcategory-edit').show();
}

</script>
@endsection