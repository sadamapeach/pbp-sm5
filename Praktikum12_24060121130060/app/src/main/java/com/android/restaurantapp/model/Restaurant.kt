package com.android.restaurantapp.model;

class Restaurant {
    private var id = 0
    private var name: String? = null
    private var description: String? = null
    private var coverUrl: String? = null

    fun Restaurant(id: Int, name: String?, description: String?, coverUrl: String?) {
        this.id = id
        this.name = name
        this.description = description
        this.coverUrl = coverUrl
    }

    fun getId(): Int {
        return id
    }

    fun setId(id: Int) {
        this.id = id
    }

    fun getName(): String? {
        return name
    }

    fun setName(name: String?) {
        this.name = name
    }

    fun getDescription(): String? {
        return description
    }

    fun setDescription(description: String?) {
        this.description = description
    }

    fun getCoverUrl(): String? {
        return coverUrl
    }

    fun setCoverUrl(coverUrl: String?) {
        this.coverUrl = coverUrl
    }
}
