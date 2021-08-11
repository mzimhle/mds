<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    /**
     * Properties of the country table
     */
	protected $table = 'country';
    protected $fillable = ['name', 'code', 'date_created', 'date_updated'];	
}
