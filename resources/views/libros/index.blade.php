@extends('layouts.app')

@section('content')

<div class="container-fluid">
      @if (session('message'))
          <div class="alert alert-success">
              {{ session('message') }}
          </div>
      @endif

      <p>
          @if(Auth::Check())
              <a href="{{ route('dashboard') }}" class="btn btn-primary">< Regresar</a>
          @else
              <a href="{{ route('home') }}" class="btn btn-primary">< Regresar</a>
          @endif
      </p>

      <table id="booksTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                  @if(Auth::check())
                    <th>Acciones</th>
                  @endif
                    <th>Numero de adquisición</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Editorial</th>
                    <th>País</th>
                    <th>Año</th>
                    <th>Número de paginas</th>
                    <th>Procedencia</th>
                    <th>Clasificación</th>
                    <th>Ubicación</th>
		                <th>Código</th>
                    <th>Fecha de Registro</th>

                </tr>
                </thead>
                <tbody>

                </tbody>

            </table>


  </div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/datatables.min.js"></script>

<script type="text/javascript">
    var data = @json($books);

    $(document).ready(function() {
        $('#booksTable').DataTable({
            "data": data,
            "pageLength": 100,
            "order": [
                [0, "desc"]
            ],
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar (filtro):",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "�ltimo",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
            responsive: true,
            // dom: 'Bfrtip',
            dom: '<"col-xs-3"l><"col-xs-5"B><"col-xs-4"f>rtip',
            buttons: [
                'copy', 'excel',
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LETTER',
                }

            ]
        })
       loader(false);
    });
  </script>




@endsection
