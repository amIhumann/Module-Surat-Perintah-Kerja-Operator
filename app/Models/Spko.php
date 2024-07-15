<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spko extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'remarks',
        'employee',
        'trans_date',
        'process',
        'sw'
    ];
}
