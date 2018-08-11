@extends('layouts.head')
@section('title','Sales')
@section('content')
    <div class="col-md-8 col-md-offset-2" style="border-style: ridge;">
    <center>
        <h3>
            Michale's Sweet Stall<br>
            <small>Contact : 2345989601</small>
        </h3>
    </center>
        <hr>
        <table class="table table-hover" border=1>
            <thead>
        <tr>
            <td>
                Name :
            </td>
            <td colspan="3">
                {{ $customer_name }}
            </td>
        </tr>
        <tr>
            <td>
                Date :
            </td>
            <td colspan="3">
                {{ date('d-m-Y') }}
            </td>
        </tr>
                <th style="text-align:center">Description</th>
                <th style="text-align:center">Unit Cost</th>
                <th style="text-align:center">Qty</th>
                <th style="text-align:center">Amount</th>
            </thead>
            <tbody>
                {!! $items !!}
                <tr>
                    <td colspan=2></td>
                    <td style="text-align:right;"><b>Total</b></td>
                    <td style="text-align:center;"><b>{{ $total }}</b></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-12">
    <hr>
    <center>
        <button class="btn btn-success" id="print" onclick="printInvoice()"><span class="glyphicon glyphicon-print"></span> Print</button>
    </center>
    </div>
@endsection