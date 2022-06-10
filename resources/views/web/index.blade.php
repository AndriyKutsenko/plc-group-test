@extends('web.web')
@section('content')
    <br>
    <h3>PLC Group. Cars list</h3><br><br>
    @foreach($vehicles as $vehicle)
            <div class="card col-lg-4" style="margin: 10px;">
                <div class="card-body">
                    <h4 class="card-title">{{ $vehicle->company_name }} {{ $vehicle->model_name }}</h4>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <table>
                            <tr>
                                <th style="width: 100px;">VIN</th><th style="width: 200px;">{{ $vehicle->vin }}</th>
                            </tr>
                            <tr>
                                <th>Fuel</th><th>{{ $vehicle->fuel_type_name }}</th>
                            </tr>
                            <tr>
                                <th>Engine</th><th>{{ $vehicle->engine_volume }}</th>
                            </tr>
                            <tr>
                                <th>Year</th><th>{{ $vehicle->year }}</th>
                            </tr>
                            <tr>
                                <th>Country</th><th>{{ $vehicle->country_name }}</th>
                            </tr>
                        </table>
                    </li>
                </ul>
                <div class="card-body">
                    <h4>${{ $vehicle->cost }}</h4>
                    <a href="{{ route('detail', ['id' => $vehicle->id]) }}" class="font-weight-bold"><button type="button" class="btn btn-primary">Detail Info</button></a>
                </div>
            </div>
    @endforeach
@endsection
