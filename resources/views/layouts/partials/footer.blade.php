@if(session('Success'))
<script>
    swal("Success","{{ session('Success') }}","success");
</script>
@endif

<script>
function confirm(arg){
    swal({
        title: "Are you sure?",
        text: "Are you sure you want to delete this item?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel please!",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm) {
        var myForm = document.getElementById(arg);
        if (isConfirm) {
            myForm.submit();
        } else {
            swal("Cancelled", "Your item is safe :)", "error");
        }
    });
}
function calculate(arg){
    var qnty = document.getElementById('quantity'+arg).value;
    var price = document.getElementById('price'+arg).innerHTML;
    document.getElementById('amount'+arg).innerHTML = qnty * price;
}
function displayInput(arg){
    if(document.getElementById(arg).className == "hidden"){
        document.getElementById(arg).className = "form-control";
        document.getElementById(arg).focus();
    }else{
        document.getElementById(arg).className = "hidden";
    }
}
function printInvoice(){
    document.getElementById('print').className = "hidden";
    window.print();
    document.getElementById('print').className = "btn btn-success";
}
</script>