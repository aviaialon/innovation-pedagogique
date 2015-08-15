<?php
    $category   = $this->getViewData('category');
	$modalTitle = $this->getViewData('title');
	$product = \Core\Hybernate\Products\Product::getInstance(1);
?>
<style type="text/css">
	.block-inner {padding: 10px 15px;}
	.addAttribute {margin-top: 35px;}
</style>
<div class="modal-backdrop fade hide editProdBackdrop"></div>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title"><i class="icon-quill2"></i> <?php echo $modalTitle; ?></h4>
</div>

<form id="editCategoryForm" class="validate">
<div class="modal-body with-padding with-padding-b0 productEditor">


    <div class="tabbable">
    	<?php if ($category->getId() > 0) { ?>
    		<button type="button" class="btn btn-danger pull-right btnDeleteCategory" data-category-id="<?php echo $category->getId(); ?>">
            	<i class="icon-remove3"></i> Delete This Category</button>
        <?php } ?>
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tabModal1" data-toggle="tab"><i class="icon-paragraph-left2"></i> Category Info</a></li>
        </ul>
        <div class="tab-content">
            <input type="hidden" name="categoryId" value="<?php echo($category->getId()); ?>" class="productId" />
            
            <div class="tab-pane fade in active" id="tabModal1"> 
            
                <div class="block-inner">
                    <div class="form-group no-margin">
                        <div class="row">
                            <div class="col-md-6">
                              <label>(EN) Category Name:</label>
                              <input type="text" class="form-control required " name="name_en" placeholder="Title (English)"
                                                                    value="<?php echo($category->getName_En()); ?>" />
                            </div>
                            <div class="col-md-6">
                              <label>(FR) Category Name:</label>
                              <input type="text" class="form-control required " name="name_fr" placeholder="Title (French)"
                                                                    value="<?php echo($category->getName_Fr()); ?>" />
                            </div>
    					</div>
                        <div class="clear"></div>
                        <div class="clear"></div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Will this be a main category?</label>
                            </div>
                            <div class="col-md-6">    
                                <select data-placeholder="Select a Status" class="select-liquid select isParent" tabindex="2" name="is_parent" <?php echo $readOnly; ?>>
                                    <option value="1" <?php echo(((int) $category->getIsParent()) === 1 ? 'selected="selected"' : ''); ?>>Yes - Make this a main category</option>
                                    <option value="0" <?php echo(((int) $category->getIsParent()) === 0 ? 'selected="selected"' : ''); ?>>No - Make this a sub category</option>
                                </select>
                            </div>
                        </div>
    
                        <br />
                    </div>
            	</div>
                
            </div>

        </div>
    </div>
    <!-- edit form eof -->
</div>
</form>

<div class="modal-footer">
    <button class="btn btn-warning" data-dismiss="modal">Close</button>
    <button class="btn btn-primary categorySave">Save</button>
</div>

<script type="text/javascript">
	$(document).ready(function(e) {
        $(".isParent").select2({
			minimumResultsForSearch: "-1",
			width: "100%"
		}).select2('readonly', <?php echo (($category->getId()) ? 'true' : 'false'); ?>);
		
		SYSTEM.APPLICATION.STATIC_INSTANCE.configure(SYSTEM.APPLICATION.MAIN.CONFIGURATION.CATEGORY_EDITSAVE_URL, '<?php echo $this->getViewData('editCategorySaveUrl'); ?>');
		SYSTEM.APPLICATION.STATIC_INSTANCE.configure(SYSTEM.APPLICATION.MAIN.CONFIGURATION.CATEGORY_DELETE_URL, '<?php echo $this->getViewData('deleteCategoryUrl'); ?>');
	    SYSTEM.APPLICATION.STATIC_INSTANCE.startModule(SYSTEM.APPLICATION.MAIN.MODULE.CATEGORY_EDITOR_EVENTS); 
    });
</script>