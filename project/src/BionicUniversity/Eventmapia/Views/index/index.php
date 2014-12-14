<div class="container-fluid">
    <div class="row">

        <div id="map-canvas"></div>

        <div class="col-xs-5" id="left">
            <br>
            <?php foreach($this->events as $event) : ?>
            <ul class="list-group">
                <li class="list-group-item active">
                    <span class="list-group-item-heading"> <a href="#"><?= $event['title']; ?></a> </span>
                    <span class="label label-success pull-right"><?= $event['date']; ?></span>
                </li>
                <li class="list-group-item">
                    <?= $event['description']; ?>
                    <hr> <span class="small">Created by: <a href="/web/user/view/<?= $event['user_id']; ?>" class="text-info"><?= $event['username']; ?></a></span>
                    <span class="pull-right" style="margin-top: -4px;">
                        <a href="/web/events/view/<?= $event['id']; ?>" class="btn btn-default" style="padding: 3px 20px;">More</a>
                    </span>
                </li>
            </ul>
            <?php endforeach; ?>

            <a href="/web/calendar/index" class="center-block btn btn-primary">Show all events</a><br>

        </div>
        <div class="col-xs-7"></div>

    </div>
</div>