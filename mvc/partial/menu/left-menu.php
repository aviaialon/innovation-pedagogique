<?php 
	$Application = \Core\Application::getInstance();
	$activeMenu  = \Core\Hybernate\Menu\Menu::getActiveMenu($Application->translate(2, 1, 3));
	$menuItems   = $activeMenu->getChildren();
	$linkFormat  = '<li><a href="%s">%s</a></li>';
	
	if (empty($menuItems) === true && $activeMenu->getParent_Id() > 0) {
		$menuItems = \Core\Hybernate\Menu\Menu::getInstance($activeMenu->getParent_Id())->getChildren();
	}
?>
<section id="secondary-left" class="secondary-sidebar secondary-has-left-sidebar grey">
    <?php if (empty($menuItems) === false) { ?>
    <aside class="widget widget_categories">
      <h4 class="widgettitle">Liens Intéressants</h4>
      <ul>
      	<?php 
      		foreach ($menuItems as $menu) {
      			echo sprintf($linkFormat, $menu['url'], ucwords($menu['title']));
      		}
      	?>
      </ul>
    </aside>
    <?php } ?>
    <aside class="widget widget_recent_entries" id="my_recent_posts-3">
      <h4 class="widgettitle"><span>Recent Posts</span></h4>
      <div class="recent-posts-widget">
        <ul>
          <li>
            <div class="thumb"> <a href="#" title=""> <img src="http://www.placehold.it/85x85&amp;text=Blog" alt="image" title=""></a> </div>
            <h4><a href="#">Holy Motors - A review of best old machines</a></h4>
            <!-- **entry-meta-data - Starts** -->
            <div class="entry-meta-data">
              <p><span class="fa fa-calendar"> </span> 04 Jan 2014 </p>
              <p><a href="#"><span class="fa fa-comment"> </span> 16 </a></p>
            </div>
            <!-- **entry-meta-data - Ends** --> 
          </li>
          <li>
            <div class="thumb"> <a href="#" title=""> <img src="http://www.placehold.it/85x85&amp;text=Blog" alt="image" title=""></a> </div>
            <h4><a href="#">Concept based theme with various features</a></h4>
            <!-- **entry-meta-data - Starts** -->
            <div class="entry-meta-data">
              <p><span class="fa fa-calendar"> </span> 03 Aug 2014 </p>
              <p><a href="#"><span class="fa fa-comment"> </span> 20 </a></p>
            </div>
            <!-- **entry-meta-data - Ends** --> 
          </li>
          <li>
            <div class="thumb"> <a href="#" title=""> <img src="http://www.placehold.it/85x85&amp;text=Blog" alt="image" title=""></a> </div>
            <h4><a href="#">Colors inspired from Nature </a></h4>
            <!-- **entry-meta-data - Starts** -->
            <div class="entry-meta-data">
              <p><span class="fa fa-calendar"> </span> 15 Sep 2014 </p>
              <p><a href="#"><span class="fa fa-comment"> </span> 24 </a></p>
            </div>
            <!-- **entry-meta-data - Ends** --> 
          </li>
        </ul>
      </div>
    </aside>
    <aside class="widget widget_text">
      <h4 class="widgettitle">Special Features</h4>
      <div class="textwidget"> 
        <!-- **dt-sc-toggle-frame-set - Starts** -->
        <div class="dt-sc-toggle-frame-set">
          <h5 class="dt-sc-toggle-accordion active"> <a href="#">Various Options &amp; Features</a></h5>
          <div class="dt-sc-toggle-content" style="display: block;">
            <div class="block"> Maecenas nec odio et ante tincidunt  al say tempus. Donec vitae sapien ut libero vene natis faucibus. Nullam quis ante.vitae sapien ut libero vene natis faucibus. </div>
          </div>
          <h5 class="dt-sc-toggle-accordion"> <a href="#">Exclusive Documentation</a></h5>
          <div class="dt-sc-toggle-content">
            <div class="block"> Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC. </div>
          </div>
          <h5 class="dt-sc-toggle-accordion"> <a href="#">Easy Customization</a></h5>
          <div class="dt-sc-toggle-content">
            <div class="block"> Maecenas nec odio et ante tincidunt  al say tempus. Donec vitae sapien ut libero vene natis faucibus. Nullam quis ante.vitae sapien ut libero vene natis faucibus. </div>
          </div>
        </div>
        <!-- **dt-sc-toggle-frame-set - Ends** --> 
      </div>
    </aside>
    <aside class="widget widget_tag_cloud">
      <h4 class="widgettitle">Tag</h4>
      <div class="tagcloud"> <a href="#">webdesign </a> <a href="#">html</a> <a href="#">woo com</a> <a href="#">blog</a> <a href="#">about</a> <a href="#">news</a> <a href="#">photography </a> <a href="#">tech</a> <a href="#">creative</a> <a href="#">photoshop</a> <a href="#">responsive</a> </div>
    </aside>
    <aside class="widget tweetbox">
      <h4 class="widgettitle">Latest Tweets</h4>
      <div class="tweet_list">
        <p class="loading">loading tweets...</p>
      </div>
    </aside>
  </section>