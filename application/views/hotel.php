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
							<h1 class="cursive-font"><?= $hotel->NomeHotel ?></h1>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<div class="gtco-section">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2 class="cursive-font primary-color">Sobre nós:</h2>
					<p class="text-justify wordwrap"><?= $hotel->DescricaoHotel ?></p>
				</div>
			</div>

			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-left gtco-heading">
					<p class="text-justify wordwrap"><b>Telefone:</b> <?= $hotel->Telefone ?></p>
					<p class="text-justify wordwrap"><b>Endereço:</b> <?= $hotel->Rua.", ".$hotel->Numero." ".$hotel->Complemento." - ".$hotel->Bairro." - ".$cidade." - ".$estado?></p>
				</div>
			</div>

			<!-- Fotos -->
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2 class="cursive-font primary-color">Fotos do Hotel</h2>
				</div>

				<?php if (!empty($fotos)) { ?>
				<?php foreach($fotos as $foto) { ?>
					<div class="col-lg-4 col-md-4 col-sm-6">
						<a href="<?= base_url('assets/uploads/'.$foto->Foto) ?>" class="fh5co-card-item image-popup nomargin-image">
							<figure>
								<img src="<?= base_url('assets/uploads/'.$foto->Foto) ?>" alt="Image" class="img-responsive">
							</figure>
						</a>
					</div>
					<?php } ?>
				<?php } else { ?>
					<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
						<h4>O hotel não cadastrou fotos ainda</h4>
					</div>
				<?php } ?>
			</div><!-- /row -->

			<!-- Quartos -->
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2 class="cursive-font primary-color">Quartos do Hotel</h2>
				</div>

				<?php if ($hotel->IDHotel == $this->session->hotel_id) :?>
					<div class="col-md-12 text-right">
						<a href="<?= base_url('novo-quarto') ?>" class="btn btn-primary">Adicionar Quarto</a>
					</div>
				<?php endif ?>

				<?php if (!empty($quartos)) { ?>
					<table class="table table-striped">
						<thead>
							<tr>
								<th class="col-md-3">Quarto</th>
								<th class="col-md-3">Valor</th>
								<th class="col-md-3">Tipo</th>
								<th class="col-md-1"></th>
								<?php  if ($hotel->IDHotel == $this->session->hotel_id) {?><th class="col-1"></th><?php } ?>
							</tr>
						</thead>
						<tbody>
							<?php foreach($quartos as $quarto) { ?>
								<tr>
									<td><?= $quarto->TituloQuarto ?></td>
									<td>R$ <?= number_format($quarto->Preco, 2, ",", ".") ?></td>
									<td><?php 
										switch ($quarto->TipoQuarto) {
											case 0:
												echo 'Standrad';
												break;
											case 1:
												echo 'Superior';
												break;
											case 2:
												echo 'Deluxe';
												break;
											
											default:
												echo 'Erro';
												break;
										}
									?></td>
									<td class="text-right"><a href="<?= base_url('quarto/'.$quarto->IDQuarto) ?>">Ver</a></td>
									<?php  if ($hotel->IDHotel == $this->session->hotel_id) {?>
										<td class="text-right"><a href="<?= base_url('editar-quarto/'.$quarto->IDQuarto) ?>">Editar</a></td>
									<?php } ?>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				<?php } else { ?>
					<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
						<h4>O hotel ainda não cadastrou nenhum quarto</h4>
					</div>
				<?php } ?>

			</div><!-- /row -->
		</div>
	</div>

<?php $this->load->view('includes/footer') ?>