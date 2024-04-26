package com.android.restaurantapp.activity;

import android.os.Bundle
import android.os.PersistableBundle
import android.view.View
import android.view.inputmethod.InputMethodManager
import android.widget.EditText
import android.widget.ImageView
import android.widget.TextView
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.android.restaurantapp.BuildConfig
import com.android.restaurantapp.R
import com.android.restaurantapp.adapter.ReviewListAdapter
import com.android.restaurantapp.model.Restaurant
import com.android.restaurantapp.model.Review
import com.bumptech.glide.Glide
import com.google.android.material.button.MaterialButton
import com.loopj.android.http.AsyncHttpClient
import com.loopj.android.http.AsyncHttpResponseHandler
import com.loopj.android.http.RequestParams
import cz.msebera.android.httpclient.Header
import org.json.JSONObject
import java.util.Locale

class DetailActivity : AppCompatActivity(), View.OnClickListener {
    private var restaurantId = 0
    private var ivRestaurantCover: ImageView? = null
    private var tvRestaurantName: TextView? = null
    private var tvRestaurantDescription: TextView? = null
    private lateinit var rvReviews: RecyclerView
    private var etReview: EditText? = null

    override fun onCreate(savedInstanceState: Bundle?, persistentState: PersistableBundle?) {
        super.onCreate(savedInstanceState, persistentState)
        setContentView(R.layout.activity_detail)

        ivRestaurantCover = findViewById<ImageView>(R.id.iv_restaurant_image)
        tvRestaurantName = findViewById<TextView>(R.id.tv_restaurant_name)
        tvRestaurantDescription = findViewById<TextView>(R.id.tv_restaurant_description)
        etReview = findViewById<EditText>(R.id.et_restaurant_review)

        rvReviews = findViewById<RecyclerView>(R.id.rv_restaurant_reviews)
        rvReviews.layoutManager = LinearLayoutManager(this@DetailActivity)
        rvReviews.setHasFixedSize(true)

        val btnSendReview = findViewById<MaterialButton>(R.id.btn_send_review)
        btnSendReview.setOnClickListener(this)

        val restaurantId = intent.getIntExtra(KEY_RESTAURANT_ID, 0)
        this.restaurantId = restaurantId

        getRestaurantDetail(restaurantId)
    }

    fun parseRestaurantView(restaurant: Restaurant) {
        tvRestaurantName!!.text = restaurant.getName()
        tvRestaurantDescription!!.text = restaurant.getDescription()
        val imgUrl: String =
            BuildConfig.API_BASE_URL + "api/v1/restaurants/cover/" + restaurant.getCoverUrl()
        Glide.with(this@DetailActivity)
            .load(imgUrl)
            .into(ivRestaurantCover!!)
    }

    fun getRestaurantDetail(restaurantId: Int) {
        val client = AsyncHttpClient()
        val url = BuildConfig.API_BASE_URL + "api/v1/restaurants/" + restaurantId
        client[url, object : AsyncHttpResponseHandler() {
            override fun onSuccess(
                statusCode: Int,
                headers: Array<out Header>?,
                responseBody: ByteArray
            ) {
                val response = String(responseBody)
                try {
                    val jsonResponse = JSONObject(response)
                    val jsonData = jsonResponse.getJSONObject("data")
                    val arrReviews = jsonData.getJSONArray("reviews")
                    val id = jsonData.getInt("id")
                    val name = jsonData.getString("name")
                    val description = jsonData.getString("about")
                    val coverUrl = jsonData.getString("cover_url")
                    val reviews = ArrayList<Review>()
                    for (i in 0 until arrReviews.length()) {
                        val jsonReview = arrReviews.getJSONObject(i)
                        val reviewId = jsonReview.getInt("id")
                        val writer = jsonReview.getString("writer")
                        val content = jsonReview.getString("content")
                        val createdAt = jsonReview.getString("created_at")
                        val review = Review()
                        review.Review(reviewId, writer, content, createdAt)
                        reviews.add(review)
                    }
                    val restaurant = Restaurant()
                    restaurant.Restaurant(id, name, description, coverUrl)
                    parseRestaurantView(restaurant)
                    parseRestaurantReviewView(reviews)
                } catch (e: Exception) {
                    Toast.makeText(
                        this@DetailActivity, e.message,
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
                val message = String.format(
                    Locale.getDefault(), "Error with code: %d", statusCode)
                        Toast.makeText(this@DetailActivity, message,
                    Toast.LENGTH_SHORT).show()
            }
        }]
    }

    fun parseRestaurantReviewView(reviews: ArrayList<Review>?) {
        val adapter = ReviewListAdapter(reviews)
        rvReviews.adapter = adapter
    }

    fun postRestaurantReview(restaurantId: Int) {
        val client = AsyncHttpClient()
        val params = RequestParams()
        val reviewerName = "<NAMA>" // Sesuaikan dengan nama kamu
        val reviewerContent = etReview!!.text.toString().trim { it <= ' ' }
        params.put("writer", reviewerName)
        params.put("content", reviewerContent)
        val url = BuildConfig.API_BASE_URL + "api/v1/restaurants/" + restaurantId +
                "/reviews"
        client.post(url, params, object : AsyncHttpResponseHandler() {
            override fun onSuccess(
                statusCode: Int,
                headers: Array<out Header>?,
                responseBody: ByteArray
            ) {
                val response = String(responseBody)
                try {
                    val jsonResponse = JSONObject(response)
                    val arrReviews = jsonResponse.getJSONArray("data")
                    val reviews = ArrayList<Review>()
                    for (i in 0 until arrReviews.length()) {
                        val jsonReview = arrReviews.getJSONObject(i)
                        val id = jsonReview.getInt("id")
                        val writer = jsonReview.getString("writer")
                        val content = jsonReview.getString("content")
                        val createdAt = jsonReview.getString("created_at")
                        val review = Review()
                        review.Review(id, writer, content, createdAt)
                        reviews.add(review)
                    }
                    parseRestaurantReviewView(reviews)
                } catch (e: java.lang.Exception) {
                    Toast.makeText(
                        this@DetailActivity, e.message,
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
                val message = String.format(Locale.getDefault(), "Error with code: %d", statusCode)
                Toast.makeText(this@DetailActivity, message, Toast.LENGTH_SHORT).show()
            }
        })
    }

    override fun onClick(view: View?) {
        if (view!!.id === R.id.btn_send_review) {
            postRestaurantReview(restaurantId)
            val imm = getSystemService(INPUT_METHOD_SERVICE) as InputMethodManager
            imm.hideSoftInputFromWindow(view!!.windowToken, 0)
            Toast.makeText(this@DetailActivity, "Writing review...", Toast.LENGTH_SHORT).show()
        }
    }

    companion object {
        val KEY_RESTAURANT_ID = "key_restaurant"
    }
}