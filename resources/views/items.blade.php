@extends('layouts.head')
@section('title','Products')
@section('content')
    <div class="panel panel-success">
        <div class="panel-heading">
            Products

        </div>
        <div class="panel-body">
            <form action="/addProduct" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-inline">
                    <label for="item_name">Item Name:</label>
                    <input required type="text" name="item_name" id="item_name" placeholder="Item Name" class="form-control">    
                    <label for="image">Image:</label>
                    <input required type="file" name="image" id="image" class="form-control" accept="image/*">
                    <label for="price">Price:</label>
                    <input required type="number" name="price" id="price" placeholder="Price" min=1 class="form-control">
                    <label for="quantity">Quantity:</label><input type="number" name="quantity" id="quantity" placeholder="Quantity" class="form-control">
                    <input type="submit" value="Save" class="btn btn-success">
                </div>
            </form>
            <hr>
            <label for="item_list">Items:</label>
            <table class="table table-hover">
                <thead>
                    <th>Sl.No</th>
                    <th>Item name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </thead>
                <?php $i = 1; ?>
                <tbody>
                    @foreach($items as $item)
                        @include('layouts.partials.item',['item'=>$item,'i'=>$i++])
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection