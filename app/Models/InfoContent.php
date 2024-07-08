<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\InfoDetails;
class InfoContent extends Model
{
    use HasFactory;

    public function details()
    {
        return $this->hasMany(InfoDetails::class,'info_content_id');
    }
}
