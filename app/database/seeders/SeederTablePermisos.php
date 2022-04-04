<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//Spatie
use Spatie\Permission\Models\Permission;

class SeederTablePermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos=[
            //Operaciones para tabla roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',

            //Operaciones para tabla empresas
            'ver-empresa',
            'crear-empresa',
            'editar-empresa',
            'borrar-empresa',

             //Operaciones para tabla afianzadoras
             'ver-afianzadora',
             'crear-afianzadora',
             'editar-afianzadora',
             'borrar-afianzadora',


             //Operaciones para tabla clientes
             'ver-cliente',
             'crear-cliente',
             'editar-cliente',
             'borrar-cliente',

             //Operaciones para tabla empleados
             'ver-empleado',
             'crear-empleado',
             'editar-empleado',
             'borrar-empleado',

              //Operaciones para tabla contratos
              'ver-contrato',
              'crear-contrato',
              'editar-contrato',
              'borrar-contrato',

              //Operaciones para tabla firmantes
                'ver-firmante',
                'crear-firmante',
                'editar-firmante',
                'borrar-firmante',

                //Operaciones para tabla cargos
                'ver-cargo',
                'crear-cargo',
                'editar-cargo',
                'borrar-cargo',

                //Operaciones para tabla cargos
                'ver-unidad',
                'crear-unidad',
                'editar-unidad',
                'borrar-unidad',

                //Operaciones para tabla conceptos
                'ver-concepto',
                'crear-concepto',
                'editar-concepto',
                'borrar-concepto',

                 //Operaciones para tabla usuarios
                 'ver-usuario',
                 'crear-usuario',
                 'editar-usuario',
                 'borrar-usuario',

                 //Operaciones para tabla operativos
                 'ver-operativo',
                 'crear-operativo',
                 'editar-operativo',
                 'borrar-operativo',



        ];

        foreach($permisos as $permiso){
            Permission::create(['name'=>$permiso]);            
        }
    }
}
