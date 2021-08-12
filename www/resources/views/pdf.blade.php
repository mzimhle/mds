<html>
	<head>
		<title>PDF Downloadable</title>
		<style type="text/css">
			table {
				border-collapse: collapse;
				border: 1px solid black;
				width: 100%;
			}		
			table, th, td {
				border: 1px solid black;
			}	
			th {
				height: 20px;
				background-color: #04AA6D;
				color: white; 
			}
			td {
				text-align: center;
			}
			th, td {
				padding: 15px;
				text-align: left;
			}
			tr:nth-child(even) {
				background-color: #f2f2f2;
			}
		</style>
	</head>
<body>
<h2>Holidays</h2>
<p>Below is the list of holidays for the selected filters.</p>
<p>The filters for this PDF download are for the country of <b>{{ $country }}</b> on the year of <b>{{ $year }}</b> @if ( $month != '') for the month of <b>{{ $month }}</b> @endif.</p>
<br />
<table>
	<tr>
		<th>Country</th>
		<th>Year</th>
		<th>Holiday</th>
	</tr>
	@if ( count($holidays) != 0 ) 
	@foreach ($holidays as $holiday)
	<tr>
		<td>{{ $holiday->getCountry->name }}</td>
		<td>{{ $holiday->year }}</td>
		<td>{{ $holiday->day }} of {{ $holiday->getMonth->name }} on {{ $holiday->getDayOfWeek->name }}</td>				
	</tr>
	@endforeach
	@else  
		<tr><td colspan="3">There are no results for the given filters</td></tr>
	@endif	
</table>
</body>
</html>