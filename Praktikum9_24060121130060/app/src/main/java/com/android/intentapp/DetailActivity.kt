package com.android.intentapp

import android.content.Intent
import android.net.Uri
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.view.View
import android.widget.Button
import android.widget.TextView

class DetailActivity : AppCompatActivity(), View.OnClickListener {
    // Deklarasi variabel kunci yang akan digunakan untuk bertukar informasi
    companion object {
        const val KEY_NAME = "key_name"
        const val KEY_NIM = "key_nim"
        const val KEY_PHONE = "key_phone"
        const val KEY_EMAIL = "key_email"
    }

    private var phoneNumber: String? = null
    private var emailString: String? = null

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_detail)

        val tvName = findViewById<TextView>(R.id.tv_name)
        val tvNIM = findViewById<TextView>(R.id.tv_nim)
        val tvPhone = findViewById<TextView>(R.id.tv_phone)
        val tvEmail = findViewById<TextView>(R.id.tv_email)

        // Mengambil data dari Intent
        val name = intent.getStringExtra(KEY_NAME)
        val nim = intent.getStringExtra(KEY_NIM)
        val phone = intent.getStringExtra(KEY_PHONE)
        val email = intent.getStringExtra(KEY_EMAIL)

        // Memasukkan data ke view
        tvName.text = String.format("Nama: %s", name)
        tvNIM.text = String.format("NIM: %s", nim)
        tvPhone.text = String.format("No. HP: %s", phone)
        tvEmail.text = String.format("Email: %s", email)

        phoneNumber = phone;
        val btnPhoneCall = findViewById<Button>(R.id.btn_phone_call)
        btnPhoneCall.setOnClickListener(this);

        emailString = email;
        val btnSendEmail = findViewById<Button>(R.id.btn_email)
        btnSendEmail.setOnClickListener(this);
    }

    override fun onClick(view: View?) {
        if (view != null) {
            if (view.id == R.id.btn_phone_call) {
                val callPhoneIntent = Intent()
                callPhoneIntent.action = Intent.ACTION_DIAL
                callPhoneIntent.data = Uri.parse("tel:$phoneNumber")
                startActivity(callPhoneIntent)
            } else if (view.id == R.id.btn_email) {
                val emailIntent = Intent()
                emailIntent.action = Intent.ACTION_SENDTO
                emailIntent.data = Uri.parse("mailto:$emailString")
                startActivity(emailIntent)
            }
        }
    }
}