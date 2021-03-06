<?php echo validation_errors(); ?>

<?php echo form_open('', array('class' => 'form-horizontal', 'data-toggle' => 'validator')); ?>

<div class="panel panel-default">
  <div class="panel-heading">Preencha os dados abaixo: </div>
  <div class="panel-body">
    <div class="form-group">
      <?php echo form_label('Nome', 'nome', array('class' => 'col-sm-2 control-label')); ?>
      <div class="col-sm-4">
        <?php echo form_input(array('id' => 'nome', 'name' => 'nome', 'value' => set_value('nome'), 'class' => 'form-control', 'data-error' => 'Campo obrigatório', 'required' => 'required')); ?>
      </div>
      <div class="help-block with-errors"></div>
    </div>

    <div class="form-group">
      <?php echo form_label('Perfil', 'perfil', array('class' => 'col-sm-2 control-label')); ?>
      <div class="col-sm-4">
        <?php echo form_dropdown(array('id' => 'perfil', 'name' => 'perfil', 'class' => 'form-control', 'data-error' => 'Campo obrigatório', 'required' => 'required'), $perfil_select_opts); ?>
      </div>
      <div class="help-block with-errors"></div>
    </div>

    <div class="form-group">
      <?php echo form_label('Documento', 'documento', array('class' => 'col-sm-2 control-label')); ?>
      <div class="col-sm-4">
        <?php echo form_dropdown(array('id' => 'documento', 'name' => 'documento', 'class' => 'form-control', 'data-error' => 'Campo obrigatório', 'required' => 'required'), $documento_select_opts); ?>
      </div>
      <div class="help-block with-errors"></div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-4">
        <?php echo form_submit(array('name' => 'save', 'value' => 'Salvar', 'class' => 'btn btn-lg btn-primary')); ?>
      </div>
    </div>

    <?php echo form_close(); ?>

  </div>
</div>