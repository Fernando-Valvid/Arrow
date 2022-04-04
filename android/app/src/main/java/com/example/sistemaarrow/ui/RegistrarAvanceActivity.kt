package com.example.sistemaarrow.ui

import android.R.attr
import android.app.Activity
import android.content.Intent
import android.net.Uri
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.view.View
import android.widget.*
import android.util.Base64
import android.graphics.Bitmap
import com.example.sistemaarrow.R
import com.example.sistemaarrow.io.ApiService
import com.example.sistemaarrow.io.response.SimpleResponse
import com.example.sistemaarrow.model.Avance
import com.example.sistemaarrow.model.Concepto
import com.example.sistemaarrow.model.Contrato
import com.example.sistemaarrow.model.User
import com.example.sistemaarrow.util.PreferenceHelper
import com.example.sistemaarrow.util.PreferenceHelper.get
import com.example.sistemaarrow.util.toast
import com.google.android.material.textfield.TextInputLayout
import retrofit2.Call
import android.provider.MediaStore
import retrofit2.Callback
import retrofit2.Response
import java.io.ByteArrayOutputStream
import android.graphics.BitmapFactory
import okhttp3.MediaType
import okhttp3.RequestBody
import java.io.File
import android.R.attr.bitmap
import android.R.attr.bitmap








class RegistrarAvanceActivity : AppCompatActivity() {

    private val apiService by lazy {
        ApiService.create()
    }
    private val preferences by lazy {
        PreferenceHelper.defaultPrefs(this)
    }

    private val SELECT_ACTIVITY =50

    private var imageUri: Uri?=null

    var bm: Bitmap? = null

