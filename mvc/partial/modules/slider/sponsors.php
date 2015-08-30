<?php
    $Application   = \Core\Application::getInstance();
    $imagePath     = $Application->getConfigs()->get('Application.core.mvc.controller.assets.base.img');
	$sponsors      = array(
		array(
			'img'  => $imagePath . '/sponsors/art-esthetique.png',
			'name' => 'art-esthetique.ca',
			'url'  => 'http://www.art-esthetique.ca'
		),
		array(
			'img'  => $imagePath . '/sponsors/aubergine.png',
			'name' => 'boutiquelaubergine.com',
			'url'  => 'http://www.boutiquelaubergine.com'
		),     
		array(
			'img'  => $imagePath . '/sponsors/tattooquebec.png',
			'name' => 'Pénélope Art Corporel',
			'url'  => 'http://www.tattooquebec.ca'
		),
		array(
			'img'  => $imagePath . '/sponsors/ladoq.gif',
			'name' => 'ladoq.ca',
			'url'  => 'http://www.ladoq.ca'
		),
		array(
			'img'  => $imagePath . '/sponsors/successcolaire.png',
			'name' => 'successcolaire.ca',
			'url'  => 'http://www.successcolaire.ca'
		),
		array(
			'img'  => $imagePath . '/sponsors/jardin-vicky.png',
			'name' => 'jardindevicky.c',
			'url'  => 'http://www.jardindevicky.ca'
		),
		array(
			'img'  => 'https://s-media-cache-ak0.pinimg.com/736x/f3/86/cc/f386cc526ea6106d20f133500bd21573.jpg',
			'name' => 'Le sac à dos du suppléant',
			'url'  => '#'
		),
		array(
			'img'  => $imagePath . '/sponsors/mcdonalds.png',
			'name' => 'mcdonalds.ca',
			'url'  => 'http://www.mcdonalds.ca'
		),
		array(
			'img'  => $imagePath . '/sponsors/millemerveilles.png',
			'name' => 'millemerveilles.com',
			'url'  => 'http://www.millemerveilles.com'
		),
		array(
			'img'  => $imagePath . '/logo.png',
			'name' => 'Faculté des études supérieures et postdoctorales',
			'url'  => 'http://www.fesp.umontreal.ca/en/home.html'
		),
		array(
			'img'  => $imagePath . '/sponsors/union.jpg',
			'name' => 'unionlibre.com',
			'url'  => 'http://www.unionlibre.com'
		),
		array(
			'img'  => $imagePath . '/sponsors/lapress.jpg',
			'name' => 'plus.lapresse.ca',
			'url'  => 'http://plus.lapresse.ca'
		),
		array(
			'img'  => $imagePath . '/sponsors/mssi.jpg',
			'name' => 'mssi.ca',
			'url'  => 'http://www.mssi.ca'
		),
		array(
			'img'  => $imagePath . '/sponsors/cheneliere.jpg',
			'name' => 'cheneliere.ca',
			'url'  => 'http://www.cheneliere.ca'
		),
		array(
			'img'  => $imagePath . '/sponsors/pepsico.gif',
			'name' => 'pepsico.ca',
			'url'  => 'http://www.pepsico.ca/fr/index.html'
		),
		array(
			'img'  => $imagePath . '/sponsors/blainville.jpg',
			'name' => 'Boucherie Marché Blainville Ste-Thérèse',
			'url'  => 'https://plus.google.com/112726431954284080277/about?gl=ca&hl=en'
		),
		array(
			'img'  => $imagePath . '/sponsors/polar.png',
			'name' => 'polarbearsclub.ca',
			'url'  => 'http://www.polarbearsclub.ca'
		),
		array(
			'img'  => $imagePath . '/sponsors/vrais-vie.jpg',
			'name' => 'Les productions dans la vraie vie',
			'url'  => 'http://www.lesproductionsdanslavraievie.com'
		),
		array(
			'img'  => $imagePath . '/sponsors/uniprix.png',
			'name' => 'Uniprix',
			'url'  => 'http://www.uniprix.com'
		)
	);
