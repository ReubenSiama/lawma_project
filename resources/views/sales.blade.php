@extends('layouts.head')
@section('title','Sales')
@section('content')
    <div class="col-md-8 col-md-offset-2">
        <table class="table table-hover">
            <thead>
                <th>Date</th>
                <th>Description</th>
                <th>Unit Cost</th>
                <th>Qty</th>
                <th>Amount</th>
            </thead>
            <tbody>
                @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->created_at->format('d-m-Y') }}</td>
                    <td>{{ $invoice->item_name }}</td>
                    <td>{{ $invoice->price }}</td>
                    <td>{{ $invoice->quantity }}</td>
                    <td>{{ $invoice->total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div id="container" style="width: 550px; height: 400px; margin: 0 auto"></div>
        </div>
        <div class="col-md-6">
            <div id="container2" style="width: 550px; height: 400px; margin: 0 auto"></div>
        </div>
    </div>
    <script language="JavaScript">
    function drawChart() {
        // Define the chart to be drawn.
        var data = google.visualization.arrayToDataTable([
        ['Week Sales', 'Sales Statistics'],
        @foreach($week_sales as $stats)
            ['{{ $stats["item"] }}', {{ $stats['count'] }}],
        @endforeach
        ]);
        var options = {
        title: 'Week Sales Statistics',
        isStacked:true	
        }; 
        // Instantiate and draw the chart.
        var chart = new google.visualization.BarChart(document.getElementById('container'));
        chart.draw(data, options);
        }
    google.charts.setOnLoadCallback(drawChart);
    </script>

    <script language="JavaScript">
    function drawChart() {
        // Define the chart to be drawn.
        var data = google.visualization.arrayToDataTable([
        ['All Times Sales', 'Sales Statistics'],
        @foreach($all_sales as $stats)
            ['{{ $stats["item"] }}', {{ $stats['count'] }}],
        @endforeach
        ]);
        var options = {
        title: 'Sales Of All Times',
        isStacked:true	
        }; 
        // Instantiate and draw the chart.
        var chart = new google.visualization.BarChart(document.getElementById('container2'));
        chart.draw(data, options);
        }
    google.charts.setOnLoadCallback(drawChart);
    </script>
@endsection