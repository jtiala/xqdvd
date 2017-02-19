
						<article class="video">
							<div class="clearfix">
								<h3 class="pull-left"><a href="#" class="open-video"><i class="video-caret fa fa-caret-down"></i> <?=$video->title ?></a></h3>
								<div class="pull-right thumbs">
									<a href="#" class="up"><i class="fa fa-lg fa-thumbs-up"></i></a>
									<a href="#" class="down"><i class="fa fa-lg fa-thumbs-down"></i></a>
								</div>
							</div>
							
							<div class="info clearfix">
								<div class="pull-left">
									<span>Linkki:</span> <a href="https://youtube.com/watch?v=<?=$video->url?>" target="_blank">https://youtube.com/watch?v=<?=$video->url ?></a><br>
									<span>Ehdotettu:</span> <?=$video->date ?>
								</div>
								<div class="pull-right text-right">
									<span>Pistemäärä:</span> <span class="score"><?=$video->getScore() ?></span><br>
									<span>Ehdottaja:</span> <?=$video->suggestedBy ?>
								</div>
							</div>
							<div class="video-wrapper hidden" data-video="<?=$video->url ?>">
							</div>
						</article>