?>




<style>
	.sponsors img {max-width: 80px; max-height:80px;}
</style>
<!-- **Full-width-section - Starts** -->
<div class="full-width-section <?php echo (true === (bool) $this->getPartialData('home') ? 'grey' : ''); ?> sponsors"> 
  <!-- **container - Starts** -->
  <div class="<?php echo (true === (bool) $this->getPartialData('home') ? 'container' : ''); ?> animate" data-animation="fadeInDown">
  	<?php if (true === (bool) $this->getPartialData('home')) { ?>
    <br />
    <h2 class="aligncenter"><a href="/sponsors">Nos Commanditaires</a></h2>
    <div class="dt-sc-hr-invisible-small"></div>
    
    <div class="full-width-section">
        <div class="container">
        	
        	<div class="events-carousel-wrapper">
                <div class="events-carousel">
                	<?php foreach ($sponsors as $sponsor) { ?>
                    <div class="column dt-sc-one-fourth"> 
                      <div class="events dt-sc-team type3" style="min-height:120px;">
                        <div class="image" style="padding:5px;">
                        <img src="<?php echo ($sponsor['img']); ?>" alt="<?php echo ($sponsor['name']); ?>" style="padding:8px;min-width: 85%;"/></div>
                        <div class="team-details">
                          <h6><a href="<?php echo ($sponsor['url']); ?>" target="_blank" style="line-height:20px"><?php echo ($sponsor['name']); ?></a></h6>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
               </div>   
            </div>
            <div class="product-carousel">
                <a class="event-prev" href="#"><span class="fa fa-angle-left"></span> </a>
                <a class="event-next" href="#"><span class="fa fa-angle-right"></span> </a>
            </div>
        </div>
    </div>     
    
    <?php } else { ?>
    <hr />
    <br />
    <style type="text/css">
		.dt-sc-team .image img{padding: 6px;}
		.column.first {clear: both;}
	</style>
    <div class="d animate" data-animation="fadeInDown">
    
        <div class="column dt-sc-one-third first"> 
          <div class="dt-sc-team type3">
            <div class="image"><a href="http://www.art-esthetique.ca" target="_blank"><img src="<?php echo $imagePath; ?>/sponsors/art-esthetique.png" alt="www.art-esthetique.ca/"/></a></div>
            <div class="team-details">
              <h6><a href="http://www.art-esthetique.ca" target="_blank">art-esthetique.ca</a></h6>
              <p>art-esthetique.ca</p>
            </div>
          </div>
        </div>
        
        <div class="column dt-sc-one-third"> 
          <div class="dt-sc-team type3">
            <div class="image">
            <a href="http://www.boutiquelaubergine.com" target="_blank"><img src="<?php echo $imagePath; ?>/sponsors/aubergine.png" alt="www.boutiquelaubergine.com/"/></a></div>
            <div class="team-details">
              <h6><a href="http://www.boutiquelaubergine.com" target="_blank">boutiquelaubergine.com</a></h6>
              <p>boutiquelaubergine.com</p>
            </div>
          </div>
        </div>
        <div class="column dt-sc-one-third"> 
          <div class="dt-sc-team type3">
            <div class="image">
            <img src="<?php echo $imagePath; ?>/sponsors/tattooquebec.png" alt="http://www.tattooquebec.ca/"/></div>
            <div class="team-details">
              <h6><a href="http://www.mcdonalds.ca" target="_blank">Pénélope Art Corporel</a></h6>
              <p>http://www.tattooquebec.ca/</p>
            </div>
          </div>
        </div>
        
           
        <div class="column dt-sc-one-third first"> 
          <div class="dt-sc-team type3">
            <div class="image"><a href="http://www.ladoq.ca" target="_blank"><img src="<?php echo $imagePath; ?>/sponsors/ladoq.gif" alt="www.ladoq.ca"/></a></div>
            <div class="team-details">
              <h6><a href="http://www.ladoq.ca" target="_blank">ladoq.ca</a></h6>
              <p>ladoq.ca</p>
            </div>
          </div>
        </div>
        
        <div class="column dt-sc-one-third"> 
          <div class="dt-sc-team type3">
            <div class="image"><a href="http://www.successcolaire.ca/" target="_blank"><img src="<?php echo $imagePath; ?>/sponsors/successcolaire.png" alt="successcolaire.ca"/></a></div>
            <div class="team-details">
              <h6><a href="http://www.successcolaire.ca/" target="_blank">Successcolaire.ca</a></h6>
              <p>Successcolaire.ca</p>
            </div>
          </div>
        </div>
        
        <div class="column dt-sc-one-third"> 
          <div class="dt-sc-team type3">
            <div class="image"><a href="http://www.jardindevicky.ca/" target="_blank"><img src="<?php echo $imagePath; ?>/sponsors/jardin-vicky.png" alt="www.jardindevicky.ca"/></a></div>
            <div class="team-details">
              <h6><a href="http://www.jardindevicky.ca/" target="_blank">www.jardindevicky.ca</a></h6>
              <p>jardindevicky.ca</p>
            </div>
          </div>
        </div>
            
        
        <div class="column dt-sc-one-third first"> 
          <div class="dt-sc-team type3">
            <div class="image"><a href="#">
                <img src="https://s-media-cache-ak0.pinimg.com/736x/f3/86/cc/f386cc526ea6106d20f133500bd21573.jpg" alt="Le sac à dos du suppléant"/></a></div>
            <div class="team-details">
              <h6><a href="#">Le sac à dos du suppléant</a></h6>
            </div>
          </div>
        </div>
        
        
        <div class="column dt-sc-one-third "> 
          <div class="dt-sc-team type3">
            <div class="image">
            <img src="<?php echo $imagePath; ?>/sponsors/mcdonalds.png" alt="www.mcdonalds.ca"/></div>
            <div class="team-details">
              <h6><a href="http://www.mcdonalds.ca" target="_blank">mcdonalds.ca</a></h6>
              <p>mcdonalds.ca</p>
            </div>
          </div>
        </div>
        
        <div class="column dt-sc-one-third"> 
          <div class="dt-sc-team type3">
            <div class="image"><a href="http://www.millemerveilles.com" target="_blank"><img src="<?php echo $imagePath; ?>/sponsors/millemerveilles.png" alt="www.millemerveilles.com"/></a></div>
            <div class="team-details">
              <h6><a href="http://www.millemerveilles.com" target="_blank">millemerveilles.com</a></h6>
              <p>millemerveilles.com</p>
            </div>
          </div>
        </div>
        
        
        <div class="column dt-sc-one-third first"> 
          <div class="dt-sc-team type3">
            <div class="image"><a href="http://www.fesp.umontreal.ca/en/home.html" target="_blank"><img src="<?php echo $imagePath; ?>/logo.png" alt="Faculté des études supérieures et postdoctorales"/></a></div>
            <div class="team-details">
              <h6><a href="http://www.fesp.umontreal.ca/fr" target="_blank" style="line-height: 20px;">Faculté des études supérieures et postdoctorales</a></h6>
              <p>http://www.fesp.umontreal.ca/fr</p>
            </div>
          </div>
        </div>
        
        
        <div class="column dt-sc-one-third"> 
          <div class="dt-sc-team type3">
            <div class="image">
            <img src="<?php echo $imagePath; ?>/sponsors/union.jpg" alt="www.unionlibre.com"/></div>
            <div class="team-details">
              <h6><a href="http://www.unionlibre.com" target="_blank">unionlibre.com</a></h6>
              <p>unionlibre.com</p>
            </div>
          </div>
        </div>
        <div class="column dt-sc-one-third"> 
          <div class="dt-sc-team type3">
            <div class="image">
            <img src="<?php echo $imagePath; ?>/sponsors/lapress.jpg" alt="plus.lapresse.ca"/></div>
            <div class="team-details">
              <h6><a href="http://plus.lapresse.ca" target="_blank">plus.lapresse.ca</a></h6>
              <p>plus.lapresse.ca</p>
            </div>
          </div>
        </div>
        
        <div class="column dt-sc-one-third first"> 
          <div class="dt-sc-team type3">
            <div class="image">
            <img src="<?php echo $imagePath; ?>/sponsors/mssi.jpg" alt="www.mssi.ca"/></div>
            <div class="team-details">
              <h6><a href="http://www.mssi.ca" target="_blank">mssi.ca</a></h6>
              <p>mssi.ca</p>
            </div>
          </div>
        </div>
        
        <div class="column dt-sc-one-third"> 
          <div class="dt-sc-team type3">
            <div class="image">
            <a href="http://www.cheneliere.ca" target="_blank"><img src="<?php echo $imagePath; ?>/sponsors/cheneliere.jpg" alt="www.cheneliere.ca"/></a></div>
            <div class="team-details">
              <h6><a href="http://www.cheneliere.ca" target="_blank">cheneliere.ca</a></h6>
              <p>cheneliere.ca</p>
            </div>
          </div>
        </div>
        
        <div class="column dt-sc-one-third"> 
          <div class="dt-sc-team type3">
            <div class="image"><img src="<?php echo $imagePath; ?>/sponsors/pepsico.gif" alt="www.pepsico.ca/fr/index.html"/></div>
            <div class="team-details">
              <h6><a href="http://www.pepsico.ca" target="_blank">pepsico.ca</a></h6>
              <p>pepsico.ca</p>
            </div>
          </div>
        </div>
        
        
        
        <div class="column dt-sc-one-third first"> 
          <div class="dt-sc-team type3">
            <div class="image">
            <img src="<?php echo $imagePath; ?>/sponsors/blainville.jpg" alt="Boucherie Marché Blainville Ste-Thérèse"/></div>
            <div class="team-details">
              <h6><a href="https://plus.google.com/112726431954284080277/about?gl=ca&hl=en" target="_blank">Boucherie Marché Blainville Ste-Thérèse</a></h6>
              <p>Boucherie Marché Blainville Ste-Thérèse</p>
            </div>
          </div>
        </div>
        
        
        <div class="column dt-sc-one-third"> 
          <div class="dt-sc-team type3">
            <div class="image">
            <img src="<?php echo $imagePath; ?>/sponsors/polar.png" alt="www.polarbearsclub.ca"/></div>
            <div class="team-details">
              <h6><a href="http://www.polarbearsclub.ca" target="_blank">polarbearsclub.ca</a></h6>
              <p>polarbearsclub.ca</p>
            </div>
          </div>
        </div>
        
        <div class="column dt-sc-one-third"> 
          <div class="dt-sc-team type3">
            <div class="image">
            <img src="<?php echo $imagePath; ?>/sponsors/vrais-vie.jpg" alt="www.lesproductionsdanslavraievie.com"/></div>
            <div class="team-details">
              <h6><a href="http://www.lesproductionsdanslavraievie.com" target="_blank">lesproductionsdanslavraievie.com</a></h6>
              <p>lesproductionsdanslavraievie.com</p>
            </div>
          </div>
        </div>
        <div class="column dt-sc-one-third first"> 
          <div class="dt-sc-team type3">
            <div class="image">
            <img src="<?php echo $imagePath; ?>/sponsors/uniprix.png" alt="www.uniprix.com"/></div>
            <div class="team-details">
              <h6><a href="http://www.uniprix.com" target="_blank">uniprix.com</a></h6>
              <p>uniprix.com</p>
            </div>
          </div>
        </div>
    </div>
  </div>
  
  <?php } ?>
  <!-- **container - Ends** -->
  <div class="dt-sc-hr-invisible-small"></div>
</div>
