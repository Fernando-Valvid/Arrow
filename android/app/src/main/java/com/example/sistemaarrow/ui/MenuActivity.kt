package com.example.sistemaarrow.ui

import android.content.Intent
import android.content.SharedPreferences
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.view.View
import android.widget.Button
import android.widget.ImageView
import android.widget.Switch
import androidx.appcompat.app.AppCompatDelegate
import com.example.sistemaarrow.util.PreferenceHelper
import com.example.sistemaarrow.util.PreferenceHelper.set
import com.example.sistemaarrow.util.PreferenceHelper.get
import com.example.sistemaarrow.R
import com.example.sistemaarrow.io.ApiService
import com.example.sistemaarrow.util.toast
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response


class MenuActivity : AppCompatActivity() {
    private val apiService by lazy {
        ApiService.create()
    }

    private val preferences by lazy {
        PreferenceHelper.defaultPrefs(this)
    }

    private val switch: Switch? = null
    internal lateinit var sharedPreferences: SharedPreferences

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_menu)


        val btn_contratos=findViewById<Button>(R.id.btn_contratos)

        btn_contratos.setOnClickListener {
            //Toast.makeText(this,getString(R.string.please_fill_login), Toast.LENGTH_SHORT).show()
            var lanzar= Intent(this, ContratosActivity::class.java)
            startActivity(lanzar)
        }

        val btn_cerrar=findViewById<Button>(R.id.btn_cerrar)

        btn_cerrar.setOnClickListener {
            perfomLogout()

        }

        val  btn_register=findViewById<Button>(R.id.btn_register)

        btn_register.setOnClickListener {
            var lanzar= Intent(this, RegistrarAvanceActivity::class.java)
            startActivity(lanzar)
        }


    }

    fun editProfile(view: View){
        val intent =Intent(this,PerfilActivity::class.java)
            startActivity(intent)

    }

    private fun perfomLogout(){

        val jwt =preferences["jwt",""]
        val call=apiService.postLogout("Bearer $jwt")
        call.enqueue(object: Callback<Void>{
            override fun onResponse(call: Call<Void>, response: Response<Void>) {
                    clearSessionPreference()
                    var lanzar= Intent(this@MenuActivity, MainActivity::class.java)
                    startActivity(lanzar)
                    finish()

            }

            override fun onFailure(call: Call<Void>, t: Throwable) {
                toast(t.localizedMessage)
            }

        })
    }

    private fun clearSessionPreference(){

        val preferences= PreferenceHelper.defaultPrefs(this)
        preferences["jwt"]=""
    }


}