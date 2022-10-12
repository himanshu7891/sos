@extends('admin.v1.common.app')

@section('content')

    <div class="container">
        <div id="ajax-msg"></div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xs-12 col-md-12 table-responsive">
                        <table class="table table-striped table-boardered application-datatable">
                            <thead>
                                <tr>
                                    <th>Application Code</th>
                                    <th>Member Code</th>
                                    <th>Source Type</th>
                                    <th>Source Name</th>
                                    <th>Source Email</th>
                                    <th>Source GST No</th>
                                    <th>Source Contact</th>
                                    <th>Status</th>
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

@endsection

@section('scripts')

<script>
    
    $(function() {
        var table = $(".application-datatable").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('application.index') }}",
            columns: [
                {data: 'application_code', name: 'application_code'},
                {data: 'member_code', name: 'member_code'},
                {data: 'source_type', name: 'source_type'},
                {data: 'source_name', name: 'source_name'},
                {data: 'source_email', name: 'source_email'},
                {data: 'source_gst_no', name: 'source_gst_no'},
                {data: 'source_contact', name: 'source_contact'},
                {data: 'status', name: 'status'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

    $(document).on("change","#application_status", function(e) {

        var status = $(this).val();
        var id = $(this).data('applicationid');

        $.ajax({
            url: "{{ route('change.application.status',1132443) }}",
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            data: {
                status: status,
                applicationId: id,
            },
            success: function(data) {
                if($.isEmptyObject(data.error)) {
                    var html = '';
                    html += '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                    html += '<strong>'+data.success+'</strong>';
                    html += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    html += '</div>';
                    $("#ajax-msg").html(html);
                    $('html, body').animate({
                        scrollTop: "0px"
                    }, 1000);
                    setInterval(function() {
                        location.reload(true);
                    }, 1000);
                } else {
                    var html = '';
                    html += '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                    html += '<strong>'+data.error+'</strong>';
                    html += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    html += '</div>';
                    $("#ajax-msg").html(html);
                    $('html, body').animate({
                        scrollTop: "0px"
                    }, 1000);
                }
            }
        });
    });

</script>

@endsection
