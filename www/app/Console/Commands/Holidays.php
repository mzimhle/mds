<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
// Models
use App\Models\Country;
use App\Models\DayOfWeek;
use App\Models\Month;
use App\Models\Holiday;
// Services
use App\Services\EnricoService;

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
     * The service to fetch the data.
     *
     */
    protected $enricoService = null;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(EnricoService $service)
    {
		$this->enricoService = $service;
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
			$holidays = $this->enricoService->getHolidaysForMonth($year, $country);
			// Get the holidays
			if($holidays) {
				// Reporting.
				$added = 0;
				$this->info("".count($holidays)." number of holidays $year in {$country->name}");
				$this->info("----------------------------------------");
				// Loop
				foreach($holidays as $holiday) {
					$this->info("{$holiday->name[0]->text} - Found");
					// Check if already exists
					$row = Holiday::where([
						['country', '=', $country->id],
						['month', '=', $holiday->date->month],
						['dayofweek', '=', $holiday->date->dayOfWeek],
						['day', '=', $holiday->date->day],
						['year', '=', $holiday->date->year]						
					])->first();
					// Insert into database if null
					if(null === $row) {
						// Lets build the data.
						$data = [
							'name' => $holiday->name[0]->text,
							'country' => $country->id,
							'month' => $holiday->date->month,
							'dayofweek' => $holiday->date->dayOfWeek,
							'day' => $holiday->date->day,
							'year' => $holiday->date->year	
						];
						// Add data
						Holiday::create($data);
						$added++;
						$this->info("{$holiday->name[0]->text} - Added");
					} else {
						$this->info("{$holiday->name[0]->text} - Sipped");
					}
				}
			} else {
				$this->error("Error: Either no holidays in this month or there are no holidays for this year");
			}
		} catch(\Exception $e) {
			$this->error('Error: '.$e->getMessage());
			return 2;
		}
		$this->info("----------------------------------------");
		$this->info("$added added holidays for the year $year");
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
		if (preg_match('/^\d{4}$/', $year)) {
			return (int)$year;
		} else {
			throw new \Exception("Error: Invalid year '$year' - must be 4 digits");
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
