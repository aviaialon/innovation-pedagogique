<?php $products = $this->getPartialdata('products'); ?>
<input type="hidden" name="minDate" id="reportMinDate" value="" />
<input type="hidden" name="maxDate" id="reportMaxDate" value="" />
<div class="navbar navbar-inverse" role="navigation" style="position: relative; z-index: 100;">
  <ul class="nav navbar-nav navbar-right collapse" id="navbar-menu-right">
    <li class="dropdown"> 
    	<a data-toggle="dropdown" class="dropdown-toggle" onclick="javascript: window.open('<?php echo $this->route('index', null); ?>')">
        	<i class="icon-arrow2"></i> Open Admin in New Window </a></li>
    <li class="dropdown"> 
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-paragraph-justify2"></i> Bulk Actions <b class="caret"></b></a>
      <ul class="dropdown-menu icons-right dropdown-menu-right">
        <li><a href="#" data-action="enable" class="__bulk_action"><i class="icon-checkmark4"></i> Enable Selected</a></li>
        <li><a href="#" data-action="disable" class="__bulk_action"><i class="icon-angry"></i> Disable Selected</a></li>
      </ul>
    </li>
    <li class="dropdown"> 
    	<a href="<?php echo $this->route('manage', 'categories'); ?>">
        	<i class="icon-cog"></i> Manage Categories </a></li>
  </ul>
  
</div>
<div class="clear"></div>

<div class="tabbable">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#productListingTable" data-toggle="tab"><i class="icon-paragraph-left2"></i> Product Listing</a></li>
    </ul>
    <div class="tab-content with-padding">
    	<div class="tab-pane body fade in active" id="productListingTable">
            <div class="block-inner">
            <div class="clear"></div>
            <!--- CONTENT --->
            <div class="panel panel-default" id="reportProducts">
              <div class="panel-heading">
                <h2 class="panel-title main-heading">Product Catalog <span class="label label-danger">
                    <?php echo(count($products)); ?> Product<?php echo(count($products) > 1 ? 's' : ''); ?></span></h2>
              </div>
              <div class="datatable-add-row">
                <table class="table table-bordered table-striped" id="tblReportProducts">
                  <thead>
                    <tr>
                      <th class="sorting_disabled text-center"><input type="checkbox" id="bulk_all" value="" /></th>
                      <th class="image-column">Image</th>
                      <th>Product Key</th>
                      <th>Categories</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>
                        <div id="reportrange" class="range">
                            <div class="visible-xs footer-element-toggle">
                                <a class="btn btn-primary btn-icon"><i class="icon-calendar"></i></a>
                            </div>
                            <div class="date-range"></div>
                        </div>
                      </th>
                      <th>Views</th>
                      <th>Status</th>
                      <th class="team-links">Links</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th class="noFilter"></th>
                      <th class="noFilter"></th>
                      <th>Product Key</th>
                      <th>Categories</th>
                      <th>Title</th>
                      <th>Desc (EN)</th>
                      <th class=""></th>
                      <th class="noFilter"></th>
                      <th class="noFilter">
                          <select data-placeholder="Select a Status" class="select-liquid filterActiveStatus select" tabindex="2">
                            <option value="">Any Status</option>
                            <option value="Active">Active</option>
                            <option value="Disabled">Disabled</option>
                        </select>
                      </th>
                      <th class="noFilter"></th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php foreach ($products as $index => $product) { ?>
                    <?php
                        $image = $product['mainImage'];
                        if (empty($image) === true && false === empty($product['images'])) {
                            $images = explode('|', $product['images']);
                            if (false === empty($images)) {
                                $image = $images[0];
                            }
                        }
                        
                        if (empty($image) === false)
                            $image = (\Core\Hybernate\Products\Product_Image_Position::getImagePositionWebDirecotryPath(2) . '/' . $image);
                    ?>
                    <tr id="p_<?php echo $product['id']; ?>">
                      <td class="text-center">
                        <input type="checkbox" name="bulk[]" class="bulk_chkbx" value="<?php echo $product['id']; ?>" />    
                      </td>
                      <td class="text-center p_image"><img src="<?php echo($image); ?>" alt="" class="img-media"></td>
                      <td class="text-semibold p_productKey text-center" style="max-width: 150px"><?php echo $product['productKey']; ?></td>
                      <td class="p_title text-center ">
                      	<div class="btn-group">
                        	<?php
								if (empty($product['catGroupEn']) === false) {
									$categoryArray = explode('|', $product['catGroupEn']);
									$count = count($categoryArray);
							?>
                                <button type="button" data-toggle="dropdown" class="btn btn-link dropdown-toggle">
                                    <span class="label label-<?php echo ($count >= 1 ? 'info' : 'danger'); ?>"><?php echo ($count); ?></span> 
                                    &nbsp;&nbsp;Categories <span class="caret"></span></button>
                                <ul class="dropdown-menu scrolldp">
                                    <?php foreach ($categoryArray as $category) { ?>
                                    <li><a href="#"><?php echo $category; ?></a></li>
                                    <?php } ?>
                                </ul>
                            <?php } else { ?>
                            	<a href="<?php echo $this->route('manage', 'manage-product', array('id' => $product['id'], 'panel' => 'categories')); ?>">
                                	<span class="label label-danger">No Category</span></a>
                            <?php } ?>    
                        </div>
                      </td>
                      <td class="muted p_title" style="max-width: 220px"><?php echo $product['title']; ?></td>
                      <td class="muted p_desc" style="max-width: 600px"><div class="productDesc"><?php echo substr(strip_tags($product['description']), 0, 150); ?>...</div></td>
                      <td class="muted text-center p_date" style="min-width: 180px"><?php echo date('Y-m-d', strtotime($product['dateCreated'])); ?></td>
                      <td class="muted text-center" width="60">
                         <strong class="text-danger p_views"><?php echo $product['views']; ?></strong>
                       </td>
                       <td class="muted text-center p_status">
                         <span class="label label-<?php echo ((int) $product['activeStatus'] === 1 ? 'success' : 'danger'); ?>">
                            <?php echo ((int) $product['activeStatus'] === 1 ? 'Active' : 'Disabled'); ?>
                         </span>
                       </td>
                      
                      <td class="text-center">
                        <div class="btn-group">
                            <!--<button class="btn btn-icon btn-default"><i class="icon-spinner3"></i></button>-->
                            <a class="btn btn-icon btn-default" title="Edit This Product" href="<?php echo $this->route('manage', 'manage-product', array('id' => $product['id'])); ?>">
                                <i class="icon-pencil"></i></a>
                            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="height: 38px;"><span class="caret caret-split"></span></button>
                            <ul class="dropdown-menu icons-right leftmenu">
                                <li><a class="btnEditProduct" href="<?php echo $this->route('manage', 'product', array('id' => $product['id'])); ?>">
                                <i class="icon-share2"></i> Quick Edit</a></li>
                                <li><a class="btnEditProduct" href="<?php echo $this->route('manage', 'product', array('id' => $product['id'], 'panel' => 'images')); ?>">
                                    <i class="icon-stack"></i> Edit Images</a></li>
                                <li><a href="#"><i class="icon-remove3"></i> Delete</a></li>
                                <li><a href="#"><i class="icon-eye"></i> View Product</a></li>
                            </ul>
                        </div>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!--- CONTENT EOF --->
            <div class="clear"></div>
            </div>         
        </div>
    </div>
</div>

<div id="edProdModalDialog" class="modal fade" tabindex="-1" role="dialog" style="text-align:left">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
        </div>
    </div>
</div>