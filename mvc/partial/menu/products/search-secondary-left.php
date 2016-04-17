<?php
	$Application  = \Core\Application::getInstance();
	$categoryTree = $this->getPartialData('categoryTree');
	$category     = (int) $Application->getRequestDispatcher()->getRequestParam('category', 0);
?>
<form method="get" name="filters" class="filters" action="<?php echo($Application->getRequestDispatcher()->route('projects')); ?>">
    <input type="hidden" name="q" id="q" class="q" value="<?php echo $Application->getRequestDispatcher()->getRequestParam('q', ''); ?>" />
    <input type="hidden" name="category" id="category" class="category" value="<?php echo (int) $Application->getRequestDispatcher()->getRequestParam('category', ''); ?>" />
    <input type="hidden" name="min-age" id="min-age" class="min-age" value="<?php echo (int) $Application->getRequestDispatcher()->getRequestParam('min-age', 0); ?>" />
    <input type="hidden" name="max-age" id="max-age" class="max-age" value="<?php echo (int) $Application->getRequestDispatcher()->getRequestParam('max-age', 0); ?>" />
    <input type="hidden" name="year" id="year" class="year" value="<?php echo (int) $Application->getRequestDispatcher()->getRequestParam('year', 0); ?>" />
</form>
<section id="secondary-left" class="secondary-sidebar secondary-has-left-sidebar">
    <aside class="widget widget_product_categories">
        <h3><?php echo ($Application->translate('Categories', 'Catégories')); ?></h3>
        <ul class="categorySelection">
        	<li class="category-list-item"> 
            	<a class="<?php echo(empty($category) === true ? 'dt-sc-toggle active' : ''); ?>" 
                	href="<?php echo ($Application->getRequestDispatcher()->route('projects')); ?>"><?php echo($Application->translate('All Projects', 'Tous Les Projets')); ?></a>
            </li>
        	<?php foreach ($categoryTree as $parentCategoryId => $parentCategory) { ?>
            	<li class="category-list-item"> 
                	<a class="dt-sc-toggle" href="#"><?php echo($Application->translate($parentCategory['name_en'], $parentCategory['name_fr'])); ?> 
					<?php if (empty($parentCategory['children']) === false) { ?>
                        <span class="fa fa-plus-square"></span> <span class="fa fa-minus-square "></span>
                    <?php } ?></a> 
                    <?php if (empty($parentCategory['children']) === false) { ?>
                        <ul class="dt-sc-toggle-content">
                        	<?php foreach ($parentCategory['children'] as $subCatData) { ?>
                            	<?php $_class = ((int) $subCatData['id'] === $category) ? 'active' : ''; ?>
                                <li><a class="<?php echo $_class; ?>" href="<?php echo $this->route('projects', null, array('category' => $subCatData['id']));?>">
                                            <?php echo($Application->translate($subCatData['name_en'], $subCatData['name_fr'])); ?> </a></li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </li>
            <?php } ?>
        </ul>	
    </aside>	 
    
    <aside class="widget widget_price_filter">
        <div class="price_slider_amount">
            <div class="price_label">
                <span class="from" id="age-filter"></span>
            </div>
        </div>
        <h3><?php echo $Application->translate('Filter by age', 'Filtrer par âge'); ?></h3>
        <div class="dt-sc-margin10"></div>
        <div class="price_slider_wrapper">
            <div id="priceslider" class="price_slider"></div>
        </div>
        <!--<a class="dt-sc-button mini submit hide applyFilters" href="#"><i class="fa fa-search"></i> <?php echo $Application->translate('Apply', 'Exécuter'); ?></a>-->
        <a class="dt-sc-button mini submit hide applyFilters" href="#"><i class="fa fa-search"></i> <?php echo $Application->translate('Apply', 'Exécuter'); ?></a>
    </aside>
    
    <?php /*?><aside class="widget widget_price_filter">
        <div class="price_slider_amount">
            <div class="price_label">
                <span class="from" id="year-filter"></span>
            </div>
        </div>
        <h3><?php echo $Application->translate('Filter by year', 'Filtrer par année'); ?></h3>
        <div class="dt-sc-margin10"></div>
        <div class="price_slider_wrapper">
            <div id="yearslider" class="price_slider"></div>
        </div>
        <a class="dt-sc-button mini submit hide applyFilters" href="#"><i class="fa fa-search"></i> <?php echo $Application->translate('Apply', 'Exécuter'); ?></a>
    </aside><?php */?>
    
    <aside class="widget widget_tag_cloud">
        <h3>
			<?php echo $Application->translate('Filter by year', 'Filtrer par année'); ?>
            <?php if ($Application->getRequestDispatcher()->getRequestParam('year', false)) { ?>
            <a href="<?php echo $this->route('projects');?>" class="pull-right" 
            	style="font-size:11px;color: #21c2f8; margin-top: 6px; text-decoration:underline; margin-right:8px;">
				<?php echo $Application->translate('All years', 'Tout les années'); ?></a>
            <?php } ?>    
        </h3>
        <div class="tagcloud">
            <?php foreach (range(date('Y'), 2015) as $year) { ?>
                <a href="<?php echo $this->route('projects', null, array('year' => $year));?>" 
                    style="<?php echo ((int) $Application->getRequestDispatcher()->getRequestParam('year', 0) === $year) ? 
                        'background: #21c2f8;color:#FFF;' : ''; ?>margin-right: 5px;"><?php echo $year; ?></a>&nbsp;
            <?php } ?>
        </div>
    </aside>
         
    <aside class="widget widget_featured_products">
    	<hr />
    	<?php $this->renderPartial('modules::rss::feed-menu', array('limit' => 1)); ?>
        <?php /*?>
        <h3><?php echo $Application->translate('Recently Viewed', 'Vu Récemment'); ?></h3>
        <!-- **products - Starts** -->
        <div class="products">
            <!-- **product-wrapper - Starts** -->   
            <div class="product-wrapper">
                <!-- **product-container - Starts** -->   
                <div class="product-container">
                    <a href="shop-detail.html"><div class="product-thumb"> <img src="images/product-14.jpg" alt="image"/> </div> </a>
                    <!-- **product-title - Starts** -->
                    <div class="product-title"> 
                        <a href="#"> <span class="fa fa-shopping-cart"></span> Add to Cart </a>
                        <a href="#"> <span class="fa fa-unlink"></span> Options </a>
                    </div> <!-- **product-title - Ends** -->
                </div> <!-- **product-container - Ends** --> 
                <!-- **product-details - Starts** --> 
                <div class="product-details"> 
                    <h5> <a href="shop-detail.html"> Ellents Style Grade </a> </h5>
                    <span class="amount"> $20.00 </span> 
                </div> <!-- **product-details - Ends** --> 
            </div> <!-- **product-wrapper - Ends** -->
        </div> <!-- **products - Ends** --><?php */?>
    </aside>
</section>