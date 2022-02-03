<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;
    protected $fillable = ['id','type','action','params','ip','updated_at','created_at'];
    protected $primaryKey = 'id';
}
