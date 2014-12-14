<div class="container-fluid">
    <div class="row">

        <?= $this->map; ?>

        <div class="col-xs-5">
            <br>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= $this->event['title']; ?></h3>
                </div>
                <div class="panel-body">
                    <?= nl2br($this->event['description']); ?>
                    <br><br>

                    <?php if (empty($this->event['routeFrom'])) : ?>
                        <i class="glyphicon glyphicon-map-marker text-info"></i> <strong>Where: </strong> <?= $this->event['routeTo']; ?> <br>
                    <?php else: ?>
                        <i class="glyphicon glyphicon-map-marker text-info"></i> <strong>From: </strong> <?= $this->event['routeFrom']; ?> <br>
                        <i class="glyphicon glyphicon-map-marker text-success"></i> <strong>To: </strong> <?= $this->event['routeTo']; ?> <br>
                    <?php endif; ?>

                    <?php if (!empty($this->event['routeVia'])) : ?>
                        <strong>Via: </strong> <?= $this->event['routeVia']; ?>
                    <?php endif; ?>

                    <i class="glyphicon glyphicon-time text-info"></i> <strong>Date/Time: </strong> <?= $this->event['date']; ?> <br>

                    <br>
                    <div class="event-instructions-wrapper">
                        <a class="show-instructions" href="#">Show instructions</a>
                        <div class="event-instructions-content">

                            <table class="table">
                                <?php foreach ($this->instructions as $instruction) : ?>
                                <tr>
                                    <td><?= $instruction[0]; ?></td>
                                    <td width="60"><?= $instruction[1]; ?></td>
                                    <td width="50"><?= $instruction[2]; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </table>

                        </div>
                    </div>
                    <hr>

                    <strong>Who’s Attending: </strong> <br>
                    <small><strong>
                    <?php
                        foreach ($this->attendingUsers as $user) {
                            $string .= '<a href="/web/user/view/'. $user['user_id'] .'" style="color: #333">'. $user['username'] .'</a>, ';
                        }
                        echo rtrim($string, ', ');
                    ?>
                    </strong></small>

                    <hr>

                    <span class="small">Created by: <a href="/web/user/view/<?= $this->event['user_id']; ?>" class="text-info"><?= $this->event['username']; ?></a></span>
                    <span class="pull-right" style="margin-top: -4px;">
                        <?php if (!$this->isJoined && $this->commentsAccess) :?>
                            <a href="/web/events/accept/<?= $this->event['id']; ?>" class="btn-join btn btn-primary" style="padding: 3px 20px;"><i class="glyphicon glyphicon-thumbs-up"></i> Join</a>
                        <?php elseif ($this->commentsAccess) : ?>
                            <a href="/web/events/cancel/<?= $this->event['id']; ?>" class="btn-cancel btn btn-warning" style="padding: 3px 20px;"><i class="glyphicon glyphicon-thumbs-down"></i> Cancel</a>
                        <?php endif; ?>
                    </span>
                </div>
            </div>

            <div class="leave-comment-container">
                <?php if ($this->commentsAccess == 1) : ?>
                    <form method="post" action="/web/events/addcomment" name="leave-comment-form">
                        <strong>Comments:</strong>
                        <small><a href="#" class="leave-comment-link">Show/hide comments</a></small>
                        <textarea name="comment" rows="2" class="form-control leave-comment-textarea"></textarea>
                        <input type="hidden" name="event_id" value="<?= $this->event['id']; ?>">
                        <button class="btn btn-sm btn-primary leave-comment-btn" type="submit" style="margin-top: 5px;">Submit</button>
                    </form> <br>
                <?php else : ?>
                    <div class="alert alert-warning">
                        <span>You must be logged in to leave a comment.</span>
                        <a href="/web/index/login">Sign in</a>
                    </div>
                <?php endif; ?>

                <div class="panel-default comments-content">
                <?php $i = 1; foreach ($this->comments as $comment) : ?>

                    <div class="panel-heading" style="padding: 6px 10px;">
                        <span class="text-muted">#<?= $i; ?></span>
                        <span>
                            <a href="/web/user/view/<?= $comment['user_id']; ?>" class="text-info" style="font-size: 13px;">
                                <?= $comment['username']; ?>
                            </a>
                        </span>
                        <span class="pull-right text-muted">
                            <small><?= $comment['created_time']; ?></small>
                        </span>
                    </div>
                    <p style="padding: 10px 5px 20px; font-size: 13px;">
                        <?= nl2br($comment['text']); ?>
                    </p>

                <?php $i++; endforeach; ?>
                </div>
            </div>

        </div>
        <div class="col-xs-7">

        </div>
    </div>
</div>


<script>

    //$('#map-canvas-view').css('position', 'fixed');

    $(function() {

        // Hide map instructions on page load
        $('.event-instructions-content').hide();

        // Show instructions
        $('.show-instructions').click(function(e){
            e.preventDefault();
            $('#map-canvas-view').css('position', 'fixed');
            $('.event-instructions-content').toggle();
        });

        // Leave a comment
        $('.leave-comment-link').click(function(e){
            e.preventDefault();
            $('.comments-content').toggle();
        });

    });


</script>