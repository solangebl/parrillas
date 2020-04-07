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
                    <form class="form-inline" action="{{ route('categories.destroySubcat', $sc->id)}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger" onClick="return confirm('Seguro desea eliminar la subcategoría {{ $sc->name }}?')" type="submit"><i class="fe fe-trash-2 mr-2"></i></button>
                    </form>
                    {!! $sc->name !!}
                </li>
                @endforeach
            </ul>
            </div>
        </div>
        </div>
        <!--/div-->
      </div>
</div>

@endsection