
				<div class="col-md-6">
					<div id="dvd-info" class="box">
						<article class="dvd">
							<h3><?= $currentDVD->title ?></h3>
							<div class="info">

								<table class="table">
									<tbody>
										<tr>
											<th>Tekijä</th>
											<td><?= $currentDVD->author ?></td>
											<th>Videoita</th>
											<td><?= $currentDVD->getNumVideos() ?></td>
										</tr>
										<tr>
											<th>Julkaisu</th>
											<td><?= empty($currentDVD->publishDate) ? '-' : date('d.m.Y', strtotime($currentDVD->publishDate)) ?></td>
											<th>Ehdotusten deadline</th>
											<td><?= empty($currentDVD->deadlineDate) ? '-' : date('d.m.Y', strtotime($currentDVD->deadlineDate)) ?></td>
										</tr>
									</tbody>
								</table>
							</div>
						</article>
					</div>
					<div id="video-list" class="box">
						<h2>Videot</h2>