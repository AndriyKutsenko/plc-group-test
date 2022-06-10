@extends('admin.admin')
@section('content')
    <br>
    <h3>Vehicles Add Action</h3>
    <form action="{{ route('vehicles-create') }}" method="post">
        @csrf
        Company: <select name="company" onchange="selectModels();">
            @foreach($companies as $company)
                <option value="{{ $company->id }}">{{ $company->name }}</option>
            @endforeach
        </select><br>
        Model: <select name="model">
            @foreach($models as $model)
                <option value="{{ $model->id }}">{{ $model->name }}</option>
            @endforeach
        </select><br>
        VIN: <input type="text" name="vin" placeholder="VIN"><br>
        Fuel Type: <select name="fuel">
            @foreach($fuelTypes as $fuel)
                <option value="{{ $fuel->id }}">{{ $fuel->name }}</option>
            @endforeach
        </select><br>
        Engine (cm<sup>2</sup>): <input type="text" name="engine" placeholder="0"><br>
        Year: <input type="text" name="year" placeholder="{{ date('Y') }}"><br>
        Cost ($): <input type="text" name="cost" placeholder="0,00"><br>
        Country: <select name="country">
            @foreach($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select><br>

        <br>
        <button type="submit" name="add-action" class="btn btn-primary">CREATE</button>
    </form>

    <script>
        function selectModels(){
            let company_id = $('select[name="company"]').val();
            if(!company_id){
                $('div[name="selectCategory"]').html('');

            } else {
                $.ajax({
                    type: "POST",
                    url: "{{ route('models-by-company') }}/",
                    data: {"_token": "{{ csrf_token() }}", "company_id": company_id },
                    cache: false,
                    success: function(response) {
                        $('select[name="model"]').empty();
                        $.each(response.models, function(key, value) {
                            $('select[name="model"]').append(new Option(value.name, value.id));
                        });
                    }
                });
            }
        }
    </script>
@endsection
