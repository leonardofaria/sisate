<div class="modal fade" id="analisar_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo validation_errors(); ?>
      <?php echo form_error('uploadedimages[]'); ?>

      <?php echo form_open_multipart(base_url('processos/analisar/' . $id), array('class' => 'form-horizontal')); ?>

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Analisar processo</h4>
      </div>
      <div class="modal-body">

        <br/><br/>
        <div class="form-group">
          <?php echo form_label('Evento', 'evento', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php echo form_dropdown(array('id' => 'evento', 'name' => 'evento', 'class' => 'form-control'), $evento_select_opts); ?>
          </div>
        </div>

        <div class="form-group" id="form_complemento">
          <?php echo form_label('Servidor', 'complemento', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php #echo form_input(array('id' => 'complemento', 'name' => 'complemento', 'value' => set_value('complemento'), 'class' => 'form-control')); ?>
            <?php echo form_dropdown(array('id' => 'complemento', 'name' => 'complemento', 'class' => 'form-control'), $complemento_select_opts); ?>
          </div>
        </div>

        <div class="form-group">
          <?php echo form_label('Arquivos', 'nb', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php // echo form_upload('uploadedfiles[]', '', 'multiple'); ?>

            <div class="input-group">
              <span class="input-group-btn">
                <span class="btn btn-file">
                  Selecione <input type="file" name="uploadedfiles[]" multiple>
                </span>
              </span>
              <input type="text" class="form-control" readonly>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn " data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>

    <?php echo form_close(); ?>
    </div>
  </div>
</div>
