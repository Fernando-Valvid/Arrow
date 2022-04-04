<?php

namespace App\Http\Controllers;

use App\Models\Afianzadora;
use App\Models\Empleado;
use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmpresaController extends Controller
{
    function __construct(){
        $this->middleware('permission:ver-empresa|crear-empresa|editar-empresa|borrar-empresa')->only('index');
        $this->middleware('permission:crear-empresa' , ['only' => ['create','store']] );
        $this->middleware('permission:editar-empresa' , ['only' => ['edit','update']] );
        $this->middleware('permission:borrar-empresa' , ['only' => ['destroy']] );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $usuario=Auth::id();
        $empresas=Empresa::where('id_tenant','=',$usuario)->get();
       
        // $empresas=Empresa::paginate(5);

        return view('empresas.index',compact('empresas'));

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empresas.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'nombre' => 'required|regex:/^[\pL\s\-]+$/u',
            'ubicacion' => 'required',
            'rfc' => 'required|min:12|max:13',
            'imms' => 'required|min:10|max:11',
            'ccem' => 'required|max:35'
            ],
            [
                'nombre.required' => 'Campo nombre obligatorio.',
                'nombre.regex' => 'Campo nombre solo acepta letras.',
                'ubicacion.required' => 'Campo ubicación obligatorio.',
                'rfc.required' => 'Campo RFC obligatorio.',
                'rfc.min' => 'Campo RFC debe tener 13 caracteres.',
                'rfc.max' => 'Campo RFC debe tener máximo  13 caracteres.',
                'imms.required' => 'Campo IMMS obligatorio.',
                'imms.min' => 'Campo IMMS debe tener 11 caracteres.',
                'imms.max' => 'Campo IMMS debe tener máximo  11 caracteres.',
                'ccem.required' => 'Campo CCEM obligatorio.',
                'ccem.max' => 'Campo CCEM debe tener máximo 35 caracteres.',

            ]
        );
                
        $data=$request->only([
            'nombre',
            'ubicacion',
            'rfc',
            'imms',
            'ccem',
            'id_tenant'
        ]);

        $data['id_tenant']=auth()->id();
        Empresa::create($data);
        return redirect()->route('empresas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {
        return view('empresas.editar',compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresa $empresa)
    {
        request()->validate([
            'nombre' => 'required|regex:/^[\pL\s\-]+$/u',
            'ubicacion' => 'required',
            'rfc' => 'required|min:12|max:13',
            'imms' => 'required|min:10|max:11',
            'ccem' => 'required|max:35'
        ],
        [
            'nombre.required' => 'Campo nombre obligatorio.',
            'nombre.regex' => 'Campo nombre solo acepta letras.',
            'ubicacion.required' => 'Campo ubicación obligatorio.',
            'rfc.required' => 'Campo RFC obligatorio.',
            'rfc.min' => 'Campo RFC debe tener 13 caracteres.',
            'rfc.max' => 'Campo RFC debe tener máximo  13 caracteres.',
            'imms.required' => 'Campo IMMS obligatorio.',
            'imms.min' => 'Campo IMMS debe tener 11 caracteres.',
            'imms.max' => 'Campo IMMS debe tener máximo  11 caracteres.',
            'ccem.required' => 'Campo CCEM obligatorio.',
            'ccem.max' => 'Campo CCEM debe tener máximo 35 caracteres.',

        ]
    );
        
        $empresa->update($request->all());
        return redirect()->route('empresas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {

        // return $empresa->id;

        $existen=Empleado::where('id_empresa','=', $empresa->id)->select(DB::raw('count(*) as empleados'))
        ->first();
        $existen2=User::where('empresa','=',$empresa->id)->count();
        $existen3=Afianzadora::where('id_empresa','=',$empresa->id)->count();

        if($existen2>0){
            $mensaje_error='No puedes eliminar '.$empresa->nombre. ' cuenta con un responsable de empresa';
            return redirect()->route('empresas.index')->with(compact('mensaje_error'));
        }else{
            $empresa->delete();
             $mensaje='Empresa: '.$empresa->nombre." se elimino correctamente";
            return redirect()->route('empresas.index')->with(compact('mensaje'));
        }

      

    } 



    //     if($existen->empleados<=0 || $existen2<=0){

    //         if($existen3<=0){
    //             $empresa->delete();
    //             $mensaje='Empresa: '.$empresa->nombre." se elimino correctamente";
    //            return redirect()->route('empresas.index')->with(compact('mensaje'));
    //         }
       
             
    //         else{ 
    //             $mensaje_error='No puedes eliminar '.$empresa->nombre. ' cuenta con fianzas activas';
    //             return redirect()->route('empresas.index')->with(compact('mensaje_error'));
    //         }
    //     }else{
    //        $mensaje_error='No puedes eliminar '.$empresa->nombre. ' cuenta con empleados Activos';
    //        return redirect()->route('empresas.index')->with(compact('mensaje_error'));
    //     }

    // }
}
