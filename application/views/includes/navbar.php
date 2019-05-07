<nav class="gtco-nav" role="navigation">
	<div class="gtco-container">
		
		<div class="row">
			<div class="col-sm-4 col-xs-12">
				<div id="gtco-logo"><a href="<?= base_url() ?>">QurtoHoteis <em>.</em></a></div>
			</div>
			<div class="col-xs-8 text-right menu-1">
				<!-- Navbar deslogada -->
				<?php if(!$this->session->login) { ?>
					<ul>
						<!-- <li><a href="<?= base_url() ?>">Home</a></li> -->
						<!-- <li><a href="<?= base_url('quartos') ?>">Quartos</a></li> -->
						<li><a href="<?= base_url('entrar') ?>">Login</a></li>
						<li class="btn-cta"><a href="<?= base_url('cadastrar') ?>"><span>Sou Hotel</span></a></li>
					</ul>
				<!-- Navbar logada -->
				<?php } else { ?>
				<ul>
					<li>Olá! <span class="text-white"><?= $this->session->user ?>&nbsp</span></li>
					<li class="has-dropdown">
						<a href="<?= base_url('hotel/'.$this->session->hotel_id) ?>">
	          	<?php if ($this->session->foto_hotel != NULL) { ?>
	          		<img src="<?= base_url('assets/uploads/'.$this->session->foto_hotel) ?>" width="30" height="30" class="rounded-circle">
	          	<?php } else { ?>
	          		<img src="<?= base_url('assets/images/no-image-placeholder.png') ?>" width="30" height="30" class="rounded-circle">
	          	<?php } ?>
						</a>
						<ul class="dropdown">
							<li><a href="<?= base_url() ?>">Home</a></li>
							<!-- <li><a href="<?= base_url('quartos') ?>">Quartos</a></li> -->
							<li><a href="<?= base_url('hotel/'.$this->session->hotel_id) ?>">Página do Hotel</a></li>
							<li><a href="<?= base_url('editar-perfil/'.$this->session->hotel_id) ?>">Editar Perfil</a></li>
							<li><a href="<?= base_url('sair') ?>">Sair</a></li>
						</ul>
					</li>
				</ul>
				<?php } ?>
			</div>
		</div>
		
	</div>
</nav>