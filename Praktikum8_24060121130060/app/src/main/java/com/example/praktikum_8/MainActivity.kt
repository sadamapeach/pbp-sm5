package com.example.praktikum_8

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.view.View
import android.widget.Button
import android.widget.EditText

class MainActivity : AppCompatActivity(), View.OnClickListener {

    private lateinit var btnStart: Button
    private lateinit var et_nama: EditText

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)

        btnStart = findViewById(R.id.btn_start)
        et_nama = findViewById(R.id.et_nama)

        btnStart.setOnClickListener(this)
    }

    override fun onClick(view: View?) {
        if (view != null) {
            if (view.id == R.id.btn_start) {
                val registrationIntent = Intent(this, RegistrationActivity::class.java)
                registrationIntent.putExtra(RegistrationActivity.EXTRA_NAME, et_nama.text.toString())

                startActivity(registrationIntent)
            }
        }
    }
}