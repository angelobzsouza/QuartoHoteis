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
							<h1 class="cursive-font">Dashboard</h1>	
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
					<h2 class="cursive-font primary-color">Reservas nos últimos 12 mêses</h2>
				</div>
				<div class="col-md-10 col-md-offset-1 text-center">
					<canvas id="reservas_mes" width="300" height="200"></canvas>
					<script type="text/javascript">let reservas = <?= json_encode($reservas) ?></script>
				</div>
			</div>

		</div>
	</div>

<?php $this->load->view('includes/footer') ?>