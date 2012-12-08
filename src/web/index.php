<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="utf-8">
        <title>TodoList</title>
        <script src="js/libs/jquery-1.8.0/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/base/jquery-ui.css">
        <script src="js/libs/timepicker/picker.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="stylesheet" type="text/css" href="js/libs/angular-ui/angular-ui.css"/>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
        <style type="text/css">
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
        </style>
        <link href="css/bootstrap-responsive.css" rel="stylesheet">
        <script src="js/libs/json/json2-min.js"></script>
        <script src="js/configuration.js"></script>
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->


    </head>

    <body ng-app="todolist"  ng-controller="TodoListCtrl" >

        <div class="navbar navbar-inverse navbar-fixed-top"   >



            <div class="navbar-inner"  >
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#" >TodoList</a>
                    <div class="nav-collapse collapse" id="synergy_mainbar">
                        <ul class="nav" id="navbar" >
                            <li class="active" id="nav_home"><a href="#">Home</a></li>
                            
                        </ul>
                        <div >
                            
                           
                        </div>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>

        <div class="container-fluid">


            
            <div class="row-fluid"  >



                <div class="span12">



                    <div ng-view ng-cloak></div>
                </div>
                <div class="span2"></div>
            </div>
            <!-- Main hero unit for a primary marketing message or call to action -->

            <!-- Example row of columns -->


            <hr>

            <footer>
                <p>&copy; Company 2012</p>
            </footer>

        </div> <!-- /container -->
        <div class="modal fade hide" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Modal header</h3>
            </div>
            <div class="modal-body" id="modal-body">
                <p>One fine body 2…</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
        </div>
        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->

        <script src="js/libs/bootstrap/bootstrap-transition.js"></script>
        <script src="js/libs/bootstrap/bootstrap-alert.js"></script>
        <script src="js/libs/bootstrap/bootstrap-modal.js"></script>
        <script src="js/libs/bootstrap/bootstrap-dropdown.js"></script>
        <script src="js/libs/bootstrap/bootstrap-scrollspy.js"></script>
        <script src="js/libs/bootstrap/bootstrap-tab.js"></script>
        <script src="js/libs/bootstrap/bootstrap-tooltip.js"></script>
        <script src="js/libs/bootstrap/bootstrap-popover.js"></script>
        <script src="js/libs/bootstrap/bootstrap-button.js"></script>
        <script src="js/libs/bootstrap/bootstrap-collapse.js"></script>
        <script src="js/libs/bootstrap/bootstrap-carousel.js"></script>
        <script src="js/libs/bootstrap/bootstrap-typeahead.js"></script>
        <script src="js/controllers.js"></script>
        <script src="js/libs/angularjs-1.0.2/angular.js"></script>

        <script src="js/libs/angular-ui/angular-ui.js"></script>
        <script src="js/app.js"></script>

    </body>
</html>
