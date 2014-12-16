<?php $url = trim($_SERVER['REQUEST_URI'], '/');?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Eventmapia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/web/css/bootstrap.min.css">
    <link rel="stylesheet" href="/web/css/fullcalendar.min.css">
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="/web/css/styles.css">
    <script src="/web/js/vendor/jquery.min.js"></script>
</head>
<body>

<div class="navbar navbar-custom navbar-fixed-top">
    <div class="navbar-header">
        <a class="navbar-brand" href="/"><img src="http://bionic.dev/web/images/logo.png" /></a>
    </div>
    <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <li class="<?= $url == 'web/index/index' ? 'active' : ''; ?>"><a href="/web/index/index">Events</a></li>
            <li class="<?= $url == 'web/events/add' ? 'active' : ''; ?>"><a href="/web/events/add">Create event</a></li>
            <li class="<?= $url == 'web/calendar/index' ? 'active' : ''; ?>"><a href="/web/calendar/index">Calendar</a></li>

            <?php if(!$_SESSION['user_id']) : ?>
                <li class="<?= $url == 'web/index/registration' ? 'active' : ''; ?>"><a href="/web/index/registration">Registration</a></li>
                <li class="<?= $url == 'web/index/login' ? 'active' : ''; ?>"><a href="/web/index/login">Login</a></li>
            <?php else : ?>
                <li><a href="/web/index/logout">Logout</a></li>
            <?php endif; ?>

            <li>&nbsp;</li>
        </ul>
        <!--form class="navbar-form">
            <div class="form-group" style="display:inline;">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="What are searching for?">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span> </span>
                </div>
            </div>
        </form-->
    </div>
</div>

<div class="content" id="main">
    <?php require_once $name . '.php'; ?>
</div>

<script src="/web/js/vendor/bootstrap.min.js"></script>
<!--script src="http://maps.googleapis.com/maps/api/js?sensor=false&extension=.js&output=embed"></script-->
<script src="/web/js/scripts.js"></script>
</body>
</html>
