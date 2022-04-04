package com.example.sistemaarrow

import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView
import com.example.sistemaarrow.model.Concepto


class  ConceptosAdapter(private val conceptos: ArrayList<Concepto>) : RecyclerView.Adapter<ConceptosAdapter.ViewHolder>() {

    class ViewHolder(itemView: View): RecyclerView.ViewHolder(itemView){

        val tvcodigo: TextView
        val tvconcepto: TextView
        val tvunidad: TextView
        val tvcantidad: TextView
        val tvpunitario: TextView


        init {
            // Define click listener for the ViewHolder's View.
            tvcodigo = itemView.findViewById(R.id.tvcodigo)
            tvconcepto = itemView.findViewById(R.id.tvconcepto)
            tvunidad = itemView.findViewById(R.id.tvunidad)
            tvcantidad=itemView.findViewById(R.id.tvcantidad)
            tvpunitario=itemView.findViewById(R.id.tvpunitario)


        }

    }
    //Crear un viewholder y regresar un objeto de la clase, inflar el xml
    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ViewHolder {
        return ViewHolder(
            LayoutInflater.from(parent.context).inflate(R.layout.item_concepto,parent,false)
        )
    }
    //Enlazar la data que tenemos en el dataset con la vista
    override fun onBindViewHolder(holder: ViewHolder, position: Int) {
        val concepto=conceptos[position]
        holder.tvcodigo.text =concepto.codigo.toString()


    }
    //Devolver la cantidad de elementos
    override fun getItemCount(): Int = conceptos.size
}