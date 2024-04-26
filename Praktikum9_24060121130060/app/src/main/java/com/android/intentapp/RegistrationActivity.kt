package com.android.intentapp

import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.view.View
import android.widget.Button
import android.widget.EditText

class RegistrationActivity : AppCompatActivity(), View.OnClickListener {
    private var etName: EditText? = null
    private var etNIM: EditText? = null
    private var etPhone: EditText? = null
    private var etEmail: EditText? = null

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_registration)

        etName = findViewById(R.id.et_name);
        etNIM = findViewById(R.id.et_nim);
        etPhone = findViewById(R.id.et_phone_number);
        etEmail = findViewById(R.id.et_email);

        val btnNext = findViewById<Button>(R.id.btn_next)
        btnNext.setOnClickListener(this)
    }

    override fun onClick(view: View?) {
        if (view != null) {
            if (view.id == R.id.btn_next) {
                // Ambil data dari EditText
                val name = etName!!.text.toString().trim { it <= ' ' }
                val nim = etNIM!!.text.toString().trim { it <= ' ' }
                val phone = etPhone!!.text.toString().trim { it <= ' ' }
                val email = etEmail!!.text.toString().trim { it <= ' ' }

                // Pastikan seluruh EditText telah diisi
                var isEmptyField = false
                if (name.isEmpty()) {
                    etName!!.error = "Field harus diisi"
                    isEmptyField = true
                }

                if (nim.isEmpty()) {
                    etNIM!!.error = "Field harus diisi"
                    isEmptyField = true
                }

                if (phone.isEmpty()) {
                    etPhone!!.error = "Field harus diisi"
                    isEmptyField = true
                }

                if (phone.isEmpty()) {
                    etEmail!!.error = "Field harus diisi"
                    isEmptyField = true
                }

                // Jika seluruh EditText telah diisi, pindah Activity
                if (!isEmptyField) {
                    val detailIntent = Intent(
                        this,
                        DetailActivity::class.java
                    )
                    detailIntent.putExtra(DetailActivity.KEY_NAME, name)
                    detailIntent.putExtra(DetailActivity.KEY_NIM, nim)
                    detailIntent.putExtra(DetailActivity.KEY_PHONE, phone)
                    detailIntent.putExtra(DetailActivity.KEY_EMAIL, email)
                    startActivity(detailIntent)
                }
            }
        }
    }
}