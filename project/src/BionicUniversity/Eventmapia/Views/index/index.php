<div id="map-canvas"></div>
<div class="container-fluid">
    <div class="row">
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
                    <hr> <span>Created by: <a href="#" class="text-info">John Doe</a></span>
                    <span class="pull-right" style="margin-top: -7px;">
                        <a href="#" class="btn btn-default" style="padding: 3px 20px;">Join</a>
                    </span>


                </li>
            </ul>
            <?php endforeach; ?>

            <!--
            div class="panel panel-default"> <div class="panel-heading"><a href="">title here</a></div> </div>
            <p>description</p><hr
            -->

            <p> <a href="#" target="_ext" class="center-block btn btn-primary">Load more events</a> </p>

        </div>
        <div class="col-xs-7"><!--map-canvas will be postioned here--></div>

    </div>
</div>