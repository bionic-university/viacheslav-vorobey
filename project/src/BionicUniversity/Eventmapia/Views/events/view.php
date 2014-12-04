<div class="container-fluid">
    <div class="row">
        <div class="col-xs-5">
            <br>
            <ul class="list-group">
                <li class="list-group-item active">
                    <span class="list-group-item-heading"> <?= $this->event['title']; ?> </span>
                    <span class="label label-success pull-right"><?= $this->event['date']; ?></span>
                </li>
                <li class="list-group-item">
                    <?= nl2br($this->event['description']); ?>
                    <hr> <span>Created by: <a href="/web/user/view/<?= $this->event['user_id']; ?>" class="text-info"><?= $this->event['username']; ?></a></span>
                    <span class="pull-right" style="margin-top: -4px;">
                        <a href="/web/events/accept/<?= $this->event['id']; ?>" class="btn-join btn btn-primary" style="padding: 3px 20px;">Join</a>
                    </span>
                </li>
            </ul>



            <div class="leave-comment-container">
                <form method="post" action="" name="leave-comment-form">
                    <strong>Comments:</strong>
                    <small><a href="#" class="leave-comment-link" style="text-decoration: underline;">Leave a comment</a></small>
                    <textarea rows="2" class="form-control leave-comment-textarea"></textarea>
                    <button class="btn btn-sm btn-primary leave-comment-btn" type="submit" style="margin-top: 5px;">Submit</button>
                </form>
                <hr>
            </div>


        </div>
        <div class="col-xs-7">
            <br> map must be here
        </div>
    </div>
</div>


<script>
    $(function() {

        // test btn alert
        $('.btn-join').click(function(e){
            e.preventDefault();
            alert('aaaaaa');
        });

        // leave a comment
        $('.leave-comment-link').click(function(e){
            e.preventDefault();
            $('.leave-comment-textarea').toggle();
            $('.leave-comment-btn').toggle();
        });

        //$.ajax({
        //    url: "http://bionic.dev/web/events/view/1",
        //    type: "POST",
        //    data: { func: "test" },
        //    success: function(data) { alert(data); }
        //});

    });


</script>