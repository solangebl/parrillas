@extends('layouts.app')

@section('content')
<div class="page-header">
  <h1 class="page-title">
  Nuevo Producto
  </h1>
</div>
<div class="row">
    <div class="col-md-12 col-md-offset-1">
        <!--div class="panel panel-default"-->
        @include('parts.errors')

            <div class="panel-body">
              <form action="{{ route('products.store') }}" class="needs-validation" novalidate method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <fieldset>
                <div class='row'>
                  <div class='col-md-6 col-sm-12'>
                    <div class='form-group'>
                      <label for="name">Nombre</label>
                      <input type="text" class="form-control" name="name" id="name" required value={{ old('name') }}>
                    </div>
                  </div>
                  <div class='col-md-6 col-sm-12'>
                    <div class='form-group'>
                      <label for="active">Activo</label>
                      <select class="form-control" required name="active" id="active">
                        <option value="1" selected>Sí</option>
                        <option value="0" >No</option>
                      </select>
                    </div>
                  </div>
				        </div>
                <div class='row'>
                  <div class='col-md-6 col-sm-12'>
                    <div class='form-group'>
                      <label for="provider_id">Proveedor</label>
                      <select class="form-control" required name="provider_id" id="provider_id">
                        <option value="">Seleccione un proveedor</option>
                        @foreach($providers as $provider)
                        <option value="{{ $provider->id }}" {{(old('client_id')==$provider->id) ? 'selected' : ''}}>{{ $provider->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class='col-md-6 col-sm-12'>
                    <div class='form-group'>
                      <label for="deposit_id">Depósito</label>
                      <select class="form-control" required name="deposit_id" id="deposit_id">
                        <option value="">Seleccione un depósito</option>
                        @foreach($deposits as $deposit)
                        <option value="{{ $deposit->id }}" {{(old('deposit_id')==$deposit->id) ? 'selected' : ''}}>{{ $deposit->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
				        </div>

              <div class="row">
                <div class='col-md-6 col-sm-12'>    
                  <div class='form-group'>
                    <label for="categories">Categoría</label>
                    <select class="form-control" required name="category_id" id="category_id" >
                      <option value="">Seleccione la categoría</option>
                      @foreach($categories as $category)
                      <option value="{{ $category->id }}" {{ $category->id==old('category_id') ? 'selected' : ''}}>{{ $category->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class='col-md-6 col-sm-12'>    
                  <div class='form-group'>
                    <label for="categories">Subcategoría</label>
                    <select class="form-control" name="subcategory_id" id="subcategory_id" >
                      <option value="">Seleccione una subcategoría</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class='row'>
                <div class='col-md-3 col-sm-12'>
                  <div class='form-group'>
                    <label for="name">Precio Compra</label>
                    <input type="number" class="form-control" name="buy_price" id="buy_price" value={{ old('buy_price') }}>
                  </div>
                </div>
                <div class='col-md-3 col-sm-12'>
                  <div class='form-group'>
                    <label for="sale_price">Precio Venta</label>
                    <input type="number" class="form-control" name="sale_price" id="sale_price" required value={{ old('sale_price') }}>
                  </div>
                </div>
                <div class='col-md-3 col-sm-12'>
                  <div class='form-group'>
                    <label for="sale_price_ml">Precio ML</label>
                    <input type="number" class="form-control" name="sale_price_ml" id="sale_price_ml" value={{ old('sale_price_ml') }}>
                  </div>
                </div>
                <div class='col-md-3 col-sm-12'>
                  <div class='form-group'>
                    <label for="amount">Cantidad</label>
                    <input type="number" class="form-control" name="amount" id="amount" value={{ old('amount') }}>
                  </div>
                </div>
              </div>

                <div class="row">
                  <div class='col-md-6 col-sm-12'>
                    <div class='form-group'>
                      <label for="text">Descripción</label>
                      <textarea class="form-control description" id="description" name="description" size="30" rows="10" maxlength="500">{{old('description')}}</textarea>
                    </div>
                  </div>
                  <div class='col-md-6 col-sm-12'>
                    <div class='form-group'>
                      <label for="text">Notas</label>
                      <textarea class="form-control other" id="other" name="other" size="30" rows="10" maxlength="500">{{old('other')}}</textarea>
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
                      <input type="file" class="form-control" id="" required name="images[]" multiple>
                    </div>
                  </div>
                </div>
                
              </fieldset>
              <button type="submit" class="btn btn-primary">
                <i class="fe fe-file-plus mr-2"></i> Guardar
              </button>
              <a class="btn btn-danger" href="{{ route('products.index') }}"><i class="fe fe-rewind mr-2"></i> Cancelar</a>
            </form>
            </div>
        <!--/div-->
      </div>
    </div>
    @endsection

@section('script')

<script>

var categories = @json($categories);

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
  
  tinymce.init({ selector:'.description'});
  tinymce.init({ selector:'.other' });
  $('#category_id').on('change', function(){ loadSubcats( $('#category_id'), $('#subcategory_id'), categories ) });
  
});

</script>


@endsection