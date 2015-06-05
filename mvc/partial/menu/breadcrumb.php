<?php
	$Application = \Core\Application::getInstance();
	$menuItems   = \Core\Hybernate\Menu\Menu::getCurrentMenuByPath($Application->translate(2, 1, 3), true);
	
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
        <h1><?php echo ucwords($_last['label']); ?></h1>
        <div class="breadcrumb"> 
        	<?php  
        		echo sprintf($format, $this->route('index', 'index'), 'Acceuil');
        		reset($menuItems);
        		foreach ($menuItems as $index => $menu) {
        			$islast = (($index + 1) === $_count);
        			echo (true === $islast ? 
        				sprintf($current, ucwords($menu['label'])) : 
        				sprintf($format, $menu['url'], ucwords($menu['label']))
        			);
        		}
        	?> 
        </div>
      </div>
    </div>
</div>