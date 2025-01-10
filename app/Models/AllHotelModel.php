<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AllHotelModel extends Model
{
    use HasFactory;
    
    protected $table="hotelbeds_all_hotels";

}
