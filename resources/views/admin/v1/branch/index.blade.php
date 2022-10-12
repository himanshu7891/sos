@extends('admin.v1.common.app')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
            	<div>
                <h5 class="card-title">
                	Branch 
                	<!-- <a href="{{route('branch.create')}}" class="btn btn-primary" style="float: right;">Create</a> -->
                </h5>
                <h6 class="card-subtitle mb-2 text-muted">List</h6>
            </div>
            <div class="card-body">
            	<div class="card">
            		<div class="card-body">
		            	<div class="row">
		                    <div class="col-xs-12 col-md-12 table-responsive">
		                        <table class="table table-striped table-boardered branch-datatable">
		                        	<thead>
		                        		<tr>
		                        			<th>Branch Code</th>
		                        			<th>Team Code</th>
		                        			<th>Branch Name</th>
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
        var table = $(".branch-datatable").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('branch.index') }}",
            columns: [
                {data: 'branch_code', name: 'branch_code'},
                {data: 'team_code', name: 'team_code'},
                {data: 'branch_name', name: 'branch_name'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

</script>

@endsection
