@extends('admin.v1.common.app')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                Branch
                <a href="{{ url()->previous() }}" class="btn btn-primary" style="float: right;">Back</a>
            </h5>
                <h6 class="card-subtitle mb-2 text-muted">Edit</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('branch.update', $data->id)}}" id="branch_form">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-md-4">
                            <div>
                                <label class="form-label">Branch Code</label>
                                <input type="text" class="form-control" id="branch_code" name="branch_code" value="{{old('branch_code', $data->branch_code ?? '')}}" readonly>
                                @error('branch_code')
                                    <span class="help-block input-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div>
                                <label class="form-label">Branch Name</label>
                                <input type="text" class="form-control" id="branch_name" name="branch_name" value="{{old('branch_name', $data->branch_name ?? '')}}">
                                @error('branch_name')
                                    <span class="help-block input-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4" style="padding-top: 30px;">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

<script>
    

</script>

@endsection
