@extends('layouts.app')

@section('content')

{{-- @if(Auth::check() && (Auth::user()->role == 'normal')) --}}

<div class="container">
    <div class="row justify-content-center">

    @if (session('message'))
        <div class="alert alert-success">
            <h2>{{ session('message') }}</h2>
        </div>
    @endif
        <div class="col-md-8">

                <div class="container mt-5">

                        <div class="row d-flex justify-content-center">


                            <div class="col-md-10">

                                <div class="card p-3  py-4">

                                    <div class="col-md-5">
                                        <h5>Búsqueda de libros</h5>
                                    </div>

                                    <div class="col-md-auto">
                                        @if(Auth::check() && (Auth::user()->role == 'normal'))
                                            <div class="alert alert-info" role="alert">
                                              Ultimo libro capturado: <strong> {{$lastNum_adquisicion ?? ''}} </strong>
                                            </div>
                                        @endif
                                    </div>



                                    <form action="{{route('searchBook')}} " method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row g-3 mt-2">



                                            <div class="col-md-3">
                                                <select class="form-select btn btn-secondary dropdown-toggle" type="button"  id="fieldSelected" name="fieldSelected">
                                                    <option selected value="num_adquisicion">Número de adquisición o inventario</option>
                                                    <option value="rango">Por rango(-)</option>
                                                    <option value="autor">Autor</option>
                                                    <option value="titulo">Título</option>
                                                    <option value="procedencia">Procedencia</option>
                                                    <option value="codigo">Código de barras</option>
                                                    <option value="fechaDeRegistro">Fecha de registro</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <input type="text" class="form-control" placeholder="Ingrese un campo" name="search" required>
                                            </div>

                                            <div class="col-md-3">
                                                <button class="btn btn-secondary btn-block" type="submit">Buscar</button>
                                            </div>
                                        </div>
                                    </form>


                    </div>
                            </div>
                        </div>
                    </div>


        </div>
    </div>
</div>

{{-- Search styles --}}
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
{{-- @else
    Usted no tiene acceso, por favor contactar al administrativo de CTA.
@endif --}}


@endsection
