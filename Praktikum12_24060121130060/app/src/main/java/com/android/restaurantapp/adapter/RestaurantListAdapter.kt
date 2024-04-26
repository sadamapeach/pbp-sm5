package com.android.restaurantapp.adapter;

import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.ImageView
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView
import com.android.restaurantapp.BuildConfig
import com.android.restaurantapp.R
import com.android.restaurantapp.model.Restaurant
import com.bumptech.glide.Glide

class RestaurantListAdapter(restaurants: ArrayList<Restaurant>?) : RecyclerView.Adapter<RestaurantListAdapter.RestaurantViewHolder>() {
    private var restaurants: ArrayList<Restaurant>? = null
    private var onItemClickCallback: OnItemClickCallback? = null

    fun setOnItemClickCallback(onItemClickCallback: OnItemClickCallback?) {
        this.onItemClickCallback = onItemClickCallback
    }

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): RestaurantViewHolder {
        val view: View =
            LayoutInflater.from(parent.context).inflate(R.layout.item_restaurant, parent, false)
        return RestaurantViewHolder(view)
    }

    override fun getItemCount(): Int {
        return restaurants!!.size;
    }

    override fun onBindViewHolder(holder: RestaurantViewHolder, position: Int) {
        val restaurant = restaurants!![position]

        val imgUrl: String =
            BuildConfig.API_BASE_URL + "api/v1/restaurants/cover/" + restaurant.getCoverUrl()

        Glide.with(holder.itemView.context)
            .load(imgUrl)
            .into(holder.ivRestaurantImage)

        holder.tvRestaurantName.text = restaurant.getName()
        holder.tvRestaurantDescription.text = restaurant.getDescription()

        holder.itemView.setOnClickListener { view -> onItemClickCallback!!.onItemClicked(restaurant) }
    }

    class RestaurantViewHolder(itemView: View) : RecyclerView.ViewHolder(itemView) {
        var ivRestaurantImage: ImageView
        var tvRestaurantName: TextView
        var tvRestaurantDescription: TextView

        init {
            ivRestaurantImage = itemView.findViewById<ImageView>(R.id.item_iv_restaurant_image)
            tvRestaurantName = itemView.findViewById<TextView>(R.id.item_tv_restaurant_name)
            tvRestaurantDescription =
                itemView.findViewById<TextView>(R.id.item_tv_restaurant_description)
        }
    }

    interface OnItemClickCallback {
        fun onItemClicked(restaurant: Restaurant?)
    }
}
