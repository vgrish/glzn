<div class="modal <?=$param?> fade" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Клиенты</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <label>Выберите фото</label>
                        <input ui-jq="filestyle" name="img" type="file" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="files"  accept="image/fits" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);">
                        <label>Введите имя</label>
                        <input type="text" class="form-control m-b" placeholder="Сати Казанова" name="name">
                        <label>Введите текс</label>
                        <input type="text" class="form-control m-b" placeholder="Сати Казанова в платье glzn by galina zhondorova..." name="text">
                        <label>Введите год</label>
                        <input type="text" class="form-control m-b" placeholder="2014" name="year">
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