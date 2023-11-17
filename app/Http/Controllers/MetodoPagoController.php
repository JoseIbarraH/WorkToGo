<?php

namespace App\Http\Controllers;

use App\Models\Metodo_pago;
use App\Models\Servicio;
use Illuminate\Http\Request;

class MetodoPagoController extends Controller
{
    
    public function nuevoMetodoPago(Request $request){
        $metodo = new Metodo_pago();

        $metodo->numeroTarjeta = $request->inputNumero;
        $metodo->nombreTitular = $request->inputNombre;
        $metodo->mes = $request->mes;
        $metodo->año = $request->year;
        $metodo->ccv = $request->inputCCV;
        $metodo->id_usuario = auth()->user()->id;

        $metodo->save(); 

        return back()->with("Nuevo metodo de pago agregado correctamente");
    }


    public function destroy(Metodo_pago $metodo_pago){
        $metodo_pago->delete();
        return back()->with("Se elimino correctamente");
    }
}
