@extends('admin.admin')
@section('content')
    <br>
    <h3>Delivery Cost Add Action</h3>
    <form action="{{ route('delivery-create') }}" method="post">
        @csrf
        Country: <select name="country">
            @foreach($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select><br>
        Cost ($): <input type="text" name="cost" placeholder="0,00"><br>
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
                    data: {"_token": "{{ csrf_token() }}", action: 'showRegionForInsert', "company_id": company_id },
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
