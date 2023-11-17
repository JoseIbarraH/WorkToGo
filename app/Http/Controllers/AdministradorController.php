<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use App\Models\administrador;
use App\Models\Servicio;
use App\Models\User;
use App\Models\Reporte;
use App\Models\Pqr;
use App\Models\postulacion;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdministradorController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('admin.admin', compact('usuarios'));
    }

    public function showServices()
    {

        $servicios = Servicio::all();

        return view('admin.servicios', compact('servicios'));
    }

    public function showreportes(){

        $reportes = Reporte::all();

        return view('admin.reportes', compact('reportes'));
    }

    public function pqrshow()
    {

        $pqrs = Pqr::all();

        return view('admin.pqr', compact('pqrs'));
    }

    public function listaPostu()
    {
        $postulaciones = Postulacion::all();

        $results = DB::table('postulacions')
            ->join('users as us', 'postulacions.id_usuario', '=', 'us.id')
            ->select('us.nombre', 'postulacions.proyectos', 'postulacions.tipo', 'postulacions.estado', 'postulacions.id_usuario')
            ->get();

        return view('admin.postulacion', compact('postulaciones', 'results'));
    }

    public function editar(Request $request)
    {
        $id = $request->inputid;

        $user = User::find($id);

        $nombre = $request->inputname;
        $username = $request->inputusername;
        $email = $request->inputemail;
        $cedula = $request->inputcedula;
        $celular = $request->inputcelular;
        $tipo = $request->inputtipo;
        $newpass = $request->inputpassword;

        if ($request->inputpassword != "") {
            if (strlen($newpass) >= 8) {
                $user->password = Hash::make($newpass);
                $sqlBD = DB::table("users")
                    ->where('id', $user->id)
                    ->update(['password' => $user->password]);

                $sqlBD2 = DB::table("users")
                    ->where('id', $user->id)
                    ->update(['nombre' => $nombre]);

                $sqlBD3 = DB::table("users")
                    ->where('id', $user->id)
                    ->update(['username' => $username]);

                $sqlBD4 = DB::table("users")
                    ->where('id', $user->id)
                    ->update(['celular' => $celular]);

                $sqlBD5 = DB::table("users")
                    ->where('id', $user->id)
                    ->update(['cedula' => $cedula]);

                $sqlBD6 = DB::table("users")
                    ->where('id', $user->id)
                    ->update(['email' => $email]);

                $sqlBD7 = DB::table("users")
                    ->where('id', $user->id)
                    ->update(['tipo' => $tipo]);

                return redirect()->back()->with('updateClave', 'La clave fue cambiada correctamente.');
            } else {
                return redirect()->back()->with('clavemenor', 'Recuerde la clave debe ser mayor a 8 digitos.');
            }
        } else {

            $nombre = $request->inputname;
            $username = $request->inputusername;
            $email = $request->inputemail;
            $cedula = $request->inputcedula;
            $celular = $request->inputcelular;
            $tipo = $request->inputtipo;

            $sqlBD2 = DB::table("users")
                ->where('id', $user->id)
                ->update(['nombre' => $nombre]);

            $sqlBD3 = DB::table("users")
                ->where('id', $user->id)
                ->update(['username' => $username]);

            $sqlBD4 = DB::table("users")
                ->where('id', $user->id)
                ->update(['celular' => $celular]);

            $sqlBD5 = DB::table("users")
                ->where('id', $user->id)
                ->update(['cedula' => $cedula]);

            $sqlBD6 = DB::table("users")
                ->where('id', $user->id)
                ->update(['email' => $email]);

            if ($tipo === 'Trabajador') {
                $select = DB::select('select * from trabajadors where id_usuario = ?', [$user->id]);
                $select2 = DB::select('select * from administradors where id_usuario = ?', [$user->id]);

                if ($select2) {
                    $sqlBD7 = DB::table("administradors")
                        ->where('id_usuario', $user->id)
                        ->update(['estado' => 'Inactivo']);
                }

                if (!$select) {

                    $trabajador = new Trabajador();
                    $trabajador->estado = 'Activo';
                    $trabajador->id_usuario = $user->id;
                    $trabajador->save();

                    $sqlBD7 = DB::table("users")
                        ->where('id', $user->id)
                        ->update(['tipo' => $tipo]);

                    $sqlBD7 = DB::table("users")
                        ->where('id', $user->id)
                        ->update(['service' => 'Activo']);
                } else {
                    $sqlBD7 = DB::table("trabajadors")
                        ->where('id_usuario', $user->id)
                        ->update(['estado' => 'Activo']);

                    $sqlBD7 = DB::table("users")
                        ->where('id', $user->id)
                        ->update(['tipo' => $tipo]);

                    $sqlBD7 = DB::table("users")
                        ->where('id', $user->id)
                        ->update(['service' => 'Activo']);
                }
            } else if ($tipo === 'Cliente') {
                $select = DB::select('select * from trabajadors where id_usuario = ?', [$user->id]);
                $select2 = DB::select('select * from administradors where id_usuario = ?', [$user->id]);

                if ($select2) {
                    $sqlBD7 = DB::table("administradors")
                        ->where('id_usuario', $user->id)
                        ->update(['estado' => 'Inactivo']);
                }

                if ($select) {
                    $sqlBD7 = DB::table("trabajadors")
                        ->where('id_usuario', $user->id)
                        ->update(['estado' => 'Inactivo']);

                    $sqlBD7 = DB::table("users")
                        ->where('id', $user->id)
                        ->update(['tipo' => $tipo]);

                    $sqlBD7 = DB::table("users")
                        ->where('id', $user->id)
                        ->update(['service' => 'suspendido']);
                } else {
                    $sqlBD7 = DB::table("users")
                        ->where('id', $user->id)
                        ->update(['tipo' => $tipo]);

                    $sqlBD7 = DB::table("users")
                        ->where('id', $user->id)
                        ->update(['service' => 'Inactivo']);
                }
            } else if ($tipo === 'Administrador') {
                $select2 = DB::select('select * from trabajadors where id_usuario = ?', [$user->id]);
                $select = DB::select('select * from administradors where id_usuario = ?', [$user->id]);
                if ($select) {

                    $sqlBD7 = DB::table("administradors")
                        ->where('id_usuario', $user->id)
                        ->update(['estado' => 'Activo']);

                    $sqlBD7 = DB::table("users")
                        ->where('id', $user->id)
                        ->update(['tipo' => $tipo]);

                    $sqlBD7 = DB::table("users")
                        ->where('id', $user->id)
                        ->update(['service' => 'suspendido']);

                    $sqlBD7 = DB::table("trabajadors")
                        ->where('id_usuario', $user->id)
                        ->update(['estado' => 'Inactivo']);

                } else {

                    $admin = new Administrador();
                    $admin->estado = 'Activo';
                    $admin->id_usuario = $user->id;
                    $admin->save();

                    $sqlBD7 = DB::table("users")
                        ->where('id', $user->id)
                        ->update(['tipo' => $tipo]);

                    $sqlBD7 = DB::table("trabajadors")
                        ->where('id_usuario', $user->id)
                        ->update(['estado' => 'Inactivo']);

                    $sqlBD7 = DB::table("users")
                        ->where('id', $user->id)
                        ->update(['service' => 'suspendido']);

                }

            }

            $sqlBD7 = DB::table("users")
                ->where('id', $user->id)
                ->update(['tipo' => $tipo]);



            return redirect()->back()->with('datos', 'Datos Cambiados correctamente');
        }
    }

    public function suspender(Request $request)
    {
        $id = $request->inputid;
        $user = User::find($id);

        if ($user->estado === 'Activo') {
            $sqlBD7 = DB::table("users")
                ->where('id', $user->id)
                ->update(['estado' => 'Inactivo']);
            return redirect()->back()->with('Suspendido');
        } else if ($user->estado === 'Inactivo') {
            $sqlBD7 = DB::table("users")
                ->where('id', $user->id)
                ->update(['estado' => 'Activo']);
            return redirect()->back()->with('Suspencion levantada');
        }
    }

    public function deletePostu(Request $request)
    {
        $id = $request->usuario;

        $rutaArchivo = storage_path("app/public/assets/img/postulacion/{$id}");

        if (File::exists($rutaArchivo)) {
            File::deleteDirectory($rutaArchivo);
        }

        $sqlBD7 = DB::table("users")
            ->where('id', $id)
            ->update(['service' => 'Inactivo']);

        $sqlBD7 = DB::table("postulacions")
            ->where('id_usuario', $id)
            ->delete();

        return redirect()->back()->with('Solicitud denegada');
    }

    public function aceptarPostu(Request $request)
    {
        $id = $request->usuario;

        $rutaArchivo = storage_path("app/public/assets/img/postulacion/{$id}");

        if (File::exists($rutaArchivo)) {
            File::deleteDirectory($rutaArchivo);
        }

        $sqlBD7 = DB::table("postulacions")
            ->where('id_usuario', $id)
            ->delete();

        $sqlBD7 = DB::table("users")
            ->where('id', $id)
            ->update(['service' => 'Activo']);

        $sqlBD7 = DB::table("users")
            ->where('id', $id)
            ->update(['tipo' => 'Trabajador']);

        $trabajador = new Trabajador();
        $trabajador->estado = 'Activo';
        $trabajador->id_usuario = $id;
        $trabajador->save();


        return redirect()->back()->with('Solicitud aceptada');
    }

    public function eliminarServicios(Request $request)
    {

        $id = $request->servicio;

        $servicio = DB::table('servicios')
            ->where('id', $id)
            ->delete();

        $rutaArchivo = storage_path("app/public/assets/img/servicioImagenes/{$id}.jpg");

        if (File::exists($rutaArchivo)) {
            File::delete($rutaArchivo);
        }

        return redirect()->back()->with('Servico eliminado con exito');
    }

    public function respuesta(Request $request)
    {
        $id = $request->usuario;

        $pqr = pqr::find($id);

        $pqr->respuesta = $request->respuesta;
        $pqr->fechaResolucion = $request->fechaResolucion;

        $update = DB::table('pqrs')->where('id', $id)->update(['respuesta' => $pqr->respuesta]);
        $update = DB::table('pqrs')->where('id', $id)->update(['fechaResolucion' => $pqr->fechaResolucion]);
        $update = DB::table('pqrs')->where('id', $id)->update(['estado' => 'Inactivo']);

        return redirect()->back()->with('Respuesta realizada con exito');
    }

    public function eliminarpqr(Request $request)
    {

        $id = $request->usuario;
        $pqr = pqr::find($id);

        $pqr->delete();
        return redirect()->back()->with('Eliminacion exitosa');
    }

    public function eliminarReporte(Reporte $reporte){

        $reporte->delete();
        return redirect()->back()->with('Eliminacion exitosa');
    }
}
