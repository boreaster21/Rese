<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Fav;
use App\Models\User;
use App\Models\Shop;
use App\Models\ShopReview;
use App\Models\Booking;


class ReseController extends Controller
{
  public function allshop(REQUEST $request)
  {
    $areas = Shop::groupBy('area')->get('area');
    $ganres = Shop::groupBy('ganre')->get('ganre');
    // $favCounts = Shop::withCount('favs')->orderBy('id', 'desc')->paginate(10);

    //検索+ジャンル+エリア
    if ($request->keyword) {
      if ($request->area) 
      {
        if ($request->ganre) 
        {
          $shops = Shop::KeywordSearch($request->keyword)->areaSearch($request->area)->ganreSearch($request->ganre)->get();
          return view('allshop', compact('shops', 'areas', 'ganres'));//検索+ジャンル+エリア
        }
        else {
          $shops = Shop::KeywordSearch($request->keyword)->areaSearch($request->area)->get();
          return view('allshop', compact('shops', 'areas', 'ganres'));//検索+エリア
        }
      }
      elseif ($request->ganre) 
      {
        $shops = Shop::KeywordSearch($request->keyword)->ganreSearch($request->ganre)->get();
        return view('allshop', compact('shops', 'areas', 'ganres')); //検索+ジャンル
      }
      else
      {
        $shops = Shop::KeywordSearch($request->keyword)->get();
        return view('allshop', compact('shops', 'areas', 'ganres'));//検索
      }
      $shops = Shop::KeywordSearch($request->keyword)->get();
      return view('allshop', compact('shops', 'areas', 'ganres'));
    } 
    elseif ($request->area) 
    {
      if ($request->ganre) 
      {
        $shops = Shop::areaSearch($request->area)->ganreSearch($request->ganre)->get();
        return view('allshop', compact('shops', 'areas', 'ganres')); //ジャンル+エリア
      } 
      else 
      {
        $shops = Shop::areaSearch($request->area)->get();
        return view('allshop', compact('shops', 'areas', 'ganres')); //エリア

      }
    } 
    elseif ($request->ganre)
    {
      $shops = Shop::ganreSearch($request->ganre)->get();
      return view('allshop', compact('shops', 'areas', 'ganres')); //ジャンル
    }
    else
    {
      //無条件
      $shops = Shop::get();
      return view('allshop', compact('shops', 'areas', 'ganres'));
    }
  }

  public function detail($id)
  {
    $shop = Shop::where('id', $id)->first();
    $user = User::where('id', Auth::user()->id)->first();
    return view('detail', compact('shop','user'));
  }

  public function thx4regi()
  {
    return view('thx4regi');
  }

  public function mypage()
  {
    $user = Auth::user();
    $favs = Fav::where('user_id', $user->id)->orderBy('shop_id', 'asc')->get();
    $shops = Shop::get();
    $bookings = Booking::where('user_id', $user->id)->get();
    $booking_No = 1;
    $No = 1;
    $reviews = ShopReview::where('user_id', $user->id)->get();
    $bookings = Booking::where('user_id', $user->id)->get();
    
    return view('mypage', compact('shops', 'bookings', 'booking_No', 'No','favs', 'reviews'));
  }


  public function admin()
  {
    $users = User::get();
    return view('admin', compact('users'));
  }

  public function regiowner(REQUEST $Request)
  {
    User::where('id', $Request->id)->first()->fill(['role' => $Request->role])->save();
    return
    redirect()->back()
      ->with('message', 'ユーザーの権限を更新しました');
  }

  public function owner()
  {
    $users = User::get();
    $bookings = Booking::get();
    $booking_No = 1;
    
    $shops = Shop::where('user_id', Auth::user()->id)->get();
    return view('owner', compact('shops', 'bookings', 'booking_No', 'users'));
  }

  public function regishop(REQUEST $request)
  {
    
    $path = $request->file('image')->store('public/images');
    
    Shop::create([
      'user_id' => Auth::user()->id,
      'name' => $request->name,
      'area' => $request->area,
      'ganre' => $request->ganre,
      'detail' => $request->detail,
      'URL' => $path,
    ]);
    $shops = Shop::where('user_id', Auth::user()->id)->get();

    return view('owner', compact('shops'));
  }

  public function editshop($id)
  {
    $shop = Shop::where('id', $id)->first();
    return view('editshop', compact('shop'));
  }
  public function editedshop(REQUEST $req)
  {
    if($req->file('image')){
      $path = $req->file('image')->store('public/images');
      Shop::where('id', $req->shop_id)->first()->fill([
        'name' => $req->name,
        'area' => $req->area,
        'ganre' => $req->ganre,
        'detail' => $req->detail,
        'URL' => $path,
      ])->save();
    }
    else{
      Shop::where('id', $req->shop_id)->first()->fill([
        'name' => $req->name,
        'area' => $req->area,
        'ganre' => $req->ganre,
        'detail' => $req->detail,
      ])->save();
    }

    return redirect()->back()->with('message', '変更を保存しました');
  }
}
