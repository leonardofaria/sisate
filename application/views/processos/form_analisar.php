<div class="modal fade" id="analisar_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo validation_errors(); ?>
      <?php echo form_error('uploadedimages[]'); ?>

      <?php echo form_open_multipart(base_url('processos/analisar/' . $id), array('class' => 'form-horizontal', 'id' => 'form-analisar', 'data-toggle' => 'validator')); ?>

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Analisar processo</h4>
      </div>
      <div class="modal-body">

        <br/><br/>
        <div class="form-group">
          <?php echo form_label('Evento', 'analisar_evento', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php echo form_dropdown(array('id' => 'analisar_evento', 'name' => 'evento', 'class' => 'form-control', 'required' => 'required', 'data-error' => 'Selecione um evento da lista'), $evento_select_opts); ?>
            <div class="help-block with-errors"></div>
          </div>
        </div>

        <div class="form-group" id="form_complemento">
          <?php echo form_label('Servidor', 'analisar_complemento', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php #echo form_input(array('id' => 'complemento', 'name' => 'complemento', 'value' => set_value('complemento'), 'class' => 'form-control')); ?>
            <?php echo form_dropdown(array('id' => 'analisar_complemento', 'name' => 'complemento', 'class' => 'form-control', 'data-error' => 'É necessário atribuir esse processo a um servidor.'), $complemento_select_opts); ?>
            <div class="help-block with-errors"></div>
          </div>
        </div>

        <div class="form-group">
          <?php echo form_label('Arquivos', 'analisar_arquivos', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php echo form_upload(array('name' => 'uploadedfiles[]', 'multiple' => 'multiple', 'data-error' => 'É necessário anexar pelo menos um documento PDF', 'required' => 'required')); ?>
            <div id="analisar_arquivos_erro" class="help-block with-errors"></div>
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
