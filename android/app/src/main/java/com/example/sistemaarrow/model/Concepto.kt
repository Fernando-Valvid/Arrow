package com.example.sistemaarrow.model


data class Concepto( val id:Int,
                     val codigo:String

                     ){
    override fun toString(): String {
        return codigo
    }
}