    private var postPath: String? =null

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_registrar_avance)

        val btn_save=findViewById<Button>(R.id.btn_save)

        btn_save.setOnClickListener {
            perfomStoreAvance()

        }

        val img_load=findViewById<ImageView>(R.id.imageSelected)

        img_load.setOnClickListener{
            selectPhoto(this@RegistrarAvanceActivity, SELECT_ACTIVITY)
        }




        loadContratos()
        loadConceptos()
        loadAvances()


    }

    private fun perfomStoreAvance(){


        val jwt =preferences["jwt",""]

        val byteArrayOutputStream = ByteArrayOutputStream()
        bm?.compress(Bitmap.CompressFormat.JPEG, 75, byteArrayOutputStream)
        val imageInByte = byteArrayOutputStream.toByteArray()
        val imagen = Base64.encodeToString(imageInByte, Base64.DEFAULT)

        val authHeader="Bearer $jwt"
        val etIdAvance=findViewById<EditText>(R.id.id_avance)
        val id_avance= etIdAvance.text.toString()
        val etDescripcion=findViewById<EditText>(R.id.descripcion)
        val descripcion= etDescripcion.text.toString()

        if(id_avance.isEmpty()){
            etIdAvance.error=getString(R.string.error_vacio_concepto)
            return
        }

        if(descripcion.length<3){
            etDescripcion.error=getString(R.string.error_descripcion)
            return
        }


      val call=apiService.postAvance(authHeader, id_avance , imagen , descripcion )
        call.enqueue(object: Callback<SimpleResponse>{
            override fun onResponse(
                call: Call<SimpleResponse>,
                response: Response<SimpleResponse>
            ) {
                if(response.isSuccessful){
                    toast("Avance registrado exitosamente.")
                    finish()
                }
            }

            override fun onFailure(call: Call<SimpleResponse>, t: Throwable) {
                toast(t.localizedMessage)
                toast("Error no se pudo registrar el avance")
            }

        })

    }



    override fun onActivityResult(requestCode: Int, resultCode: Int, data: Intent?) {
        super.onActivityResult(requestCode, resultCode, data)

        when{
            requestCode==SELECT_ACTIVITY && resultCode== Activity.RESULT_OK->{
                imageUri =data!!.data
                val img_load=findViewById<ImageView>(R.id.imageSelected)
                bm=MediaStore.Images.Media.getBitmap(contentResolver,imageUri)
                img_load.setImageBitmap(bm)
            }
        }
    }

  /*  private fun covertTString() : String{
        val byteArrayOutputStream = ByteArrayOutputStream()
        bm?.compress(Bitmap.CompressFormat.JPEG, 100, byteArrayOutputStream)
        val imgByte = byteArrayOutputStream.toByteArray()
        return Base64.encodeToString(imgByte, Base64.DEFAULT)

    }*/

    private fun loadContratos(){
        val jwt =preferences["jwt",""]
        val call= apiService.getContratosId("Bearer $jwt")
        call.enqueue(object: Callback<ArrayList<Contrato>> {
            override fun onResponse(
                call: Call<ArrayList<Contrato>>,
                response: Response<ArrayList<Contrato>>
            ) {
                if(response.isSuccessful){
                    response.body()?.let {
                        val contratos = it.toMutableList()
                        val spinnercontratos=findViewById<Spinner>(R.id.spinner_contrato)
                        spinnercontratos.adapter=ArrayAdapter<Contrato>(this@RegistrarAvanceActivity,android.R.layout.simple_list_item_1,contratos)
                    }


                }
            }

            override fun onFailure(call: Call<ArrayList<Contrato>>, t: Throwable) {
                toast(t.localizedMessage)
                finish()
            }

        } )

    }

    private fun loadConceptos(){

        val spinnercontratos=findViewById<Spinner>(R.id.spinner_contrato)
        spinnercontratos.onItemSelectedListener = object:AdapterView.OnItemSelectedListener{
            override fun onItemSelected(
                adapter: AdapterView<*>?,
                view: View?,
                position: Int,
                id: Long
            ) {
                val contrato=adapter?.getItemAtPosition(position) as Contrato
                loadConceptosId(contrato.id)
            }

            override fun onNothingSelected(parent: AdapterView<*>?) {

            }

        }
    }

    private fun loadAvances(){
        val spinnerconceptos=findViewById<Spinner>(R.id.spinner_concepto)
        spinnerconceptos.onItemSelectedListener = object:AdapterView.OnItemSelectedListener{
            override fun onItemSelected(
                adapter: AdapterView<*>?,
                view: View?,
                position: Int,
                id: Long
            ) {
                val concepto= adapter?.getItemAtPosition(position) as Concepto
                loadAvancesId(concepto.id)
            }

            override fun onNothingSelected(parent: AdapterView<*>?) {
                TODO("Not yet implemented")
            }

        }


    }


    private fun loadConceptosId(id: Int){
        val jwt =preferences["jwt",""]
        val spinnerconceptos=findViewById<Spinner>(R.id.spinner_concepto)
        val call= apiService.getConceptos(id)
        call.enqueue(object: Callback<ArrayList<Concepto>>{
            override fun onResponse(
                call: Call<ArrayList<Concepto>>,
                response: Response<ArrayList<Concepto>>
            ) {
                if(response.isSuccessful){
                    response.body()?.let {
                        val conceptos= it.toMutableList()
                        spinnerconceptos.adapter = ArrayAdapter<Concepto>(this@RegistrarAvanceActivity,android.R.layout.simple_list_item_1,conceptos)
                    }
                }
            }

            override fun onFailure(call: Call<ArrayList<Concepto>>, t: Throwable) {
                toast(t.localizedMessage)
            }

        })


    }

    private fun loadAvancesId(id: Int){
        val call=apiService.getAvances(id)
        call.enqueue(object : Callback<Avance>{
            override fun onResponse(call: Call<Avance>, response: Response<Avance>) {
                if(response.isSuccessful){
                    val avance  = response.body()
                    if(avance !=null){
                        displayAvanceId(avance)
                    }
                }
            }

            override fun onFailure(call: Call<Avance>, t: Throwable) {
                toast(t.localizedMessage)
            }

        })
    }

    private fun displayAvanceId(avance: Avance){
        val etIdAvance=findViewById<EditText>(R.id.id_avance)
        etIdAvance.setText(avance.id)
    }

    private fun selectPhoto(activity: Activity, code: Int){
        val intent= Intent(Intent.ACTION_PICK)
        intent.type="image/*"
        activity.startActivityForResult(intent,code)
    }
}