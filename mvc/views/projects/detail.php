<?php
	$Application     = \Core\Application::getInstance();
	$wishlist        = \Core\Inp\Products\Product_Wishlist::getInstance();
	$lang            = $Application->translate('en', 'fr');
	$product         = $this->getViewData('product');
	$relatedProducts = $product->getRelatedProducts(array('limit' => 3));
	$mainCategory    = $product->getMainCategory();
?>
<div id="main">
	<?php $this->renderPartial('menu::search_breadcrumb', array(
		'title' => $product->getDescription($lang)->getTitle() . ' (' . $mainCategory['name_' . $lang] . ')')); ?>
    <div class="dt-sc-margin30"></div>    
    <!-- Container starts-->
     <div class="container">
        
        <?php $this->renderPartial('menu::products::search-secondary-left', array('categoryTree' => $this->getViewData('categoryTree'))); ?>
        
        <!-- **primary - Starts** --> 
        <section id="primary" class="with-left-sidebar page-with-sidebar">
            <div class="woocommerce">
                <div class="product single-product">
                    <?php
						$exists    = $wishlist->has($product->getId());
						$class     = ($exists ? 'active' : '');
						$whlstText = ($exists ? 'Retirer de la liste de souhaits' : 'Ajouter à la liste de souhaits');
						$whlstUrl  = ($exists ? $wishlist->getRemoveUrl($product->getId()) : $wishlist->getAddUrl($product->getId()));
					?>
					<a href="<?php echo $whlstUrl; ?>" 
							title="<?php echo $whlstText; ?>" class="wishlistBtn <?php echo $class; ?>"><span class="fa fa-heart"></span></a>
                    <div class="images">
                        <div class="yith_magnifier_zoom_wrap">
                            <a href="#" class="yith_magnifier_zoom woocommerce-main-image" > 
                                <img src="<?php echo $product->getMainImage()->getImagePath(20) ?>" 
                                	data-lrgImg="<?php echo $product->getMainImage()->getImagePath(0) ?>" />
                            </a>
                        </div> 
                    </div> <!-- **images - Ends** -->
                    <!-- **summary - Starts** -->
                    <div class="summary entry-summary">
                        <h1 class="product_title entry-title"><?php echo $product->getDescription($lang)->getTitle(); ?></h1>
                        <div class="woocommerce-product-rating">
                            <div title="Rated 5.00 out of 5" class="star-rating">
                                <span><strong class="rating">5.00</strong> out of 5</span>
                            </div>
                            <!--<p class="price">$190.00</p>-->
                        </div>
                        <div class="description">
                            <p><?php echo $product->getDescription($lang)->getDescription(); ?></p>
                        </div>
                        <div class="project-details">
                            <h6>Details</h6>
                            <ul class="client-details">
                                <li>
                                    <p>
                                    	<span>Categorie:</span> 
                                        <?php foreach ($product->getCategories() as $category) { ?>
                                        	<a href="<?php echo $Application->getRequestDispatcher()->route('projects', null, array(
												'category' => $category['subCatId']
											)); ?>"><?php echo($category['subCat_' . $lang]); ?></a>
                                        <?php } ?>
                                    </p>
                                </li>
                                <li>
                                    <p><span>Age:</span> <?php echo($product->getMinAge()); ?> - <?php echo($product->getMaxAge()); ?> <?php echo($Application->translate('Years old', 'Ans')); ?></p>
                                </li>
                                <li>
                                    <p><span>Annee:</span> <?php echo($product->getYear()); ?></p>
                                </li>
                            </ul>
                        </div>
                        <div class="dt-sc-margin10"></div>
                        <a href="#productMoreInfo" rel="modal" id="productInfoRequest" class="dt-sc-button medium strt submit single_add_to_cart_button" title="">
                        	<i class="fa fa-envelope"></i> Demander plus de renseignements</a>
                        <?php /*?><form method="post" class="cart">
                            <div class="quantity buttons_added">
                                <input type="button" class="minus" value="-">
                                <input type="number"  class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
                                <input type="button" class="plus" value="+">
                            </div>
                            <input type="hidden" value="727" name="add-to-cart">
                            <button class="single_add_to_cart_button button alt" type="submit">Read More</button>
                        </form>  <?php */?>
                    </div>
                </div>
            </div>
            <!-- **dt-sc-tabs-container - Starts** -->
            <?php /*?><div class="dt-sc-tabs-container type2 woocommerce-tabs">
                  **dt-sc-tabs-frame - Starts** 
                <ul class="dt-sc-tabs-frame">
                    <li> <a href="#">Specifications</a> </li>
                    <li> <a href="#">Reviews (14)</a> </li>
                    <li> <a href="#">About Enigma</a> </li>
                </ul>   **dt-sc-tabs-frame - Ends** 
                
                 **dt-sc-tabs-frame-content - Starts** 
                <div class="dt-sc-tabs-frame-content">
                    <div class="thumb"> <img src="images/product-9.jpg" alt="image"/> </div>
                    <h6> <strong>Specifications of Enigma </strong></h6>
                    <ul>
                        <li> <span> <i class="fa fa-adjust"></i>Model case:</span> Oyster, 36 mm, steel and yellow gold </li>
                        <li> <span> <i class="fa fa-gear"></i>Movement:</span> Perpetual, mechanical, self-winding </li>
                        <li> <span> <i class="fa fa-wrench"></i>Bracelet</span> Jubilee, five-piece links </li>
                        <li> <span> <i class="fa fa-clock-o"></i>Dial</span> Black, Red </li>
                    </ul>
                    <p>Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.</p>
                    <p></p>
                </div>  **dt-sc-tabs-frame-content - Ends** 
                
                 **dt-sc-tabs-frame-content - Starts** 
                <div class="dt-sc-tabs-frame-content">
                    <div class="thumb"> <img src="images/product-10.jpg" alt="image"/> </div>
                    <h4>Reviews</h4>
                    <p>Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.</p>
                    <div class="dt-sc-hr-invisible-very-small"></div>
                    <p> <strong>Priority</strong> has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. Aldus PageMaker including versions of Lorem Ipsum. </p>
                </div>  **dt-sc-tabs-frame-content - Ends** 
                
                 **dt-sc-tabs-frame-content - Starts** 
                <div class="dt-sc-tabs-frame-content">
                    <h4>About Enigma</h4>
                    <p>Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.</p>
                    <div class="dt-sc-hr-invisible-very-small"></div>
                    <p> <strong>Priority</strong> has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. Aldus PageMaker including versions of Lorem Ipsum. </p>
                    <div class="dt-sc-margin10"></div>
                </div>  **dt-sc-tabs-frame-content - Ends** 
                
            </div><?php */?> <!-- **dt-sc-tabs-container - Ends** -->
            
            <div class="dt-sc-margin30"></div>
            
            <?php if (empty($relatedProducts) === false) { ?>
				<?php $count = count($relatedProducts); ?>
                <div class="hr-title dt-sc-hr-invisible-small">
                    <h3>Autres projets dans la categorie <i>"<?php echo $mainCategory['name_' . $lang]; ?>"</i></h3>
                    <div class="title-sep"></div>
                </div>
               
                <ul class="products relatedProducts">
                    <?php foreach($relatedProducts as $index => $relProduct) { ?>
                    <?php $isLast = (($index + 1) === $count) ? 'last' : ''; ?>
                    <li class="<?php echo $isLast; ?>">
                        <?php 
                            $imageUrl = \Core\Hybernate\Products\Product_Image_Position::getImagePositionWebDirecotryPath(21) . '/' .
                                        $relProduct['mainImage'];
                            $prodUrl  = \Core\Hybernate\Products\Product::getStaticProductUrl($relProduct['id'], $relProduct['title_' . $lang]);			
                        ?>     
                         
                        <div class="product-wrapper product-three-column">
                            <div class="product-container">
                                <a href="<?php echo $prodUrl; ?>" title="<?php echo $relProduct['title_' . $lang]; ?>">
                                    <div class="product-thumb"><img src="<?php echo $imageUrl; ?>" alt="<?php echo $relProduct['title_' . $lang]; ?>"/></div>
                                </a>
                            </div>
                            <div class="product-details"> 
                                <h5>
                                    <a href="<?php echo $prodUrl; ?>"><?php echo $relProduct['title_' . $lang]; ?></a>
                                </h5>
                            </div>
                        </div> 
                    </li>
                    <?php } ?>
                </ul>
            <?php } ?>
            <div class="dt-sc-margin10"></div>
        </section>
        
    </div> <!-- **container - Ends** --> 
    <?php $this->renderPartial('modules::cta::collaborate', $this->getRequestData()); ?> 
