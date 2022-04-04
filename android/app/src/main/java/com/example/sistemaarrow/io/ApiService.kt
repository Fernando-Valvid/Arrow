package com.example.sistemaarrow.io

import com.example.sistemaarrow.io.response.LoginResponse
import com.example.sistemaarrow.io.response.SimpleResponse
import com.example.sistemaarrow.model.Avance
import com.example.sistemaarrow.model.Concepto
import com.example.sistemaarrow.model.Contrato
import com.example.sistemaarrow.model.User
import retrofit2.Call
import retrofit2.Retrofit
import retrofit2.converter.gson.GsonConverterFactory
import okhttp3.OkHttpClient
import okhttp3.logging.HttpLoggingInterceptor
import retrofit2.http.*
import okhttp3.RequestBody

import okhttp3.MultipartBody
import retrofit2.Response

import retrofit2.http.POST

import retrofit2.http.Multipart





interface ApiService {

    @GET("auth/contratos")
    fun getContratos(@Header("Authorization") authHeader:String):
            Call<ArrayList<Contrato>>

    @GET("auth/contratoid")
    fun getContratosId(@Header("Authorization") authHeader:String):
            Call<ArrayList<Contrato>>

    @GET("auth/contratos/{id}/conceptos")
    abstract fun getConceptos(@Path("id")  id:Int): Call<ArrayList<Concepto>>

    @GET("auth/conceptos/{id}/avances")
    abstract fun getAvances(@Path("id")  id:Int): Call<Avance>

    @POST("auth/login")
    fun postLogin(@Query("email") email: String, @Query("password") password:String):
                  Call<LoginResponse>
    @POST("auth/logout")
    fun postLogout(@Header("Authorization") authHeader:String): Call<Void>

    @GET("auth/user")
    @Headers("Accept: application/json")
    fun getUser(@Header("Authorization") authHeader:String):Call<User>

    @POST("auth/update")
    @Headers("Accept: application/json")
    fun postUser(@Header("Authorization") authHeader:String,
    @Query("name")name: String):Call<Void>

    @FormUrlEncoded
    @POST("auth/avances/store")
    fun postAvance(@Header("Authorization") authHeader: String,
                   @Query("id_avance") id_avance : String,
                   @Field("imagen")imagen : String,
                   @Query("descripcion") descripcion:String): Call<SimpleResponse>

    @GET("auth/contratos/busqueda")
    @Headers("Accept: application/json")
    fun getSearch(@Header("Authorization") authHeader:String,
                  @Query("busqueda") busqueda: String)
    :Call<ArrayList<Contrato>>



    companion object Factory{
        private const val BASE_URL="http://arrow.valvid.mx/public/api/"
        fun create():ApiService{
            val interceptor= HttpLoggingInterceptor()
            interceptor.level=HttpLoggingInterceptor.Level.BODY
            val client =OkHttpClient.Builder().addInterceptor(interceptor).build()

            val retrofit=Retrofit.Builder()
                .baseUrl(BASE_URL)
                .addConverterFactory(GsonConverterFactory.create())
                .client(client)
                .build()

            return retrofit.create(ApiService::class.java)
        }
    }

   
}