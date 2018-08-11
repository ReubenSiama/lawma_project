<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="main.js"></script>
    <style>
        .form-control{
            border-radius: 0;
        }
    </style>
</head>
<body>
<div class="jumbotron">
    <center>
        <h2>Michael's Sweet Stall</h2>
    </center>
</div>
<div class="container-fluid">
    <div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-success">
            <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" action="/login" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Email:</label>
                            <div class="col-sm-10">
                                <input required type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Password:</label>
                            <div class="col-sm-10"> 
                                <input required type="password" name="psw" class="form-control" id="pwd" placeholder="Enter password">
                            </div>
                        </div>
                        <div class="text-center" style="color:red">
                            @if(session('error'))
                                {{ session('error') }}
                            @endif
                        </div>
                        <div class="form-group"> 
                            <div class="col-sm-offset-2 col-sm-10">
                            <input value="Login" type="submit" class="form-control btn btn-success">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
</body>
</html>