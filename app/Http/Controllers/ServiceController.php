<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class serviceController extends Controller
{

    public function showEditar($service) {

        $servicio = Servicio::find($service);

        return view('service.editar', compact('servicio'));
    }

    public function showServi(){

        $services = Servicio::orderBy('id', 'desc')->paginate();
        return view('service.showService', compact('services'));
    }

    public function gestionJobs(){
        if (Auth::check()){

            $services = Servicio::orderBy('id', 'desc')->paginate();

            return view('service.gestionJobs', compact('services'));
        }
        return redirect('/home');
    }

    public function update (Servicio $servicio, Request $request) {

        $servicio->titulo = $request->titulo;
        $servicio->tipoServicio = $request->tipoServicio;
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

    public function saveService(Request $request) {
        $service = new Servicio();

        $service->titulo = $request->titulo;
        $service->tipoServicio = $request->tipoServicio;
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
        }else{
            return "no se selecciono ninguna imagen";
        }

        return Redirect('/gestionJobs');
    }

    public function destroy (Servicio $servicio) {

        $rutaArchivo = storage_path("app/public/assets/img/servicioImagenes/{$servicio->id}.jpg");

        if (File::exists($rutaArchivo)) {
            File::delete($rutaArchivo);

            $servicio->delete();

        } else {
            return "Esto no sirve.";
        }

        return redirect()->route('gestionJobs', $servicio);
    }
}
