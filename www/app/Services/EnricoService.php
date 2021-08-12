<?php

namespace App\Services;

use App\Models\Month;
use App\Models\Country;

use GuzzleHttp\Client;

/**
 * Manage all functions of this service
 *
 * @package	Services
 * @author		Mzimhle Mosiwe <mzimhle.mosiwe@gmail.com>
 */
class EnricoService
{
	/*
	 * Properties of the service
	 */
	 // Version number
	public $version = 'v2.0';
	// Return type of the data.
	public $returnType = 'json';
	// The URL of the base link.
	public $base = 'kayaposoft.com/enrico';
	// protocol used.
	public $protocol = 'https://';
	// The full url to be used.
	public $url;
	// Client object to fetch the data.
	public $http;
	// Where we will keep the headers.
	public $headers;	
	// Minimum year required
	private $minYear = 2013;
	// Maximum year required 
	private $maxYear = 2100;
	// Enum for the url to fetch based on what action
	const HOLIDAY_FOR_MONTH = 'getHolidaysForMonth';
    /**
     * Constructor of the service.
     *
     * @return null
     */
    public function __construct()
    {
		// Lets build our properties.
        $this->url = $this->protocol.$this->base.'/'.$this->returnType.'/'.$this->version.'/';
        $this->http = new Client();
        $this->headers = [
            'cache-control' => 'no-cache',
            'content-type' => 'application/json',
        ];
    }

    /**
     * Get holidays in a year by month and country
     *
     * @param int $year
     * @param string $country
     *
     * @return array
	 *
     */	
	 public function getHolidaysForMonth(int $year, Country $country): array
	 {
		// Check the year range
		if($year >= 2013 && $year <= 2100) {
			// Lets get the months of the year from the database.
			$months = Month::all();
			// Array to hold all my data.
			$holidays = array();
			// Lets loop through the months, get holidays.
			foreach ($months as $month) {
				// Build URL
				$this->url .= '?action='.self::HOLIDAY_FOR_MONTH."&month={$month->sequence}&year=$year&country={$country->iso}&holidayType=public_holiday";
				// Make the request.
				$request = $this->http->get($this->url, [
					'headers'         		=> $this->headers,
					'timeout'         		=> 30,
					'connect_timeout'	=> true,
					'http_errors'			=> true,
				]);
				// Get the response.
				$response = $request ? $request->getBody()->getContents() : null;
				// Get the http response code
				$status = $request ? $request->getStatusCode() : 500;
				// Check if we data returned is what we are looking for
				if ($response && $status === 200 && $response !== 'null') {
					foreach(json_decode($response) as $holiday) {
						$holidays[] = $holiday;
					}
				}
			}
		} else {
			throw new \Exception("Error: Year must be between 2013 and 2100");
		}
		return $holidays;
	 }
}
?>