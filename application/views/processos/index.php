<div class="accordion">

<div class="panel panel-default">
	<?php

	$body_class_name = 'panel-collapse collapse ';
	$title_class_name = 'panel-title ';
	if ($this->perfil_id != 4) {
		$body_class_name .= 'in';
	} else {
		$title_class_name .= 'collapsed';
	}

	?>
	<div class="panel-heading">
		<h4 class="<?php echo $title_class_name; ?>" data-toggle="collapse" data-target="#lista">
			Processos em <?php echo $this->ol; ?>
		</h4>
	</div>
	<div class="<?php echo $body_class_name; ?>" id="lista">
	<div class="panel-body">

		<table data-toggle="table"
		       data-url="<?php echo base_url('api/processos'); ?>"
		       data-pagination="true"
		       data-side-pagination="server"
		       data-page-size="10"
		       data-page-list="[10]"
		       class="table table-hover table-striped">
	    <thead>
	    <tr>
        <th data-sortable="true" data-field="link">Objeto</th>
        <th data-sortable="true" data-field="data">Data</th>
        <th data-sortable="true" data-field="evento">Último evento</th>
        <th data-sortable="true" data-field="orgao">Órgão Responsável</th>
	    </tr>
	    </thead>
		</table>

		<!--
		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th style="width: 160px">Objeto</th>
					<th style="width: 160px">Data</th>
					<th>Último evento</th>
					<th style="width: 170px">Órgão Responsável</th>
				</tr>
			</thead>
			<tbody>

		<?php

		foreach ($processos as $processo) {

			echo "<tr>";
			echo "<td><a href=\"" . base_url('processos/visualizar/' . $processo->getId()) . "\">";
			if ($processo->getNb()) {
				echo $this->inss->formataProtocolo($processo->getNb());
			} else if ($processo->getCtc()) {
				echo $this->inss->formataProtocolo($processo->getCtc());
			}
			echo "</a></td>";
			echo "<td>" . $processo->getCriado() . "</td>";
			echo "<td>" . $processo->getProcessoEventos()[0]->getEvento()->getNome();
			if ($processo->getProcessoEventos()[0]->getComplemento() != '') {
				echo " - " . $processo->getProcessoEventos()[0]->getComplemento();
			}
			echo "</td>";
			echo "<td>" . $processo->getOrgaoResponsavel()->getNome() . "</td>";
			echo "</tr>\n";

		}

		?>

		</tbody>
		</table>

		<div class="text-center"><?php // echo $pagination; ?></div>
		-->
	</div>
	</div>
</div>

</div>


<div class="accordion">
<?php
if (isset($processos_usuarios)) {
	foreach ($processos_usuarios as $usuario => $processos) {
		$id = "p_" . md5($usuario);
		$total = count($processos);

		$body_class_name = 'panel-collapse collapse ';
		$title_class_name = 'panel-title ';
		if ($this->nome == $usuario) {
			$body_class_name .= 'in';
		} else {
			$title_class_name .= 'collapsed';
		}
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="<?php echo $title_class_name; ?>" data-toggle="collapse" data-target="#<?php echo $id; ?>">Processos em análise por <?php echo $usuario; ?> (<?php echo $total; ?>)
		</h4>
	</div>
	<div class="<?php echo $body_class_name; ?>" id="<?php echo $id; ?>">
		<div class="panel-body">

		<?php if (count($processos) == 0) { ?>

		<div class="alert alert-info" role="alert"><i class="glyphicon glyphicon-info-sign" aria-hidden="true"></i> <span>Não foram encontrados processos.</span></div>

		<?php } else { ?>

		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th style="width: 160px">Objeto</th>
					<th style="width: 160px">Data</th>
					<th>Último evento</th>
					<th style="width: 170px">Órgão Responsável</th>
				</tr>
			</thead>
			<tbody>

		<?php

		foreach ($processos as $processo) {

			echo "<tr>";
			echo "<td><a href=\"" . base_url('processos/visualizar/' . $processo->getId()) . "\">";
			if ($processo->getNb()) {
				echo $this->inss->formataProtocolo($processo->getNb());
			} else if ($processo->getCtc()) {
				echo $this->inss->formataProtocolo($processo->getCtc());
			}
			echo "</a></td>";
			echo "<td>" . $processo->getCriado() . "</td>";
			echo "<td>" . $processo->getProcessoEventos()[0]->getEvento()->getNome();
			if ($processo->getProcessoEventos()[0]->getComplemento() != '') {
				echo " - " . $processo->getProcessoEventos()[0]->getComplemento();
			}
			echo "</td>";
			echo "<td>" . $processo->getOrgaoResponsavel()->getNome() . "</td>";
			echo "</tr>\n";

		}

		?>

		</tbody>
		</table>

		<?php } ?>

		</div><!-- //panel-body -->
	</div><!-- //panel-collapse -->
</div><!-- //panel -->

<?php
	} // foreach
} // if
?>
</div>
