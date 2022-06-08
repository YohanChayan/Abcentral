@extends('layouts.app')

@section('content')

<div class="container">
    @if(Auth::check())
        @if (session('message'))
            <div class="alert alert-success">
                <h2>{{ session('message') }}</h2>

            </div>
        @endif

        <form action="{{route('libros.update', $book->id)}}" method="post" enctype="multipart/form-data" class="col-12">
          @method('PUT')
            <div class="row">
                <div class="col">
                    @csrf
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <br>

                    </div>
                    <br>
                    <div class="row g-3 align-items-center">
                        <div class="col-md-4">
                            <label for="num_adquisicion">Número de adquisicion o inventario</label>
                            <input type="number" class="form-control" id="num_adquisicion" name="num_adquisicion" value="{{$book->num_adquisicion}}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="titulo">Titulo</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" value="{{$book->titulo}}" required>
                        </div>

                        <div class="col-md-4">
                            <label for="autor">Autor</label>
                            <input type="text" class="form-control" id="autor" name="autor" value="{{$book->autor}}" required>
                        </div>
                    </div>

                    <div class="row g-3 align-items-center">

                        <div class="col-md-4">
                            <label for="editorial">Editorial</label>
                            <input type="text" class="form-control" id="editorial" name="editorial" value="{{$book->editorial}}" required>
                        </div>

                        <div class="col-md-4">
                            <label for="pais">Pais</label>
                            <input type="text" class="form-control" id="pais" name="pais" value="{{$book->pais}}" required>
                        </div>

                        <div class="col-md-4">
                            <label for="anio">Año</label>
                            <input type="text" class="form-control" id="anio" name="anio" value="{{$book->anio}}" required>
                        </div>
                  </div>

                  <div class="row g-3 align-items-center">

                      <div class="col-md-4">
                          <label for="num_paginas">Numero de paginas</label>
                          <input type="text" class="form-control" id="num_paginas" name="num_paginas" value="{{$book->num_paginas}}" required>
                      </div>

                      <div class="col-md-4">
                          <label for="procedencia">Procedencia</label>
                          <input type="text" class="form-control" id="procedencia" name="procedencia" value="{{$book->procedencia}}" required>
                      </div>

                      <div class="col-md-4">
                          <label for="clasificacion">Clasificacion</label>
                          <input type="text" class="form-control" id="clasificacion" name="clasificacion" value="{{$book->clasificacion}}" required>
                      </div>
                </div>

                <div class="row g-3 align-items-center">

                    <div class="col-md-4">
                        <label for="ubicacion">Ubicacion</label>
                        <input type="text" class="form-control" id="ubicacion" name="ubicacion" value="{{$book->ubicacion}}" required>
                    </div>

                    <div class="col-md-4">
                        <label for="codigo">Codigo de barras</label>
                        <input type="text" class="form-control" id="codigo" name="codigo" value="{{$book->codigo}}" required>
                    </div>

                    <!-- <div class="col-md-4">
                        <label for="fechaDeRegistro">fechaDeRegistro</label>
                        <input type="date" class="form-control" id="fechaDeRegistro" name="fechaDeRegistro" value="{{$book->fechaDeRegistro}}" required>
                    </div> -->
              </div>

              <div class="row g-3 align-items-center">
                	<div class="col-md-6">
                    		<a href="{{ route('dashboard') }}" class="btn btn-danger">Cancelar</a>
                    		<button type="submit" class="btn btn-success">Actualizar datos</button>
                	</div>
            	</div>

          </form>

    @else
        El periodo de Registro de Proyectos a terminado
    @endif

</div>

@endsection