</div>

<div class="remodal" data-remodal-id="productMoreInfo" id="productMoreInfo" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
  <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
  <form action="">
  <input type="hidden" name="productId" value="<?php echo $product->getId(); ?>" />
  <div>
    <h2 id="modal1Title"><?php echo $Application->translate('Get more information', 'Obtenez plus d\'informations'); ?></h2>
    <p id="modal1Desc">
      	<p><?php echo $Application->translate('Fill in the form below to receive more information on the ' . $product->getDescription($lang)->getTitle() . ' project', 
            'Remplissez le formulaire ci-dessous pour recevoir plus d\'informations sur le project <i><b>' . $product->getDescription($lang)->getTitle() . '</b></i>'); ?></p>
            <div class="error_msg hide"></div>
        <div class="txt-fld">
            <input class="email" name="email" type="text" placeholder="<?php echo $Application->translate('Your Email', 'Votre address courriel'); ?>" />
            <textarea placeholder="Message" name="message"></textarea>
        </div>
    </p>
  </div>
  <br>
  <div class="column dt-sc-one-half first">
    <?php echo \Core\Util\Recaptcha\Recaptcha::getInstance()->getRecaptchaField(); ?>
  </div>
  <div class="column dt-sc-one-half">
      <button class="wishlist-confirm sendInfoRequest"><?php echo $Application->translate('Send', 'Envoyer'); ?></button>
      <button data-remodal-action="cancel" class="remodal-cancel"><?php echo $Application->translate('Cancel', 'Annuler'); ?></button>
  </div>
  </form>
</div>
