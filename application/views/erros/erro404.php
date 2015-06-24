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
	.page {
		display: table;
		height: 100%;
		position: absolute;
		width: 100%;
	}
	.container {
		display: table-cell;
		vertical-align: middle;
	}
	</style>
</head>
<body>
<div class="page">
<div class="container">
  <div class="row">
    <div class="col-sm-4 col-md-6 col-md-offset-3 text-center">
    	<div class="panel panel-default">
    		<div class="panel-heading">
	      	<h3>Página não encontrada <sup>Erro 404</sup></h3>
	      </div>
	      <div class="panel-body">
	      	<p>O documento que você deseja visualizar está indisponível.</p>
		      <a href="javascript: history.go(-1);" class="btn btn-large btn-info">
		      	<span class="glyphicon glyphicon-arrow-left"></span> &nbsp; Voltar
		      </a>
		      <a href="<?php echo base_url(); ?>" class="btn btn-large btn-info">
		      	<span class="glyphicon glyphicon-home"></span> &nbsp; Página Inicial
		      </a>
		    </div>
	    </div>
    </div>
  </div>
</div>
</div>
</body>
</html>