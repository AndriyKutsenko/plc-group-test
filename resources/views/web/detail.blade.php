@extends('web.web')
@section('content')
    <br>
    <h3>{{ $vehicle->company_name }} {{ $vehicle->model_name }}</h3>
    <div class="card col-lg-4" style="margin: 10px;">
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
            <button type="button" class="btn btn-warning" onclick="getDeliveryCosts();">Get Delivery Costs</button>
            <div id="delivery_info" style="display: none;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <table>
                            <tr>
                                <th style="width: 100px;">Акциз</th><th style="width: 200px;">$<span id="valueE"></span></th>
                            </tr>
                            <tr>
                                <th>Тип топлива</th><th>$<span id="valueF"></span></th>
                            </tr>
                            <tr>
                                <th>НДС</th><th>$<span id="valueT"></span></th>
                            </tr>
                        </table>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        function getDeliveryCosts(){
            $.ajax({
                type: "POST",
                url: "{{ route('get-delivery-cost') }}/",
                data: {"_token": "{{ csrf_token() }}", "vehicle_id": {{ $vehicle->id}} },
                cache: false,
                success: function(response) {
                    console.log(response);
                    document.getElementById("delivery_info").style.display = "block";
                    document.getElementById("valueE").textContent = response.varE.toFixed(2);
                    document.getElementById("valueF").textContent = response.varF.toFixed(2);
                    document.getElementById("valueT").textContent = response.varT.toFixed(2);
                }
            });
        }
    </script>
@endsection
