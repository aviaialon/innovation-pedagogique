<?php
	$Application = \Core\Application::getInstance();
	$pagination  = $this->getViewData('pagination');
	$category    = $this->getViewData('category');
	$results     = $pagination->getPageData(); 
	$breadCrumb  = array();
	
	if ((int) $category->getId() > 0) {
		$breadCrumb = array(
			$Application->translate($category->getName_En(), $category->getName_Fr()) => $this->route(__CLASS__, null, array(
				'category' => (int) $category->getId()
			))
		);
	}
?>
<div id="main">
	<?php $this->renderPartial('menu::breadcrumb', array('additionalItems' => $breadCrumb)); ?>
    <div class="dt-sc-margin30"></div>    
    <!-- Container starts-->
    <div class="container">
    	<?php $this->renderPartial('modules::search::search-bar', array()); ?>
        <?php $this->renderPartial('menu::products::search-secondary-left', array('categoryTree' => $this->getViewData('categoryTree'))); ?>
        
        <!-- **primary - Starts** --> 
        <section id="primary" class="with-left-sidebar page-with-sidebar">
            <div class="dt-sc-margin30"></div>
            
            <?php if (empty($results)=== false) { ?>
            	<ul class="products">
                <?php $_col = 1; ?>
            	<?php foreach ($results as $product) { ?>
                	<?php $imageUrl    = \Core\Hybernate\Products\Product_Image_Position::getImagePositionWebDirecotryPath(1) . '/' . $product[ 'mainImage']; ?>
                    <?php $productLink = \Core\Hybernate\Products\Product::getStaticProductUrl($product['id'], $product['title']); ?>
                    <li class="<?php echo ($_col === 3 ? 'last' : ''); ?>">
                        <div class="product-wrapper product-three-column">
                            <div class="product-container">
                                <a href="<?php echo $productLink;?>">
                                	<div class="product-thumb">
                                    	<img src="<?php echo $imageUrl; ?>" alt="<?php echo $product['title']; ?>"/>
                                    </div>
                                </a>
                                <div class="product-title"> 
                                    <a href="shop-cart.html"> <span class="fa fa-shopping-cart"></span> Add to Cart </a>
                                    <a href="#"> <span class="fa fa-unlink"></span> Options </a>
                                </div>
                            </div>
                            <!-- **product-details - Starts** --> 
                            <div class="product-details"> 
                                <h5><a href="<?php echo $productLink;?>"><?php echo $product['title']; ?></a></h5>
                                <span class="amount"> $20.00 </span> 
                            </div>
                        </div>
                    </li>
                    <?php $_col ++ ?>
                    <?php if ($_col === 4) { $_col = 1; } ?>
                <?php } ?>
                </ul>
                
                <div class="dt-sc-margin10"></div>
                
                <div class="pagination">
                	<ul>
                	<?php foreach($pagination->getPaginationLinks() as $paginationLink) { ?>
                        <li><a href="<?php echo $paginationLink['href'] . '&q=' . $_GET['q'];?>" class="<?php echo $paginationLink['class']; ?>">
                            <?php echo $paginationLink['text']; ?></a></li>
                    <?php } ?>
                    </ul>
                </div> <!-- **pagination - Ends** -->
            
            <?php } ?>
        </section> <!-- **primary - Ends** --> 
        <div class="dt-sc-margin80"></div>
    </div> <!-- **container - Ends** --> 
    <?php $this->renderPartial('modules::cta::collaborate', $this->getRequestData()); ?> 
</div>