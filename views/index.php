<!DOCTYPE html>
<html lang="en">
<head>
    <title>ICT Archive</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="assets/css/font-awesome.css">

    <!-- toastr -->
    <link rel="stylesheet" type="text/css" href="assets/css/toastr.css">

     
</head>
<body>
<div class="container">
    <!-- navbar -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="" class="navbar-brand"><img src="image/ict_logo.png" width="80" height="40" style="margin-top: -10px"></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <!-- <li ><a href="" id="login"><i class="fa fa-sign-in"></i> Login</a></li> -->
                </ul>
            </div>
        </div>
    </nav><br />
    <div class="row">
        <div class="col-xs-1 col-sm-3 col-md-3"></div>
        <div class="col-xs-10 col-sm-6 col-md-6">
            <div class="well">
                <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <!-- form here -->
                    <form class="form-horizontal" id="lgn-frm">
                        <div class="form-group">
                            <label class="col-xs-4 col-sm-3 col-md-3 control-label"></label>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <input type="text" name="usrn" class="form-control" placeholder="Username" autofocus="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4 col-sm-3 col-md-3 control-label"></label>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <input type="Password" name="pass" class="form-control" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4 col-sm-3 col-md-3 control-label"></label>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <button type="submit" class="btn btn-success btn-block"><i class="fa fa-sign-in"></i> Login</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    
                </div>
            </div>
            </div>
        </div>
        <div class="col-xs-1 col-sm-3 col-md-3"></div>
    </div>
    
    
</div>    



<script type="text/javascript" src="assets/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/toastr.min.js"></script>
<script src="myModules/login.js"></script>
</body>
</html>