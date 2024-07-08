<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopReview extends Model
{
    use HasFactory;
    protected $fillable = [
        'shop_id',
        'user_id',
        'stars',
        'comment',
    ];
    public function user()
    {

        return $this->belongsTo(User::class, 'user_id', 'id')
            ->select('id', 'name');
    }
    public function shop()
    {

        return $this->belongsTo(Shop::class, 'shop_id', 'id')
            ->select('id', 'name');
    }
}
