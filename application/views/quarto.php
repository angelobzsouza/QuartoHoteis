<?php $this->load->view('includes/head') ?>
	<?php $this->load->view('includes/navbar') ?>

	<!-- ID do Quarto -->
	<input type="hidden" name="quarto_id" id="quarto_id" value="<?= $quarto->IDQuarto ?>">

	<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(<?= base_url('assets/images/background-general-2.jpg') ?>)" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-center">
					<div class="row row-mt-15em">
						<div class="col-md-12 mt-text animate-box" data-animate-effect="fadeInUp">
	          	<?php if ($hotel->Logo != NULL) { ?>
								<a href="<?= base_url('Hotel/'.$hotel->IDHotel) ?>"><img src="<?= base_url('assets/uploads/'.$hotel->Logo) ?>" class="profile-image-header"></a>
	          	<?php } else { ?>
								<a href="<?= base_url('hotel/'.$hotel->IDHotel) ?>"><img src="<?= base_url('assets/images/no-image-placeholder.png') ?>" class="profile-image-header"></a>
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
					<h2 class="cursive-font primary-color"><?= $quarto->TituloQuarto ?></h2>
					<p class="text-left"><b>Preço: R$</b><?= number_format($quarto->Preco, 2, ",", ".") ?>/noite</p>
					<p class="text-left"><b>Tipo:</b> <?php
						switch ($quarto->TipoQuarto) {
							case 0:
								echo "Standard";
							break;
							
							case 1:
								echo "Superior";
							break;

							case 2:
								echo "Deluxe";
							break;

							default:
								echo 'Erro';
								break;
						}
					?></p>
					<p class="text-left"><b>Cadastrado em:</b> <?php $data = date_create($quarto->SalvoEm); echo date_format($data,"d/m/Y"); ?></p>
					<p class="text-left"><b>Hotel:</b> <a href="<?= base_url('hotel/'.$hotel->IDHotel) ?>"><?= $hotel->NomeHotel ?></a></p>
					<p class="text-left text-justify wordwrap"><b>Sobre:</b> <?= $quarto->DescricaoQuarto ?></p>

				</div>
			</div>

			<!-- Fotos do quarto -->
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2 class="cursive-font primary-color">Fotos do Quarto</h2>
				</div>

				<?php if (empty($fotos)): ?>
					<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
						<h5>Não foram cadastradas fotos desse quarto.</h5>
					</div>
				<?php endif ?>

				<?php foreach($fotos as $foto) : ?>
				<div class="col-lg-4 col-md-4 col-sm-6">
					<a href="<?= base_url('assets/uploads/'.$foto->Foto) ?>" class="fh5co-card-item image-popup nomargin-image">
						<figure>
							<img src="<?= base_url('assets/uploads/'.$foto->Foto) ?>" alt="Image" class="img-responsive">
						</figure>
					</a>
				</div>
				<?php endforeach ?>

			</div>

			<!-- Reserva do quarto -->
			<div class="row">
				<div class="col-md-12 text-center">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_reserva">
					  Reservar Quarto
					</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal de reserva de quartos -->
	<div class="modal fade" id="modal_reserva" tabindex="-1" role="dialog" aria-labelledby="reservaModal" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Reservar Quarto</h5>
	      </div>
	      <div class="modal-body">
	        <div class="container-fluid">
	        	<!-- Entrada -->
	        	<div class="row">
	        		<div class="col-md-12">
	        			<span>Entrada</span>
	        		</div>
	        	</div>
	        	<div class="row mb-1">
	        		<div class="col-lg-6">
	        			<input type="date" name="data_entrada" id="data_entrada" class="form-control">
	        		</div>
	        		<div class="col-lg-6">
	        			<input type="text" name="hora_entrada" id="hora_entrada" class="form-control" placeholder="00:00">
	        		</div>
	        	</div>
	        	<!-- Saida -->
	        	<div class="row">
	        		<div class="col-md-12">
	        			<span>Saída</span>
	        		</div>
	        	</div>
	        	<div class="row mb-1">
	        		<div class="col-md-6">
	        			<input type="date" name="data_saida" id="data_saida" class="form-control">
	        		</div>
	        		<div class="col-md-6">
	        			<input type="text" name="hora_saida" id="hora_saida" class="form-control" placeholder="00:00">
	        		</div>
	        	</div>
	        	<!-- Nome e email -->
	        	<div class="row">
	        		<div class="col-md-12">
	        			<span>Informações Pessoais</span>
	        		</div>
	        	</div>
	        	<div class="row mb-1">
	        		<div class="col-md-6">
	        			<input type="text" name="nome_reserva" id="nome_reserva" class="form-control" placeholder="Nome Completo">
	        		</div>
	        		<div class="col-md-6">
	        			<input type="email" name="email_reserva" id="email_reserva" class="form-control" placeholder="Email" maxlength="255">
	        		</div>
	        	</div>
	        	<!-- Quantidade de pessoas -->
	        	<div class="row">
	        		<div class="col-md-12">
	        			<span>Quantidade de Pessoas</span>
	        		</div>
	        	</div>
	        	<div class="row">
	        		<div class="col-md-12">
	        			<input type="number" name="quantidade_pessoas" id="quantidade_pessoas" class="form-control" min="0">
	        		</div>
	        	</div>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        <button type="button" class="btn btn-primary" onclick="reserva()">Reservar</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal de reserva de quartos -->
	<div class="modal fade" id="modal_confirmacao" tabindex="-1" role="dialog" aria-labelledby="confirmacaoModal" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Reserva Finalizada</h5>
	      </div>
	      <div class="modal-body container-fluid">
	      	<div class="row">
	      		<div class="col-md-12 text-center">
	      			<h2 class="text-info">Sua reserva foi realizada com sucesso, obrigado pela preferência!</h2>
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
	      </div>
	    </div>
	  </div>
	</div>

<?php $this->load->view('includes/footer') ?>