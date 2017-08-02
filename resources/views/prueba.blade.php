<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>LARAJAX</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>

	<div class="container">
		<div class="col-md-2"></div>


		<div class="col-md-8">
			<div class="row">
				<div class="page-header">
					<h1 class="text-center text-primary">CRUD Usando LARAVEL y AJAX</h1>
				</div>

				<div class="row">

					<div class="panel panel-default">
						<div class="panel-heading">Sistema De Admón</div>

						<div class="panel-body">
							<p>
			                    <span class="glyphicon glyphicon-stats"></span>
			                    <span id="products-total">
			                        {{ $products->total() }} Registros  |  Pág. {{ $products->currentPage() }} De {{ $products->lastPage() }}
			                    </span>
			                </p>

		                    <div class="alert alert-info" id="alert"></div>

		                    <a href="#" class="btn btn-primary" title="Nuevo Producto" data-toggle="modal" data-target="#modalCreate">
		                    	<span class="glyphicon glyphicon-plus-sign"> </span> Agregar
		                    </a>
						</div>
					</div>

					<table class="table table-hover table-striped table-bordered">
						<thead>
							<th>#</th>
							<th>Nombre</th>
							<th>Opciones</th>
						</thead>

						<tbody>
							@foreach($products as $prod)
								<tr data-id="{{ $prod->id }}">
									<td width="20">{{ $prod->id }}</td>
									<td>{{ $prod->name }}</td>
						
									<td class="text-center">
										{!! Form::open(['route' => ['viewProduct', $prod->id], 'method' => 'POST', 'class' => 'pull-left']) !!}
											<a href="#" title="Ver {{ $prod->name }}" class="btn btn-default btn-view" data-toggle="modal" data-target="#modalView">
												<span class="glyphicon glyphicon-eye-open"></span>
											</a>
										{!! Form::close() !!}

										<span class="pull-left">&nbsp;&nbsp;&nbsp;</span>

									    {!! Form::open(['route' => ['editProduct', $prod->id], 'method' => 'POST', 'class' => 'pull-left']) !!}
											<a href="#" title="Editar {{ $prod->name }}" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#myModal">
												<span class="glyphicon glyphicon-pencil"></span>
											</a>
										{!! Form::close() !!}


										<span class="pull-left">&nbsp;&nbsp;&nbsp;</span>

										{!! Form::open(['route' => ['destroyProduct', $prod->id], 'method' => 'DELETE', 'class' => 'pull-left']) !!}
	                                        <a href="#" title="Eliminar {{ $prod->name }}" class="btn btn-danger btn-delete">
	                                            <span class="glyphicon glyphicon-trash"></span>
	                                        </a>
	                                    {!! Form::close() !!}


	                               
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>

					<div class="table-responsive text-center">
						{!! $products->render() !!}
					</div>


					<!-- MODAL EDITAR -->
			
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title text-center text-capitalize text-primary" id="myModalLabel">
					        	<span id="product-name"></span>
					        </h4>
					      </div>
					      <div class="modal-body">
					        {!! Form::Open(['id' => 'form-update']) !!}
					        	<div class="form-group">
					        		{!! form::label('name', 'Producto') !!}
					        		{!! form::text('name', null, ['class' => 'form-control', 'id' => 'productName']) !!}
					        	</div>

					        	<div class="form-group">
					        		{!! form::label('short', 'Descripción Breve') !!}
					        		{!! form::text('short', null, ['class' => 'form-control', 'id' => 'productShort']) !!}
					        	</div>

					        	<div class="form-group">
					        		{!! form::label('description', 'Descripción Completa') !!}
					        		{!! form::textarea('description', null, ['class' => 'form-control', 'id' => 'productDescription']) !!}

					        		{!! form::hidden('id-product', null, ['id' => 'id-product']) !!}
					        	</div>
					      </div>

					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					        {!! form::submit('Actualizar Datos', ['class' => 'btn btn-primary', 'id' => 'btn-update']) !!}
					      </div>
					      {!! Form::Close() !!}
					    </div>
					  </div>
					</div>

					
					<!-- MODAL VISTA -->

					<div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title text-center text-primary" id="myModalLabel">
					        	<span id="productoName"></span>
					        </h4>
					      </div>
					      <div class="modal-body">
					      	<div class="form-group">
					      		<label class="control-label">Descripción Breve: </label>
					      		<p id="shortProduct" class="text-justify" style="padding: 25px 25px;"></p>
					      	</div>

					      	<div class="form-group">
					      		<label class="control-label">Descripción Completa: </label>
					      		<p id="desProduct" class="text-justify" style="padding: 25px 25px;"></p>
					      	</div>

					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					      </div>
					    </div>
					  </div>
					</div>


					<!-- MODAL CREAR -->

					<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title text-primary text-center" id="myModalLabel">Agregar Nuevo Producto</h4>
					      </div>
					      <div class="modal-body">
					        {!! Form::Open(['route' => 'storageProduct', 'method' => 'POST', 'id' => 'form-create']) !!}
					        	<div class="form-group" style="padding: 10px 20px;">
					        		{!! form::label('name', 'Producto', ['class' => 'control-label']) !!}
					        		{!! form::text('name', null, ['class' => 'form-control']) !!}
					        	</div>

					        	<div class="form-group" style="padding: 0 20px;">
					        		{!! form::label('short', 'Descripción Breve', ['class' => 'control-label']) !!}
					        		{!! form::text('short', null, ['class' => 'form-control']) !!}
					        	</div>

					        	<div class="form-group" style="padding: 10px 20px;">
					        		{!! form::label('description', 'Descripción', ['class' => 'control-label']) !!}
					        		{!! form::textarea('description', null, ['class' => 'form-control']) !!}
					        	</div>

					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					        	{!! form::submit('Almacenar', ['class' => 'btn btn-primary', 'id' => 'btn-create']) !!}

					        {!! Form::Close() !!}
					      </div>
					    </div>
					  </div>
					</div>

				</div>
			</div>
		</div>
		<div class="col-md-2"></div>	
	</div>



	<script src="{{ asset('js/jquery.js') }}"></script>
    <!--script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>