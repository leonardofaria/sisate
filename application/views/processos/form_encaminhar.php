<div class="modal fade" id="encaminhar_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo validation_errors(); ?>
      <?php echo form_error('uploadedimages[]'); ?>

      <?php echo form_open_multipart(base_url('processos/encaminhar/' . $id), array('class' => 'form-horizontal', 'data-toggle' => 'validator')); ?>

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Encaminhar processo</h4>
      </div>
      <div class="modal-body">

        <br/><br/>
        <div class="form-group">
          <?php echo form_label('Orgão', 'orgao', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-10">
            <?php echo form_dropdown(array('id' => 'orgao', 'name' => 'orgao', 'class' => 'form-control', 'required' => 'required', 'data-error' => 'Selecione um órgão da lista'), $orgao_select_opts); ?>
            <div class="help-block with-errors"></div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn " data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>

    <?php echo form_close(); ?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
