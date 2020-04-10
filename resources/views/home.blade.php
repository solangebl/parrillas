@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul class="list-unstyled">
						<li><a href="{{ route('categories.index') }}"><i class="fe fe-tag"></i> Categorías</a></li>
						<li><a href="{{ route('providers.index') }}"><i class="fe fe-truck"></i> Proveedores</a></li>
						<li><a href="{{ route('deposits.index') }}"><i class="fe fe-package"></i> Depósitos</a></li>
						<li><a href="{{ route('products.index') }}"><i class="fe fe-shopping-cart"></i> Productos</a></li>
					</ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
