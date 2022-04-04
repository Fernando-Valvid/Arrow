package com.example.sistemaarrow.ui

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Button
import android.widget.EditText
import android.widget.Toast
import com.example.sistemaarrow.util.PreferenceHelper
import com.example.sistemaarrow.R
import com.example.sistemaarrow.util.PreferenceHelper.get
import com.example.sistemaarrow.util.PreferenceHelper.set
import com.example.sistemaarrow.io.ApiService
import com.example.sistemaarrow.io.response.LoginResponse
import com.example.sistemaarrow.util.toast
import retrofit2.Call
import retrofit2.Response


class LoginActivity : AppCompatActivity() {

    private val apiService: ApiService by lazy {
        ApiService.create()
    }

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_login)

        //peferences para persisitir datos


        val btn_login=findViewById<Button>(R.id.btn_login)

        //val preferences= getSharedPreferences("general",Context.MODE_PRIVATE)

        //val session=preferences.getBoolean("session",false)

       val preferences= PreferenceHelper.defaultPrefs(this)

        if(preferences["jwt",""].contains("."))
            //Validar los datos del usuario antes de iniciar sesión
            goToMenuActivity()


        btn_login.setOnClickListener {

            performLogin()
            //createSessionPreference()
            //goToMenuActivity()

        }
    }

    private fun performLogin(){
        val emailito=findViewById<EditText>(R.id.editTextTextEmailAddress)
        val passwordi=findViewById<EditText>(R.id.editTextTextPassword)
        val email=emailito.text.toString()
        val password=passwordi.text.toString()
        if(email.trim().isEmpty()|| password.trim().isEmpty()){
            toast(getString(R.string.error_empty_credentials))
            return
        }
        val call=apiService.postLogin(email, password)
        call.enqueue(object: retrofit2.Callback<LoginResponse>{
            override fun onResponse(call: Call<LoginResponse>, response: Response<LoginResponse>) {
                if(response.isSuccessful){
                    val loginResponse=response.body()
                    if (loginResponse == null) {
                        toast(getString(R.string.errror_login_response))
                        return
                    }

                    if(loginResponse.success){
                        toast(getString(R.string.welcome_name,loginResponse!!.user.name))
                        createSessionPreference(loginResponse.jwt)

                        goToMenuActivity()
                    }else{
                        toast(getString(R.string.error_invalid_credentials))
                    }
                }else{
                    toast(getString(R.string.errror_login_response))
                }


            }

            override fun onFailure(call: Call<LoginResponse>, t: Throwable) {
                toast(t.localizedMessage)
            }

        })
    }

    private fun createSessionPreference(jwt: String){
        /*val preferences= getSharedPreferences("general",Context.MODE_PRIVATE)
        val editor=preferences.edit()
        editor.putBoolean("session",true)
        editor.apply()*/
        val preferences= PreferenceHelper.defaultPrefs(this)
        preferences["jwt"]=jwt
    }

    private fun goToMenuActivity(){
        var lanzar= Intent(this, MenuActivity::class.java)
        startActivity(lanzar)
        finish()
    }
}