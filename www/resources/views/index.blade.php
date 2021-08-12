@extends('include.layout')
@section('style')
<link href="{{ asset('/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@stop
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Dashboard</h2>
            </div>
			<br /><br />
            <div class="pull-right">
                <a class="btn btn-success" href="/pdf">Generate PDF</a>
            </div>
        </div>
    </div>
	<br /><br />
    <table class="table table-bordered yajra-datatable">
        <tbody></tbody>
    </table>
@endsection
@section('javascript')
<script type="text/javascript">
$(function () {
	var table = $('.yajra-datatable').DataTable({
		processing: true,
		serverSide: true,
		ajax: "/paginate",
		columns: [
			{data: 'name', name: 'name', title: 'Name'},			
			{data: 'country', name: 'country', title: 'Country'},
			{data: 'date', name: 'date', title: 'Date'},				
		]
	});
});
</script>
@stop