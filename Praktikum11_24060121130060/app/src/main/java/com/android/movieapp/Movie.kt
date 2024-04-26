package com.android.movieapp
import android.media.Rating
import java.io.Serializable

class Movie : Serializable {
    private var title: String? = null
    private var description: String? = null
    private var posterImage = 0

    fun getTitle(): String? {
        return title
    }
    fun setTitle(title: String?) {
        this.title = title
    }
    fun getDescription(): String? {
        return description
    }
    fun setDescription(description: String?) {
        this.description = description
    }
    fun getPosterImage(): Int {
        return posterImage
    }
    fun setPosterImage(posterImage: Int) {
        this.posterImage = posterImage
    }
}