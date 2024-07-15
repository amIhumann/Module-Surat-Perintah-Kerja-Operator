<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spko_item extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'idm',
        'ordinal',
        'id_product',
        'qty'
    ];
}
