
						<a href="<?= SITE_URL . '/' . $dvd->id . '/' . $dvd->publicUrl ?>">
							<article class="dvd">
								<div class="info">
									<h3><?= $dvd->title ?></h3>

									<table class="table">
										<tbody>
											<tr>
												<th>Tekijä</th>
												<td><?= $dvd->author ?></td>
												<th>Videoita</th>
												<td><?= $dvd->getNumVideos() ?></td>
											</tr>
											<tr>
												<th>Julkaisu</th>
												<td><?= empty($dvd->publishDate) ? '-' : date('d.m.Y', strtotime($dvd->publishDate)) ?></td>
												<th>Ehdotusten deadline</th>
												<td><?= empty($dvd->deadlineDate) ? '-' : date('d.m.Y', strtotime($dvd->deadlineDate)) ?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</article>
						</a>