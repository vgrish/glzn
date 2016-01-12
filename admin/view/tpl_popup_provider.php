<div class="modal <?=$param?> fade" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Поставщики</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <label>Название</label>
                        <input type="text" class="form-control m-b" placeholder="Название" name="name">
                        <label>Название для клиента</label>
                        <input type="text" class="form-control m-b" placeholder="Название для клиента" name="name_klient">
                        <label>Наценка</label>
                        <input type="text" class="form-control m-b" placeholder="Наценка «1.3»" name="margin">
                        <label>Выберите курс</label>
                        <select name="kurs" class="form-control m-b hidden_section">
                            <option value="0" selected="selected"></option>
                            <?
                            $kurs = DB::select('kurs');
                            foreach ($kurs as $row) {
                                ?><option value="<?=$row['id']?>"><?=$row['name']?></option><?
                            }
                            ?>
                        </select>
                        <label>Доставка</label>
                        <input type="text" class="form-control m-b" placeholder="Доставка" name="delivery">
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

<div class="modal update fade" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Обновление прайс-листа</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <label>Выберите файл csv</label>
                        <div class="form-group">
                            <input ui-jq="filestyle" name="csv" type="file" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="files"  accept="text/csv" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);">
                        </div>
                        <input type="hidden" name="update" value="save">
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