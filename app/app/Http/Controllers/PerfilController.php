<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerfilController extends Controller
{
  
    public function index(){
        
    }

  
    public function create(){
      
    }

  
    public function store(Request $request){
        

    }

  
    public function show($id)
    {
        
        $rol=DB::table('users')->join('model_has_roles','users.id','=','model_has_roles.model_id')
        ->join('roles','roles.id','=','model_has_roles.role_id')
        ->select('roles.name')
        ->where('users.id','=',$id)->first();
        $usuario=User::find($id);
       
        return view('perfil.editperfil',compact('usuario','rol'));

    
    }

    public function edit($id)
    {
        $usuario=User::find($id);

        return view('perfil.formulario',compact('usuario'));
      
        
       
    }

  
    public function update(Request $request,$id)
    {

        $rol=DB::table('users')->join('model_has_roles','users.id','=','model_has_roles.model_id')
        ->join('roles','roles.id','=','model_has_roles.role_id')
        ->select('roles.name')
        ->where('users.id','=',$id)->first();
        $usuario=User::find($id);

        

        $this->validate($request,
        [
            'name' => 'required',
            'password' => 'same:confirm-password',
            
        ],
        [
            'name.required' => 'El campo nombre debe ser obligatorio'
        ]
        
         );
     
        $usuario=User::find($id);
        $usuario->name=$request->input('name');
        $usuario->password=bcrypt($request->input('password'));
        $imagen=$request->input("photo");

     

        if(!empty($request->hasFile('photo'))){
            $imagen=$request->file("photo");
         
            $nombreImagen=strtotime(now()).rand(11111,99999).'.'.$imagen->guessExtension();
            $ruta=public_path("img/usuarios");
            $imagen->move($ruta,$nombreImagen);
            $usuario->photo=$nombreImagen;

        }else{
            $p=$usuario->photo;
            $usuario->photo=$p;
        }




       

        $usuario->save();
        

        
        return redirect()->route('perfil.show',$usuario->id);
        
        //  return view('perfil.editperfil',compact('usuario','rol'));
        

      
    }

  
    public function destroy($id)
    {
        //
    }
}
