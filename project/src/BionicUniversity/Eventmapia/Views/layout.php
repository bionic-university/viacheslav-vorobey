<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Eventmapia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="http://bionic.dev/web/css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="http://bionic.dev/web/css/styles.css" rel="stylesheet">
</head>
<body>

<div class="navbar navbar-custom navbar-fixed-top">
    <div class="navbar-header">
        <a class="navbar-brand" href="/"><img src="http://bionic.dev/web/images/logo.png" /></a>
    </div>
    <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Events</a></li>
            <li><a href="#">Add event</a></li>
            <li><a href="#">Login</a></li>
            <li>&nbsp;</li>
        </ul>
        <form class="navbar-form">
            <div class="form-group" style="display:inline;">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="What are searching for?">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span> </span>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="content" id="main">

    <?php require_once $name . '.php'; ?>

</div>

<!-- script references -->
<script src="http://bionic.dev/web/js/jquery.min.js"></script>
<script src="http://bionic.dev/web/js/bootstrap.min.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&extension=.js&output=embed"></script>
<script src="http://bionic.dev/web/js/scripts.js"></script>
</body>
</html>