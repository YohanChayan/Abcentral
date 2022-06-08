<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      // $books = Libro::limit('500')->get();
      // $vsbooks = $this->cargarDT($books);
      // return view('libros.index')->with('books', $vsbooks);
    }

    function cargarDT($query){
      $books = [];
      foreach ($query as $key => $value) {

       $edit =  route('libros.edit', $value['id']);
       $delete =  route('deletebook', $value['id']);
       $acciones = '';
       if(Auth::check() && Auth::user()->role == 'normal'){
         $acciones = '
             <div class="btn-acciones">
                 <div class="btn-circle">
                     <a href="'.$edit.'" class="btn btn-success" title="Actualizar">
                         <i class="far fa-edit"></i>
                     </a>
                 </div>
             </div>

             <div class="btn-acciones">
                 <div class="btn-circle">
                     <a href="'.$delete.'" class="btn btn-danger"  title="Borrar Prestamo">
                        <i class="fas fa-eraser"></i>
                     </a>
                 </div>
             </div>
         ';
       }

       if(Auth::check()){
         $books[$key] = array(
             $acciones,
              $value['num_adquisicion'],
              $value['titulo'],
              $value['autor'],
              $value['editorial'],
              $value['pais'],
              $value['anio'],
              $value['num_paginas'],
              $value['procedencia'],
              $value['clasificacion'],
              $value['ubicacion'],
              $value['codigo'],
              $value['fechaDeRegistro'],
          );
       }else{
         $books[$key] = array(
             // $acciones,
              $value['num_adquisicion'],
              $value['titulo'],
              $value['autor'],
              $value['editorial'],
              $value['pais'],
              $value['anio'],
              $value['num_paginas'],
              $value['procedencia'],
              $value['clasificacion'],
              $value['ubicacion'],
              $value['codigo'],
              $value['fechaDeRegistro'],
          );
       }

      }
      return $books;
    }

    public function deleteBook($id){
      // dd($id);
      $book = Libro::find($id);

      if($book){

        $book->activo = 0;
        $book->update();

        $NewLog =  new Log();
        $NewLog->tabla = 'Libros';
        $NewLog->movimiento = 'Eliminacion(logica) de libro';
        $NewLog->usuario_id = Auth::user()->id;
        $NewLog->usuario_nombre = Auth::user()->name;
        $NewLog->Acciones = 'Eliminacion';
        $NewLog->num_libro = $book->num_adquisicion;
        $NewLog->fecha_de_accion = date('Y-m-d');
        $NewLog->save();


        return redirect('dashboard')->with(array(
              'message'=>'Libro eliminado completamente'
          ));

      }else {
        return redirect('dashboard')->with(array(
              'message'=>'No se pudo eliminar el libro'
          ));
      }


    }

    public function search(Request $request){
        $validateData = $this->validate($request,[
           'search'=>'required'
           ]);


       $fieldSelected = $request->input('fieldSelected');
       $search = $request->input('search');
       $books = '';


       if(isset($search) && !is_null($search)){

         if($fieldSelected != 'num_adquisicion' && $fieldSelected != 'rango'){
           $books = Libro::where('activo','1')
           ->where($fieldSelected,'LIKE','%'.$search.'%')
           ->get();

         }else if ($fieldSelected == 'num_adquisicion'){ //fecha?
           $books = Libro::where('activo','1')
           ->where($fieldSelected,$search)->get();
         }elseif ($fieldSelected == 'rango') {
           $arrayValues = explode("-", $search);

           $books = Libro::where('activo','1')
           ->whereBetween('num_adquisicion', [$arrayValues[0], $arrayValues[1]])
           ->get();
         }
       }else{
         return redirect('home')->with(array(
               'message'=>'Debe introducir un término de búsqueda'
           ));
       }
       $vsBooks = $this->cargarDT($books);
       $message = 'Libro no encontrado.';
       return view('libros.index')->with('books',$vsBooks);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('libros.create')->with('lastNum_adquisicion');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validateData = $this->validate($request,[
          // 'num_adquisicion'=>'required',
          'autor'=>'required',
          'titulo'=>'required',
          'editorial'=>'required',
          'pais'=>'required',
          'anio'=>'required',
          'num_paginas'=>'required',
          'procedencia'=>'required',
          'clasificacion'=>'required',
          'ubicacion'=>'required',
          'codigo'=>'required',
          // 'fechaDeRegistro'=>'required',
      ]);

      $numAd = $request->input('num_adquisicion');

      $Exist = Libro::where('activo', '1')->
      where('num_adquisicion',$numAd)->first();
      if($Exist){
        return redirect()->route('libros.create')->with(array(
              'message'=>'Numero de adquisicion YA EXISTE'
          ));
      }

      $newBook = new Libro();
      $newBook->num_adquisicion = $numAd;

      $newBook->autor = $request->input('autor');
      $newBook->titulo = $request->input('titulo');
      $newBook->editorial = $request->input('editorial');
      $newBook->pais = $request->input('pais');
      $newBook->anio = $request->input('anio');
      $newBook->num_paginas = $request->input('num_paginas');
      $newBook->procedencia = $request->input('procedencia');
      $newBook->clasificacion = $request->input('clasificacion');
      $newBook->ubicacion = $request->input('ubicacion');

      $newBook->codigo = $request->input('codigo');
      // $newBook->fechaDeRegistro = $request->input('fechaDeRegistro');
      $newBook->fechaDeRegistro = date('Y-m-d');
      $newBook->save();

      $NewLog =  new Log();
      $NewLog->tabla = 'Libros';
      $NewLog->movimiento = 'Creacion de libro';
      $NewLog->usuario_id = Auth::user()->id;
      $NewLog->usuario_nombre = Auth::user()->name;
      $NewLog->num_libro = $newBook->num_adquisicion;
      $NewLog->Acciones = 'Captura';
      $NewLog->fecha_de_accion = date('Y-m-d');
      $NewLog->save();

      $choose = $request->input('newCopy');
      $message = 'Libro creado correctamente, numero de adquisicion: ' . $newBook->num_adquisicion;
      if($choose == 'yes'){
        // return redirect()->route('libros.create')->with('book', $newBook);
        // return redirect()->route('create2',$newBook);

        return view('libros.create')
        ->with('book', $newBook)
        ->with('lastNum_adquisicion',$numAd+1)
        ->with('successMsg', $message);
      }else {
        // $message = 'Libro creado correctamente, numero de adquisicion: ' . $newBook->num_adquisicion;
        // return redirect()->route('libros.create')
        // ->with('lastNum_adquisicion', $numAd+1)
        // ->with(array(
        //       'message'=> $message
        //   ));

        return view('libros.create')
        ->with('lastNum_adquisicion', $numAd+1)
        ->with('successMsg', $message);
      }




      // return redirect()->route('home')->with(array(
      //       'message'=>'Libro capturado correctamente'
      //   ));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function show(Libro $libro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $book = Libro::find($id);
        return view('libros.edit')->with('book', $book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Libro::find($id);
        $book->num_adquisicion = $request->input('num_adquisicion');
        $book->autor = $request->input('autor');
        $book->titulo = $request->input('titulo');
        $book->editorial = $request->input('editorial');
        $book->pais = $request->input('pais');
        $book->anio = $request->input('anio');
        $book->num_paginas = $request->input('num_paginas');
        $book->procedencia = $request->input('procedencia');
        $book->clasificacion = $request->input('clasificacion');
        $book->ubicacion = $request->input('ubicacion');
        $book->codigo = $request->input('codigo');
        $book->fechaDeRegistro = date('Y-m-d');
        $book->update();

        $NewLog =  new Log();
        $NewLog->tabla = 'Libros';
        $NewLog->movimiento = 'Actualizacion de libro';
        $NewLog->usuario_id = Auth::user()->id;
        $NewLog->usuario_nombre = Auth::user()->name;
        $NewLog->num_libro = $book->num_adquisicion;
        $NewLog->Acciones = 'Actualizar';
        $NewLog->fecha_de_accion = date('Y-m-d');
        $NewLog->save();

        return redirect()->route('dashboard')->with(array(
              'message'=>'Libro actualizado correctamente'
          ));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Libro $libro)
    {
        //
    }
}
