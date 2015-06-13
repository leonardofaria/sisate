<?php echo validation_errors(); ?>

<?php echo form_open_multipart('', array('class' => 'form-horizontal', 'data-toggle' => 'validator')); ?>

<div class="panel panel-default">
  <div class="panel-heading">Preencha os dados abaixo: </div>
  <div class="panel-body">
    <div class="form-group">
      <?php echo form_label('SIAPE', 'siape', array('class' => 'col-sm-2 control-label')); ?>
      <div class="col-sm-4">
    	  <?php echo form_input(array('id' => 'siape', 'name' => 'siape', 'value' => set_value('nb'), 'class' => 'form-control', 'data-error' => 'Campo obrigatório', 'required' => 'required')); ?>
    	</div>
      <div class="help-block with-errors"></div>
    </div>

    <div class="form-group">
      <?php echo form_label('Nome', 'nome', array('class' => 'col-sm-2 control-label')); ?>
      <div class="col-sm-4">
        <?php echo form_input(array('id' => 'nome', 'name' => 'nome', 'value' => set_value('nb'), 'class' => 'form-control', 'data-error' => 'Campo obrigatório', 'required' => 'required')); ?>
      </div>
      <div class="help-block with-errors"></div>
    </div>

    <div class="form-group">
      <?php echo form_label('E-mail', 'email', array('class' => 'col-sm-2 control-label')); ?>
      <div class="col-sm-4">
        <?php echo form_email(array('id' => 'email', 'name' => 'email', 'value' => set_value('nb'), 'class' => 'form-control', 'data-error' => 'E-mail obrigatório', 'required' => 'required')); ?>
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
      <?php echo form_label('Órgão', 'orgao', array('class' => 'col-sm-2 control-label')); ?>
      <div class="col-sm-8">
        <?php echo form_dropdown(array('id' => 'orgao', 'name' => 'orgao', 'class' => 'form-control', 'data-error' => 'Campo obrigatório', 'required' => 'required'), $orgao_select_opts); ?>
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