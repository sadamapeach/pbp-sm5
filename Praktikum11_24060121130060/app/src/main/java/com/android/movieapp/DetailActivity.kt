package com.android.movieapp

import android.os.Bundle
import android.widget.ImageView
import android.widget.TextView
import androidx.appcompat.app.AppCompatActivity
import com.bumptech.glide.Glide

class DetailActivity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_detail)

        // Mendapatkan data Movie yang dipilih dari Intent
        val movie = intent.getSerializableExtra("MOVIE") as Movie

        // Inisialisasi komponen tampilan pada layout detail
        val ivPoster: ImageView = findViewById(R.id.iv_detail_poster)
        val tvTitle: TextView = findViewById(R.id.tv_detail_title)
        val tvDescription: TextView = findViewById(R.id.tv_detail_description)

        // Mengisi komponen tampilan dengan informasi Movie
        Glide.with(this)
            .load(movie.getPosterImage())
            .into(ivPoster)
        tvTitle.text = movie.getTitle()
        tvDescription.text = movie.getDescription()
    }
}