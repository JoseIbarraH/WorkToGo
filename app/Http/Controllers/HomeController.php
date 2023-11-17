<?php

namespace App\Http\Controllers;

use App\Models\Metodo_pago;
use App\Models\postulacion;
use App\Models\Servicio;
use App\Models\User;
use App\Models\pqr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function showpqr(){
        return view('home.pqrs');
    }

    public function perfil()
    {
        $metodo = Metodo_pago::orderBY('id','desc')->paginate();

        return view('home.perfil', compact('metodo'));
    }

    public function history()
    {
        $services = Servicio::orderBy('id', 'desc')->paginate();
        
        $result = DB::table('users')
            ->join('trabajadors as tr', 'users.id', '=', 'tr.id_usuario')
            ->join('postulas as po', 'tr.CodigoTrabajador', '=', 'po.id_trabajador')
            ->join('servicios as se', 'po.id_servicio', '=', 'se.id')
            ->select('users.nombre', 'tr.CodigoTrabajador', 'po.sugerido', 'users.id as id_usuario', 'se.id as idservices', 'po.id_servicio', 'se.costo', 'po.estado', 'users.celular')
            ->get();

        return view('home.historial', compact('services','result'));
    }

    public function postulacion()
    {
        return view('home.postulacion');
    }
    public function pqrs()
    {
        return view('home.pqrs');
    }

    public function update(Request $request)
    {

        $user = Auth::user();
        $id = $user->id;
        $email = $user->email;
        $password = $user->password;
        $cedula = $user->cedula;

        if ($request->password_actual != "") {
            $newpass = $request->password_nueva;
            $conpass = $request->password_confirmar;
            $nombre = $request->nombre;
            $celular = $request->celular;
            $username = $request->username;

            if (Hash::check($request->password_actual, $password)) {

                if ($newpass == $conpass) {

                    if (strlen($newpass) >= 8) {
                        $user->password = Hash::make($request->password_nueva);
                        $sqlBD = DB::table("users")
                            ->where('id', $user->id)
                            ->update(['password' => $user->password]);

                        $sqlBD2 = DB::table("users")
                            ->where('id', $user->id)
                            ->update(['nombre' => $user->nombre]);

                        $sqlBD3 = DB::table("users")
                            ->where('id', $user->id)
                            ->update(['username' => $user->username]);

                        $sqlBD4 = DB::table("users")
                            ->where('id', $user->id)
                            ->update(['celular' => $user->celular]);

                        return redirect()->back()->with('updateClave', 'La clave fue cambiada correctamente.');
                    } else {
                        return redirect()->back()->with('clavemenor', 'Recuerde la clave debe ser mayor a 8 digitos.');
                    }
                } else {
                    return redirect()->back()->with('claveIncorrecta', 'Por favor verifique las claves no coinciden');
                }
            } else {
                return redirect()->back()->with(['password_Actual' => 'La clave no coincide']);
            }
        } else {
            $nombre = $request->nombre;
            $celular = $request->celular;
            $username = $request->username;

            $sqlUpdate2 = DB::table('users')
                ->where('id', $user->id)
                ->update(['nombre' => $nombre]);

            $sqlUpdate3 = DB::table('users')
                ->where('id', $user->id)
                ->update(['username' => $username]);

            $sqlUpdate4 = DB::table('users')
                ->where('id', $user->id)
                ->update(['celular' => $celular]);


            $rutaArchivo = storage_path("app/public/assets/img/perfilImagenes/{$user->id}.jpg");

            if ($request->hasFile('imagen')) {

                if (File::exists($rutaArchivo)) {
                    File::delete($rutaArchivo);
                }

                $imagen = $request->file('imagen');
                $nombreImagen = $user->id . '.jpg';
                Storage::disk('public')->put('assets/img/perfilImagenes/' . $nombreImagen, File::get($imagen));
            }
            return redirect()->back()->with('datos', 'Datos Cambiados correctamente');
        }
    }

    public function savepostu(Request $request)
    {
        $user = Auth::user();

        $carpeta = storage_path("app/public/assets/img/postulacion/{$user->id}");
        $car_perfil = storage_path("app/public/assets/img/postulacion/{$user->id}/imgperfil");
        $car_cedula = storage_path("app/public/assets/img/postulacion/{$user->id}/imgcedula");
        $car_test = storage_path("app/public/assets/img/postulacion/{$user->id}/imgtest");

        $postulacion = new postulacion();
        $postulacion->proyectos = $request->proyectos;
        $postulacion->tipo = $request->tipo;
        $postulacion->estado = "Activo";
        $postulacion->id_usuario = $request->id_usuario;

        if (!file_exists($carpeta)) {
            mkdir($carpeta, 0777, true);
            if (!file_exists($car_perfil)) {
                mkdir($car_perfil, 0777, true);
            }
            if (!file_exists($car_cedula)) {
                mkdir($car_cedula, 0777, true);
            }
            if (!file_exists($car_test)) {
                mkdir($car_test, 0777, true);
            }
        }

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = $user->id . '.jpg';
            Storage::disk('public')->put('assets/img/postulacion/' . $user->id . '/imgperfil/' . $nombreImagen, File::get($imagen));
        }

        if ($request->hasFile('imagen1')) {
            $imagen = $request->file('imagen1');
            $nombreImagen = $user->id . '.jpg';
            Storage::disk('public')->put('assets/img/postulacion/' . $user->id . '/imgcedula/' . $nombreImagen, File::get($imagen));
        }

        if ($request->hasFile('imagenes')) {
            $imagenes = $request->file('imagenes');
            $number = 1; 
            foreach ($imagenes as $imagen) {
                if ($imagen->isValid()) {
                    $nombreImagen = $number . '.jpg';
                    Storage::disk('public')->put('assets/img/postulacion/' . $user->id . '/imgtest/' . $nombreImagen, File::get($imagen));
                    $number++; 
                } else {
                    return "esto no sirve";
                }
            }
        }

        $sqlUpdate = DB::table('users')
            ->where('id', $user->id)
            ->update(['service' => 'Pendiente']);

        $postulacion->save();
        return Redirect('/perfil/postulacion')->with("Su postulacion se registro con exito");
    }

    public function cancelPublic()
    {
        $user = Auth::user();

        if ($user->service === 'Pendiente') {
            $sqlUpdate = DB::table('users')
                ->where('id', $user->id)
                ->update(['service' => 'Inactivo']);
            $sqlDelete = DB::table('postulacions')->where('id_usuario', $user->id)->delete();

            $rutaArchivo = storage_path("app/public/assets/img/postulacion/{$user->id}");

            if (File::exists($rutaArchivo)) {
                File::deleteDirectory($rutaArchivo);
            } 
            return Redirect('/perfil/postulacion')->with("La cancelacion se realizo con exito");
        } elseif ($user->service === 'Activo') {
            $sqlUpdate = DB::table('users')
                ->where('id', $user->id)
                ->update(['service' => 'Offline']);
            return Redirect('/perfil/postulacion')->with("Su postulacion ahora esta offline");
        } elseif ($user->service === 'Offline') {
            $sqlUpdate = DB::table('users')
                ->where('id', $user->id)
                ->update(['service' => 'Activo']);
            return Redirect('/perfil/postulacion')->with("Su postulacion volvio a estar activa");
        }
    }

    public function savepqr(Request $request){
        $pqr = new pqr();

        $pqr->titulo = $request->titulo;
        $pqr->tipo = $request->tipo;
        $pqr->fechaCreacion = date('Y-m-d H:i:s');
        $pqr->descripcion = $request->descripcion;
        $pqr->estado = 'Activo';
        $pqr->id_usuario = auth()->user()->id;

        $pqr->save();

        return Redirect()->back()->with("creado con exito");
    }

}
