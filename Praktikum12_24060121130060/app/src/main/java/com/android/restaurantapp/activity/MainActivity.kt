package com.android.restaurantapp.activity;

import android.content.Intent
import android.os.Bundle
import android.os.PersistableBundle
import android.util.Log
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.android.restaurantapp.BuildConfig
import com.android.restaurantapp.R
import com.android.restaurantapp.adapter.RestaurantListAdapter
import com.android.restaurantapp.adapter.RestaurantListAdapter.OnItemClickCallback
import com.android.restaurantapp.model.Restaurant
import com.loopj.android.http.AsyncHttpClient
import com.loopj.android.http.AsyncHttpResponseHandler
import cz.msebera.android.httpclient.Header
import org.json.JSONObject
import java.util.Locale

class MainActivity : AppCompatActivity() {
    private val TAG = "MainActivity"
    private lateinit var rvRestaurants: RecyclerView

    override fun onCreate(savedInstanceState: Bundle?, persistentState: PersistableBundle?) {
        super.onCreate(savedInstanceState, persistentState)
        setContentView(R.layout.activity_main);

        rvRestaurants = findViewById(R.id.rv_restaurants);
        rvRestaurants.setHasFixedSize(true);
        rvRestaurants.layoutManager = LinearLayoutManager(this@MainActivity)

        getRestaurantData();
    }

    private fun getRestaurantData() {
        // TODO 5: Lengkapi fungsi getRestaurantData
        val client = AsyncHttpClient()
        val url = BuildConfig.API_BASE_URL + "api/v1/restaurants"
        client.get(url, object : AsyncHttpResponseHandler() {
            override fun onSuccess(
                statusCode: Int,
                headers: Array<out Header>?,
                responseBody: ByteArray
            ) {
                val response = String(responseBody)
                Log.d(TAG, response)
                try {
                    val jsonResponse = JSONObject(response)
                    val arrRestaurants = jsonResponse.getJSONArray("data")
                    val restaurants = ArrayList<Restaurant>()
                    for (i in 0 until arrRestaurants.length()) {
                        val jsonRestaurant = arrRestaurants.getJSONObject(i)
                        val id = jsonRestaurant.getInt("id")
                        val name = jsonRestaurant.getString("name")
                        val description = jsonRestaurant.getString("about")
                        val coverUrl = jsonRestaurant.getString("cover_url")
//                        val restaurant = Restaurant(id, name, description, coverUrl)
                        val restaurant = Restaurant()
                        restaurant.Restaurant(id, name, description, coverUrl)
                        restaurants.add(restaurant)
                    }
                    parseRestaurantsView(restaurants)
                } catch (e: Exception) {
                    Toast.makeText(
                        this@MainActivity, e.message,
                        Toast.LENGTH_SHORT
                    ).show()
                }
            }
            override fun onFailure(
                statusCode: Int,
                headers: Array<out Header>?,
                responseBody: ByteArray?,
                error: Throwable?
            ) {
                var message: String = String.format(
                    Locale.getDefault(), "Error with code: %d", statusCode)
                    Toast.makeText(this@MainActivity, message, Toast.LENGTH_SHORT).show();
            }
        })
    }

    private fun moveToDetailActivity(restaurant: Restaurant?) {
        val intent = Intent(this@MainActivity, DetailActivity::class.java)
        intent.putExtra(DetailActivity.KEY_RESTAURANT_ID, restaurant!!.getId())
        startActivity(intent)
    }

    private fun parseRestaurantsView(restaurants: ArrayList<Restaurant>) {
        val adapter = RestaurantListAdapter(restaurants)
        adapter.setOnItemClickCallback(object : OnItemClickCallback {
            override fun onItemClicked(restaurant: Restaurant?) {
                moveToDetailActivity(restaurant)
            }
        })
        rvRestaurants.adapter = adapter
    }
}