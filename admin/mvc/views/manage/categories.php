<?php 
	$categoryTree     = $this->getViewData('categoryTree');
	$subCategories    = $this->getViewData('subCategories');
	$parentCategories = $this->getViewData('parentCategories');
?>
<style type="text/css">
.no-sort::after { display: none!important; }
.no-sort { pointer-events: none!important; cursor: default !important; background: none; padding-right: 0px;}
.no-sort a { pointer-events: auto !important; cursor: pointer !important;}
#tblReportCategories { margin-bottom: 0px; border-bottom: 0px;}
</style> 
<form id="categoryManagementForm">
<div class="tabbable">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#productListingTable" data-toggle="tab"><i class="icon-paragraph-left2"></i> Category Listing</a></li>
    </ul>
    <div class="tab-content with-padding">
    	<div class="tab-pane body fade in active" id="productListingTable">
            <div class="block-inner">
            <div class="clear"></div>
            <!--- CONTENT --->
            <div class="panel panel-default" id="reportCategories">
              <div class="panel-heading">
                <h2 class="panel-title main-heading"><span class="label label-danger">
                    <?php echo(count($subCategories) + count($parentCategories)); ?></span> Categories</h2>
              </div>
              <div class="datatable-add-row">
                <table class="table table-bordered table-striped" id="tblReportCategories">
                  <thead>
                    <tr>
                      <th class="text-center">-- Sub Categories --</th>
                      <?php foreach ($parentCategories as $parentCategory) { ?>
                      	<th class="text-center">
                            <a href="<?php echo $this->route('manage', 'manage-category', array('id' => $parentCategory['id'])); ?>" 
                            	title="Click to edit" data-category-id="<?php echo ($parentCategory['id']); ?>"
                            	 class="editCategory editCategory_<?php echo ($parentCategory['id']); ?>"><?php echo ($parentCategory['name_en']); ?></a> 
                        </th>
                      <?php } ?>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th></th>
                        <?php foreach ($parentCategories as $parentCategory) { ?>
                        	<th class="noFilter">
                                  <select data-placeholder="Select a Status" class="select-liquid filterActiveStatus select" tabindex="2">
                                    <option value="">All</option>
                                    <option value="category_checked">Selected</option>
                                    <option value="category_unchecked">Not Selected</option>
                                </select>
                            </th>
                        <?php } ?>
                    </tr>
                  </tfoot>
                  <tbody>
                  	<?php foreach ($subCategories as $subCategory) { ?>
                    	<tr id="cat_<?php echo $subCategory['id']; ?>">
                        	<td class="muted p_title" style="max-width: 220px; font-weight:bold">
                                <a href="<?php echo $this->route('manage', 'manage-category', array('id' => $subCategory['id'])); ?>" 
                                	title="Click to edit" data-category-id="<?php echo ($subCategory['id']); ?>" 
                                	class="editCategory editCategory_<?php echo ($subCategory['id']); ?>"><?php echo ($subCategory['name_en']); ?></a>
                            </td>
							<?php foreach ($parentCategories as $parentCategory) { ?>
                            	<td class="text-center">
                                	<?php
										$checked = '';
										$status  = 'category_unchecked';
										$ogChk   = false;
										if (true === array_key_exists($subCategory['id'], $categoryTree[$parentCategory['id']]['children'])) {
											$checked = 'checked="checked"';
											$status  = 'category_checked';
											$ogChk   = true;
										}
									?>
                                    <label class="checkbox-inline checkbox-info">
                                    	<span class="hide"><?php echo $status; ?></span>
                                        <input type="checkbox" name="category[<?php echo $subCategory['id']; ?>]" 
                                        	data-og-checked="<?php echo $ogChk; ?>" 
                                        	data-category-id="<?php echo $subCategory['id']; ?>" 
                                        	value="<?php echo $parentCategory['id']; ?>" 
                                            class="styled categorySelection" <?php echo $checked; ?> />
                                    </label>    
                                </td>
                            <?php } ?>
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
</form>
<div id="editCatModalDialog" class="modal fade" tabindex="-1" role="dialog" style="text-align:left">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
        </div>
    </div>
</div>


<div id="confirm_deleteImg_modal" class="modal fade" tabindex="-1" role="dialog" style="z-index:1500">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header info">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Please Confirm.</h4>
            </div>
            <div class="modal-body with-padding">
                <div class="confTxt">
                    <h5 class="text-error">Confirm Delete!</h5>
                    <p>You are about to delete this category. Please confirm as this is not un-doable.</p>
                </div>      
                <br />      
                <br />          
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-danger confirmDeleteCategoryBtn">Confirm</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function(e) {
       	SYSTEM.APPLICATION.STATIC_INSTANCE.configure(SYSTEM.APPLICATION.MAIN.CONFIGURATION.CATEGORY_SAVE_URL, '<?php echo $this->getViewData('categorySaveUrl'); ?>');
       	SYSTEM.APPLICATION.STATIC_INSTANCE.configure(SYSTEM.APPLICATION.MAIN.CONFIGURATION.CATEGORY_ADD_URL, '<?php echo $this->route('manage', 'manage-category', array()); ?>');
	    SYSTEM.APPLICATION.STATIC_INSTANCE.startModule(SYSTEM.APPLICATION.MAIN.MODULE.CATEGORY_LISTING_EVENTS); 
    });
</script>