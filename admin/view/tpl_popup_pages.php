<div class="modal <?=$param?> fade" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Раздел</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <label class="hidden_section">Введите раздел</label>
                        <select name="section" class="form-control m-b hidden_section">
                            <option value="0" selected="selected"></option>
                            <? Pages::viewCatOptions(Pages::getCat(),0,0); ?>
                        </select>
                        <label>Введите название</label>
                        <input type="text" class="form-control m-b" placeholder="Название" name="name">
                        <label>Url</label>
                        <input type="text" class="form-control m-b" placeholder="Url" name="url">
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