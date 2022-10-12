@extends('admin.v1.common.app')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                Team
                <a href="{{ url()->previous() }}" class="btn btn-primary" style="float: right;">Back</a>
            </h5>
                <h6 class="card-subtitle mb-2 text-muted">Edit</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('team.update', $data->id)}}" id="team_form">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-md-4">
                            <div>
                                <label class="form-label">Branch</label>
                                <select class="form-select" name="branch_id" id="branch_id">
                                    <option value="">Select Branch</option>
                                    @if(isset($branches) && !empty($branches))
                                        @foreach($branches as $key => $row)
                                            <option value="{{$row->id}}" {{ $data->branch_id == $row->id ? "selected" : "" }}>{{$row->branch_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('branch_id')
                                    <span class="help-block input-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div>
                                <label class="form-label">Team Code</label>
                                <input type="text" class="form-control" id="team_code" name="team_code" value="{{old('team_code', $data->team_code ?? '')}}" readonly>
                                @error('team_code')
                                    <span class="help-block input-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div>
                                <label class="form-label">Team Name</label>
                                <input type="text" class="form-control" id="team_name" name="team_name" value="{{old('team_name', $data->team_name ?? '')}}">
                                @error('team_name')
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
