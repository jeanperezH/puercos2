<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Puerco;
use App\Cria;
use Illuminate\Support\Facades\DB;

class CriaController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $puercos = Puerco::join('crias','puercos.id','=','crias.id')
            
            ->select('puercos.id','puercos.nombre','puercos.raza','puercos.color',
            'puercos.fecha_nacimiento',DB::raw('TIMESTAMPDIFF(YEAR,puercos.fecha_nacimiento,CURDATE()) as edad') ,'puercos.ubicacion','puercos.descripcion',
            'puercos.estado','puercos.foto',
            'crias.id_gallo','crias.id_gallina')
            ->orderBy('puercos.fecha_nacimiento', 'desc')->paginate(3);
        }
        else{
            $puercos = Puerco::join('crias','puercos.id','=','crias.id')
            ->select('puercos.id','puercos.nombre','puercos.raza','puercos.color',
            'puercos.fecha_nacimiento',DB::raw('TIMESTAMPDIFF(YEAR,puercos.fecha_nacimiento,CURDATE()) as edad'),'puercos.ubicacion','puercos.descripcion',
            'puercos.estado','puercos.foto',
            'crias.id_gallo','crias.id_gallina')           
            ->where('puercos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('puercos.fecha_nacimiento', 'desc')->paginate(3);
        }
        

        return [
            'pagination' => [
                'total'        => $puercos->total(),
                'current_page' => $puercos->currentPage(),
                'per_page'     => $puercos->perPage(),
                'last_page'    => $puercos->lastPage(),
                'from'         => $puercos->firstItem(),
                'to'           => $puercos->lastItem(),
            ],
            'puercos' => $puercos
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        try{
            DB::beginTransaction();
            $puerco = new Puerco();
            $puerco->nombre = $request->nombre;
            $puerco->raza = $request->raza;
            $puerco->color = $request->color;
            $puerco->fecha_nacimiento = $request->fecha_nacimiento;
            $puerco->ubicacion = $request->ubicacion;
            $puerco->descripcion = $request->descripcion;
            $puerco->estado = 1;
            
            $puerco->foto = null;
            $puerco->save();

            $cria = new Cria();
            $cria->id = $puerco->id;
            $cria->id_gallo = $request->id_gallo;
            $cria->id_gallina = $request->id_gallina;
            $cria->save();

            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }

        
        
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        try{
            DB::beginTransaction();

            //Buscar primero el puerco a modificar
            $cria = Cria::findOrFail($request->id);
            $puerco = Puerco::findOrFail($cria->id);
            

            $puerco->nombre = $request->nombre;
            $puerco->raza = $request->raza;
            $puerco->color = $request->color;
            $puerco->fecha_nacimiento = $request->fecha_nacimiento;
            $puerco->ubicacion = $request->ubicacion;
            $puerco->descripcion = $request->descripcion;
            $puerco->estado = 1;
            $puerco->foto = null;
            $puerco->save();
            //$cria->id=$puerco->id;
            $cria->id_gallo = $request->id_gallo;
            $cria->id_gallina = $request->id_gallina;
            $cria->save();
            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }

    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $puerco = Puerco::findOrFail($request->id);
        $puerco->estado = '0';
        $puerco->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
         
        $puerco = Puerco::findOrFail($request->id);
        $puerco->estado = '1';
        $puerco->save();
    }
}
