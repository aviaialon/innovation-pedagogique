<?php
	$Application = \Core\Application::getInstance();
	$menuItems   = \Core\Hybernate\Menu\Menu::getCurrentMenuByPath($Application->translate(1, 2, 3), true);

	if (true === empty($menuItems)) {
		return;
	}
	
	$format  = '<a href="%s">%s</a><span class="default"> / </span>';
	$current = '<span class="current">%s</span>';
	$_count  = count($menuItems);
	$_last   = end($menuItems);
?>
<div class="breadcrumb-wrapper type6">
    <div class="container">
      <div class="main-title">
      	<h1><?php echo ((empty($_last['short_title']) === false ? ucwords($_last['short_title']) : ucwords($_last['label']))); ?></h1>
        <div class="breadcrumb"> 
        	<?php  
        		echo sprintf($format, $this->route(), '<i class="fa fa-home"></i> Acceuil');
        		reset($menuItems);
        		foreach ($menuItems as $index => $menu) {
        			$islast = (($index + 1) === $_count);
        			echo (true === $islast ? 
        				sprintf($current, (empty($menu['short_title']) === false ? 
							ucwords($menu['short_title']) : ucwords($menu['label']))) : 
        				sprintf($format, $menu['url'], (empty($menu['short_title']) === false ? 
							ucwords($menu['short_title']) : ucwords($menu['label'])))
        			);
        		}
        	?> 
        </div>
      </div>
    </div>
</div>