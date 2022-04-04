package com.example.sistemaarrow.model

/*
* "id": 3,
        "name": "Mario",
        "email": "mario@gmail.com",
        "email_verified_at": null,
        "photo": "163876577666978.jpg",
        "id_tenant": 1,
        "empresa": 1,
        "created_at": "2021-12-06T04:42:56.000000Z",
        "updated_at": "2021-12-06T04:42:56.000000Z",
        "confirmed": 1,
        "confirmation_code": null
        *
        * "rol": {
        "name": "Responsable de obra"
    },
* */
data class User(val id:Int,
                val name:String,
                val email:String,
                val photo:String,
                val id_tenant:Int,
                val empresa:Int,
                val confirmed: Int,
                val estatus:Int
                )