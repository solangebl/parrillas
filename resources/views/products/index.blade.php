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
				<a href="{{ route('projects.create') }}"><span class="fe fe-plus"></span> Nuevo Proyecto</a>
            </div>
			<br>
            <div class="panel-body"> 
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Descripción</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($projects as $project)
                  <tr>
                    <th scope="row">{{ $project->id }}</th>
                    <td>{!! $project->client->name !!}</td>
                    <td>{!! substr($project->description_es,0, 100) !!}</td>
                    <td class="form-inline">
					            <a class="btn btn-info" href="{{ route('projects.edit', $project->id)}}"><i class="fe fe-edit mr-2"></i>Editar </a> &nbsp;&nbsp;
                      <form action="{{ route('projects.destroy', $project->id)}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger" onClick="return confirm('Seguro desea eliminar al proyecto #{{ $project->id }}?')" type="submit"><i class="fe fe-user-x mr-2"></i>Eliminar</button>
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