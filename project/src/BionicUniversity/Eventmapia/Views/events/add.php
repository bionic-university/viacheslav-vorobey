<div class="container-fluid" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    <div class="row">

        <div class="col-xs-6" style="padding-top: 20px;">
            <div class="input-group col-xs-12">
                <form action="/web/events/add" method="post">

                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-xs-8">
                            <input class="form-control" type="text" name="title" placeholder="Title" />
                        </div>
                        <div class="col-xs-4">
                            <input class="form-control" type="text" name="date_start" placeholder="dd/mm/yy" />
                        </div>
                    </div>

                    <textarea rows="10" class="form-control" name="description"> </textarea>

                    <input type="submit" name="submit" value="Add event" class="btn btn-primary" />
                </form>
            </div>
        </div>

        <div class="col-xs-6">

        </div>

    </div>
</div>