@extends('admin.admin')
@section('content')
    <br>
    <h3>Delivery Costs List</h3>
    <table class="table">
        <tr>
            <th>Country</th>
            <th>Cost</th>
            <th>Action</th>
        </tr>
        <tr>
            <th colspan="10"><a href="{{ route('delivery-add') }}" class="font-weight-bold"><button type="button" class="btn btn-primary">ADD</button></a></th>
        </tr>
    @foreach($items as $item)
        <tr>
            <th>{{ $item->country_name }}</th>
            <th>{{ $item->cost }}</th>
            <th>
                <a href="{{ route('delivery-edit', ['id' => $item->id]) }}" class="font-weight-bold"><button type="button" class="btn btn-info">EDIT</button></a>
                <a href="{{ route('delivery-delete', ['id' => $item->id]) }}" class="font-weight-bold" onclick="if (true === confirm('Delete this item?')) return true; else return false;"><button type="button" class="btn btn-danger">DELETE</button></a>
            </th>
        </tr>
    @endforeach
    </table>
@endsection
