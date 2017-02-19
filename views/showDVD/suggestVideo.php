
					</div>
				</div>
				<div class="col-md-6">
					<div id="dvd-suggest" class="box">
						<h2>Ehdota videota</h2>
						
						<?php
							if (! empty($errors)) {
								foreach ($errors as $error) {
									echo '<p class="alert alert-danger">' . $error . '</p>';
								}
							}
						?>
						
						<form class="form-horizontal" action="<?= SITE_URL . '/' . $URL[0] . '/' . urlencode($URL[1]) ?>/suggest" method="post">

							<div class="form-group">
								<label for="suggestedBy" class="col-sm-4 col-xs-12 control-label">Ehdottaja</label>
								<div class="col-sm-6 col-xs-10">
									<input type="text" class="form-control" id="suggestedBy" name="suggestedBy" value="<?= empty($data['suggestedBy']) ? null : $data['suggestedBy']?>">
								</div>
								<div class="col-xs-2"><span class="label label-danger" data-toggle="tooltip" data-placement="top" title="Vaadittu kenttä">*</span></div>
							</div>
							
							<div class="form-group">
								<label for="title" class="col-sm-4 col-xs-12 control-label">Videon nimi</label>
								<div class="col-sm-6 col-xs-10">
									<input type="text" class="form-control" id="title" name="title" value="<?= empty($data['title']) ? null : $data['title']?>">
								</div>
								<div class="col-xs-2"><span class="label label-danger" data-toggle="tooltip" data-placement="top" title="Vaadittu kenttä">*</span></div>
							</div>
							<div class="form-group">
								<label for="url" class="col-sm-4 col-xs-12 control-label">Videon URL</label>
								<div class="col-sm-6 col-xs-10">
									<input type="text" class="form-control" id="url" name="url" value="<?= empty($data['url']) ? null : $data['url']?>">
								</div>
								<div class="col-xs-2"><span class="label label-danger" data-toggle="tooltip" data-placement="top" title="Vaadittu kenttä">*</span>&nbsp;<span class="label label-info" data-toggle="tooltip" data-placement="top" title="Linkki videon YouTube-sivulle">?</span></div>
							</div>
							
							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-8">
									<button type="submit" class="btn btn-primary">Ehdota</button>
								</div>
							</div>
						</form>
					</div>
