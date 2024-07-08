<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $fillable = [
        'page_title'
    ];

    public static function orderTrackId()
    {
        $lastOrderId = Order::orderBy('created_at','DESC')->get('id')->first();
        $id = 'COT-'.date("ymd").'-'.($lastOrderId->id +1);
        return $id;
    }
}
