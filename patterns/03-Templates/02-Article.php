<?php inc('organism','header'); ?>
<div role="main">
	<div class="l-two-col">
		<div class="l-main">
			<article class="article">
				<header class="article-header">
					<h1>Article Headline Lorem ipsum dolor sit amet</h1>
					<?php inc('molecule','byline-author-time') ?>
				</header>
				<?php inc('organism','article-body') ?>
			</article><!--end .article-->
			<?php inc('molecule','social-share') ?>
			<?php inc('organism','comment-thread') ?>

		</div><!--end l-main-->

		<div class="l-sidebar">
			<?php inc('organism','related-posts') ?>
			<?php inc('organism','recent-tweets') ?>
		</div><!--end l-sidebar-->
	</div><!--end l-two-col-->	
</div><!--End role=main-->
<?php inc('organism','footer'); ?>