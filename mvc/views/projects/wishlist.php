<?php 
	$Application = \Core\Application::getInstance(); 
	$wishlist    = $this->getViewData('wishlist', array());
	$total       = count($wishlist);
?>
<div id="main">
  <?php $this->renderPartial('menu::breadcrumb', array()); ?>
  <div class="full-width-section ">
    <div class="dt-sc-margin30"></div>
    <div class="container"> 
      <?php $this->renderPartial('menu::left-menu', array()); ?>
      <!-- right section -->
      <section id="primary" class="with-left-sidebar page-with-sidebar width840">
        <div class="hr-title dt-sc-hr-invisible-small">
          <h3><?php echo ucwords(($total > 0 ? $total . ' ' : $Application->translate('No ', 'Aucun ')) .  
			$Application->translate('Projects Found', 'projets trouvés') . ' ' .
			$Application->translate(' in Your Wishlist', ' dans votre liste de souhaits')); ?></h3>
          <div class="title-sep"> </div>
        </div>
        
		<?php if ($total === 0) { ?>
		<p>Consulter les <a href="<?php echo $this->route('projects'); ?>">projets de cette année</a> pour commencer.</p>
		<?php } ?>
		
        <!-- **column - Starts** -->
        <div class="column first wishlistContent">
          <?php if (empty($wishlist) === false) { ?>
          	<ul class="products">
            	<?php $_col = 1; ?>
            	<?php foreach ($wishlist as $product) { ?>
                	<?php $imageUrl    = \Core\Hybernate\Products\Product_Image_Position::getImagePositionWebDirecotryPath(17) . '/' . $product[ 'img']; ?>
                    <?php $productLink = \Core\Hybernate\Products\Product::getStaticProductUrl($product['id'], $product['title']); ?>
                    <li class="<?php echo ($_col === 3 ? 'last' : ''); ?>">
                        <div class="product-wrapper product-<?php echo($total >= 2 ? 'three' : 'one'); ?>-column">
                            <div class="product-container">
                            	<a href="<?php echo \Core\Inp\Products\Product_Wishlist::getInstance()->getRemoveUrl($product['id']); ?>" 
                                        title="<?php echo $Application->translate('Remove from wishlist', 'Retirer de la liste de souhaits'); ?>" 
                                        class="wishlistBtn active fromListPage"><span class="fa fa-heart"></span></a>
                                
                                <a href="<?php echo $productLink;?>">
                                	<div class="product-thumb">
                                    	<img src="<?php echo $imageUrl; ?>" alt="<?php echo $product['title']; ?>"/>
                                    </div>
                                </a>
                            </div>
                            <!-- **product-details - Starts** --> 
                            <div class="product-details"> 
                                <h5><a href="<?php echo $productLink;?>"><?php echo $product['title']; ?></a></h5>
                            </div>
                        </div>
                    </li>
                    <?php $_col ++; ?>
                    <?php if ($_col === 4) { $_col = 1; } ?>
                <?php } ?>
            </ul>
          <?php } ?>
        </div>
        <!-- **column - Ends** --> 
		<?php if ($total > 0) { ?>
		<div style="clear: both"></div>
        <div id="wishlist-links">
            <a class="dt-sc-button mini strt submit printWishlist" href="#" title="Imprimez votre liste de souhaits"><i class="fa fa-print"></i> Imprimer</a>&nbsp;&nbsp;
            <a href="#wishListShare" rel="modal" id="emailWishlist" class="dt-sc-button mini strt submit emailWishlist" title=""><i class="fa fa-envelope"></i> Envoyer par courriel</a>
       </div>
		<?php } ?>
      </section>
    </div>
    <div class="dt-sc-margin50"></div>
  </div>
  <?php $this->renderPartial('modules::cta::collaborate', $this->getRequestData()); ?>  
</div>
<?php if (empty($wishlist) === false) { ?>
<div class="remodal" data-remodal-id="wishListShare" id="wishListShare" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
  <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
  <form action="">
  <div>
    <h2 id="modal1Title"><?php echo $Application->translate('Email Your Wishlist', 'Envoyer Votre liste souhaits'); ?></h2>
    <p id="modal1Desc">
      	<p><?php echo $Application->translate('Fill in the form below to receive your wish list by email.', 
            'Remplissez le formulaire ci-dessous pour recevoir votre liste de souhaits par courriel.'); ?></p>
            <div class="error_msg hide"></div>
        <div class="txt-fld">
            <input class="email" name="email" type="text" placeholder="<?php echo $Application->translate('Your Email', 'Votre address courriel'); ?>" />
        </div>
    </p>
  </div>
  <br>
  <div class="column dt-sc-one-half first">
    <?php echo \Core\Util\Recaptcha\Recaptcha::getInstance()->getRecaptchaField(); ?>
  </div>
  <div class="column dt-sc-one-half">
      <button class="wishlist-confirm sendWishlist"><?php echo $Application->translate('Send', 'Envoyer'); ?></button>
      <button data-remodal-action="cancel" class="remodal-cancel"><?php echo $Application->translate('Cancel', 'Annuler'); ?></button>
  </div>
  </form>
</div>
<?php } ?>
