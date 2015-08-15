<div id="confirm_deleteImg_modal" class="modal fade" tabindex="-1" role="dialog" style="z-index:1500">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header info">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Please Confirm.</h4>
            </div>
            <div class="modal-body with-padding">
                <div class="confImg"></div>
                <div class="confTxt">
                    <h5 class="text-error">Confirm Delete!</h5>
                    <p>You are about to delete this image from the server. Please confirm as this is not un-doable.</p>
                </div>                
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-danger confirmDeleteImageBtn">Confirm</button>
            </div>
        </div>
    </div>
</div>

<div id="confirm_deleteManual_modal" class="modal fade" tabindex="-1" role="dialog" style="z-index:1500">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header info">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Please Confirm.</h4>
            </div>
            <div class="modal-body with-padding">
                <div class="confTxt">
                    <h5 class="text-error">Confirm Delete!</h5>
                    <p>You are about to delete this manual from the server. Please confirm as this is not un-doable.</p>
                </div>                
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-danger confirmDeleteManualBtn">Confirm</button>
            </div>
        </div>
    </div>
</div>

<div id="changes_not_applied" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="alert alert-block alert-warning fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h6><i class="icon-command"></i> Oh snap! You have unsaved changes!</h6>
                <hr>
                <p>It seems that you have made changes and forgot to save them.</p><br>
                <div class="text-left">
                    <a class="btn btn-danger" id="takeMeBack" href="#"><i class="icon-link"></i> Take me back!</a> 
                    <a class="btn btn-info" id="ignoreTackmeBack" href="#"><i class="icon-link2"></i> Chill out, i know what im doing</a>
                </div>
            </div>	
        </div>
    </div>
</div>


<div class="modal fade" id="addNewManual" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body">

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>