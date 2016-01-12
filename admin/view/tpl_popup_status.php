<div class="modal <?=$param?> fade" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Статусы заказов</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <label>Название</label>
                        <input type="text" class="form-control m-b" placeholder="Название" name="name">
                        <label>Цвет</label>
                        <select name="color" class="form-control m-b hidden_section">
                            <option value="success">success</option>
                            <option value="primary">primary</option>
                            <option value="info">info</option>
                            <option value="danger">danger</option>
                            <option value="warning">warning</option>
                            <option value="dark">dark</option>
                            <option value="default">default</option>
                        </select>
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