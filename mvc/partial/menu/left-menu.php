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
      <?php $this->renderPartial('modules::rss::feed-menu', array()); ?>
    </aside>
  </section>