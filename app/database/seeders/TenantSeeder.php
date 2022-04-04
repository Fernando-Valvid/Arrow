<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario=User::create([
            'name' => 'Bryan',
            'email'=> 'bryan@gmail.com',
            'password' => bcrypt('12345678'),
            'photo' => 'tenant.png'

        ]);

        $rol=Role::create([
            'name' => 'Tenant'
        ]);

        $permisos=Permission::pluck('id','id')->all();

        $rol->syncPermissions($permisos);

        $usuario->assignRole($rol->id);
    }
}
