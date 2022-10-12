@extends('admin.v1.common.app')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
            	<div>
                <h5 class="card-title">
                	Team 
                	<!-- <a href="{{route('team.create')}}" class="btn btn-primary" style="float: right;">Create</a> -->
                </h5>
                <h6 class="card-subtitle mb-2 text-muted">List</h6>
            </div>
            <div class="card-body">
            	<div class="card">
            		<div class="card-body">
		            	<div class="row">
		                    <div class="col-xs-12 col-md-12 table-responsive">
		                        <table class="table table-striped table-boardered team-datatable">
		                        	<thead>
		                        		<tr>
		                        			<th>Team Code</th>
		                        			<th>Team Name</th>
		                        			<th>Created At</th>
		                        			<th>Action</th>
		                        		</tr>
		                        	</thead>
		                        	<tbody></tbody>
		                        </table>
		                    </div>
		                </div>
	               	</div>
		        </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@include('admin.v1.common.js')

<script>
    
	$(function() {
        var table = $(".team-datatable").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('team.index') }}",
            columns: [
                {data: 'team_code', name: 'team_code'},
                {data: 'team_name', name: 'team_name'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

</script>

@endsection
