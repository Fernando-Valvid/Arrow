<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\UseUse;
use Symfony\Component\Console\Input\Input;

use function PHPUnit\Framework\isEmpty;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // $usuarios=User::paginate(5);
        $id=Auth::id();
        $usuarios=User::where('users.id_tenant',$id)->paginate(5);

        $id_responsable=Role::select('id')->where('name','=','Responsable de empresa')->first();

        
        $usuarios=DB::table('users')
        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->join('roles','roles.id','=','model_has_roles.role_id')
        ->where('users.id_tenant',$id)
        ->whereIn('role_id', [$id_responsable->id])
        ->select('users.*','roles.name as rol')
        ->paginate(5);

    //    return $usuarios;

        
    

        
        return view('usuarios.index',compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $id=Auth::id();
        // return $id;
        $empresas=DB::table('users')->join('empresas','users.id','=','empresas.id_tenant')
        ->select('empresas.id','empresas.nombre')
        ->where('empresas.id_tenant','=',$id)->groupBy('empresas.id')->get();

        

        $rol=DB::table('users')->join('model_has_roles','users.id','=','model_has_roles.model_id')
        ->join('roles','roles.id','=','model_has_roles.role_id')
        ->select('roles.name')
        ->where('users.id','=',$id)->first();
        // $rolSelect= $rol;



        if($rol->name=='Tenant'){
            $roles=Role::select('id','name')->whereNotIn('name',['Tenant','Responsable de obra', 'Asistente de obra'])->get();
        }else if($rol->name=='Responsable de empresa'){
            $roles=Role::select('id','name')->whereNotIn('name',['Tenant','Responsable de empresa'])->get();
        }




        
        // return $roles;
        return view('usuarios.crear',compact('roles','empresas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        // $formulario=$request->all();
        $rol=$request->input('roles');
        $consulta=Role::select('id')->where('name','like',$rol)->first();
        $mensaje=[];


        // return $rol;
      
        //tenant
        if($consulta->id==1){
            $id_tenant=null;
        }else{
            $id_tenant=Auth::id();
        }
        
            $this->validate($request,
            [
                'name' => 'required|max:50|regex:/^[\pL\s\-]+$/u',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:confirm-password|min:8|max:15',
                'photo' => 'required|image|mimes:jpeg,png|max:1024',
                'roles' => 'required',
                
            ],
            [
                'name.required' => 'Campo nombre debe ser obligatorio.',
                'name.regex' => 'Campo nombre solo acepta letras.',
                'name.max' => 'Campo nombre debe tener máximo 50 caracteres.',
                'email.required' => 'Campo correo debe ser obligatorio.',
                'email.email' => 'Ingrese un formato de correo correcto.',
                'email.unique' => 'El correo ya está registrado',
                'password.required' => 'Campo contraseña debe ser obligatorio.',
                'password.min' => 'Campo contraseña debe tener mínimo 8 caracteres.',
                'password.max' => 'Campo contraseña debe tener máximo 15 caracteres.',
                'password.same' => 'Las contraseñas no coinciden',
                'photo.required' => 'Campo foto deber ser obligatorio',
                'photo.mimes' => 'Solo se aceptan fotos en formato: jpeg y png',
                'photo.max' => 'El tamaño maximo de la foto es de 1024',


            ]
            
             );
    
    
          $idempresa=$request->input('empresa');



             if($rol=='Responsable de empresa' && $request->input('empresa')==0){
                $mensaje="¡ERROR!, por favor selecciona una empresa.";
                return back()->withInput()->with(compact('mensaje'));
             }

            
            // $busqueda= User::where('empresa', '=', $idempresa)->exists();// user found}

            //buscar role responsable
            $role=Role::select('id')->where('name','=','Responsable de empresa')->first();


             $busqueda = DB::table('users')
             ->join('empresas', 'users.empresa', '=', 'empresas.id')
             ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
             ->where('users.id_tenant','=',$id_tenant)
             ->where('empresas.id','=',$idempresa)
             ->where('role_id','=',$role->id)->count();

            //  return $users;
            // ->select('users.*', 'contacts.phone', 'orders.price')
            // ->get();

            if($busqueda==1){
                $mensaje="¡ERROR!, Esta empresa ya cuenta con un responsable.";


                // return redirect()->route('usuarios.create')->with(compact('mensaje'));
                // return  back()->with(compact('mensaje'));
                return back()->withInput()->with(compact('mensaje'));



            }else{
                $usuario= new User;
                $usuario->name=$request->name;
                $usuario->email=$request->email;
                $usuario->password=bcrypt($request->input('password'));
                $usuario->id_tenant=$id_tenant;
    
    
                $usuario->empresa=$request->input('empresa');
                if($request->hasFile("photo")){
                    $imagen=$request->file("photo");
                    $nombreImagen=strtotime(now()).rand(11111,99999).'.'.$imagen->guessExtension();
                    $ruta=public_path("img/usuarios");
                    $imagen->move($ruta,$nombreImagen);
                    $usuario->photo=$nombreImagen;
    
                   
                }

                $usuario->confirmed=true;
               
              
                $usuario->save();
                $usuario->assignRole($consulta->id);

                $mensaje="Usuario registrado exitosamente.";
             
            }
        
            

           
            
        return redirect()->route('usuarios.index')->with(compact('mensaje'));
     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        

        $rol=DB::table('users')->join('model_has_roles','users.id','=','model_has_roles.model_id')
        ->join('roles','roles.id','=','model_has_roles.role_id')
        ->select('roles.name')
        ->where('users.id','=',$id)->first();
        $usuario=User::find($id);
        return view('perfil.editperfil',compact('usuario','rol'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {

        //trae las empresas
        $id=Auth::id();
        $empresas=DB::table('users')->join('empresas','empresas.id_tenant','=','users.id_tenant')
        ->select('empresas.id','empresas.nombre')
        ->where('empresas.id_tenant','=',$id)->groupBy('empresas.id')->get();

        //consulta para obtener el rol del usuario 
        $rol=DB::table('users')->join('model_has_roles','users.id','=','model_has_roles.model_id')
        ->join('roles','roles.id','=','model_has_roles.role_id')
        ->select('roles.name')
        ->where('users.id','=',$id)->first();
        //trae el rol que tiene
        $rol2=DB::table('users')->join('model_has_roles','users.id','=','model_has_roles.model_id')
        ->join('roles','roles.id','=','model_has_roles.role_id')
        ->select('roles.name')
        ->where('users.id','=',$usuario->id)->first();
        $rolSelect= $rol2;
        //todos los roles
        // $roles=Role::select('id','name')->get();

        if($rol->name=='Tenant'){
            $roles=Role::select('id','name')->whereNotIn('name',['Tenant','Responsable de obra', 'Asistente de obra'])->get();
        }else if($rol->name=='Responsable de empresa'){
            $roles=Role::select('id','name')->whereNotIn('name',['Tenant','Responsable de empresa'])->get();
        }

        // return $rol;
    


        $empresaS = new Empresa();
        //consulta para obtener todos los roles
      

        //consulta para traer la empresa en caso de existir
        $empresaE=DB::table('users')->join('empresas','empresas.id','=','users.empresa')
        ->select('empresas.id','empresas.nombre')
        ->where('empresas.id','=',$usuario->empresa)->first();


        if(!empty($empresaE)){
            $empresaS->nombre=$empresaE->nombre;
        }else{
            $empresaS->nombre=0;
        }
         return view('usuarios.editar',compact('usuario','empresas','roles','rolSelect','empresaS'));

    }

    
    public function update(Request $request,User $usuario)   {

        $rol =$request->input(['roles']);
        $consulta=Role::select('id')->where('name','like',$rol)->first();
      
        
        if($consulta->id==1){
            $id_tenant=null;
        }else{
            $id_tenant=Auth::id();
        }
        
        $this->validate($request,
        [
            'name' => 'required|max:50|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|unique:users,email',
            'password' => 'same:confirm-password|max:15',
            'photo' => 'required|image|mimes:jpeg,png|max:1024',
            'roles' => 'required',
            
        ],
        [
            'name.required' => 'Campo nombre debe ser obligatorio.',
            'name.regex' => 'Campo nombre solo acepta letras.',
            'name.max' => 'Campo nombre debe tener máximo 50 caracteres.',
            'email.required' => 'Campo correo debe ser obligatorio.',
            'email.email' => 'Ingrese un formato de correo correcto.',
    
            'password.max' => 'Campo contraseña debe tener máximo 15 caracteres.',
            'password.same' => 'Las contraseñas no coinciden.',
            'photo.image' => 'el archivo ingresado no es una foto.',
            'photo.mimes' => 'Solo se aceptan fotos en formato: jpeg y png',
            'photo.max' => 'El tamaño maximo de la foto es de 1024',


        ]
        
         );

          
             $usuario->name=$request->name;
             $usuario->email=$request->email;

             if(!empty($request->input('password'))){
                $usuario->password=bcrypt($request->input('password'));
             }else{
                $v=$usuario->password;
                $usuario->password=$v;
             }

             if(!empty( $request->hasFile('photo'))){
                $imagen=$request->file("photo");
                $nombreImagen=strtotime(now()).rand(11111,99999).'.'.$imagen->guessExtension();
                $ruta=public_path("img/usuarios");
                $imagen->move($ruta,$nombreImagen);
                $usuario->photo=$nombreImagen;
                
            }else{
                $p=$usuario->photo;
                $usuario->photo=$p;

            }
           
             $usuario->id_tenant=$id_tenant;
             

             
             $idempresa=$request->input('empresa');

             


             if($rol=='Responsable de empresa' && $request->input('empresa')==0){
                $mensaje="¡ERROR!, por favor selecciona una empresa.";
                return back()->withInput()->with(compact('mensaje'));
             }

             if(!empty($idempresa)){

                if($rol=='Responsable de empresa'){
                    $role=Role::select('id')->where('name','=','Responsable de empresa')->first();
                    $busqueda = DB::table('users')
                    ->join('empresas', 'users.empresa', '=', 'empresas.id')
                    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->where('users.id_tenant','=',$id_tenant)
                    ->where('empresas.id','=',$idempresa)
                    ->where('role_id','=',$role->id)->count();
    
                    if($busqueda>0){

                        $mensaje="¡ERROR!, Esta empresa ya cuenta con un responsable.";
                       return back()->withInput()->with(compact('mensaje'));
                     }else{
                        $usuario->empresa=$request->input('empresa');
                        $usuario->update();
                        $mensaje="Usuario modificado exitosamente: ".$usuario->name;
                    }

             }else{
             
                $usuario->empresa=null;
                $mensaje="Usuario modificado exitosamente: ".$usuario->name;
                $usuario->update();
             }
            
                DB::table('model_has_roles')->where('model_id',$usuario->id)->delete();
                $usuario->assignRole($consulta->id);
                return redirect()->route('usuarios.index')->with(compact('mensaje'));
        
        }else{
            DB::table('model_has_roles')->where('model_id',$usuario->id)->delete();
            $usuario->assignRole($consulta->id);
            return redirect()->route('usuarios.index');
        }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $busqueda= User::select('empresa')->where('id', '=', $id)->first();

  
      
        if($busqueda->empresa == null){
            User::find($id)->delete();
            $mensaje='Usuario eliminado exitosamente';
            return redirect()->route('usuarios.index')->with(compact('mensaje'));
        }else{
           
            $mensaje_error='El usuario no se puede eliminar, cuenta con una empresa responsable';
            return redirect()->route('usuarios.index')->with(compact('mensaje_error'));
        }

        
    }
}
