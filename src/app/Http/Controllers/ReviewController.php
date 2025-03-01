<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Fav;
use App\Models\User;
use App\Models\Shop;
use App\Models\ShopReview;
use App\Models\Booking;
use App\Models\Keyword;
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function review(Request $request)
    {
        $user = Auth::user();
        ShopReview::create([
            'shop_id' => $request->shop_id,
            'user_id' => $user->id,
            'stars' => $request->stars,
            'comment' => $request->comment,
        ]);

        $target = Booking::where('id', $request->booking_id)->first();
        $target->update([
            'posted' => 1,
        ]);
        
        $favs = Fav::where('user_id', $user->id)->orderBy('shop_id', 'asc')->get();
        $shops = Shop::get();
        $booking_No = 1;
        $No = 1;
        $reviews = ShopReview::where('user_id', $user->id)->get();
        $bookings = Booking::where('user_id', $user->id)->get();

        return view('mypage', compact('shops', 'bookings', 'booking_No', 'No', 'favs', 'reviews'));
    }
    public function edit(REQUEST $Request)
    {
        $target = ShopReview::where('id', $Request->review_id)->first();
        $target->update([
            'stars' => $Request->posted_stars,
            'comment' => $Request->comment,
        ]);
        $user = Auth::user();
        $favs = Fav::where('user_id', $user->id)->orderBy('shop_id', 'asc')->get();
        $shops = Shop::get();
        $bookings = Booking::where('user_id', $user->id)->get();
        $booking_No = 1;
        $No = 1;
        $reviews = ShopReview::where('user_id', $user->id)->get();
        return view('mypage', compact('shops', 'bookings', 'booking_No', 'No', 'favs', 'reviews'));
    }
}