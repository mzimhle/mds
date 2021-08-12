<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Country;
use App\Models\DayOfWeek;
use App\Models\Month;

class Holidays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'holiday {year} {country=ZA}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all holidays based on the selected year and country iso code';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
		try {
			$year = $this->getYear();
			$country = $this->getCountry();
			// All validation has been done.
			$url = 'https://kayaposoft.com/enrico/json/v2.0/?action=getHolidaysForMonth&month=1&year=2022&country=deu&region=bw&holidayType=public_holiday';
			
		} catch(\Exception $e) {
			$this->error($e->getMessage());
			return 2;
		}
        return 0;
    }

    /**
     * Validate and return the year given
     *
     * @return int|null
     */
	private function getYear(): ?int
	{
		$year = (int)$this->arguments()['year'];
		// Validate year
		if (preg_match('/^\d{4}$/', $year) && ($year > 1900 && $year < 2100)) {
			return (int)$year;
		} else {
			throw new \Exception("Error: Invalid year '$year' - must be 4 digits and between 1900 and 2100");
		}
	}

    /**
     * Validate and return the country from the database
     *
     * @return int|null
     */
	private function getCountry(): ?Country
	{
		$country = strtoupper($this->arguments()['country']);
		// Validate iso country
		if (preg_match('/^[A-Z]{2,3}$/', $country)) {
			$countryObject = Country::where('iso', '=', $country)->first();
			
			if($countryObject === null) {
				throw new \Exception("Error: Country was not found");
			}
			return $countryObject;
		} else {
			throw new \Exception("Error: Invalid country iso: '$country'");
		}
	}
}
