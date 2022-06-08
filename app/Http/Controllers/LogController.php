<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogController extends Controller
{

    public function index(){
      $logs = Log::orderBy('fecha_de_accion', 'desc')->get();
      $Logs = $this->cargarDT($logs);
      return view('logs.index')->with('logs',$Logs);
    }

    function cargarDT($query){
      $logs = [];
      foreach ($query as $key => $value) {
       $logs[$key] = array(
            $value['tabla'],
            $value['movimiento'],
            $value['usuario_nombre'],
            $value['num_libro'],
            $value['acciones'],
            $value['fecha_de_accion'],
        );

      }
      return $logs;
    }


}
