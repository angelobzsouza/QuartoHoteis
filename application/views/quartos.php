<?php $this->load->view('includes/head') ?>
	<?php $this->load->view('includes/navbar') ?>
	<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(<?= base_url('assets/images/background-general.jpg') ?>)" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-center">
					<div class="row row-mt-15em">
						<div class="col-md-12 mt-text animate-box" data-animate-effect="fadeInUp">
							<span class="intro-text-small">#PARTIU<span class="text-orange">FERIAS</span></span>
							<h1 class="cursive-font">Veja todos os quartos anuncaidos!</h1>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<div class="gtco-section">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 text-center gtco-heading">
					<h2 class="cursive-font primary-color">Quartos</h2>
					<!-- Filtros -->
						<form action="<?= base_url('filtra-quartos') ?>" method="post" id="filter_form">
							<div class="form-row">
								<div class="form-group col-md-2">
										<label for="tipo_rap">Estrelas</label>
										<input type="number" name="estrelas_hotel" id="estrelas_hotel" class="form-control" value="<?= $filtros['Estrelas'] ?>" placeholder="1 a 5">
								</div>
								<div class="form-group col-md-2">
										<label for="tipo_vaga">Tipo de Quarto</label>
										<select name="tipo_quarto" id="tipo_quarto" class="form-control">
											<option value="" class="text-black">Tipo</option>
											<option value="0" <?= $filtros['TipoQuarto'] === '0' ? 'selected':'' ?> class="text-black">Standard</option>
											<option value="1" <?= $filtros['TipoQuarto'] === '1' ? 'selected':'' ?> class="text-black">Superior</option>
											<option value="2" <?= $filtros['TipoQuarto'] === '2' ? 'selected':'' ?> class="text-black">Deluxe</option>
										</select>
								</div>
								<div class="form-group col-md-2">
										<label for="estado">Estado</label>
										<select name="estado" id="estado" class="form-control" onchange="buscaCidades(this.value)">
											<option value="" class="text-black">Estado</option>
												<?php foreach($estados as $estado): ?>
													<option value="<?= $estado->IDEstado ?>" <?= $filtros['IDEstado'] == $estado->IDEstado ? 'selected':'' ?> class="text-black"><?= $estado->UF ?></option>
												<?php endforeach ?>
										</select>
								</div>
								<div class="form-group col-md-2">
										<label for="cidade">Cidade</label>
										<select name="cidade" id="cidade" class="form-control">
											<option value="" class="text-black">Cidade</option>
												<?php foreach($cidades as $cidade): ?>
													<option value="<?= $cidade->IDCidade ?>" <?= $filtros['IDCidade'] == $cidade->IDCidade ? 'selected':'' ?> class="text-black"><?= $cidade->NomeCidade ?></option>
												<?php endforeach ?>
										</select>
								</div>
								<div class="form-group col-md-2">
										<label for="valor">Valor Mínimo R$</label>
										<input type="number" step="20" name="valor_minimo" id="valor_miximo" class="form-control" value="<?= $filtros['ValorMinimo'] ?>" placeholder="Valor" min="0">
								</div>
								<div class="form-group col-md-2">
										<label for="valor">Valor Máximo R$</label>
										<input type="number" step="20" name="valor_maximo" id="valor_maximo" class="form-control" value="<?= $filtros['ValorMaximo'] ?>" placeholder="Valor" min="0">
								</div>
								<div class="col-md-10">
									<input type="text" name="busca_texto" id="busca_texto" class="form-control" placeholder="Nome do quarto ou do hotel" value="<?= $filtros['BuscaTexto'] ?>">
								</div>
								<div class="form-group col-md-2 text-right">
										<input type="submit" name="submit" id="sumbit" class="btn btn-primary btn-block" value="Buscar">
								</div>
							</div>
						</form>	
				</div>
			</div>
			<div class="row">

				<?php if (count($quartos) == 0) :?>
					<div class="col-md-12 text-center">
						<h2 class="text-primary">Nenhum quarto encontrado!</h2>
					</div>
				<?php endif;?>

				<?php foreach($quartos as $quarto) : ?>
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
				<?php endforeach ?>

				<div class="col-md-12 text-center">
					<?= $this->pagination->create_links() ?>
				</div>

			</div><!-- /row -->
		</div>
	</div>
	
<?php $this->load->view('includes/footer') ?>