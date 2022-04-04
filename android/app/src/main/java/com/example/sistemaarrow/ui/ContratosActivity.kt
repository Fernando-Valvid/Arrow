package com.example.sistemaarrow.ui

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.*
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.example.sistemaarrow.ContratosAdapter
import com.example.sistemaarrow.R
import com.example.sistemaarrow.io.ApiService
import com.example.sistemaarrow.model.Contrato
import com.example.sistemaarrow.util.PreferenceHelper
import com.example.sistemaarrow.util.PreferenceHelper.get
import com.example.sistemaarrow.util.toast
import org.w3c.dom.Text
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response



class ContratosActivity : AppCompatActivity() {
    private val apiService by lazy {
        ApiService.create()
    }
    private val preferences by lazy {
        PreferenceHelper.defaultPrefs(this)
    }
    private val contratoAdapter= ContratosAdapter()

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_contratos)

        loadContratos()



        val rvContratos=findViewById<RecyclerView>(R.id.rvContratos)
        rvContratos.layoutManager=LinearLayoutManager(this)
        rvContratos.adapter= contratoAdapter

        val btn_buscar=findViewById<Button>(R.id.btnBuscar)

        btn_buscar.setOnClickListener {
            buscarContratos()
        }


    }

    private fun buscarContratos(){
        val busq=findViewById<EditText>(R.id.textBuscar)

        val busqueda=busq.text.toString()

        val jwt =preferences["jwt",""]
        val call= apiService.getSearch("Bearer $jwt",busqueda)

        call.enqueue(object: Callback<ArrayList<Contrato>>{
            override fun onResponse(
                call: Call<ArrayList<Contrato>>,
                response: Response<ArrayList<Contrato>>
            ) {
                if(response.isSuccessful){
                    response.body()?.let {
                        contratoAdapter.contratos=it
                        contratoAdapter.notifyDataSetChanged()
                    }

                }
            }

            override fun onFailure(call: Call<ArrayList<Contrato>>, t: Throwable) {
                toast(t.localizedMessage)
            }

        })



    }

    private fun loadContratos(){
        val jwt =preferences["jwt",""]
        val call= apiService.getContratos("Bearer $jwt")
        call.enqueue(object: Callback<ArrayList<Contrato>>{
            override fun onResponse(
                call: Call<ArrayList<Contrato>>,
                response: Response<ArrayList<Contrato>>
            ) {
                if(response.isSuccessful){
                    response.body()?.let {
                        contratoAdapter.contratos=it
                        contratoAdapter.notifyDataSetChanged()
                    }


                }
            }

            override fun onFailure(call: Call<ArrayList<Contrato>>, t: Throwable) {
                toast(t.localizedMessage)
            }

        })
    }

}