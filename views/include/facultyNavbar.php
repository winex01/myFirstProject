    <nav class="navbar navbar-default hidden-xs ">
        <div class="container-fluid">
            <div class="navbar-header"><br /><br />
                <div class="banner">
                    <img src="image/ict_logo.png" class="img-responsive" width="200" height="135" style="position:absolute;margin-top:-20px;"><br />
                        <div style="color:#FFFFFF;margin-left:230px;margin-bottom:50px;margin-top:20px;font-size:40px;" class="fa fa-archive"> Online Archiving Documents in ICT Department  <br />
                            <center>(OADS)</center> 
                        </div>

                </div>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-default visible-xs">
        <div class="container-fluid">
            <div class="navbar-header"><br /><br />
                <div class="banner">
                    <img src="image/ict_logo.png" class="img-responsive" width="70" height="50" style="position:absolute;margin-top:-20px; margin-left: 10px">
                        <div style="color:#FFFFFF;margin-left:100px;margin-bottom:50px;margin-top:0;font-size:10px;" class="fa fa-archive"> Online Archiving Documents <br / ><center>in</center>
                            <center>ICT Department (OADS)</center> 
                        </div>
                </div>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="" class="navbar-brand" id="navbar-brand"><i class="glyphicon glyphicon-user glyphicon-lg"></i> Faculty</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">

                <ul class="nav navbar-nav nav-pills">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-folder fa-lg"> Documents</i>  <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#" id="listDocuments"><i class="fa fa-list"></i> List Documents</a></li>
                            <li><a href="#" id="Uploaded"><i class="fa fa-list-alt"></i>  List Uploaded Documents</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-history fa-lg"> Activity Logs</i></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="panel-body">
                                    <table class="table table-hover" style="width: 450px">
                                        <thead>
                                            <tr>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="all-logs">
                                                
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="myNotification"> <i class="fa fa-globe fa-lg"></i><span class="badge badge-secondary myNotification" id="hideNotification"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="panel-body tbl-notification">
                                    <table class="table table-hover" style="width: 450px">
                                        <thead>
                                            <tr>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="receiveNotify">
                                                
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="admin/backup"><i class="fa fa-save fa-lg"> Back up</i> </a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> Setting <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#" id="editProfile"><i class="fa fa-pencil"></i> Edit Profile</a></li>
                            <li><a href="#" id="changePass">Change Password</a></li>
                            <li><a href="#" id="log-out"><i class="fa fa-sign-out"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>