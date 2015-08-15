<?php
/*
 * Product search box plugin
 */
$__Application      = \Core\Application::getInstance();
$__apiTokenUrl      = '/catalog/api/?token=' .
					  \Core\Net\Router::callbackToken(new \Core\Inp\Products\Ajax_Search(), 'findBy', array(array('keyword' => true)));
$__parentCategories = \Core\Hybernate\Products\Product_Category::getMultiInstance(array('isParent' => 1), true, 
					array('order_by' => sprintf('a.orderIndex ASC, a.name_%s ASC', $__Application->translate('en', 'fr'))));
					
$sources    = array();
$catFilters = array();

$sources[$__Application->translate('All Categories', 'Toute Categories')] = array(
	'url' => array(
		array (
			'type' => 'GET',
			'url'  => $__apiTokenUrl,
			'data' => array('keyword' => "{{query}}")	
		), 'results'
	)
);

foreach ($__parentCategories as $__category) {
	$catFilters[$__category[$__Application->translate('name_en', 'name_fr')]] = array (
		'name'       => $__category[$__Application->translate('name_en', 'name_fr')],
		'categoryId' => $__category['id'],
		'url'  		 => $__apiTokenUrl
	);
}
?>

<div class="search">
    <form id="__productPartFinder" name="__productPartFinder"  action="">
        <div class="typeahead-container __productSelector">
          <div class="typeahead-field "> <span class="typeahead-query">
            <input id="__productId" name="__productId" type="hidden" value="" />
            <input id="__categoryId" name="__categoryId" type="hidden" value="" />
            <input id="__keyword" name="__keyword" type="search" placeholder="<?php echo $__Application->translate('Search', 'Recherche'); ?>" autocomplete="off" />
            </span> <span class="typeahead-button">
            <button type="submit"> <i class="search-icon"></i> </button>
            </span> </div>
        </div>
    </form> 
</div>

<script type="text/javascript">
	jQuery(document).ready(function($) {
        Parts_Search.setSearchPageUrl('<?php echo $__Application->getRequestDispatcher()->route('projects', null, array()); ?>');
		Parts_Search.setSources(<?php echo json_encode($sources); ?>);
		Parts_Search.setFilters(<?php echo json_encode($catFilters); ?>);
		Parts_Search.setLang('<?php echo $__Application->translate('en', 'fr'); ?>');
		Parts_Search.init();
    });
</script>