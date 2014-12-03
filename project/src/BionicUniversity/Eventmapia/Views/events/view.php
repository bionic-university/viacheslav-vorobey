<div class="container-fluid">
    <div class="row">
        <div class="col-xs-6">
            <br>
            <ul class="list-group">
                <li class="list-group-item active">
                    <span class="list-group-item-heading"> <a href="#"><?= $this->event['title']; ?></a> </span>
                    <span class="label label-success pull-right"><?= $this->event['date']; ?></span>
                </li>
                <li class="list-group-item">
                    <?= nl2br($this->event['description']); ?>
                    <hr> <span>Created by: <a href="/web/user/view/<?= $this->event['user_id']; ?>" class="text-info"><?= $this->event['username']; ?></a></span>
                    <span class="pull-right" style="margin-top: -4px;">
                        <a href="/web/events/accept/<?= $this->event['id']; ?>" class="btn btn-primary" style="padding: 3px 20px;">Join</a>
                    </span>
                </li>
            </ul>

            <strong>Comments:</strong>
        </div>
        <div class="col-xs-6">
            <br> map must be here
        </div>
    </div>
</div>