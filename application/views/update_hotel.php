<?php $this->load->view('includes/head') ?>	
	<?php $this->load->view('includes/navbar') ?>
	
	<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(<?= base_url('assets/images/novo-hotel.jpg') ?>)">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-center">
					<div class="row row-mt-15em">
						<div class="col-md-12 mt-text animate-box" data-animate-effect="fadeInUp">
							<span class="intro-text-small">#PARTIU<span class="text-orange">FÉRIAS</span></span>
							<h1 class="cursive-font">Atualizar Perfil</h1>	
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
						<h3>Informações</h3>
						<form action="<?= base_url('Hoteis/update') ?>" method="post" name="form_cadastro" id="form_update_perfil" class="text-left" enctype="multipart/form-data">
							<!-- Id enviado por post -->
							<input type="hidden" name="hotel_id" id="hotel_id" value="<?= $hotel->IDHotel ?>">

							<div class="form-row">
								<div class="col-md-12">
									<label for="nome_hotel">Nome do Hotel<span style="color: red;">*</span></label>
									<input type="text" name="nome_hotel" id="nome_hotel" class="form-control" placeholder="Ex: Super Hotel!" maxlength="50" required value="<?= $hotel->NomeHotel ?>">
								</div>
							</div>

							<div class="form-row">
								<div class="col-md-3">
									<label for="cep">CEP<span style="color: red;">*</span></label>
									<input type="text" name="cep" id="cep" class="form-control" placeholder="Ex: 00000-000" maxlength="9" required value="<?= $hotel->CEP ?>">
								</div>

								<div class="col-md-3">
									<label for="estado">Estado<span style="color: red;">*</span></label>
									<select name="estado" id="estado" class="form-control" required onchange="buscaCidades(this.value)">
										<option value="">Selecione o estado...</option>
										<?php foreach($estados as $estado): ?>
											<option value="<?= $estado->IDEstado ?>" <?= ($hotel->IDEstado == $estado->IDEstado) ? 'selected':'' ?>><?= $estado->UF ?></option>
										<?php endforeach ?>
									</select>
								</div>

								<div class="col-md-3">
									<label for="bairro">Cidade<span style="color: red;">*</span></label>
									<select name="cidade" id="cidade" class="form-control" required>
										<option value="">Selecione a cidade...</option>
										<?php foreach($cidades as $cidade): ?>
											<option value="<?= $cidade->IDCidade ?>" <?= ($hotel->IDCidade == $cidade->IDCidade) ? 'selected':'' ?>><?= $cidade->NomeCidade ?></option>
										<?php endforeach ?>
									</select>
								</div>
								
								<div class="col-md-3">
									<label for="bairro">Bairro</label>
									<input type="text" name="bairro" id="bairro" class="form-control" placeholder="Ex: Bairro da Praia" maxlength="100" value="<?= $hotel->Bairro ?>">
								</div>
							</div>
							
							<div class="form-row">
								<div class="col-md-8 form-group">
									<label for="rua">Rua<span style="color: red;">*</span></label>
									<input type="text" name="rua" id="rua" class="form-control" placeholder="Ex: Av. Super Hotel" maxlength="200" required value="<?= $hotel->Rua ?>">
								</div>

								<div class="col-md-2 form-group">
									<label for="numero">Numero</label>
									<input type="text" name="numero" id="numero" class="form-control" placeholder="10" maxlength="10" value="<?= $hotel->Numero ?>">
								</div>

								<div class="col-md-2 form-group">
									<label for="complemento">Complemento</label>
									<input type="text" name="complemento" id="complemento" class="form-control" placeholder="50" maxlength="50" value="<?= $hotel->Complemento ?>">
								</div>
							</div>

							<div class="form-row">
								<div class="col-md-6">
									<label for="telefone">Telefone<span style="color: red;">*</span></label>
									<input type="text" name="telefone" id="telefone" class="form-control" placeholder="Ex: (00) 00000-0000" maxlength="15" value="<?= $hotel->Telefone ?>" required>
								</div>
								<div class="col-md-6">
									<label for="tipo">Estrelas<span style="color: red;">*</span></label>
									<input type="number" step="1" min="1" max="5" value="<?= $hotel->Estrelas ?>" name="estrelas" id="estrelas" class="form-control" required>
								</div>
							</div>

							<!-- Descricao -->
							<div class="form-row">
								<div class="col-md-12">
									<label for="descricao">Descrição</label>
									<textarea name="descricao" id="descricao" class="form-control" rows="10"><?= $hotel->DescricaoHotel ?></textarea>
								</div>
							</div>

							<!-- Logo e Capa -->
							<div class="form-row">
								<div class="col-md-6 text-center" style="margin-top: 3vh">
									<p>Logo</p>
									<?php if (empty($hotel->Logo)): ?>
										<label for="logo"><img src="<?= base_url('assets/images/no-image-placeholder.png') ?>" id="img_logo" class="img-clicavel img-responsive" width="256"></label>
									<?php else : ?>
										<label for="logo"><img src="<?= base_url('assets/uploads/'.$hotel->Logo) ?>" id="img_logo" class="img-clicavel img-responsive" width="256"></label>
									<?php endif; ?>
									<input type="file" name="logo" id="logo" class="sr-only">
								</div>
								<div class="col-md-6 text-center" style="margin-top: 3vh">
									<p>Foto de capa</p>
									<?php if (empty($hotel->FotoCapa)): ?>
										<label for="foto_capa"><img src="<?= base_url('assets/images/cover-photo-placeholder.png') ?>" id="img_foto_capa" class="img-clicavel img-responsive" width="256"></label>
									<?php else : ?>
										<label for="foto_capa"><img src="<?= base_url('assets/uploads/'.$hotel->FotoCapa) ?>" id="img_foto_capa" class="img-clicavel img-responsive" width="256"></label>
									<?php endif; ?>
									<input type="file" name="foto_capa" id="foto_capa" class="sr-only">
								</div>
							</div>

							<!-- Fotos -->
							<div class="form-row">
								<div class="col-md-12" style="margin-top: 3vh">
									<label>Fotos</label>
								</div>
								<!-- "Array" de "objetos" fotos -->
								<?php for ($i = 0; $i < 6; $i++) :?>
									<!-- Label e tag -->
									<label for="input_<?= $i ?>" class="col-md-2 text-center">
										<?php if (!empty($fotos[$i])): ?>
											<img src="<?= base_url('assets/uploads/'.$fotos[$i]->Foto) ?>" class="img-clicavel" id="tag_<?= $i ?>" width="100" height="100">
										<?php else: ?>
											<img src="<?= base_url('assets/images/add-image-placeholder.png') ?>" class="img-clicavel" id="tag_<?= $i ?>" width="100" height="100">
										<?php endif; ?>
									</label>
									<!-- Nome do arquivo -->
									<input type="hidden" name="arquivo_<?= $i ?>" id="arquivo_<?= $i ?>" value="<?= empty($fotos[$i]->Foto) ? '':$fotos[$i]->Foto ?>">
									<!-- Input -->
									<input type="file" name="input_<?= $i ?>" id="input_<?= $i ?>" class="sr-only">
								<?php endfor; ?>

								<div class="col-md-12" style="margin-top: 3vh">
									<?php if (isset($erro)) : ?>
										<small class="text-danger">Erro no upload: São aceitos arquivos de até 2Mb com dimensões de no máximo 1920x1920 nos formatamos jpg, jpeg ou png.</small>
									<?php else : ?>
										<small>São aceitos arquivos de até 2Mb com dimensões de no máximo 1920x1920 nos formatamos jpg, jpeg ou png.</small>
									<?php endif; ?>
								</div>
							</div>

							<div class="form-row">
								<div class="col-md-12">
									<div class="form-group text-center">
										<input type="submit" value="Salvar" class="btn btn-primary btn-cadastro">
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