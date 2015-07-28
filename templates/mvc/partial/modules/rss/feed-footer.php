<?php
	setlocale (LC_TIME , 'fr_CA');
	$Application = \Core\Application::getInstance();
	$imagePath   = $Application->getConfigs()->get('Application.core.mvc.controller.assets.base.img');
	$rssFeed     = \Core\Util\Rss\Feed::getInstance(
		$Application->getConfigs()->get('Application.core.mvc.rss.feed.url'), 2
	);
	
	if ($rssFeed->getCount() <= 0) return;
?>
<div class="column dt-sc-one-third">
    <aside class="widget widget_popular_entries">
      <h3 class="widget-title">Dernières  <span class="wlast">Nouvelles</span><span class="small-line"> </span></h3>
      <div class="recent-property-widget">
        <ul>
	  <?php foreach ($rssFeed->getPosts() as $RssPost) { ?>
          <li> <a class="thumb" href="<?php echo $RssPost->getLink(); ?>" target="_blank">
		<img src="<?php echo $RssPost->getImage(); ?>" alt="<?php echo $RssPost->getTitle(); ?>" style="width:90px;"/></a>
            <h6><a href="<?php echo $RssPost->getLink(); ?>" target="_blank"><?php echo $RssPost->getTitle(); ?></a></h6>
            <div class="entry-meta">
              <p><span class="fa fa-calendar"></span><?php echo (strftime ('<span>%d</span> %b %Y', $RssPost->getTimeStamp())); ?></p>
	      <?php $author = explode('@', $RssPost->getAuthor()); ?>
              <p><span class="fa fa-user"></span><a href="<?php echo $RssPost->getLink(); ?>"><?php echo array_shift($author); ?></a></p>
            </div>
          </li>
	  <?php } ?>
        </ul>
      </div>
    </aside>
</div>
