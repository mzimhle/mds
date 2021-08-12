<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use PDF;
use App\Models\Holiday;
use App\Models\Month;
use App\Models\Country;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// Get models to display in the drop down.
		$months = Month::all();
		$countries = Country::all();
		// Show the view.
        return view('index', compact('months', 'countries'));
    }
    /**
     * Method to get the data for dates.
     */	
    public function paginate(Request $request)
    {
        if ($request->ajax()) {
			// Sanitize the user given data.
			$country = null !== $request->input('country') && trim($request->input('country')) != '' && (int)$request->input('country') != 0 ? (int)$request->input('country') : 0;
			$year = null !== $request->input('year') && trim($request->input('year')) != '' && (int)$request->input('year') != 0 ? (int)$request->input('year') : 0;
			$month = null !== $request->input('month') && trim($request->input('month')) != '' && (int)$request->input('month') != 0 ? (int)$request->input('month') : null;
			// Get the data.
            $data = Holiday::filtered($country, $year, $month);
			// Return datatable object
            return Datatables::of($data)
                ->addColumn('name', function($row) {
                    return $row->name;
                })
                ->addColumn('country', function($row) {
                    return $row->getCountry->name;
                })
                ->addColumn('date', function($row) {
                    return $row->day.' of '.$row->getMonth->name.' '.$row->year.' on '.$row->getDayOfWeek->name;
                })			
                ->rawColumns(['name', 'country', 'date'])
                ->make(true);
        }
    }
    /**
     * Method to get the data for dates.
     */	
    public function pdf(Request $request)
    {
		// Sanitize the user given data.
		$country = null !== $request->input('country') && (int)$request->input('country') != 0 ? (int)$request->input('country') : 0;
		$year = null !== $request->input('year') && (int)$request->input('year') != 0 ? (int)$request->input('year') : 0;
		$month = null !== $request->input('month') && (int)$request->input('month') != 0 ? (int)$request->input('month') : null;
		$nameofmonth = ''; 
		// Get the country 
		$countryObject = Country::find($country);
		if(null === $countryObject) {
			// Redirect to page not found.
			return redirect('/page-not-found');
		}
		// Get the month
		if(null !== $month) {
			$monthObject = Month::find($month);
			if(null === $monthObject) {
				// Redirect to page not found.
				return redirect('/page-not-found');
			} else {
				$nameofmonth = $monthObject->name;
			}
		}
		// Get the data.
		$holidays = Holiday::filtered($country, $year, $month);
		$data = [
			'holidays' => $holidays,
			'year' => $year,
			'country' => $countryObject->name,			
			'month' => $nameofmonth,			
		];
		// download the PDF.
		$pdf = PDF::loadView('pdf', $data);
		return $pdf->download($country.$year.($month != null ? $month : '').date('Ymdhis').'.pdf');		
    }	
}