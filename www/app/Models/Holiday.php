<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    /**
     * Properties of the Holiday table
     */
	protected $table = 'holiday';
    protected $fillable = ['country', 'dayofweek', 'month', 'name', 'day', 'year', 'date_created', 'date_updated'];	

    /**
     * Get information of the country linked to this holiday
     * 
     * @return App\Models\Country
     */
    public function country() {
        return $this->hasOne(Country::class, 'id', 'country');
    }

    /**
     * Get information of the day of week linked to this holiday.
     * 
     * @return App\Models\DayOfWeek
     */
    public function dayOfWeek() {
        return $this->hasOne(DayOfWeek::class, 'id', 'dayofweek');
    }

    /**
     * Get information of the month linked to this holiday.
     * 
     * @return App\Models\Month
     */
    public function month() {
        return $this->hasOne(Month::class, 'id', 'month');
    }		
}
