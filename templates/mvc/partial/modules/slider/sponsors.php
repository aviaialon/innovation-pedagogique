<?php
    $Application   = \Core\Application::getInstance();
    $imagePath     = $Application->getConfigs()->get('Application.core.mvc.controller.assets.base.img');
?>
<style>
	.sponsors img {max-width: 80px; max-height:80px;}
</style>
<!-- **Full-width-section - Starts** -->
<div class="full-width-section grey sponsors"> 
  <!-- **container - Starts** -->
  <div class="container">
  	<br />
    <h2 class="aligncenter">Nos Commanditaires</h2>
    <div class="dt-sc-hr-invisible-small"></div>
    
    
    
    <div class="column dt-sc-one-fourth first"> 
      <div class="dt-sc-team type3">
        <div class="image">
      	<img src="<?php echo $imagePath; ?>/sponsors/union.jpg" alt="www.unionlibre.com"/></div>
        <div class="team-details">
          <h6><a href="http://www.unionlibre.com" target="_blank">unionlibre.com</a></h6>
          <p>unionlibre.com</p>
        </div>
      </div>
    </div>
    <div class="column dt-sc-one-fourth"> 
      <div class="dt-sc-team type3">
        <div class="image">
      	<img src="<?php echo $imagePath; ?>/sponsors/lapress.jpg" alt="plus.lapresse.ca"/></div>
        <div class="team-details">
          <h6><a href="http://plus.lapresse.ca" target="_blank">plus.lapresse.ca</a></h6>
          <p>plus.lapresse.ca</p>
        </div>
      </div>
    </div>
    <div class="column dt-sc-one-fourth"> 
      <div class="dt-sc-team type3">
        <div class="image">
      	<img src="<?php echo $imagePath; ?>/sponsors/mcdonalds.png" alt="www.mcdonalds.ca"/></div>
        <div class="team-details">
          <h6><a href="http://www.mcdonalds.ca" target="_blank">mcdonalds.ca</a></h6>
          <p>mcdonalds.ca</p>
        </div>
      </div>
    </div>
    <div class="column dt-sc-one-fourth"> 
      <div class="dt-sc-team type3">
        <div class="image">
      	<img src="<?php echo $imagePath; ?>/sponsors/mssi.jpg" alt="www.mssi.ca"/></div>
        <div class="team-details">
          <h6><a href="http://www.mssi.ca" target="_blank">mssi.ca</a></h6>
          <p>mssi.ca</p>
        </div>
      </div>
    </div>
    
    
    
    <!--<div class="column dt-sc-one-fourth first"> 
      <div class="dt-sc-team">
        <div class="image"><img src="<?php echo $imagePath; ?>/sponsors/successcolaire.png" alt="successcolaire.ca"/></div>
        <div class="team-details">
          <h6><a href="http://www.successcolaire.ca/" target="_blank">Successcolaire.ca</a></h6>
          <p>Successcolaire.ca</p>
        </div>
      </div>
    </div>
    
    <div class="column dt-sc-one-fourth"> 
      <div class="dt-sc-team">
        <div class="image"><img src="<?php echo $imagePath; ?>/sponsors/jardin-vicky.png" alt="www.jardindevicky.ca"/></div>
        <div class="team-details">
          <h6><a href="http://www.jardindevicky.ca/" target="_blank">millemerveilles.com</a></h6>
          <p>Millemerveilles.com</p>
        </div>
      </div>
    </div>
    
    <div class="column dt-sc-one-fourth"> 
      <div class="dt-sc-team">
        <div class="image"><img src="<?php echo $imagePath; ?>/sponsors/ladoq.gif" alt="www.ladoq.ca"/></div>
        <div class="team-details">
          <h6><a href="http://www.ladoq.ca" target="_blank">ladoq.ca</a></h6>
          <p>ladoq.ca</p>
        </div>
      </div>
    </div>
    
    <div class="column dt-sc-one-fourth"> 
      <div class="dt-sc-team">
        <div class="image"><img src="<?php echo $imagePath; ?>/sponsors/art-esthetique.png" alt="www.art-esthetique.ca/"/></div>
        <div class="team-details">
          <h6><a href="http://www.art-esthetique.ca" target="_blank">art-esthetique.ca</a></h6>
          <p>art-esthetique.ca</p>
        </div>
      </div>
    </div>
    
    <div class="column dt-sc-one-fourth"> 
      <div class="dt-sc-team">
        <div class="image">
      	<img src="<?php echo $imagePath; ?>/sponsors/aubergine.png" alt="www.boutiquelaubergine.com/"/></div>
        <div class="team-details">
          <h6><a href="http://www.boutiquelaubergine.com" target="_blank">boutiquelaubergine.com</a></h6>
          <p>boutiquelaubergine.com</p>
        </div>
      </div>
    </div>
    
    <div class="column dt-sc-one-fourth"> 
      <div class="dt-sc-team">
        <div class="image">
      	<img src="<?php echo $imagePath; ?>/sponsors/tattooquebec.png" alt="www.tattooquebec.ca"/></div>
        <div class="team-details">
          <h6><a href="http://www.tattooquebec.ca" target="_blank">tattooquebec.ca</a></h6>
          <p>tattooquebec.ca</p>
        </div>
      </div>
    </div>
    
    <div class="column dt-sc-one-fourth"> 
      <div class="dt-sc-team">
        <div class="image">
      	<img src="<?php echo $imagePath; ?>/sponsors/mcdonalds.png" alt="www.mcdonalds.ca"/></div>
        <div class="team-details">
          <h6><a href="http://www.mcdonalds.ca" target="_blank">mcdonalds.ca</a></h6>
          <p>mcdonalds.ca</p>
        </div>
      </div>
    </div>
    <div class="column dt-sc-one-fourth"> 
      <div class="dt-sc-team">
        <div class="image"><img src="<?php echo $imagePath; ?>/sponsors/pepsico.gif" alt="www.pepsico.ca/fr/index.html"/></div>
        <div class="team-details">
          <h6><a href="http://www.pepsico.ca" target="_blank">pepsico.ca</a></h6>
          <p>pepsico.ca</p>
        </div>
      </div>
    </div>
    <div class="column dt-sc-one-fourth first"> 
      <div class="dt-sc-team">
        <div class="image"><img src="<?php echo $imagePath; ?>/sponsors/umontreal.gif" alt="www.umontreal.ca"/></div>
        <div class="team-details">
          <h6><a href="http://www.umontreal.ca" target="_blank">umontreal.ca</a></h6>
          <p>umontreal.ca</p>
        </div>
      </div>
    </div>
    <div class="column dt-sc-one-fourth"> 
      <div class="dt-sc-team">
        <div class="image">
      	<img src="<?php echo $imagePath; ?>/sponsors/lapress.jpg" alt="plus.lapresse.ca"/></div>
        <div class="team-details">
          <h6><a href="http://plus.lapresse.ca" target="_blank">plus.lapresse.ca</a></h6>
          <p>plus.lapresse.ca</p>
        </div>
      </div>
    </div>
    <div class="column dt-sc-one-fourth"> 
      <div class="dt-sc-team">
        <div class="image">
      	<img src="<?php echo $imagePath; ?>/sponsors/union.jpg" alt="www.unionlibre.com"/></div>
        <div class="team-details">
          <h6><a href="http://www.unionlibre.com" target="_blank">unionlibre.com</a></h6>
          <p>unionlibre.com</p>
        </div>
      </div>
    </div>
    <div class="column dt-sc-one-fourth"> 
      <div class="dt-sc-team">
        <div class="image">
      	<img src="<?php echo $imagePath; ?>/sponsors/cheneliere.jpg" alt="www.cheneliere.ca"/></div>
        <div class="team-details">
          <h6><a href="http://www.cheneliere.ca" target="_blank">cheneliere.ca</a></h6>
          <p>cheneliere.ca</p>
        </div>
      </div>
    </div>
    <div class="column dt-sc-one-fourth"> 
      <div class="dt-sc-team">
        <div class="image">
      	<img src="<?php echo $imagePath; ?>/sponsors/vrais-vie.jpg" alt="www.lesproductionsdanslavraievie.com"/></div>
        <div class="team-details">
          <h6><a href="http://www.lesproductionsdanslavraievie.com" target="_blank">lesproductionsdanslavraievie.com</a></h6>
          <p>lesproductionsdanslavraievie.com</p>
        </div>
      </div>
    </div>
    <div class="column dt-sc-one-fourth"> 
      <div class="dt-sc-team">
        <div class="image">
      	<img src="<?php echo $imagePath; ?>/sponsors/uniprix.png" alt="www.uniprix.com"/></div>
        <div class="team-details">
          <h6><a href="http://www.uniprix.com" target="_blank">uniprix.com</a></h6>
          <p>uniprix.com</p>
        </div>
      </div>
    </div>
    <div class="column dt-sc-one-fourth"> 
      <div class="dt-sc-team">
        <div class="image">
      	<img src="<?php echo $imagePath; ?>/sponsors/polar.png" alt="www.polarbearsclub.ca"/></div>
        <div class="team-details">
          <h6><a href="http://www.polarbearsclub.ca" target="_blank">polarbearsclub.ca</a></h6>
          <p>polarbearsclub.ca</p>
        </div>
      </div>
    </div>
    <div class="column dt-sc-one-fourth"> 
      <div class="dt-sc-team">
        <div class="image">
      	<img src="<?php echo $imagePath; ?>/sponsors/mssi.jpg" alt="www.mssi.ca"/></div>
        <div class="team-details">
          <h6><a href="http://www.mssi.ca" target="_blank">mssi.ca</a></h6>
          <p>mssi.ca</p>
        </div>
      </div>
    </div>
    
    <div class="column dt-sc-one-fourth"> 
      <div class="dt-sc-team">
        <div class="image">
      	<img src="<?php echo $imagePath; ?>/sponsors/blainville.jpg" alt="Boucherie Marché Blainville Ste-Thérèse"/></div>
        <div class="team-details">
          <h6><a href="https://plus.google.com/112726431954284080277/about?gl=ca&hl=en" target="_blank">Boucherie Marché Blainville Ste-Thérèse</a></h6>
          <p>Boucherie Marché Blainville Ste-Thérèse</p>
        </div>
      </div>
    </div>
  </div>-->
  <!-- **container - Ends** -->
  <div class="dt-sc-hr-invisible-small"></div>
