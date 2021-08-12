@extends('include.layout')
@section('style')
<link href="{{ asset('/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@stop
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Dashboard</h2>
				<p>Welcome to the dashboard of my API integrated application</p>
            </div>
        </div>
    </div>
	<h5>Filter</h5>
	<br />
    <div class="row">	
        <div class="col-md-3">
            <select class="form-control" name="country" id="country">
              @foreach($countries as $item)
              <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach		
            </select>
		</div>	
        <div class="col-md-3">
            <select class="form-control" name="year" id="year">
              <option value="2013"> 2013 </option>
              <option value="2014"> 2014 </option>
			  <option value="2015"> 2015 </option>
			  <option value="2016"> 2016 </option>
			  <option value="2017"> 2017 </option>
			  <option value="2018"> 2018 </option>
			  <option value="2019"> 2019 </option>
			  <option value="2020"> 2020 </option>
			  <option value="2021"> 2021 </option>
			  <option value="2022"> 2022 </option>
			  <option value="2023"> 2023 </option>
			  <option value="2024"> 2024 </option>
            </select>
		</div>
        <div class="col-md-3">
            <select class="form-control" name="month" id="month">
              <option value=""> --- Fetch All --- </option>
              @foreach($months as $item)
              <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach			  
            </select>
		</div>
        <div class="col-md-3">
			<a class="btn btn-success" href="#" id="filter">Filter</a>
			<a class="btn btn-warning" href="#" id="pdf">PDF</a>	
		</div>		
	</div>
	<br />
	<h5>Table of holidays</h5>
	<br />
    <table class="table table-bordered yajra-datatable">
        <tbody></tbody>
    </table>
@endsection
@section('javascript')
<script type="text/javascript">
var table;
$(function () {
	// Call the datatable after page has completed loading.
	getData();
	// Call the datatable on filtering of the data.
    $(document).on('click', '#filter', function (e) {
        e.preventDefault();
        getData();
    });
	// Download the PDF of the currently filtered data
    $(document).on('click', '#pdf', function (e) {
        e.preventDefault();
        getPDF();
    });
});

function getPDF() {
	window.location.href = "/pdf?country="+$('#country').val()+"&year="+$('#year').val()+"&month="+$('#month').val();
	return false;
}

function getData() {
	if(typeof table != 'undefined') {
		table.destroy();
	}
	table = $('.yajra-datatable').DataTable({
		processing: true,
		serverSide: true,
		ajax: "/paginate?country="+$('#country').val()+"&year="+$('#year').val()+"&month="+$('#month').val(),
		columns: [
			{data: 'name', name: 'name', title: 'Name'},			
			{data: 'country', name: 'country', title: 'Country'},
			{data: 'date', name: 'date', title: 'Date'},				
		]
	});
}
</script>
@stop