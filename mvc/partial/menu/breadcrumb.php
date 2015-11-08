<?php
	$Application = \Core\Application::getInstance();
	$menuItems   = \Core\Hybernate\Menu\Menu::getCurrentMenuByPath($Application->translate(1, 2, 3), true);
	$additional  = $this->getPartialData('additionalItems');
	
	if (true === empty($menuItems)) {
		return;
	}
	
	$_count  = count($menuItems);
	$_last   = end($menuItems);
	$format  = '<a href="%s">%s</a><span class="default"> / </span>';
	$current = '<span class="current">%s</span>';
?>
<div class="breadcrumb-wrapper type6">
    <div class="container">
      <div class="main-title">
      	<h1><?php echo ((empty($_last['short_title']) === false ? ucfirst($_last['short_title']) : ucfirst($_last['label']))); ?></h1>
        <div class="breadcrumb"> 
        	<?php  
        		echo sprintf($format, $this->route(), '<i class="fa fa-home"></i> Acceuil');
        		reset($menuItems);
        		foreach ($menuItems as $index => $menu) {
        			$islast = (($index + 1) === $_count);
					$islast = (true === $islast && true === empty($additional));
					
        			echo (true === $islast ? 
        				sprintf($current, (empty($menu['short_title']) === false ? 
							ucfirst($menu['short_title']) : ucfirst($menu['label']))) : 
        				sprintf($format, $menu['url'], (empty($menu['short_title']) === false ? 
							ucfirst($menu['short_title']) : ucfirst($menu['label'])))
        			);
        		}
				
				if (empty($additional) === false) {
					$_count = count($additional);
					$_last  = end($additional);
					reset($additional);
					foreach ($additional as $name => $url) {
						$islast = (($index + 1) === $_count);
						echo (true === $islast ? 
							sprintf($current, $name) : 
							sprintf($format, $url, $name)
						);
					}
				}
        	?> 
        </div>
      </div>
    </div>
</div>
