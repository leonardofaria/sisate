<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<title>SISATE ~ <?php echo $this->pageTitle; ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo base_url("assets/css/material/bootstrap.min.css"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("assets/css/material/roboto.min.css"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("assets/css/material/material.min.css"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("assets/css/material/ripples.min.css"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("assets/css/style.min.css"); ?>">
</head>
<body id="<?php echo $this->router->fetch_class(); ?>">

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="navbar-inner">
		<div class="container">
			<div class="navbar-header">
				 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Menu</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
				 <a class="navbar-brand" href="<?php echo base_url(); ?>">
				 	SISATE <sup><?php echo (ENVIRONMENT == 'development') ? 'TESTE' : ''; ?></sup>
				 </a>
			</div>

			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li>
						<a href="<?php echo base_url(); ?>">
							<span class="glyphicon glyphicon-home"></span>
						</a>
					</li>
					<?php if (in_array($this->perfil_id, array(1, 2))) { ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu<strong class="caret"></strong></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo base_url('processos/cadastrar'); ?>"><span class="glyphicon glyphicon-file"></span> Cadastrar processo</a></li>
							<li><a href="<?php echo base_url('processos/'); ?>"><span class="glyphicon glyphicon-duplicate"></span> Listar processos</a></li>

				      <?php if ($this->perfil_id == 1) { ?>
							<li class="divider">
							</li>
							<li role="presentation" class="dropdown-header">Administrador</li>
							<li>
								<a href="<?php echo base_url('eventos'); ?>"><span class="glyphicon glyphicon-tags"></span> Listar eventos</a>
								<a href="<?php echo base_url('orgaos'); ?>"><span class="glyphicon glyphicon-home"></span> Listar orgãos</a>
								<a href="<?php echo base_url('modalidades'); ?>"><span class="glyphicon glyphicon-wrench"></span> Listar modalidades</a>
								<a href="<?php echo base_url('perfis'); ?>"><span class="glyphicon glyphicon-sunglasses"></span> Listar perfis</a>
								<a href="<?php echo base_url('usuarios'); ?>"><span class="glyphicon glyphicon-user"></span> Listar usuários</a>
							</li>
							<?php } ?>
						</ul>
					</li>
					<?php } ?>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<?php if (isset($this->perfis)) { ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span><strong class="caret"></strong></a>
						<ul class="dropdown-menu">
							<li role="presentation" class="dropdown-header">Perfis (<?php echo $this->siape; ?>): </li>
							<li>
								<?php
									foreach ($this->perfis as $perfil) {
										echo "<a href=\"" . base_url('conta/perfil/' . $perfil['usuario_id']) . "\">" . $perfil['ol'] . " - " . $perfil['perfil_nome'] . "</a>";
									}
								?>
							</li>
						</ul>
					</li>
					<?php } ?>
					<li>
						<a href="<?php echo base_url('ajuda'); ?>">
							<span class="glyphicon glyphicon-question-sign"></span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('conta/logout'); ?>">
							<span class="glyphicon glyphicon-off"></span>
						</a>
					</li>
				</ul>

				<form role="search" class="navbar-form navbar-right" style="margin-bottom: 5px; margin-top: 7px;" method="post" action="<?php echo base_url('processos/buscar/'); ?>">
					<div class="input-group">
						<input type="text" name="busca" class="form-control" size="20" placeholder="Pesquisar">
					</div>
				</form>
			</div>
		</div>
	</div>
</nav>

<div class="container">

	<div class="content">

		<?php if ($this->session->flashdata('message_success')) { ?>
      <div class="alert alert-success"><?php echo $this->session->flashdata('message_success') ?></div>
    <?php } ?>

    <?php if ($this->session->flashdata('message_error')) { ?>
			<div class="alert alert-danger"><?php echo $this->session->flashdata('message_error') ?></div>
    <?php } ?>

		<h2 class="title"><?php echo $this->pageTitle; ?></h2>

  	{body}
  </div>

</div>

<footer class="footer">
  <div class="container">
  	<div class="row">
  	  <div class="col-md-6">
  	  	<p class="text-muted">
  	  		<span class="glyphicon glyphicon-user"></span> <?php echo $this->siape; ?> <!-- ~
  	  		<span class="glyphicon glyphicon-time"></span> Último acesso: -->
  	  	</p>
  	  </div>
  	  <div class="col-md-6">
  	  	<p class="text-muted text-right">
  	  		<!-- Versão 1.0 ~ -->
  	  		Criado na <a href="http://www-gexdiv">GEXDIV</a> <!-- ~ <a href="">Código aberto</a>-->
  	  	</p>
  	  </div>
  	</div>

  </div>
</footer>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-editable.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/ripples.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/material.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/validator.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-table/bootstrap-table.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-table/locale/bootstrap-table-pt-BR.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.mask.min.js'); ?>"></script>
<script type="text/javascript">$(document).ready(function() { $.material.init(); });</script>
<?php

$file = $this->router->fetch_class() . '_' . $this->router->fetch_method() . '.js';
$js = $_SERVER["DOCUMENT_ROOT"] . '/sisate/assets/js/' . $file;

if (file_exists($js)) {
	echo "<script type=\"text/javascript\" src=\"" . base_url('assets/js/' . $file) ."\"></script>";
}
?>

</body>
</html>