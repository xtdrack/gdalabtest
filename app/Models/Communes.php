<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Communes extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['id_com', 'id_reg', 'description', 'status'];
    protected $primaryKey = 'id_com';

}
