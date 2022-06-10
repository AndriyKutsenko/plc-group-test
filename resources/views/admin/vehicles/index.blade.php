@extends('admin.admin')
@section('content')
    <br>
    <h3>Vehicles List</h3>
    <table class="table">
        <tr>
            <th>#</th>
            <th>Company</th>
            <th>Model</th>
            <th>VIN</th>
            <th>Fuel Type</th>
            <th>Engine</th>
            <th>Year</th>
            <th>Cost</th>
            <th>Country</th>
            <th>Action</th>
        </tr>
        <tr>
            <th colspan="10"><a href="{{ route('vehicles-add') }}" class="font-weight-bold"><button type="button" class="btn btn-primary">ADD</button></a></th>
        </tr>
    @foreach($vehicles as $vehicle)
        <tr>
            <th>{{ $vehicle->id }}</th>
            <th>{{ $vehicle->company_name }}</th>
            <th>{{ $vehicle->model_name }}</th>
            <th>{{ $vehicle->vin }}</th>
            <th>{{ $vehicle->fuel_type_name }}</th>
            <th>{{ $vehicle->engine_volume }}</th>
            <th>{{ $vehicle->year }}</th>
            <th>{{ $vehicle->cost }}</th>
            <th>{{ $vehicle->country_name }}</th>
            <th>
                <a href="{{ route('vehicles-edit', ['id' => $vehicle->id]) }}" class="font-weight-bold"><button type="button" class="btn btn-info">EDIT</button></a>
                <a href="{{ route('vehicles-delete', ['id' => $vehicle->id]) }}" class="font-weight-bold" onclick="if (true === confirm('Delete this item?')) return true; else return false;"><button type="button" class="btn btn-danger">DELETE</button></a>
            </th>
        </tr>
    @endforeach
    </table>
@endsection
