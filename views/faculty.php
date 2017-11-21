<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('include/header') ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ICT Archive</title>
    <style type="text/css">
        .list {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 150px;
            background-color: #f1f1f1;
        }

        li a {
            display: block;
            color: #000;
            padding: 8px 16px;
            text-decoration: none;
        }
        /* Change the link color on hover */
        a:hover, a:focus {
            color: #ffffff;
            text-decoration: none;
            background-color: #66757F;
        }
        #well {
            background-color:  #4285F4 !important;
        }
        #myNotify {
            width: auto;
        }
        .popover {
            max-width: 500px;
        }
        #profile-pic:hover {
            background-color: #CCD6DD;
            color: #ffffff;
        }
        .bottomright {
            position: absolute;
            bottom: 8px;
            right: 50px;
            font-size: 18px;
        }
        .container-prof {
            position: relative;
        }
        #uploadeDoc {
            display: none;
        }
    </style>
</head>
<body>
    <?php $this->load->view('include/facultyNavbar') ?>
    <!-- navbar -->
	<div class="well">
        <div id="sendValid"></div>
        <div id="myNotify" class="hide">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="receiveNotify">
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2 col-md-2 col-sm-2">
                <div class="well" id="well">
                    <ul class="list">
                        <li><a href="#" id="upload"><i class="fa fa-upload"></i> Upload</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-8 col-md-8">
                <div class="panel panel-primary" id="listFile">
                    <div class="panel-body"><span style="font-size: 20px;"><i class="fa fa-list-alt"></i> List Documents</span>
                    <br /><br />
                        <div class="table-responsive">
                            <table class="table table-hover" id="fileTbl" style="font-size: 12px">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>File</th>
                                        <th>Category</th>
                                        <th>Date Upload</th>
                                    </tr>
                                </thead>
                                <tbody id="list-file">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                 <div class="panel panel-primary" id="uploadeDoc">
                    <div class="panel-body">
                        <span style="font-size: 20px;"><i class="fa fa-folder-open"></i> List of Uploaded Documents</span>
                        <hr /> 
                        <!-- <div class="table-responsive"> -->
                            <table class="table table-hover" id="table-uploaded" style="font-size: 12px; width: 100%">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>File</th>
                                        <th>Category</th>
                                        <th>Date Upload</th>
                                    </tr>
                                </thead>
                                <tbody id="listUploadFile">
                                            
                                </tbody>
                            </table>
                        <!-- </div> -->
                        
                    </div>
                </div>
            </div>
            <div class="col-sm-2 col-md-2">
                <div class="panel panel-primary">
                    <div class="panel-body" align="center">
                        <div class="container-prof">
                            <div id="profile-pic"></div>
                            <div class="bottomright"> <span><i class="fa fa-edit"> Edit</i></span> </div>
                        </div> 
                        <hr />
                        <i class="fa fa-user"><span id="profile"></span></i> <br /> 
                        <i class="fa fa-cog"></i> <span>ICT Faculty</span>
                    </div>
                </div>
                
                <!-- list active faculty -->
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <span>Active Faculty</span>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr><th></th></tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><i class="fa fa-check-circle"></i> Junrel Devocion</td>
                                    </tr>
                                    <tr>
                                        <td>Junrel Devocion</td>
                                    </tr>
                                    <tr>
                                        <td>Junrel Devocion</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- logs -->
        <div class="media hide" id="myLogs">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="all-logs">
                        
                    </tbody>
                </table>
            </div>
        </div>
        <br /> <br /><br />
        <div class="well">
            <footer class="text-center">
            <div class="pull-right hidden-xs">
                
            </div>
            <strong>Copyright &copy; 2017-2018 <span>ICT Department </span></strong>
          </footer>
        </div>
    </div>   

<!-- modal -->
<?php $this->load->view('modal/profile_mdl') ?>
<?php $this->load->view('modal/changePic_mdl') ?>
<?php $this->load->view('modal/changePass_mdl') ?>
<?php $this->load->view('modal/upload_mdl') ?>
<?php $this->load->view('modal/confirm_mdl') ?>

<?php $this->load->view('include/footer') ?>
</body>
</html>