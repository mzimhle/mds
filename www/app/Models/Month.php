<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    use HasFactory;
    /**
     * Properties of the month table
     */
	protected $table = 'month';
    protected $fillable = ['name', 'sequence', 'date_created', 'date_updated'];	
}
