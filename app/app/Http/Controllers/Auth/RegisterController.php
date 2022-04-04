<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terminos' => ['accepted']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        
        $roles=Role::select('id')->where('id','=',1)->first();

        // $user= new User;

       
        $data['confirmation_code']=str::random(25);
        
        // $user->name=$data['name'];
        // $user->email=$data['email'];
        // $user->password=Hash::make($data['password']);
        // $user->photo='tenant.jpg';
        // $user->confirmation_code=$data['confirmation_code'];
        // $user->save();


        
        

        $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'photo' =>'tenant.png',
            'confirmation_code'=>$data['confirmation_code'],
        ]);
        
        $user->assignRole($roles->id);

       

        

        Mail::send('emails.confirmation_code',$data, function ($message) use ($data) {
        
            $message->to($data['email'], $data['name']);
            $message->subject('Por favor confirma tu correo');
            
           
        });

        return $user;

       
    }

    public function verify($code){

        $user=User::where('confirmation_code',$code)->first();

        if(!$user)
            return  redirect('/');
        

        $user->confirmed=true;
        $user->confirmation_code=null;
        $user->save();

        return redirect()->route('login')->with('notification','Has confirmado correctamente tu correo electrónico ');
    } 
}
