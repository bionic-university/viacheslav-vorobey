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
            <a class="navbar-brand" href="/">EM Dashboard</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/web/dashboard/index">Home</a></li>
                <li><a href="/web/dashboard/events">Events</a></li>
                <li><a href="/web/dashboard/users">Users</a></li>
                <li class=""><a href="/web/dashboard/comments">Comments</a></li>
                <li class=""><a href="/web/dashboard/settings">Settings</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li style="margin-right: 30px;"><a href="/web/index/login">Logout</a></li>
            </ul>
        </div>
    </div>


    <div class="content" id="main">

        <?php require_once $name . '.php'; ?>

    </div>


</body>
</html>
