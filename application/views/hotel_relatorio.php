<?php $this->load->view('includes/head') ?>
	<?php $this->load->view('includes/navbar') ?>

	<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(<?= base_url('assets/uploads/'.$hotel->FotoCapa) ?>)" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-center">
					<div class="row row-mt-15em">
						<div class="col-md-12 mt-text animate-box" data-animate-effect="fadeInUp">
	          	<?php if ($hotel->Logo != NULL) { ?>
								<img src="<?= base_url('assets/uploads/'.$hotel->Logo) ?>" class="profile-image-header">
	          	<?php } else { ?>
								<img src="<?= base_url('assets/images/no-image-placeholder.png') ?>" class="profile-image-header">
	          	<?php } ?>
							<h1 class="cursive-font">Relatório</h1>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<div class="gtco-section">
		<div class="gtco-container">
			<div class="row">

				<!-- Rendimentos totais -->
				<div class="col-md-12 text-center gtco-heading" style="margin-bottom: 0px">
					<h3 class="cursive-font primary-color">Rendimentos Totais nos Últimos 12 Mêses</h3>
				</div>
				<table class="table table-primary table-bordered table-striped">
					<thead>
						<tr>
							<th>Rendimentos</th>
							<?php foreach($rendimentos_quartos as $data): ?>
								<th><?= $data->data ?></th>
							<?php endforeach; ?>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>R$</td>
							<?php foreach($rendimentos_totais as $rendimentos): ?>
								<td><?= number_format($rendimentos, 2, ',', '.'); ?></td>
							<?php endforeach; ?>
						</tr>
					</tbody>
				</table>

				<!-- Rendimentos por quarto -->
				<div class="col-md-12 text-center gtco-heading" style="margin-top: 50px; margin-bottom: 0px">
					<h3 class="cursive-font primary-color">Rendimentos por Tipo de Quarto nos Últimos 12 Mêses</h3>
				</div>
				<table class="table table-primary table-bordered table-striped">
					<thead>
						<tr>
							<th>Tipo</th>
							<?php foreach($rendimentos_quartos as $data): ?>
								<th><?= $data->data ?></th>
							<?php endforeach; ?>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Standard R$</td>
							<?php foreach($rendimentos_quartos as $rendimentos): ?>
								<td><?= number_format($rendimentos->standard, 2, ',', '.'); ?></td>
							<?php endforeach; ?>
						</tr>
						<tr>
							<td>Superior R$</td>
							<?php foreach($rendimentos_quartos as $rendimentos): ?>
								<td><?= number_format($rendimentos->superior, 2, ',', '.'); ?></td>
							<?php endforeach; ?>
						</tr>
						<tr>
							<td>Deluxe R$</td>
							<?php foreach($rendimentos_quartos as $rendimentos): ?>
								<td><?= number_format($rendimentos->deluxe, 2, ',', '.'); ?></td>
							<?php endforeach; ?>
						</tr>
					</tbody>
				</table>

				<!-- Taxa de ocupação -->
				<div class="col-md-12 text-center gtco-heading" style="margin-top: 50px; margin-bottom: 0px">
					<h3 class="cursive-font primary-color">Taxa de ocupação dos quartos nos últimos 365 dias</h3>
				</div>
				<table class="table table-primary table-bordered table-striped" id="tabela_ocupacao_por_quarto">
					<thead>
						<tr>
							<th>Quarto</th>
							<th>Dias Ocupados</th>
							<th>Dias Livres</th>
							<th>Taxa de Ocupação</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($quartos as $quarto): ?>
							<tr>
								<td><?= $quarto->TituloQuarto ?></td>
								<td><?= $quarto->occupation->dias_reservados ?></td>
								<td><?= $quarto->occupation->dias_livres ?></td>
								<td><?= number_format($quarto->occupation->porcentagem_ocupacao, 2, ',', '.') ?>%</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>

			</div>
		</div>
	</div>

<?php $this->load->view('includes/footer') ?>