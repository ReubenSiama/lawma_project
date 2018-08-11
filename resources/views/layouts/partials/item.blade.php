<tr>
    <td>{{ $i }}</td>
    <td>{{ $item->item_name }}</td>
    <td><img src="data:image/png;base64,{{ $item->image }}" alt="{{ $item->item_name }}" class="img img-thumbnail" style="height:100px;width:150px;"></td>
    <td>{{ $item->price }}</td>
    <td>{{ $item->quantity }}</td>
    <td>
        <form id="delete{{ $item->id }}" action="/deleteItem" method="post">
            <input type="hidden" name="id" value="{{ $item->id }}">
            {{ csrf_field() }}
            <div class="btn-group">
                <button type="button" data-toggle="modal" data-target="#edit{{ $item->id }}" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></button>
                <button type="button" onclick="confirm('delete{{ $item->id }}')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
            </div>
        </form>
    </td>
</tr>

<!-- Modal -->
<div class="modal fade" id="edit{{ $item->id }}" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit {{ $item->item_name }}</h4>
      </div>

      <div class="modal-body">
        <form method="POST" class="form-inline" action="/editItem" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $item->id }}">
            <div class="form-group">
                <label for="item_name">Item Name:</label>
                <input type="text" name="item_name" value="{{ $item->item_name }}" class="form-control" id="item_name">
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" name="image" class="form-control" id="image" accept="image/*">
                <br>
                <center>
                    <img src="data:image/png;base64,{{ $item->image }}" alt="{{ $item->item_name }}" class="img img-thumbnail" style="height:100%;width:300px;">
                </center>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" name="price" value="{{ $item->price }}" min=1 class="form-control" id="price">
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" value="{{ $item->quantity }}" min=1 class="form-control" id="quantity">
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>  
      </div>
    </div>
    
  </div>
</div>