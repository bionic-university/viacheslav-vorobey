<div class="container-fluid">
    <div class="row">

        <div class="col-xs-6" style="padding-top: 20px;">
            <div class="row" style="margin-bottom: 10px;">
                <form action="/web/events/add" method="post" class="form">
                    <div class="col-xs-8 form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" name="title" placeholder="Title" />
                    </div>
                    <div class="col-xs-4 form-group">
                        <label for="date">Start date:</label>
                        <input type="text" class="form-control" name="date" placeholder="dd/mm/yy" />
                    </div>
                    <div class="col-xs-12 form-group">
                        <label for="description">Event description:</label>
                        <textarea rows="10" class="form-control" name="description"> </textarea>
                    </div>
                    <div class="col-xs-12">
                        <input type="submit" name="submit" value="Add event" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>


        <div class="col-xs-6">

        </div>

    </div>
</div>