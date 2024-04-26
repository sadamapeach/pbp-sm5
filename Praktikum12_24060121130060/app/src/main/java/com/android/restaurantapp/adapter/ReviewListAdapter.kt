package com.android.restaurantapp.adapter;

import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView
import com.android.restaurantapp.R
import com.android.restaurantapp.model.Review

class ReviewListAdapter(reviews: ArrayList<Review>?) : RecyclerView.Adapter<ReviewListAdapter.ReviewViewHolder>() {
    private var reviews: ArrayList<Review>? = null

    override fun onCreateViewHolder(
        parent: ViewGroup,
        viewType: Int
    ): ReviewListAdapter.ReviewViewHolder {
        val view: View =
            LayoutInflater.from(parent.context).inflate(R.layout.item_review, parent, false)
        return ReviewViewHolder(view)
    }

    override fun onBindViewHolder(holder: ReviewListAdapter.ReviewViewHolder, position: Int) {
        val review = reviews!![position]

        holder.tvContent.text = review.getContent()
        holder.tvReviewer.text = review.getWriter()
    }

    override fun getItemCount(): Int {
        return reviews!!.size;
    }

    class ReviewViewHolder(itemView: View) : RecyclerView.ViewHolder(itemView) {
        var tvContent: TextView
        var tvReviewer: TextView

        init {
            tvContent = itemView.findViewById<TextView>(R.id.item_tv_restaurant_review)
            tvReviewer = itemView.findViewById<TextView>(R.id.item_tv_restaurant_reviewer)
        }
    }
}
