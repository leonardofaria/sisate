<?php echo validation_errors(); ?>
<?php echo form_error('uploadedimages[]'); ?>

<?php echo form_open_multipart('', array('class' => 'form-horizontal', 'data-toggle' => 'validator')); ?>

<div class="panel panel-default">
  <div class="panel-heading">Preencha os dados abaixo: </div>
  <div class="panel-body">
    <div class="form-group">
      <?php echo form_label('Número do Benefício', 'nb', array('class' => 'col-sm-2 control-label')); ?>
      <div class="col-sm-4">
    	  <?php echo form_input(array('id' => 'nb', 'name' => 'nb', 'value' => set_value('nb'), 'class' => 'form-control', 'data-mask' => '99/999.999.999-9')); ?>
    	</div>
      <div class="help-block with-errors"></div>
    </div>

    <div class="form-group">
      <?php echo form_label('CTC', 'ctc', array('class' => 'col-sm-2 control-label')); ?>
      <div class="col-sm-4">
        <?php echo form_input(array('id' => 'ctc', 'name' => 'ctc', 'value' => set_value('ctc'), 'class' => 'form-control', 'data-mask' => '99999999.9.99999/99-9')); ?>
      </div>
      <div class="help-block with-errors"></div>
    </div>

    <div class="form-group">
      <?php echo form_label('Órgão responsável', 'orgao_responsavel', array('class' => 'col-sm-2 control-label')); ?>
      <div class="col-sm-8">
        <?php echo form_dropdown(array('id' => 'orgao_responsavel', 'name' => 'orgao_responsavel', 'class' => 'form-control', 'data-error' => 'Campo obrigatório', 'required' => 'required'), $select_opts, $this->orgao_id); ?>
      </div>
      <div class="help-block with-errors"></div>
    </div>

    <div class="form-group">
      <?php echo form_label('Arquivos', 'nb', array('class' => 'col-sm-2 control-label')); ?>
      <div class="col-sm-8">
        <?php echo form_upload(array('name' => 'uploadedfiles[]', 'multiple' => 'multiple', 'data-error' => 'É necessário anexar pelo menos um documento PDF', 'required' => 'required')); ?>
        <div class="help-block with-errors"></div>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-4">
        <?php echo form_submit(array('name' => 'save', 'value' => 'Salvar', 'class' => 'btn btn-lg btn-primary')); ?>
      </div>
    </div>

    <?php echo form_close(); ?>

  </div>
</div>