<div class="container-fluid">
    <div class="row">
        <div class="col-xs-5">
            <div class="user-profile">
                <div class="pull-left">
                    <img src="/web/images/no-photo.jpg" />
                </div>
                <div class="pull-left user-profile-right">
                    <span><?php echo $this->user['username']; ?></span> <br>
                    <span class="small">id: <?php echo $this->user['id']; ?> </span>
                    <br><hr>
                    <small><strong>Registered:</strong> <?php echo $this->user['created_time']; ?></small>
                </div>
            </div>

        </div>
        <div class="col-xs-7">

            <h3>User activity</h3>

            <div role="tabpanel">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#events" aria-controls="home" role="tab" data-toggle="tab">Events</a>
                    </li>
                    <li role="presentation">
                        <a href="#comments" aria-controls="profile" role="tab" data-toggle="tab">Comments</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="events">
                        <table class="table" style="margin-top: -1px;">

                            <?php if (!empty($this->events)) : ?>

                                <?php $i = 1; foreach ($this->events as $event) : ?>
                                    <tr>
                                        <td>#<?= $i; ?></td>
                                        <td><a href="/web/events/view/<?= $event['id']; ?>"><?= $event['title']; ?></a></td>
                                        <td><?= $event['created_time']; ?></td>
                                    </tr>
                                    <?php $i++; endforeach; ?>

                            <?php else : ?>

                                <p style="margin-top: -1px;" class="alert alert-info">Events is not available </p>

                            <?php endif; ?>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="comments">
                        <table class="table" style="margin-top: -1px;">
                            <?php if (!empty($this->comments)) : ?>

                                <?php $i = 1; foreach ($this->comments as $comment) : ?>
                                    <tr>
                                        <td>#<?= $i; ?></td>
                                        <td><?= $comment['text']; ?></td>
                                        <td><?= $comment['created_time']; ?></td>
                                        <td><a href="/web/events/view/<?= $comment['event_id']; ?>">event #<?= $comment['event_id']; ?></a></td>
                                    </tr>
                                <?php $i++; endforeach; ?>

                            <?php else : ?>

                                <p style="margin-top: -1px;" class="alert alert-info">Comments is not available </p>

                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>