<div class="modal <?=$param?> fade" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Ценовые категории</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <label>Название</label>
                        <input type="text" class="form-control m-b" placeholder="Название" name="name">
                        <label>Накрутка</label>
                        <input type="text" class="form-control m-b" placeholder="Сумма накрутки «1.3»" name="sun">
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