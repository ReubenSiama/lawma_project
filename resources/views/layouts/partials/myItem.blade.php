@if($i == 0)
<div class="row">
@endif
<div class="col-md-4">
    <div class="thumbnail">
        <label for="item{{ $item->id }}">
            <img id="image{{ $item->item_name }}{{ $item->id }}" src="data:image/png;base64,{{ $item->image }}" alt="{{ $item->item_name }}" class="img img-thumbnail">
            <div class="caption col-md-10">
                <p>{{ $item->item_name }}</p>
                <p>Price : ₹{{ $item->price }}</p>
            </div>
            <input onchange="displayInput('qnty{{ $item->id }}')" type="checkbox" value="{{ $item->id }}" class="pull-right" name="item[]" id="item{{ $item->id }}">
            <input type="text" name="qnty[{{ $item->item_name }}]" id="qnty{{ $item->id }}" class="hidden" placeholder="Quantity">
        </label>
    </div>
</div>
@if($i == 2)
</div>
<?php $i = 0; ?>
@endif