package com.example.sistemaarrow.ui

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.os.Handler
import android.view.View
import android.widget.Button
import android.widget.EditText
import android.widget.LinearLayout
import android.widget.ProgressBar
import androidx.core.os.postDelayed
import com.example.sistemaarrow.R
import com.example.sistemaarrow.io.ApiService
import com.example.sistemaarrow.model.User
import com.example.sistemaarrow.util.PreferenceHelper
import com.example.sistemaarrow.util.PreferenceHelper.get
import com.example.sistemaarrow.util.toast
import com.google.android.material.textfield.TextInputLayout
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class PerfilActivity : AppCompatActivity() {

    val apiService by lazy {
        ApiService.create()
    }
    val preferences by lazy {
        PreferenceHelper.defaultPrefs(this)
    }

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_perfil)

        val jwt=preferences["jwt",""]
        val authHeader="Bearer $jwt"
        val call=apiService.getUser(authHeader)
        call.enqueue(object : Callback<User>{
            override fun onResponse(call: Call<User>, response: Response<User>) {
                if(response.isSuccessful){
                    val user  = response.body()
                    if(user !=null){
                        displayProfileData(user)
                    }
                }
            }

            override fun onFailure(call: Call<User>, t: Throwable) {
                toast(t.localizedMessage)
            }

        })

    }

    private fun displayProfileData(user: User){
        val etName=findViewById<EditText>(R.id.etName)
        etName.setText(user.name)

        val progressBar=findViewById<ProgressBar>(R.id.progressProfile)
        progressBar.visibility=View.GONE
        val linearLayoutProfile=findViewById<LinearLayout>(R.id.linearLayoutProfile)
        linearLayoutProfile.visibility=View.VISIBLE

        val btn_guardar=findViewById<Button>(R.id.btnGuardar)

        btn_guardar.setOnClickListener {
            saveProfile()
        }

    }
    private fun saveProfile(){

        val jwt=preferences["jwt",""]
        val authHeader="Bearer $jwt"
        val etName=findViewById<EditText>(R.id.etName)
        val inputName=findViewById<TextInputLayout>(R.id.inputName)
        val name= etName.text.toString()

        if(name.length<3){
            inputName.error=getString(R.string.error_name)
            return
        }

        val call=apiService.postUser(authHeader, name)
        call.enqueue(object: Callback<Void>{
            override fun onResponse(call: Call<Void>, response: Response<Void>) {
                if(response.isSuccessful){
                    toast(getString(R.string.modified_user))
                    finish()
                }
            }

            override fun onFailure(call: Call<Void>, t: Throwable) {
                toast(t.localizedMessage)
            }

        })
    }
}