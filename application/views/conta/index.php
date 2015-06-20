<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<title>SISATE</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo base_url("assets/css/material/bootstrap.css"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("assets/css/material/roboto.min.css"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("assets/css/material/material.min.css"); ?>">
	<link rel="stylesheet" href="<?php echo base_url("assets/css/material/ripples.min.css"); ?>">
	<style>
	.login {
		display: table;
		height: 100%;
		position: absolute;
		width: 100%;
	}
	.container {
		display: table-cell;
		vertical-align: middle;
	}
	.profile-img {
		width: 96px;
		height: 96px;
		margin: 0 auto 10px;
		display: block;
		-moz-border-radius: 50%;
		-webkit-border-radius: 50%;
		border-radius: 50%;
	}
	</style>
</head>
<body>
<div class="login">
<div class="container">
	<div class="row">
		<div class="col-sm-6 col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>
						SISATE <?php echo (ENVIRONMENT == 'development') ? 'TESTE' : 'PRODUÇÃO'; ?> ~ Entrar no sistema
					</strong>
				</div>
				<div class="panel-body">
					<?php echo validation_errors(); ?>
					<form id="login" data-toggle="validator" role="form" method="POST" action="<?= base_url('conta/') ?>">
						<fieldset>
							<div class="row">
								<div class="center-block">
									<img class="profile-img"
									src="<?php echo base_url('assets/img/avatar.png'); ?>" alt="">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12 col-md-10  col-md-offset-1 ">
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="glyphicon glyphicon-user"></i>
											</span>
											<input class="form-control" placeholder="Username" name="username" type="text" autofocus pattern="^([0-9]){7,}$" maxlength="7" data-error="Campo obrigatório, com 7 dígitos" required="required" />
										</div>
										<div class="help-block with-errors"></div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="glyphicon glyphicon-lock"></i>
											</span>
											<input class="form-control" placeholder="Password" name="password" type="password" value="" data-error="Campo obrigatório" required="required" />
										</div>
										<div class="help-block with-errors"></div>
									</div>
									<div class="form-group">
										<input type="submit" class="btn btn-lg btn-primary btn-block" value="Entrar">
									</div>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
				<div class="panel-footer text-center">
					Utilize os dados do SISREF para entrar <br/>
					<?php if (ENVIRONMENT == 'development') { ?>
					<a href="/sisate">Acessar ambiente de produção</a>
					<?php } else { ?>
					<a href="/sisateteste">Acessar ambiente de teste</a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/validator.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/ripples.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/material.min.js'); ?>"></script>
<script>$(document).ready(function() { $.material.init(); });</script>
</body>
</html>