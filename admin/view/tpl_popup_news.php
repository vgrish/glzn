<div class="modal <?=$param?> fade" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Добавление новости</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <label>Дата</label>
                        <div class="input-group date">
                            <input type="text" class="form-control" name="date">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th"></i>
                            </span>
                        </div>
                        <label>Название</label>
                        <input type="text" class="form-control m-b" placeholder="Новость" name="title">
                        <label>Текст</label>
                        <input type="text" class="form-control m-b" placeholder="Не большой текст" name="text">
                        <input type="hidden" name="go" value="save">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-success button">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>