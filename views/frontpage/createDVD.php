
					</div>
				</div>
				<div class="col-md-6">
					<div id="add-dvd" class="box">
						<h2>Aloita uusi DVD</h2>

						<?php
							if (! empty($errors)) {
								foreach ($errors as $error) {
									echo '<p class="alert alert-danger">' . $error . '</p>';
								}
							}
						?>
						
						<form class="form-horizontal" action="<?= SITE_URL ?>/create" method="post">

							<div class="form-group">
								<label for="title" class="col-sm-4 col-lg-3 control-label">DVD:n nimi</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="title" name="title" value="<?= empty($data['title']) ? null : $data['title']?>">
								</div>
								<div class="col-sm-1"><span class="label label-danger" data-toggle="tooltip" data-placement="top" title="Vaadittu kenttä">*</span></div>
							</div>

							<div class="form-group">
								<label for="author" class="col-sm-4 col-lg-3 control-label">Tekijä</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="author" name="author" value="<?= empty($data['author']) ? null : $data['author']?>">
								</div>
								<div class="col-sm-1"><span class="label label-danger" data-toggle="tooltip" data-placement="top" title="Vaadittu kenttä">*</span></div>
							</div>

							<div class="form-group">
								<label for="email" class="col-sm-4 col-lg-3 control-label">Tekijän email</label>
								<div class="col-sm-7">
									<input type="email" class="form-control" id="email" name="email" value="<?= empty($data['email']) ? null : $data['email']?>">
								</div>
								<div class="col-sm-1"><span class="label label-danger" data-toggle="tooltip" data-placement="top" title="Vaadittu kenttä">*</span>&nbsp;<span class="label label-info" data-toggle="tooltip" data-placement="top" title="Käyetään DVD:n admin-linkin lähetykseen">?</span></div>
							</div>

							<div class="form-group">
								<label for="publishDate" class="col-sm-4 col-lg-3 control-label">Julkaisupäivämäärä</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="publishDate" name="publishDate" value="<?= empty($data['publishDate']) ? null : $data['publishDate']?>">
								</div>
								<div class="col-sm-1 col-sm-offset-3"><span class="label label-info" data-toggle="tooltip" data-placement="top" title="Muodossa YYYY-MM-DD">?</span></div>
							</div>

							<div class="form-group">
								<label for="deadlineDate" class="col-sm-4 col-lg-3 control-label">Ehdotusten deadline</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="deadlineDate" name="deadlineDate" value="<?= empty($data['deadlineDate']) ? null : $data['deadlineDate']?>">
								</div>
								<div class="col-sm-1 col-sm-offset-3"><span class="label label-info" data-toggle="tooltip" data-placement="top" title="Muodossa YYYY-MM-DD">?</span></div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 col-lg-3 control-label">DVD:n tila</label>
								<div class="col-sm-7">
									<label class="radio-inline">
										<input type="radio" name="status" value="active" <?= empty($data['status']) || (! empty($data['status']) && $data['status'] == 'active') ? 'checked="checked"' : null ?>> Aktiivinen
									</label>
									<label class="radio-inline">
										<input type="radio" name="status" value="inactive" <?= ! empty($data['status']) && $data['status'] == 'inactive' ? 'checked="checked"' : null ?>> Epäaktiivinen
									</label>
								</div>
								<div class="col-sm-1"><span class="label label-info" data-toggle="tooltip" data-placement="top" title="Epäaktiiviseen DVD:hen pääsee käsiksi vain admin-linkillä">?</span></div>
							</div>

							<div class="form-group">
								<label for="showFrontpage" class="col-sm-4 col-lg-3 control-label">Näytä etusivulla</label>
								<div class="col-sm-7">
									<label class="checkbox-inline">
										<input type="checkbox" id="showFrontpage" name="showFrontpage" value="show" <?= ! empty($data['showFrontpage']) && $data['showFrontpage'] == 'show' ? 'checked="checked"' : null ?>>&nbsp;
									</label>
								</div>
							</div>
							
							<div class="form-group">
								<label for="description" class="col-sm-4 col-lg-3 control-label">Kuvaus</label>
								<div class="col-sm-7">
									<textarea class="form-control" rows="3" id="description" name="description"><?= empty($data['description']) ? null : $data['description']?></textarea>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-offset-4 col-lg-offset-3 col-sm-8">
									<button type="submit" class="btn btn-primary">Luo DVD</button>
								</div>
							</div>
						</form>
					</div>
				</div>