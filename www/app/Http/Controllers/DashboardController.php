<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
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
            $data = Holiday::paginate($request->input('country'), $request->input('year'), ($request->input('month') == '' ? null : (int)$request->input('month')));
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
}
