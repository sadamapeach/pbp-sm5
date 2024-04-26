package com.android.restaurantapp.model;

class Review {
    private var id = 0
    private var writer: String? = null
    private var content: String? = null
    private var createdAt: String? = null

    fun Review(id: Int, writer: String?, content: String?, createdAt: String?) {
        this.id = id
        this.writer = writer
        this.content = content
        this.createdAt = createdAt
    }

    fun getId(): Int {
        return id
    }

    fun setId(id: Int) {
        this.id = id
    }

    fun getWriter(): String? {
        return writer
    }

    fun setWriter(writer: String?) {
        this.writer = writer
    }

    fun getContent(): String? {
        return content
    }

    fun setContent(content: String?) {
        this.content = content
    }

    fun getCreatedAt(): String? {
        return createdAt
    }

    fun setCreatedAt(createdAt: String?) {
        this.createdAt = createdAt
    }
}
