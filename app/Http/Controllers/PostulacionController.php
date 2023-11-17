<?php

namespace App\Http\Controllers;

use App\Models\Postula;
use App\Models\Servicio;
use App\Models\Trabajador;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class PostulacionController extends Controller
{
    /* public function show($service){
        $servicio = Servicio::find($service);
        $usuario = DB::select('select * from users where id = ?', [$servicio->id_usuario]);
        return view('service.postularse',compact('servicio','usuario'));
    } */

    public function show($service){
        $servicio = Servicio::find($service);
        if (!$servicio) {
            return abort(404);
        }
        $usuario = User::find($servicio->id_usuario);
    
        return view('service.postularse', compact('servicio', 'usuario'));
    }

    public function postu($servicio, Request $request) {
        $serviJob = new Postula();
        $userId = auth()->user()->id;
        $trabajador = Trabajador::where('id_usuario', $userId)->first();
        if (!$trabajador) {
            return abort(404, 'Trabajador no encontrado');
        }
        $servicio = Servicio::find($servicio);
        if (!$servicio) {
            return abort(404, 'Servicio no encontrado');
        }
        $sugerido = $request->input('costo');
        $idtrabajador = $trabajador->codigoTrabajador;
        $idservicio = $servicio->id;
        if ($sugerido === 0){
            Postula::create(['id_trabajador' => $idtrabajador, 'id_servicio' => $idservicio,]);
            return redirect('/service');
        }

        Postula::create(['id_trabajador' => $idtrabajador, 'id_servicio' => $idservicio, 'sugerido' => $sugerido]);
        return redirect('/service');   
    }
}
