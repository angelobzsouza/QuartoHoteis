<?php $this->load->view('includes/head') ?>
	<?php $this->load->view('includes/navbar') ?>

	<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(<?= base_url('assets/images/background-general.jpg') ?>)" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-left">
					<div class="row row-mt-15em">
						<!-- Lado esquerdo do header -->
						<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
							<!-- <span class="intro-text-small">Reserve seu <a href="<?= base_url('quartos') ?>">Quarto</a></span> -->
							<h1 class="cursive-font">#PartiuFérias</h1>	
						</div><!-- Lado esquerdo do header -->
						<!-- Lado direito do header -->
						<div class="col-md-4 col-md-push-1 animate-box" data-animate-effect="fadeInRight">
							<div class="form-wrap">
								<div class="tab">		
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3 class="cursive-font">Reservar Quarto</h3>
											<form action="<?= base_url('filtra-quartos') ?>" method="post">
												<div class="row form-group">
													<div class="col-md-12">
														<label for="tipo_quarto">Tipo de Quarto</label>
														<select name="tipo_quarto" id="tipo_quarto" class="form-control">
															<option value="" class="text-black">Tipo</option>
															<option value="0" class="text-black">Standard</option>
															<option value="1" class="text-black">Superior</option>
															<option value="2" class="text-black">Deluxe</option>
														</select>
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														<label for="estado">Estado</label>
														<select name="estado" id="estado" class="form-control" onchange="buscaCidades(this.value)">
															<option value="" class="text-black">Estado</option>
															<?php foreach($estados as $estado): ?>
																<option value="<?= $estado->IDEstado ?>" class="text-black"><?= $estado->UF ?></option>
															<?php endforeach ?>
														</select>
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														<label for="cidade">Cidade</label>
														<select name="cidade" id="cidade" class="form-control">
															<option value="" class="text-black">Cidade</option>
														</select>
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														<input type="submit" name="submit" id="submit" class="btn btn-primary btn-block" value="Procurar">
													</div>
												</div>
											</form>	
										</div>
									</div>
								</div>
							</div>
						</div><!-- /Lado direito do header -->
					</div>
				</div>
			</div>
		</div>
	</header>
	
	<!-- Ultimas quartos -->
	<div class="gtco-section">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2 class="cursive-font primary-color">Últimos Quartos</h2>
					<p>Veja os últimos quartos anunciados no site</p>
				</div>
			</div>
			<div class="row">

				<?php foreach($ultimos_quartos as $quarto) { ?>
					<div class="col-lg-4 col-md-4 col-sm-6">
						<a href="<?= base_url('quarto/'.$quarto->IDQuarto) ?>" class="fh5co-card-item">
							<figure>
								<div class="overlay"><i class="ti-eye"></i></div>
								<?php if (empty($quarto->Thumb)): ?>
									<img src="<?= base_url('assets/images/house-placeholder.png') ?>" alt="Image" class="img-responsive">
								<?php else: ?>
									<img src="<?= base_url('assets/uploads/'.$quarto->Thumb) ?>" alt="Image" class="img-responsive">
								<?php endif; ?>
							</figure>
							<div class="fh5co-text">
								<h2><?= $quarto->TituloQuarto ?></h2>
								<p><?= substr($quarto->DescricaoQuarto, 0, 70)."..." ?>
								</p>
								<p><span class="price cursive-font">R$<?= number_format($quarto->Preco, 2, ",", ".") ?>/noite</span></p>
							</div>
						</a>
					</div>
				<?php } ?> 
				
			</div><!-- /row -->
		</div>
	</div>
	
	<!-- Nossos valores -->
	<div id="gtco-features">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading animate-box">
					<h2 class="cursive-font">Nossa Missão</h2>
					<p>Saiba um pouco mais sobre o que move o QuartoHoteis e o que buscamos trazer para nossos clientes e para o mundo.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 col-sm-6">
					<div class="feature-center animate-box" data-animate-effect="fadeIn">
						<span class="icon">
							<i class="ti-face-smile"></i>
						</span>
						<h3>Facilidade</h3>
						<p>Centralizar os hoteis em um só lugar, tornando a busca mais fácil e agradável através de um design intuitivo e minimalista</p>
					</div>
				</div>
				<div class="col-md-4 col-sm-6">
					<div class="feature-center animate-box" data-animate-effect="fadeIn">
						<span class="icon">
							<i class="ti-infinite"></i>
						</span>
						<h3>Respeito</h3>
						<p>Respeitar todas as diferenças, fazendo do mundo um lugar muito melhor para se viver e, principalmente, para se curtir as férias.</p>
					</div>
				</div>
				<div class="col-md-4 col-sm-6">
					<div class="feature-center animate-box" data-animate-effect="fadeIn">
						<span class="icon">
							<i class="ti-money"></i>
						</span>
						<h3>Sem Fins Lucrativos</h3>
						<p>Nosso projeto não possui fins lucrativos, visando apenas facilitar a vida de muitos brasileiros na hora de buscar por hoteis.</p>
					</div>
				</div>
				

			</div>
		</div>
	</div>

	<!-- Frase motivacional -->
	<div class="gtco-cover gtco-cover-sm" style="background-image: url(<?= base_url('assets/images/background-general.jpg') ?>); background-size: 100% 200%"  data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="gtco-container text-center">
			<div class="display-t">
				<div class="display-tc">
					<h1>&ldquo; Não tenho tempo pra mais nada, ser feliz me consome muito.!&rdquo;</h1>
					<p>&mdash; Clarice Lispector</p>
				</div>	
			</div>
		</div>
	</div>

	<!-- Fatos Engraçados -->
	<div id="gtco-counter" class="gtco-section">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading animate-box">
					<h2 class="cursive-font primary-color">Números</h2>
					<p>Veja em números nossas realizações até o dia de hoje</p>
				</div>
			</div>
			<div class="row">
				
				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-center">
						<span class="counter js-counter" data-from="0" data-to="<?= $qtde_hoteis ?>" data-speed="5000" data-refresh-interval="50">1</span>
						<span class="counter-label">Hoteis Cadastrados</span>

					</div>
				</div>
				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-center">
						<span class="counter js-counter" data-from="0" data-to="<?= $qtde_quartos ?>" data-speed="5000" data-refresh-interval="50">1</span>
						<span class="counter-label">Quartos Anunciados</span>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-center">
						<span class="counter js-counter" data-from="0" data-to="<?= $qtde_hoteis * 2 ?>" data-speed="5000" data-refresh-interval="50">1</span>
						<span class="counter-label">Dias de Descanso</span>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-center">
						<span class="counter js-counter" data-from="0" data-to="<?= $qtde_quartos * 5 ?>" data-speed="5000" data-refresh-interval="50">1</span>
						<span class="counter-label">Kilômetros Viajados</span>

					</div>
				</div>
					
			</div>
		</div>
	</div>

<?php $this->load->view('includes/footer') ?>