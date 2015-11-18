
						<article class="video <?= $videoCount == 1 ? 'open' : null ?>">
							<div class="clearfix">
								<h3 class="pull-left"><a href="#" class="open-video"><i class="video-caret fa <?= $videoCount == 1 ? 'fa-caret-up' : 'fa-caret-down' ?>"></i> <?=$video->title ?></a></h3>
								<div class="pull-right thumbs">
									<a href="#" class="up"><i class="fa fa-lg fa-thumbs-up"></i></a>
									<a href="#" class="down"><i class="fa fa-lg fa-thumbs-down"></i></a>
								</div>
							</div>
							
							<div class="info clearfix">
								<div class="pull-left"><span>Ehdottaja:</span> <?=$video->suggestedBy ?></div>
								<div class="pull-right"><span>Pistemäärä:</span> <span class="score"><?=$video->getScore() ?></span></div>
							</div>
							<div class="video-wrapper <?= $videoCount == 1 ? null : 'hidden' ?>">
								<iframe width="560" height="315" src="//www.youtube.com/embed/<?=$video->url ?>" frameborder="0" allowfullscreen></iframe>
							</div>
						</article>