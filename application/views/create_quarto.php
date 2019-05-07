<?php $this->load->view('includes/head') ?>	
	<?php $this->load->view('includes/navbar') ?>
	
	<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(<?= base_url('assets/images/novo-quarto.jpg') ?>)">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-center">
					<div class="row row-mt-15em">
						<div class="col-md-12 mt-text animate-box" data-animate-effect="fadeInUp">
							<span class="intro-text-small">#PARTIU<span class="text-orange">FÉRIAS</span></span>
							<h1 class="cursive-font">Cadastro de Quarto!</h1>	
						</div>						
					</div>
				</div>
			</div>
		</div>
	</header>
	
	
	<div class="gtco-section">
		<div class="gtco-container">
			<div class="row text-center">
				<div class="col-md-12">
					<div class="col-md-12 animate-box">
						<h3>Cadastro de Quarto</h3>
						<form action="<?= base_url('Quartos/create') ?>" method="post" name="form_create_quarto" id="form_create_	quarto" class="text-left" enctype="multipart/form-data">

							<div class="form-row">
								<div class="col-md-6">
									<label for="titulo">Título<span style="color: red;">*</span></label>
									<input type="text" name="titulo" id="titulo" class="form-control" placeholder="Ex: Quarto High Confort!" maxlength="100" required>
								</div>

								<div class="col-md-3">
									<label for="valor" id="label_user">Preço R$/noite<span style="color: red;">*</span></label>
									<input type="number" name="valor" id="valor" step="0.01" class="form-control" required>
								</div>

								<!-- Infos -->
								<div class="col-md-3">
									<label for="tipo">Tipo<span style="color: red;">*</span></label>
									<select name="tipo" id="tipo" class="form-control" required="">
										<option value="">Selecione...</option>
										<option value="0">Standard</option>
										<option value="1">Superior</option>
										<option value="2">Deluxe</option>
									</select>
								</div>
							</div><!-- /row -->

							<!-- Descricao -->
							<div class="form-row">
								<div class="col-md-12">
									<label for="descricao">Descrição<span style="color: red;">*</span></label>
									<textarea name="descricao" id="descricao" class="form-control" rows="5" required placeholder="Escreva uma breve descrição do quarto" maxlength="400" minlength="70"></textarea>
									<small>No mínimo 70 caractéres</small>
								</div>
							</div>

							<!-- Fotos -->
							<div class="form-row">
								<div class="col-md-12" style="margin-top: 3vh">
									<label>Fotos</label>
								</div>
								<?php for ($i = 0; $i < 6; $i++) :?>
									<!-- Label and tag -->
									<label for="input_<?= $i ?>" class="col-md-2 text-center"><img src="<?= base_url('assets/images/add-image-placeholder.png') ?>" class="img-clicavel" id="tag_<?= $i ?>" width="100" height="100"></label>
									<input type="file" name="input_<?= $i ?>" id="input_<?= $i ?>" class="sr-only">
								<?php endfor; ?>
								<div class="col-md-12" style="margin-top: 3vh">
									<?php if (isset($erro)) : ?>
										<small class="text-danger">Erro no upload: São aceitos arquivos de até 2Mb com dimensões de no máximo 1920x1080 nos formatamos jpg, jpeg ou png.</small>
									<?php else : ?>
										<small>São aceitos arquivos de até 2Mb com dimensões de no máximo 1920x1920 nos formatamos jpg, jpeg ou png.</small>
									<?php endif; ?>
								</div>
							</div>

							<div class="form-row">
								<div class="col-md-12">
									<div class="form-group text-center">
										<input type="submit" value="Finalizar" class="btn btn-primary btn-cadastro">
									</div>
								</div>
							</div>

						</form>		
					</div>
				</div>
			</div>
		</div>
	</div>

<?php $this->load->view('includes/footer') ?>