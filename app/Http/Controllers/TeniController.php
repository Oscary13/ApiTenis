<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teni;
use Carbon\Carbon;
class TeniController extends Controller
{
    public function index()
    {
        $datisTeni = Teni::all();
        return response()->json($datisTeni);
    }

    public function guardarTeni(Request $request)
    {

        $datosTeni = new Teni();
        if ($request->hasFile('imagen')) {
            $nombreArchivoOriginal = $request->file('imagen')->getClientOriginalName();
            $nuevoNombre = Carbon::now()->timestamp . "_" . $nombreArchivoOriginal;

            $carpetaDestino = './upload/';
            $request->file('imagen')->move($carpetaDestino, $nuevoNombre);

            $datosTeni->marca = $request->marca;
            $datosTeni->modelo = $request->modelo;
            $datosTeni->color = $request->color;
            $datosTeni->talla = $request->talla;
            $datosTeni->precio = $request->precio;
            $datosTeni->imagen = ltrim($carpetaDestino,'.').$nuevoNombre;


            $datosTeni->save();
        }
        return response()->json($nuevoNombre);
    }

    public function verTeni($id){
        $datosTeni= new Teni();
        $datosEncontrados=$datosTeni->find($id);
        return response()->json($datosEncontrados);

    }

    public function eliminarTeni($id){
        $datosTeni= Teni::find($id);
        if ($datosTeni) {
            $rutaArchivo= base_path('public').$datosTeni->imagen;
            if (file_exists($rutaArchivo)) {
                unlink($rutaArchivo);
            }
            $datosTeni->delete();
        }

        return response()->json("Registro Botrrado");
    }

    public function actualizarTeni(Request $request,$id){
        $datosTeni= Teni::find($id);


        if ($request->hasFile('imagen')) {
            if ($datosTeni) {
                $rutaArchivo= base_path('public').$datosTeni->imagen;
                if (file_exists($rutaArchivo)) {
                    unlink($rutaArchivo);
                }
                $datosTeni->delete();
            }

            $nombreArchivoOriginal = $request->file('imagen')->getClientOriginalName();
            $nuevoNombre = Carbon::now()->timestamp . "_" . $nombreArchivoOriginal;

            $carpetaDestino = './upload/';
            $request->file('imagen')->move($carpetaDestino, $nuevoNombre);

            $datosTeni->imagen = ltrim($carpetaDestino,'.').$nuevoNombre;
            $datosTeni->save();
        }

        if ($request->input('marca')) {
            $datosTeni->marca=$request->input('marca');
        }
        if ($request->input('modelo')) {
            $datosTeni->modelo=$request->input('modelo');
        }
        if ($request->input('color')) {
            $datosTeni->color=$request->input('color');
        }
        if ($request->input('talla')) {
            $datosTeni->talla=$request->input('talla');
        }
        if ($request->input('precio')) {
            $datosTeni->precio=$request->input('precio');
        }

        $datosTeni->save();
        return response()->json("Datos Actualizados");
    }
}
