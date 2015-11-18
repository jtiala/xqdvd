
						<article class="video">
							<div class="clearfix">
								<h3 class="pull-left"><a href="#" class="open-video"><i class="video-caret fa fa-caret-down"></i> <?=$video->title ?></a></h3>
								<div class="pull-right">
									<a href="<?= SITE_URL . '/' . $dvd . '/' . $url . '/' . $adminHash. '/deleteVideo?id=' . $video->id ?>"><i class="fa fa-lg fa-trash-o"></i></a>
								</div>
							</div>
							
							<div class="info clearfix">
								<div class="pull-left"><span>Ehdottaja:</span> <?=$video->suggestedBy ?></div>
								<div class="pull-right"><span>Pistemäärä:</span> <span class="score"><?=$video->getScore() ?></span></div>
							</div>
							<div class="video-wrapper hidden">
								<iframe width="560" height="315" src="//www.youtube.com/embed/<?=$video->url ?>" frameborder="0" allowfullscreen></iframe>
							</div>
						</article>