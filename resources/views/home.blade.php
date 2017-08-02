@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Panel Administrativo</div>

                <!-- https://github.com/avinashn/Ajax-CRUD-example-in-laravel -->

                <div class="panel-body">
                    <p>
                        <span class="glyphicon glyphicon-stats"></span>
                        <span id="products-total">
                            {{ $products->total() }} Registros  |  Pág. {{ $products->currentPage() }} De {{ $products->lastPage() }}
                        </span>

                        <a href="{{ route('test') }}" class="btn btn-success">Probar</a>
                    </p>

                    <div class="alert alert-info" id="alert"></div>

                    <table class="table table-hover table-striped">
                        <thead>
                            <th width="20">#</th>
                            <th class="text-center">Nombre Del Producto</th>
                            <th>&nbsp;</th>
                        </thead>

                        <tbody>
                            @foreach($products as $item)
                                <tr data-id="{{ $item->id }}">
                                    <td width="20">{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>

                                        <button type="button" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#myModal">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </button>


                                        {!! Form::open(['route' => ['destroyProduct', $item->id], 'method' => 'DELETE', 'class' => 'pull-right']) !!}
                                            <a href="#" title="Eliminar {{ $item->name }}" class="btn btn-danger btn-delete">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </a>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {!! $products->render() !!}

                </div>

                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                      </div>
                      <div class="modal-body">
                        ...
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
