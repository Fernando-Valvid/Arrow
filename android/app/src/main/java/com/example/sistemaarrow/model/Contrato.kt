package com.example.sistemaarrow.model

data class Contrato( val id:Int,
                     val contrato:String,
                    val nombre_obra:String,
                     val descripcion:String,
                    val fecha_alta:String,
                     val ubicacion:String,
                     val fecha_inicio: String,
                    val fecha_termino: String,
                     val plazo_dias: Int,
                     val importe: Double,
                     val amortizacion: Double,
                     val estatus: Int,
                     val id_cliente: Int,
                    val id_empresa: Int,
                    val id_responsable:Int,
                    val id_asistente:Int,
                    val nombre_cliente:String){

    override fun toString(): String {
        return contrato
    }
}

