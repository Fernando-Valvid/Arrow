package com.example.sistemaarrow.ui

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.example.sistemaarrow.ConceptosAdapter

import com.example.sistemaarrow.R
import com.example.sistemaarrow.model.Concepto
//import com.example.sistemaarrow.ConceptossAdapter)


class ConceptosActivity : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_conceptos)

        val conceptos=ArrayList<Concepto>()

        conceptos.add(
            Concepto(1,"7628738")
        )
        conceptos.add(
            Concepto(1,"223")
        )


        val rvConceptos=findViewById<RecyclerView>(R.id.rvConceptos)
        rvConceptos.layoutManager= LinearLayoutManager(this)
        rvConceptos.adapter= ConceptosAdapter(conceptos)
    }
}