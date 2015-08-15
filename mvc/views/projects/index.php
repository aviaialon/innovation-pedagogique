<?php
	$Application = \Core\Application::getInstance();
	$pagination  = $this->getViewData('pagination');
	$category    = $this->getViewData('category');
	$results     = $pagination->getPageData(); 
	$total       = (int) $pagination->getItemsTotal();
	$wishlist    = \Core\Inp\Products\Product_Wishlist::getInstance();
	/*
	$breadCrumb  = array();
	
	if ((int) $category->getId() > 0) {
		$breadCrumb = array(
			$Application->translate($category->getName_En(), $category->getName_Fr()) => $this->route(__CLASS__, null, array(
				'category' => (int) $category->getId()
			))
		);
	}
	*/
?>
<div id="main">
	<?php #$this->renderPartial('menu::breadcrumb', array('additionalItems' => $breadCrumb)); ?>
	<?php $this->renderPartial('menu::search_breadcrumb', array('title' => $Application->translate('Projects', 'Projects D\'innovation'))); ?>
    <div class="dt-sc-margin30"></div>    
    <!-- Container starts-->
    
    <div class="container">
        <?php $this->renderPartial('menu::products::search-secondary-left', array('categoryTree' => $this->getViewData('categoryTree'))); ?>
        
        <!-- **primary - Starts** --> 
        <section id="primary" class="with-left-sidebar page-with-sidebar">
        	 
             <div class="hr-title">
	            <h3><?php echo ucwords(($total > 0 ? $total . ' ' : $Application->translate('No ', 'Aucun ')) .  
					$Application->translate('Projects Found', 'projets trouvés') . (
						(int) $category->getId() > 0 ? 
							$Application->translate(' In <i>"' . $category->getName_En() . '"</i>', ' Dans <i>"' . $category->getName_Fr() . '"</i>') : ''
					)); ?></h3>
	            <div class="title-sep"></div>
	        </div>   
            <!--<div class="dt-sc-margin30"></div>-->
            <div class="dt-sc-margin10"></div>
            
            <?php if (empty($results)=== false) { ?>
            	<ul class="products">
                <?php $_col = 1; ?>
            	<?php foreach ($results as $product) { ?>
                	<?php $imageUrl    = \Core\Hybernate\Products\Product_Image_Position::getImagePositionWebDirecotryPath(1) . '/' . $product[ 'mainImage']; ?>
                    <?php $productLink = \Core\Hybernate\Products\Product::getStaticProductUrl($product['id'], $product['title']); ?>
                    <li class="<?php echo ($_col === 3 ? 'last' : ''); ?>">
                        <div class="product-wrapper product-three-column">
                            <div class="product-container">
                            	<?php
									$exists    = $wishlist->has($product['id']);
									$class     = ($exists ? 'active' : '');
									$whlstText = ($exists ? 'Retirer de la liste de souhaits' : 'Ajouter à la liste de souhaits');
									$whlstUrl  = ($exists ? $wishlist->getRemoveUrl($product['id']) : $wishlist->getAddUrl($product['id']));
								?>
                            	<a href="<?php echo $whlstUrl; ?>" 
                                        title="<?php echo $whlstText; ?>" class="wishlistBtn <?php echo $class; ?>"><span class="fa fa-heart"></span></a>
                                
                                <a href="<?php echo $productLink;?>">
                                	<div class="product-thumb">
                                    	<img src="<?php echo $imageUrl; ?>" alt="<?php echo $product['title']; ?>"/>
                                    </div>
                                </a>
                                
                                <div class="product-title"> 
                                    <?php /*?><a href="shop-cart.html"><span class="fa fa-shopping-cart"></span> Add to Cart</a><?php */?>
                                    <a href="<?php echo $productLink; ?>"> <span class="fa fa-unlink"></span> En Savoir Plus </a>
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
            
            <?php } else { ?>
            	<p>
                	<?php echo $Application->translate('Sorry, no projects were found.', 'Désolé, aucun projet n\'a été trouvé.'); ?> 
                    <?php echo sprintf($Application->translate('<a href="%s">Click here</a> to start your search again.', 
						'<a href="%s">Cliquez ici</a> pour recommencer votre recherche.'), $Application->getRequestDispatcher()->route('projects')); ?>
                </p>
            <?php } ?>
        </section> <!-- **primary - Ends** --> 
        <div class="dt-sc-margin80"></div>
    </div> <!-- **container - Ends** --> 
    <?php $this->renderPartial('modules::cta::collaborate', $this->getRequestData()); ?> 
</div>