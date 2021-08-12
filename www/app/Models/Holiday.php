<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Country;
use App\Models\DayOfWeek;
use App\Models\Month;

class Holiday extends Model
{
    use HasFactory;

    /**
     * Properties of the Holiday table
     */
	protected $table = 'holiday';
    protected $fillable = ['country', 'dayofweek', 'month', 'name', 'day', 'year', 'date_created', 'date_updated'];	
	/*
	 * Constants of the model.
	 */
    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';
	
    /**
     * Get information of the country linked to this holiday
     * 
     * @return App\Models\Country
     */
    public function getCountry() {
        return $this->hasOne(Country::class, 'id', 'country');
    }

    /**
     * Get information of the day of week linked to this holiday.
     * 
     * @return App\Models\DayOfWeek
     */
    public function getDayOfWeek() {
        return $this->hasOne(DayOfWeek::class, 'id', 'dayofweek');
    }

    /**
     * Get information of the month linked to this holiday.
     * 
     * @return App\Models\Month
     */
    public function getMonth() {
        return $this->hasOne(Month::class, 'id', 'month');
    }

    /**
     * Get all data based on country, year and month
     * 
     * @return Collection
     */
    public static function filtered(int $country, int $year, int $month = null) {
		// Sort out filters
		$where		= array();
		$where[]	= ['country', '=', $country];
		$where[]	= ['year', '=', $year];
		if($month !== null) {
			$where[]	= ['month', '=', $month];
		}
		// Get the data
		return self::where($where)->get();
    }
}
