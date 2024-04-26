package com.android.movieapp

import android.content.Context
import android.content.Intent
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.ImageView
import android.widget.TextView
import android.widget.Toast
import androidx.recyclerview.widget.RecyclerView
import com.bumptech.glide.Glide

class ListMovieAdapter(private val context: Context, private val listMovies: ArrayList<Movie>?) :
    RecyclerView.Adapter<ListMovieAdapter.ListViewHolder>() {

    inner class ListViewHolder(itemView: View) : RecyclerView.ViewHolder(itemView) {
        var ivMoviePoster: ImageView = itemView.findViewById(R.id.iv_movie_poster)
        var tvMovieTitle: TextView = itemView.findViewById(R.id.tv_movie_title)
        var tvMovieDescription: TextView = itemView.findViewById(R.id.tv_movie_description)
    }

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ListViewHolder {
        val view: View = LayoutInflater.from(parent.context)
            .inflate(R.layout.item_movie, parent, false)
        return ListViewHolder(view)
    }

    override fun onBindViewHolder(holder: ListViewHolder, position: Int) {
        val movie = listMovies!![position]
        Glide.with(holder.itemView.context)
            .load(movie.getPosterImage())
            .into(holder.ivMoviePoster)

        holder.tvMovieTitle.text = movie.getTitle()
        holder.tvMovieDescription.text = movie.getDescription()

        holder.itemView.setOnClickListener {
            // Membuat Intent untuk membuka DetailActivity
            val intent = Intent(holder.itemView.context, DetailActivity::class.java)
            // Mengirim data Movie ke DetailActivity
            intent.putExtra("MOVIE", movie)
            // Memulai DetailActivity
            holder.itemView.context.startActivity(intent)

            Toast.makeText(
                context,
                movie.getTitle(),
                Toast.LENGTH_SHORT
            ).show()
        }
    }

    override fun getItemCount(): Int {
        return listMovies?.size ?: 0
    }
}

private fun Intent.putExtra(key: String, movie: Movie) {
    putExtra(key, movie)
}
