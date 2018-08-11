@extends('layouts.head')
@section('title','Sales')
@section('content')
    <div class="col-md-8 col-md-offset-2">
        Name : <br>
        Address : <br>
        Date : <br>
        <hr>
        <table class="table table-hover">
            <thead>
                <th>Description</th>
                <th>Unit Cost</th>
                <th>Qty</th>
                <th>Amount</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="item" id="item" class="form-control">
                            <option value="">--Select--</option>
                            @foreach($items as $item)
                                <option onclick="myprice('{{ $item->price }}')" value="{{ $item->id }}">{{ $item->item_name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
@endsection