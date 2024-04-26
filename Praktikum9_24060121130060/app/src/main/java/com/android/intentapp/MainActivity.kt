package com.android.intentapp

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.view.View
import android.widget.Button

class MainActivity : AppCompatActivity(), View.OnClickListener {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)
        val btnStart: Button = findViewById(R.id.btn_start)
        btnStart.setOnClickListener(this)
    }

    override fun onClick(view: View?) {
        if (view != null) {
            if (view.id == R.id.btn_start) {
                val registrationIntent = Intent(
                    this,
                    RegistrationActivity::class.java)
                startActivity(registrationIntent)
            }
        }
    }
}