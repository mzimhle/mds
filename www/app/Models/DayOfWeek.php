<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayOfWeek extends Model
{
    use HasFactory;
    /**
     * Properties of the dayofweek table
     */
	protected $table = 'dayofweek';
    protected $fillable = ['name', 'position', 'date_created', 'date_updated'];
}
