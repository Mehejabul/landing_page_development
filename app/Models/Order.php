<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Size;
class Order extends Model
{
    use HasFactory;
    public function size()
    {
        return $this->belongsTo(Size::class,'size_id');
    }
}
