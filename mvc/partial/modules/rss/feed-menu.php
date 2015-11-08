<?php
	setlocale (LC_TIME , 'fr_CA');
	$Application = \Core\Application::getInstance();
	$imagePath   = $Application->getConfigs()->get('Application.core.mvc.controller.assets.base.img');
	$limit       = (int) $this->getPartialData('limit');
	$rssFeed     = \Core\Util\Rss\Feed::getInstance(
		$Application->getConfigs()->get('Application.core.mvc.rss.feed.url'), ($limit > 0 ? $limit : 3)
	);
	
	if ($rssFeed->getCount() <= 0) return;
?>
<h4 class="widgettitle">
	<span>Dernières nouvelles</span>
</h4>
<div class="recent-posts-widget">
	<ul>
	<?php foreach ($rssFeed->getPosts() as $RssPost) { ?>
		<li>
			<div class="thumb">
				<a href="<?php echo $RssPost->getLink(); ?>" title="<?php echo $RssPost->getTitle(); ?>">
					<img src="<?php echo $RssPost->getImage(); ?>" title="<?php echo $RssPost->getTitle(); ?>" /></a>
			</div>
			<h4><a href="<?php echo $RssPost->getLink(); ?>" target="_blank"><?php echo $RssPost->getTitle(); ?></a></h4> <!-- **entry-meta-data - Starts** -->
			<div class="entry-meta-data">
				<p><span class="fa fa-calendar"></span> 
					<?php echo (strftime ('<span>%d</span> %b %Y', $RssPost->getTimeStamp())); ?></p>
				<p><a href="#"><span class="fa fa-comment"> </span> 0 </a></p>
			</div> <!-- **entry-meta-data - Ends** -->
		</li>
	<?php } ?>
	</ul>
</div>
