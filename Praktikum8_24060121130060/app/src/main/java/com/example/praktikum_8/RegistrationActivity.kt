package com.example.praktikum_8

import android.annotation.SuppressLint
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.TextView

class RegistrationActivity : AppCompatActivity() {
    companion object {
        const val EXTRA_NAME = "extra_name"
    }

    private lateinit var tv_nama: TextView

    @SuppressLint("MissingInflatedId")
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_registration)

        val name = intent.getStringExtra(EXTRA_NAME)
        tv_nama = findViewById(R.id.tv_nama)
        tv_nama.text = "Nama: $name"
    }
}