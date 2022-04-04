package com.example.sistemaarrow.ui

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Button
import android.widget.LinearLayout
import android.widget.Toast
import com.example.sistemaarrow.R
import com.google.android.material.snackbar.Snackbar
import java.util.prefs.PreferenceChangeEvent


class MainActivity : AppCompatActivity() {





    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)

        val btn_login=findViewById<Button>(R.id.btn_login)

        btn_login.setOnClickListener {

            var lanzar= Intent(this, LoginActivity::class.java)
            startActivity(lanzar)
        }



    }

    /*override fun onBackPressed() {
        if(snackbar.isShown)
            super.onBackPressed()
        else
            snackbar.show()

    }*/
}