@extends('layouts.app')

@section('content')
<div class="page-header">
  <h1 class="page-title">
  Editar Proveedor
  </h1>
</div>
<div class="row">
    <div class="col-md-12 col-md-offset-1">
        <!--div class="panel panel-default"-->
        @include('parts.errors')

       <div class="panel-body">
        <form action="{{ route('providers.update', $provider->id) }}" class="needs-validation" novalidate method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <fieldset>
			  	<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<input type="text" class="form-control" name="name" value="{{ $provider->name }}">
						</div>
					</div>  
				</div>
        <div class="row">
          <div class='col-sm-12'>
            <div class='form-group'>
              <label for="text">Información</label>
              <textarea class="form-control description" id="information" name="information" size="30" rows="10" maxlength="500">{{ $provider->information }}</textarea>
            </div>
          </div>
				</div>
				<br><br>
			  
              <button type="submit" class="btn btn-primary">
                <i class="fe fe-file-plus mr-2"></i> Guardar
              </button>
              <a class="btn btn-danger" href="{{ route('providers.index') }}"><i class="fe fe-rewind mr-2"></i> Cancelar</a>
              </fieldset>
            </form>
            </div>
        <!--/div-->
      </div>
    </div>
    @endsection

@section('script')

<script>


$(document).ready(function(){
  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.getElementsByClassName('needs-validation');
  // Loop over them and prevent submission
  var validation = Array.prototype.filter.call(forms, function(form) {
    form.addEventListener('submit', function(event) {
      if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  });

  tinymce.init({ selector:'.description' });
  
});

</script>


@endsection
