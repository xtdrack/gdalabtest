<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{


    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['dni','id_reg','id_com','email','name','last_name','address','date_reg','status'];
    protected $primaryKey = 'dni';
    public function communes() {
        return $this->belongsTo(Communes::class, 'id_com');
    }

    public function regions() {
        return $this->belongsTo(Regions::class, 'id_reg');
    }
}
