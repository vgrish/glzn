<div class="modal status fade" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Статусы заказов</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <label>Изменить количество</label>
                        <input type="text" class="form-control m-b" placeholder="Количество" name="kol">
                        <label>Изменить наименование</label>
                        <input type="text" class="form-control m-b" placeholder="Количество" name="name">
                        <label>Статус</label>
                        <select name="status" class="form-control m-b hidden_section">
                            <?
                                $status = DB::select('provider_status');
                                foreach ($status as $stat) {
                                    ?><option value="<?=$stat['id']?>" data-color="<?=$stat['color']?>"><?=$stat['name']?></option><?
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