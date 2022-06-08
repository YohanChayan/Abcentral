@extends('layouts.app')

@section('content')

<style>
.card_background{
    background: linear-gradient(0deg, rgba(140,143,130,0) 0%, rgba(217,217,217,1) 0%, rgba(180,195,218,0) 100%, rgba(246,246,246,1) 100%);
}

.my_background_body{
    margin-top: -20px;
    width: 100%;
    height: 100%;
    /* background: linear-gradient(0deg, rgba(140,143,130,0) 0%, rgba(60,130,236,1) 1%, rgba(217,217,217,1) 73%, rgba(246,246,246,1) 100%, rgba(180,195,218,0) 100%); */
    background: radial-gradient(circle, rgba(150,205,228,1) 10%, rgba(53,141,201,1) 81%, rgba(61,87,156,0.6629026610644257) 100%);
    /* background-attachment: fixed;
    background-repeat: no-repeat; */

}

.my_margin{
    margin-top: 50px;
}


</style>
{{-- @if(Auth::check() && (Auth::user()->role == 'normal')) --}}

<div class="my_background_body">


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

                                <div class="card p-4  py-4 card_background" >

                                <div style="width:100%; text-align:center">
                                    <h3>Búsqueda de libros</h3>
                                    <img class="card-img-top" src="{{asset('img/ad.jpg')}}" alt="Card image cap" style="width:35%; height: 35%;" >
                                </div>

                                    <div class="col-md-5">

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
                                                    <option value="ubicacion">Ubicación</option>
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

                                <div style="margin-top: 10em;"></div>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
</div>

</div>

<footer class="text-center text-lg-start text-white my_footer" style="background-color: #45526e">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
      <!-- Section: Links -->
      <section class="">
        <!--Grid row-->
        <div class="row">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
            <img src="img/cta_logo.jpg" alt="cta_logo" style="width: 160%; height: 100%; margin-left: -9em; ">
          </div>

          <hr class="w-100 clearfix d-md-none" />

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3" >
          <br>
            <h6 class="text-uppercase mb-4 font-weight-bold">Contacto</h6>
            {{-- <p><i class="fas fa-home mr-3"></i> Cucsh Belenes</p> --}}
            <p><i class="fas fa-envelope mr-3"></i> cta.cucsh@administrativos.udg.mx</p>
            <p><i class="fas fa-phone mr-3"></i> +52 33 3819 3300 ext: 23609</p>
            {{-- <p><i class="fas fa-print mr-3"></i> + 01 234 567 89</p> --}}
          </div>
          <!-- Grid column -->
        </div>
        <!--Grid row-->
      </section>
      <!-- Section: Links -->

      <hr class="my-3">

      <!-- Section: Copyright -->
      <section class="p-3 pt-0">
        <div class="row d-flex align-items-center">
          <!-- Grid column -->
          <div class="col-md-7 col-lg-8 text-center text-md-start">
            <!-- Copyright -->
            <div class="p-3">
              Coordinación de Tecnologias para el Aprendizaje - Universidad de Guadalajara

            </div>
            <!-- Copyright -->
          </div>
          <!-- Grid column -->

          <!-- Grid column -->

          <!-- Grid column -->
        </div>
      </section>
      <!-- Section: Copyright -->
    </div>
    <!-- Grid container -->
  </footer>

{{-- Search resources --}}
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
{{-- @else
    Usted no tiene acceso, por favor contactar al administrativo de CTA.
@endif --}}


@endsection