</div>


<?php /*?>
<div class="full-width-section grey">
<div class="dt-sc-hr-invisible"></div>
<div class="container"> 
  <!-- **dt-sc-partner-carousel-wrapper - Starts** -->
  <div class="dt-sc-partner-carousel-wrapper">
    <ul class="dt-sc-partner-carousel">
      <li><a href="http://www.successcolaire.ca/" target="_blank">
      	<img src="<?php echo $imagePath; ?>/sponsors/successcolaire.png" alt="successcolaire.ca"/></a></li>
      <li><a href="http://www.jardindevicky.ca" target="_blank">
      	<img src="<?php echo $imagePath; ?>/sponsors/jardin-vicky.png" alt="www.jardindevicky.ca"/></a></li>
      <li><a href="http://www.millemerveilles.com" target="_blank">
      	<img src="<?php echo $imagePath; ?>/sponsors/millemerveilles.png" alt="www.millemerveilles.com"/></a></li>
      <li><a href="http://www.ladoq.ca" target="_blank">
      	<img src="<?php echo $imagePath; ?>/sponsors/ladoq.gif" alt="www.ladoq.ca"/></a></li>
      <li><a href="http://www.art-esthetique.ca/" target="_blank">
      	<img src="<?php echo $imagePath; ?>/sponsors/art-esthetique.png" alt="www.art-esthetique.ca/"/></a></li>
      <li><a href="http://www.boutiquelaubergine.com/" target="_blank">
      	<img src="<?php echo $imagePath; ?>/sponsors/aubergine.png" alt="www.boutiquelaubergine.com/"/></a></li>
      <li><a href="http://www.tattooquebec.ca/" target="_blank">
      	<img src="<?php echo $imagePath; ?>/sponsors/tattooquebec.png" alt="www.tattooquebec.ca"/></a></li>
      <li><a href="http://www.mcdonalds.ca/ca/fr.html" target="_blank">
      	<img src="<?php echo $imagePath; ?>/sponsors/mcdonalds.png" alt="www.mcdonalds.ca"/></a></li>
      <li><a href="http://www.pepsico.ca/fr/index.html" target="_blank">
      	<img src="<?php echo $imagePath; ?>/sponsors/pepsico.gif" alt="www.pepsico.ca/fr/index.html"/></a></li>
      <li><a href="http://www.umontreal.ca" target="_blank">
      	<img src="<?php echo $imagePath; ?>/sponsors/umontreal.gif" alt="www.umontreal.ca"/></a></li>
      <li><a href="http://plus.lapresse.ca" target="_blank">
      	<img src="<?php echo $imagePath; ?>/sponsors/lapress.jpg" alt="plus.lapresse.ca"/></a></li>
      <li><a href="http://www.unionlibre.com/" target="_blank">
      	<img src="<?php echo $imagePath; ?>/sponsors/union.jpg" alt="www.unionlibre.com"/></a></li>
      <li><a href="http://www.cheneliere.ca/" target="_blank">
      	<img src="<?php echo $imagePath; ?>/sponsors/cheneliere.jpg" alt="www.cheneliere.ca"/></a></li>
      <li><a href="http://www.lesproductionsdanslavraievie.com" target="_blank">
      	<img src="<?php echo $imagePath; ?>/sponsors/vrais-vie.jpg" alt="www.lesproductionsdanslavraievie.com"/></a></li>
      <li><a href="http://www.uniprix.com" target="_blank">
      	<img src="<?php echo $imagePath; ?>/sponsors/uniprix.png" alt="www.uniprix.com"/></a></li>
      <li><a href="http://www.polarbearsclub.ca" target="_blank">
      	<img src="<?php echo $imagePath; ?>/sponsors/polar.png" alt="www.polarbearsclub.ca"/></a></li>
      <li><a href="http://www.mssi.ca/" target="_blank">
      	<img src="<?php echo $imagePath; ?>/sponsors/mssi.jpg" alt="www.mssi.ca"/></a></li>
      <li><a href="https://plus.google.com/112726431954284080277/about?gl=ca&hl=en" target="_blank">
      	<img src="<?php echo $imagePath; ?>/sponsors/blainville.jpg" alt="Boucherie Marché Blainville Ste-Thérèse"/></a></li>
    </ul>
  </div>
  <!-- **dt-sc-partner-carousel-wrapper - Starts** --> 
</div>
<div class="dt-sc-hr-invisible-small"></div>
</div>
<!-- **Full-width-section - Ends** --> <?php */?>