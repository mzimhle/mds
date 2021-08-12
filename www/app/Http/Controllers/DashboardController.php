<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Holiday;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }
    /**
     * Method to get the data for dates.
     */	
    public function paginate(Request $request)
    {
        if ($request->ajax()) {
            $data = Holiday::latest()->get();
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
