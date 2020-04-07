@extends('layouts.app')

@section('content')
<div class="page-header">
  <h1 class="page-title">
  Nuevo Proyecto
  </h1>
</div>
<div class="row">
    <div class="col-md-12 col-md-offset-1">
        <!--div class="panel panel-default"-->
        @include('parts.errors')

            <div class="panel-body">
              <form action="{{ route('projects.store') }}" class="needs-validation" novalidate method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <fieldset>
                <div class='row'>
                  	<div class='col-md-4 col-sm-12'>
						<div class='form-group'>
						<label for="client_id">Cliente</label>
						<select class="form-control" required name="client_id" id="client_id">
							<option value="">Seleccione un cliente</option>
							@foreach($clients as $client)
							<option value="{{ $client->id }}" {{(old('client_id')==$client->id) ? 'selected' : ''}}>{{ $client->name }}</option>
							@endforeach
						</select>
						</div>
                  	</div>
                  	<div class='col-md-4 col-sm-12'>    
						<div class='form-group'>
              <label for="categories">Categorías</label>
							<select class="form-control" required name="categories[]" id="categories" multiple="multiple">
								<option value="">Seleccione las categorías</option>
								@foreach($categories as $category)
								<option value="{{ $category->id }}" {{is_array(old('categories')) && in_array($category->id, old('categories')) ? 'selected' : ''}}>{{ $category->name_es }}</option>
								@endforeach
							</select>
						</div>
                	</div>
				</div>

                <div class="row">
                  <div class='col-md-4 col-sm-12'>
                    <div class='form-group'>
                      <label for="text">Descripción en español</label>
                      <textarea class="form-control description" id="description_es" name="description_es" size="30" rows="10" maxlength="500">{{old('description_es')}}</textarea>
                    </div>
                  </div>
                  <div class='col-md-4 col-sm-12'>
                    <div class='form-group'>
                      <label for="description_en">Descripción en inglés</label>
                      <textarea class="form-control description" id="description_en" name="description_en" size="30" rows="10" maxlength="200">{{old('description_en')}}</textarea>
                    </div>
                  </div>
				</div>

				<div class="row">
                  <div class='col-md-4 col-sm-12'>
                    <div class='form-group'>
                      <label for="comments">Descripción en francés</label>
                      <textarea class="form-control description" id="description_fr" name="description_fr" size="30" rows="10" maxlength="200">{{old('description_fr')}}</textarea>
                    </div>
                  </div>
				  <div class='col-md-4 col-sm-12'>
                    <div class='form-group'>
                      <label for="comments">Descripción en portugués</label>
                      <textarea class="form-control description" id="description_pt" name="description_pt" size="30" rows="10" maxlength="200">{{old('description_pt')}}</textarea>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class='col-md-4 col-sm-12'>
                    <div class='form-group image-group'>
                      <label for="thumbnail">Thumbnail</label>
                      <input type="file" class="form-control" id="" name="thumbnail" required>
                    </div>
                  </div>
                  <div class='col-md-4 col-sm-12'>
                    <div class='form-group image-group'>
                      <label for="images[]">Imagenes</label>
                      <input type="file" class="form-control" id="" name="images[]" multiple>
                    </div>
                  </div>
                </div>
                
              </fieldset>
              <button type="submit" class="btn btn-primary">
                <i class="fe fe-file-plus mr-2"></i> Guardar
              </button>
              <a class="btn btn-danger" href="{{ route('projects.index') }}"><i class="fe fe-rewind mr-2"></i> Cancelar</a>
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
