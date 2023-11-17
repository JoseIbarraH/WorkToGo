<?php

namespace App\Http\Controllers;

use App\Models\Postula;
use App\Models\Servicio;
use App\Models\Trabajador;
use App\Models\User;
use App\Models\Reporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class serviceController extends Controller
{

    public function showEditar($service)
    {
        $servicio = Servicio::find($service);
        return view('service.editar', compact('servicio'));
    }

    public function showServi()
    {
        $services = Servicio::orderBy('id', 'desc')->paginate();
        return view('service.showService', compact('services'));
    }

    public function gestionJobs()
    {
        if (Auth::check()) {

            $services = Servicio::orderBy('id', 'desc')->paginate();

            return view('service.gestionJobs', compact('services'));
        }
        return redirect('/home');
    }

    public function solicitudes()
    {
        $services = Servicio::orderBy('id', 'desc')->paginate();
        $result = DB::table('users')
            ->join('trabajadors as tr', 'users.id', '=', 'tr.id_usuario')
            ->join('postulas as po', 'tr.CodigoTrabajador', '=', 'po.id_trabajador')
            ->join('servicios as se', 'po.id_servicio', '=', 'se.id')
            ->select('users.nombre', 'tr.CodigoTrabajador', 'po.sugerido', 'users.id as id_usuario', 'se.id as idservices', 'po.id_servicio', 'se.costo', 'po.estado', 'users.celular')
            ->get();
        /* return $result; */
        return view('service.solicitudes', compact('services', 'result'));
    }

    public function showpendientes (){

        $services = Servicio::orderBy('id', 'desc')->paginate();
        $result = DB::table('users')
            ->join('trabajadors as tr', 'users.id', '=', 'tr.id_usuario')
            ->join('postulas as po', 'tr.CodigoTrabajador', '=', 'po.id_trabajador')
            ->join('servicios as se', 'po.id_servicio', '=', 'se.id')
            ->select('se.titulo', 'se.id_usuario as service_user_id', 'tr.CodigoTrabajador', 'po.sugerido', 'users.id as id_usuario', 'se.id as id_services', 'po.id_servicio', 'se.costo', 'po.estado', 'users.celular', 'se.descripcion')
            ->get();

        
        return view('service.pendientes', compact('services', 'result'));
    }


    public function update(Servicio $servicio, Request $request)
    {

        $servicio->titulo = $request->titulo;
        $servicio->tipoServicio = $request->tipoServicio;
        $servicio->direccion = $request->direccion;
        $servicio->descripcion = $request->descripcion;
        $servicio->costo = $request->costo;
        $servicio->id_usuario = $request->id_usuario;

        $rutaArchivo = storage_path("app/public/assets/img/servicioImagenes/{$servicio->id}.jpg");

        if ($request->hasFile('imagen')) {

            if (File::exists($rutaArchivo)) {
                File::delete($rutaArchivo);

                $servicio->delete();

            } else {
                return "Esto no sirve.";
            }

            // Obtiene el archivo de la solicitud
            $imagen = $request->file('imagen');

            // Genera un nombre único para la imagen
            $nombreImagen = $servicio->id . '.jpg';

            // Almacena la imagen en la carpeta "imagenes" dentro del disco público (puedes cambiar el nombre de la carpeta)
            Storage::disk('public')->put('assets/img/servicioImagenes/' . $nombreImagen, File::get($imagen));
        }

        $servicio->save();

        return redirect()->route('gestionJobs', $servicio);
    }

    public function saveService(Request $request)
    {
        $service = new Servicio();

        $service->titulo = $request->titulo;
        $service->tipoServicio = $request->tipoServicio;
        $service->direccion = $request->direccion;
        $service->descripcion = $request->descripcion;
        $service->costo = $request->costo;
        $service->id_usuario = $request->id_usuario;

        $service->save();

        if ($request->hasFile('imagen')) {

            // Obtiene el archivo de la solicitud
            $imagen = $request->file('imagen');

            // Genera un nombre único para la imagen
            $nombreImagen = $service->id . '.jpg';

            // Almacena la imagen en la carpeta "imagenes" dentro del disco público (puedes cambiar el nombre de la carpeta)
            Storage::disk('public')->put('assets/img/servicioImagenes/' . $nombreImagen, File::get($imagen));
        } else {
            return Redirect('/gestionJobs')->with("Seleccione una imagen");
        }

        return Redirect('/gestionJobs')->with("Se crear con exito el servicio");
    }

    public function destroy(Servicio $servicio)
    {
        $rutaArchivo = storage_path("app/public/assets/img/servicioImagenes/{$servicio->id}.jpg");
        if (File::exists($rutaArchivo)) {
            File::delete($rutaArchivo);
            $servicio->delete();
        } else {
            $servicio->delete();
        }
        return redirect()->route('gestionJobs', $servicio);
    }

    public function acceptJob($id, $CodigoTrabajador)
    {

        $sqlservicio = DB::table('servicios')
            ->where('id', $id)
            ->update(['estado' => 'Pendiente']);
        $sqlpostu = DB::table('postulas')
        ->where('id_trabajador', $CodigoTrabajador)
        ->where('id_servicio', $id)
        ->update(['estado'=> 'Pendiente']);

        return redirect('/gestionJobs/solicitudes')->with('Aceptado con exito');
    }
    public function terminar($id, $CodigoTrabajador)
    {

        $sqlservicio = DB::table('servicios')
            ->where('id', $id)
            ->update(['estado' => 'Inactivo']);

        $sqlservicio = DB::table('postulas')
            ->where('id_trabajador', $CodigoTrabajador)
            ->where('id_servicio', $id)
            ->update(['estado' => 'Inactivo']);

        /* return "id: ".$id." codigoTrabajador: ".$CodigoTrabajador; */
        return redirect('/gestionJobs/solicitudes')->with('Terminado con exito');
    }

    public function reportar(Request $request){
        $report = new Reporte();
        $report->titulo = $request->input('titulo');
        $report->descripcion = $request->input('descripcion');
        $report->id_usuario = auth()->user()->id;
        $report->id_servicio = $request->input('servicio');
        $report->fechaCreacion = date('Y-m-d H:i:s');
        $report->estado = 'Activo';


        $report->save();

        return redirect()->back()->with('Reporte realizado con exito');
    }
}
