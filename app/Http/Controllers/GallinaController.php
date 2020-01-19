<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Puerco;
use App\Gallina;
use Illuminate\Support\Facades\DB;

class GallinaController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $puercos = Puerco::join('gallinas','puercos.id','=','gallinas.id_gallina')
            ->select('puercos.id','puercos.nombre','puercos.raza','puercos.color',
            'puercos.fecha_nacimiento',DB::raw('TIMESTAMPDIFF(YEAR,puercos.fecha_nacimiento,CURDATE()) as edad') ,'puercos.ubicacion','puercos.descripcion',
            'puercos.estado','puercos.foto',
            'gallinas.id_gallina')
            ->orderBy('puercos.id', 'desc')->paginate(3);
        }
        else{
            $puercos = Puerco::join('gallinas','puercos.id','=','gallinas.id_gallina')
            ->select('puercos.id','puercos.nombre','puercos.raza','puercos.color',
            'puercos.fecha_nacimiento',DB::raw('TIMESTAMPDIFF(YEAR,puercos.fecha_nacimiento,CURDATE()) as edad'),'puercos.ubicacion','puercos.descripcion',
            'puercos.estado','puercos.foto',
            'gallinas.id_gallina')           
            ->where('puercos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('puercos.id', 'desc')->paginate(3);
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

    public function selectGallina(Request $request){
        if (!$request->ajax()) return redirect('/');
        $mamas = Puerco::join('gallinas','puercos.id','=','gallinas.id_gallina')
        ->select('puercos.id','puercos.nombre','puercos.raza','puercos.color',
            'gallinas.id_gallina')
        ->where('puercos.estado','=',1)
        ->orderBy('puercos.id', 'desc')->get();
        return ['puercos'=>$mamas];
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
            if ($request->hasFile('foto')) {
                $puerco->foto=$request->file('foto')->store('public');
            }
            //$puerco->foto = $request->foto;
            $puerco->save();

            $gallina = new Gallina();
            $gallina->id_gallina = $puerco->id;
            $gallina->save();

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
            $puerco = Puerco::findOrFail($request->id);
            //$gallo = Gallo::findOrFail($request->id_gallo);
            
            $puerco->nombre = $request->nombre;
            $puerco->raza = $request->raza;
            $puerco->color = $request->color;
            $puerco->fecha_nacimiento = $request->fecha_nacimiento;
            $puerco->ubicacion = $request->ubicacion;
            $puerco->descripcion = $request->descripcion;
            $puerco->estado = 1;
            if ($request->hasFile('foto')) {
                $puerco->foto=$request->file('foto')->store('public');
            }
            $puerco->save();
            /*$gallo->id_gallo = $puerco->id;
            $gallo->save();*/
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
