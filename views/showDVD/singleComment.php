
						<div class="comment">
							<blockquote>
								<p><?= $comment->comment ?></p>
								<footer><?= $comment->name ?>, <?= date('d.m.Y', strtotime($comment->date)) ?></footer>
							</blockquote>
						</div>