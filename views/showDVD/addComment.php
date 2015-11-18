					
					<div id="comments" class="box">
						<h2>Kommentit</h2>

						<?php
							if (! empty($commentErrors)) {
								foreach ($commentErrors as $error) {
									echo '<p class="alert alert-danger">' . $error . '</p>';
								}
							}
						?>
						
						<form class="form-horizontal" action="<?= SITE_URL . '/' . $URL[0] . '/' . urlencode($URL[1]) ?>/comment" method="post">

							<div class="form-group">
								<label for="name" class="col-sm-4 col-lg-3 control-label">Nimi</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="name" name="name" value="<?= empty($data['name']) ? null : $data['name']?>">
								</div>
								<div class="col-sm-1"><span class="label label-danger" data-toggle="tooltip" data-placement="top" title="Vaadittu kenttä">*</span></div>
							</div>
							
							<div class="form-group">
								<label for="comment" class="col-sm-4 col-lg-3 control-label">Kommentti</label>
								<div class="col-sm-7">
									<textarea class="form-control" rows="3" id="comment" name="comment"><?= empty($data['comment']) ? null : $data['comment']?></textarea>
								</div>
								<div class="col-sm-1"><span class="label label-danger" data-toggle="tooltip" data-placement="top" title="Vaadittu kenttä">*</span></div>
							</div>

							<div class="form-group">
								<div class="col-sm-offset-4 col-lg-offset-3 col-sm-8">
									<button type="submit" class="btn btn-primary">Kommentoi</button>
								</div>
							</div>
						</form>