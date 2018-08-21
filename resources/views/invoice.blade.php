@extends('layouts.head')
@section('title','Sales')
@section('content')
    <div class="col-md-4 col-md-offset-4 noPrint" style="border-style: ridge;">
    <center>
        <h4>
            Ankit's Sweet Stall<br>
            <small><span class="glyphicon glyphicon-phone-alt"></span> Contact : 2345989601<br>
                15th Main Rd, West Of Chord Road,<br>
                3rd Stage, Rajajinagar Bengaluru<br>
                Karnataka 560010
            </small>
        </h4>
    </center>
        <hr>
        Invoice No. : {{ $invoice2->invoice_no }}
        <table class="table table-hover" style="font-size:12px;" border=1>
            <thead>
                <tr>
                    <td>
                        Name :
                    </td>
                    <td colspan="3">
                        {{ $invoice2->customer_name }}
                    </td>
                </tr>
                <tr>
                    <td>
                        Date :
                    </td>
                    <td colspan="3">
                        {{ date('d-m-Y',strtotime($invoice2->invoice_date)) }}
                    </td>
                </tr>
                <th style="text-align:center">Description</th>
                <th style="text-align:center">Unit Cost</th>
                <th style="text-align:center">Qty</th>
                <th style="text-align:center">Amount</th>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td style="text-align:center">{{ $item->item_name }}</td>
                        <td style="text-align:center">{{ $item->price }}</td>
                        <td style="text-align:center">{{ $item->quantity }}</td>
                        <td style="text-align:center">{{ $item->price * $item->quantity }}</td>
                        <?php $total += $item->price * $item->quantity; ?>
                    </tr>
                @endforeach
                <tr>
                    <td colspan=3 style="text-align:right">GST 18%</td>
                    <td style="text-align:center">{{ $gst = round($total * 18/100, 2) }}</td>
                </tr>
                <tr>
                <td colspan=3 style="text-align:right">Discount {{ $discount }}%</td>
                    <td style="text-align:center">{{ $discount = round($total * $discount/100, 2) }}</td>
                </tr>
                <tr>
                    <td colspan=2></td>
                    <td style="text-align:right;"><b>Total</b></td>
                    <td style="text-align:center;"><b>{{ $total + $gst - $discount }}</b></td>
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