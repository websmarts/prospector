@extends('layouts.default')

@section('content')

<h1>Campaign</h1>


<p> List campaigns here</p>

<p>Create a new Campaign</p>
<form method="POST" action="{{ route('create_campaign') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group row">
            <label for="campaign_name" class="col-md-4 col-form-label text-md-right">Campaign name</label>

            <div class="col-md-6">
                <input id="campaign_name" type="text" class="form-control{{ $errors->has('campaign_name') ? ' is-invalid' : '' }}" name="campaign_name" value="{{ old('campaign_name') }}" required autofocus>

                @if ($errors->has('campaign_name'))
                    <span class="invalid-feedback" >
                        <strong>{{ $errors->first('campaign_name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="prospects" class="col-md-4 col-form-label text-md-right">Prospects file</label>

            <div class="col-md-6">
                <input id="prospects" type="file" class="form-control{{ $errors->has('prospects') ? ' is-invalid' : '' }}" name="prospects" value="{{ old('prospects') }}" required autofocus>

                @if ($errors->has('prospects'))
                    <span class="invalid-feedback" >
                        <strong>{{ $errors->first('prospects') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Save
                </button>

                
            </div>
        </div>


</form>

@endsection