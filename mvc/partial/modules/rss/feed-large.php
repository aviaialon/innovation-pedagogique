<?php
	setlocale (LC_TIME , 'fr_CA');
	$Application = \Core\Application::getInstance();
	$imagePath   = $Application->getConfigs()->get('Application.core.mvc.controller.assets.base.img');
	$rssFeed     = \Core\Util\Rss\Feed::getInstance(
		$Application->getConfigs()->get('Application.core.mvc.rss.feed.url'),
		$Application->getConfigs()->get('Application.core.mvc.rss.feed.limit')
	);
	
	if ($rssFeed->getCount() <= 0) return;
?>
<!-- **Full-width-section - Starts** -->

<div class="full-width-section rssNewsPosts">
  <div class="dt-sc-margin50"></div>
  <div class="container">
    <h2 class="aligncenter">Dernières nouvelles</h2>
    <div class="dt-sc-hr-invisible-small"></div>
      <?php $delay = 200; ?>
      <?php foreach ($rssFeed->getPosts() as $RssPost) { ?>
      	<!-- **entry-post - Starts** -->
      	<div class="column dt-sc-one-third <?php echo ($RssPost->getId() === 1 ? 'first' : ''); ?> animate" data-animation="fadeInDown" data-delay="<?php echo $delay; ?>"> 
            <article class="entry-post">
                <div class="entry-meta">
                  <div class="date">
                    <p><?php echo strtoupper(strftime ('<span>%d</span> %b %Y', $RssPost->getTimeStamp())); ?></p>
                  </div>
                  <div class="post-comments"><a href="#"><span class="fa fa-comment"></span> 0</a> </div>
                </div>
                <div class="entry-post-content">
                  <div class="entry-thumb"> 
                  	<a href="<?php echo $RssPost->getLink(); ?>" target="_blank">
                    	<img src="<?php echo $RssPost->getImage(); ?>" alt="<?php echo $RssPost->getSummary(); ?>"/></a> 
                  </div>
                  <div class="entry-detail">
                    <h5><a href="<?php echo $RssPost->getLink(); ?>" target="_blank"><?php echo $RssPost->getTitle(); ?></a></h5>
                    <p><?php echo $RssPost->getLongSummary(); ?></p>
                    <a class="dt-sc-button small" href="<?php echo $RssPost->getLink(); ?>" target="_blank">
                    	Lire Plus <span class="fa fa-long-arrow-right"></span> </a> </div>
                </div>
            </article>
    	</div>
      	<!-- **entry-post - Ends** --> 
	<?php $delay = $delay + 350; ?>
      <? } ?>
    <div class="dt-sc-margin70"></div>
  </div>
</div>
<!-- **Full-width-section - Ends** --> 

<?php /*
<!-- **Full-width-section - Starts** -->

<div class="full-width-section">
  <div class="dt-sc-margin50"></div>
  <div class="container">
    <h2 class="aligncenter">dernières nouvelles</h2>
    <p class="middle-align">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical<br/>
      Latin literature from 45 BC, making it over 2000 years old. </p>
    <div class="dt-sc-hr-invisible-small"></div>
    <div class="column dt-sc-one-third first animate" data-animation="fadeInDown" data-delay="100"> 
      <!-- **entry-post - Starts** -->
      <article class="entry-post">
        <div class="entry-meta">
          <div class="date">
            <p> <span>28</span> FEB 2014 </p>
          </div>
          <div class="post-comments"> <a href="#"><span class="fa fa-comment"></span> 12</a> </div>
        </div>
        <div class="entry-post-content">
          <div class="entry-thumb"> <a href="blog-detail-with-right-sidebar.html"><img src="<?php echo $imagePath; ?>/blog-8.jpg" alt="image"/></a> </div>
          <div class="entry-detail">
            <h5><a href="blog-detail-with-right-sidebar.html"> Switzerland at its best </a></h5>
            <p> Occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. </p>
            <a class="dt-sc-button small" href="#">Read More <span class="fa fa-long-arrow-right"></span> </a> </div>
        </div>
      </article>
      <!-- **entry-post - Ends** --> 
    </div>
    <div class="column dt-sc-one-third animate" data-animation="fadeInUp" data-delay="100"> 
      <!-- **entry-post - Starts** -->
      <article class="entry-post">
        <div class="entry-meta">
          <div class="date">
            <p> <span>27</span> AUG 2014 </p>
          </div>
          <div class="post-comments"> <a href="#"><span class="fa fa-comment"></span> 15</a> </div>
        </div>
        <div class="entry-post-content">
          <div class="entry-thumb"> <a href="blog-detail-with-right-sidebar.html"><img src="<?php echo $imagePath; ?>/blog-6.jpg" alt="image"/></a> </div>
          <div class="entry-detail">
            <h5><a href="blog-detail-with-right-sidebar.html"> Get a little closer to the graphics. </a></h5>
            <p> Rokccaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum.. </p>
            <a class="dt-sc-button small" href="#">Read More <span class="fa fa-long-arrow-right"></span> </a> </div>
        </div>
      </article>
      <!-- **entry-post - Ends** --> 
    </div>
    <div class="column dt-sc-one-third animate" data-animation="fadeInDown" data-delay="100"> 
      <!-- **entry-post - Starts** -->
      <article class="entry-post">
        <div class="entry-meta">
          <div class="date">
            <p> <span>10</span> NOV 2014 </p>
          </div>
          <div class="post-comments"> <a href="blog-detail-with-right-sidebar.html"><span class="fa fa-comment"></span> 18</a> </div>
        </div>
        <div class="entry-post-content">
          <div class="entry-thumb"> <a href="blog-detail-with-right-sidebar.html"><img src="<?php echo $imagePath; ?>/blog-7.jpg" alt="image"/></a> </div>
          <div class="entry-detail">
            <h5><a href="#"> Get the App now 35% Discount </a></h5>
            <p> Eccaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. </p>
            <a class="dt-sc-button small" href="#">Read More <span class="fa fa-long-arrow-right"></span> </a> </div>
        </div>
      </article>
      <!-- **entry-post - Ends** --> 
    </div>
    <div class="dt-sc-margin70"></div>
  </div>
</div>
<!-- **Full-width-section - Ends** --> 

*/ ?>
