<section class="comments section">
	<div class="comments-container" id="comments-container">
		<h2 class="section-title">59 Comments</h2>
		<?php inc('molecule','comment-form'); ?>
		<?php inc('molecule','tabs-newest-oldest'); ?>
		<div class="fyre-stream-content">
			<?php inc('molecule','single-comment'); ?>
			<?php inc('molecule','single-comment'); ?>
			<?php inc('molecule','single-comment'); ?>
			<?php inc('molecule','single-comment'); ?>
			<?php inc('molecule','single-comment'); ?>
		</div>
	</div>
	<?php inc('molecule','pagination') ?>
</section>