package com.example.sistemaarrow

import android.transition.AutoTransition
import android.transition.TransitionManager
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Button
import android.widget.ImageView
import android.widget.LinearLayout
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView
import com.example.sistemaarrow.model.Contrato



class ContratosAdapter : RecyclerView.Adapter<ContratosAdapter.ViewHolder>() {

    var contratos = ArrayList<Contrato>()

    class ViewHolder(itemView: View): RecyclerView.ViewHolder(itemView){

        val tvcontrato: TextView
        val tvnombreobra: TextView
        val tvdescripcion: TextView
        val tvfechaalta: TextView
        val tvubicacion: TextView
        val tvfechainicio: TextView
        val tvfechatemrino: TextView
        val tvplazo: TextView
        val tvimporte: TextView
        val tvamortizacion: TextView
        val tvcliente: TextView
        val btnExpand: ImageView
        val linearDetails: LinearLayout


        init {
            // Define click listener for the ViewHolder's View.
            tvcontrato = itemView.findViewById(R.id.tvcontrato)
            tvnombreobra = itemView.findViewById(R.id.tvnombreobra)
            tvdescripcion=itemView.findViewById(R.id.tvdescripcion)
            tvfechaalta=itemView.findViewById(R.id.tvfechaalta)
            tvubicacion = itemView.findViewById(R.id.tvubicacion)
            tvfechainicio=itemView.findViewById(R.id.tvfechainicio)
            tvfechatemrino=itemView.findViewById(R.id.tvfechatermino)
            tvplazo=itemView.findViewById(R.id.tvplazo)
            tvimporte=itemView.findViewById(R.id.tvimporte)
            tvamortizacion=itemView.findViewById(R.id.tvamortizacion)
            tvcliente=itemView.findViewById(R.id.tvcliente)

            btnExpand=itemView.findViewById(R.id.ibExpand)

            linearDetails=itemView.findViewById(R.id.linearLayoutDetails)

            btnExpand.setOnClickListener {

                
                if (linearDetails.visibility == View.VISIBLE) {
                    linearDetails.visibility = View.GONE
                    btnExpand.setImageResource(R.drawable.ic_expand)
                } else{
                    linearDetails.visibility = View.VISIBLE
                    btnExpand.setImageResource(R.drawable.ic_expand_less)
                }
            }


        }

    }
    //Crear un viewholder y regresar un objeto de la clase, inflar el xml
    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ViewHolder {
        return ViewHolder(
            LayoutInflater.from(parent.context).inflate(R.layout.item_contrato,parent,false)
        )
    }
    //Enlazar la data que tenemos en el dataset con la vista
    override fun onBindViewHolder(holder: ViewHolder, position: Int) {
        val contrato=contratos[position]
        holder.tvcontrato.text =contrato.contrato.toString()
        holder.tvnombreobra.text=contrato.nombre_obra.toString()
        holder.tvdescripcion.text=contrato.descripcion.toString()
        holder.tvfechaalta.text=contrato.fecha_alta.toString()
        holder.tvubicacion.text=contrato.ubicacion.toString()
        holder.tvfechainicio.text=contrato.fecha_inicio.toString()
        holder.tvfechatemrino.text=contrato.fecha_termino.toString()
        holder.tvplazo.text=contrato.plazo_dias.toString()
        holder.tvimporte.text=contrato.importe.toString()
        holder.tvamortizacion.text=contrato.amortizacion.toString()
        holder.tvcliente.text=contrato.nombre_cliente.toString()



    }
    //Devolver la cantidad de elementos
    override fun getItemCount(): Int = contratos.size

}