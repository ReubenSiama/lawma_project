@extends('layouts.head')
@section('title','Home')
@section('content')
    <div class="col-md-8 col-md-offset-2">
        <form action="/generateInvoice">
            
            <div class="panel panel-success">
                <div class="panel-heading">
                    Item List
                    <button type="button" data-toggle="modal" data-target="#customer_details" class="btn btn-success pull-right btn-xs">Generate Invoice</button>
                </div>
                <div class="panel-body">
                        <?php $i = 0; ?>
                        @foreach($items as $item)
                            @include('layouts.partials.myItem',['item'=>$item,'i'=>$i++])
                        @endforeach
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="customer_details" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Customer Details</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="item_name">Name:</label>
                        <input type="text" name="name" class="form-control" id="name">
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
                </div>
            </div>
            </div>
        </form>
    </div>
    @if(session('Error'))
        <script>
            swal("Error","{{ session('Error') }}","error");
        </script>
    @endif
@endsection