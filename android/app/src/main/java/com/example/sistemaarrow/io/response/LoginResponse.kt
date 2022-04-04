package com.example.sistemaarrow.io.response

import com.example.sistemaarrow.model.User

data class LoginResponse (val success:Boolean,
val user: User, val definerol: String, val jwt: String)