<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\User;

class ReviewController extends Controller
{
    public function addReview(Request $request){
        $userId = auth()->user()->id;
        $reviewText = $request->review;
        $productId = $request->productId;
        $mark = $request->mark;
        $review = new Review();
        $review->product_id = $productId;
        $review->user_id = $userId;
        $review->mark = $mark;
        $review->review = $reviewText;
        $review->save();
        return json_encode(['result'=>'success']);
    }
    public function getReviews(Request $request){ // /getReviews/1 /getReviews/{productId}
        $productId = $request->productId;
        $reviews = Review::where('product_id', $productId)->get();
        foreach ($reviews as $review){
            $user = User::where('id', $review->user_id)->first();
            $review->userName = $user->name;
        }
        return json_encode($reviews);
    }
}
