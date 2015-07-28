<?php 
/**
 * Map directions Partial Class
 */	
$Application           = \Core\Application::getInstance();
$Configs     	       = $Application->getConfigs();
$strStaticResourcePath = $Configs->get('Application.core.mvc.controller.assets.base.img');
?>
<section id="map-wrapper">
	<iframe id="locationsMap" 
			style="border-bottom:1px solid #DDDDDD" 
			width="100%" 
			height="350" 
			allowtransparency="1" 
			frameborder="0" 
			marginheight="0" 
			marginwidth="0" 
			scrolling="0" src="/map/large/?.__rnd=<?php echo mt_rand(); ?>" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
	<div class="map_overlay mobile-hide">
		<div class="twelve columns">
			<!-- 
			<h3 class="locationTitle" style="margin-bottom: 14px"><?php echo $Configs->get('Application.core.mvc.site.name'); ?></h3>
			-->
			<p class="locationAddress">
				<?php echo (str_replace('<br />', ' ', $Configs->get('Application.core.mvc.contact.address'))); ?>
				<span class="smalltext ">
					<br />Tel: <?php echo $Configs->get('Application.core.mvc.contact.number'); ?> &nbsp;|&nbsp; 
						Fax: <?php echo $Configs->get('Application.core.mvc.contact.fax'); ?>
					<br />Email : <a href="mailto:<?php echo $Configs->get('Application.core.mvc.contact.email'); ?>">
						<?php echo $Configs->get('Application.core.mvc.contact.email'); ?></a>
				</span>
			</p>
			<p>
			<div class="mapSearchContainer">
				<span class="txt-info">&darr; <?php echo($Application->translate(
					'Tell us where are you coming from to get directions', 'Dites-nous où venez-vous pour obtenir les directions')); ?></span>
				<input x-webkit-speech speech id="mapSearchTextField" type="text" size="50" placeholder="<?php echo($Application->translate('Enter Your Location', 'Entrez votre Adresse')); ?>" />
				<div id="delete"><span id="x">x</span><span id="travelMode" class="hasTooltip" 
					title="<?php echo($Application->translate('Select your travel mode', 'Choisissez votre mode de transport')); ?>"></span></div>
				<a class="g-button no-text hasTooltip" id="useLoc" title="<?php echo($Application->translate('Use My Current Location', 'Utiliser ma position actuelle')); ?>">
					<i class="fa fa-location-arrow"></i></a>
				<a class="small blue" id="direction_submit" title="<?php echo($Application->translate('Search', 'Rechercher')); ?>">
				<?php echo($Application->translate('Search', 'Rechercher')); ?></a>
				<div id="travelModeSelection">
					<p><?php echo($Application->translate('Select your travel mode', 'Choisissez votre mode de transport')); ?>:</p>
					<ul>
						<li class="selected" rel-travel-mode="driving"><?php echo($Application->translate('Driving', 'Par voiture')); ?></li>
						<li rel-travel-mode="transit"><?php echo($Application->translate('By Bus', 'Par autobus')); ?></li>
						<li rel-travel-mode="walking"><?php echo($Application->translate('Walking', 'En marchant')); ?></li>
					</ul>
				</div>
			</div>
			</p>
		</div>
	</div>		
	<div class="shadow"></div>
</section>

<section id="map-direction-wrapper">
	<div class="row-fluid clear-map-panel">
		<div class="column dt-sc-one-half first">
			<h3><?php echo($Application->translate('Directions', 'Directions')); ?></h3>
		</div>
		<div class="column dt-sc-one-half">
			<div id="more_info" class="float-right">
				<p><?php echo($Application->translate('Total Distance', 'Distance Totale')); ?>: <span id="total"></span></p>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="column dt-sc-three-fourth first">
			<div id="directionsPanel">
				<div id="directionsPanelContainer"></div>
			</div>
		</div>
		<div class="column dt-sc-one-fourth">
			<div id="map_canvas"></div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="dt-sc-margin20"></div>
			<hr />
			<div class="pull-right">
				<a href="#" id="mapDirectionPrint"><?php echo($Application->translate('Print', 'Imprimer')); ?></a>
				<a href="#" id="mapDirectionDone"><?php echo($Application->translate('Done', 'Terminer')); ?></a>
			</div>
		</div>
	</div>
</section>