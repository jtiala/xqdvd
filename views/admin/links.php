
					</div>
				</div>
				<div class="col-md-6">
					<div id="dvd-suggest" class="box">
						<h2>Linkit</h2>
						
						<form class="form-horizontal">

							<div class="form-group">
								<label for="publicUrl" class="col-sm-4 col-lg-3 control-label">Julkinen linkki</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="publicUrl" value="<?= $publicUrl ?>" disabled>
								</div>
								<div class="col-sm-1"><span class="label label-info" data-toggle="tooltip" data-placement="top" title="Jaa tämä linkki, mikäli haluat videoehdotuksia käyttäjiltä">?</span></div>
							</div>

							<div class="form-group">
								<label for="adminUrl" class="col-sm-4 col-lg-3 control-label">Ylläpitolinkki</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="adminUrl" value="<?= $adminUrl ?>" disabled>
								</div>
								<div class="col-sm-1"><span class="label label-info" data-toggle="tooltip" data-placement="top" title="Jaa tämä linkki, mikäli haluat jakaaylläpito-oikeudet">?</span></div>
							</div>
						</form>
					</div>