<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="http://bionic.dev/web/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://bionic.dev/web/css/styles.css" rel="stylesheet">
</head>

<body>

    <div class="navbar navbar-custom navbar-fixed-top">
        <div class="navbar-header">
            <a class="navbar-brand" href="/"><img src="http://bionic.dev/web/images/logo.png" /></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/web/events/index">Events</a></li>
                <li><a href="#">Add event</a></li>
                <li><a href="/web/index/registration">Registration</a></li>
                <li><a href="/web/index/login">Login</a></li>
                <li>&nbsp;</li>
            </ul>
        </div>
    </div>


    <div class="content" id="main">

        <?php require_once $name . '.php'; ?>

    </div>


</body>
</html>
