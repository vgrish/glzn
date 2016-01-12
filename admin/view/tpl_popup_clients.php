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
                        <label>Изменение оптовых цен</label>
                        <select name="opt" class="form-control m-b hidden_section">
                            <?
                            $opt = DB::select('opt');
                            foreach ($opt as $row) {
                                ?><option value="<?=$row['id']?>"><?=$row['name']?></option><?
                            }
                            ?>
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