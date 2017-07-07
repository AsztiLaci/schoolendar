<?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>
    <!-- content ends -->
    </div><!--/#content.col-md-0-->
<?php } ?>
</div><!--/fluid-row-->
<?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>
    <hr>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Beállítások</h3>
                </div>
                <div class="modal-body">
                    <p>Ide be lehet dobálni majd valamit...</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a>
                </div>
            </div>
        </div>
    </div>

    <footer class="row">
        <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; <a href="<?php URL::to('/');?>" target="_blank">Schoolendar</a> 2017 - <?php echo date('Y') ?></p>

        <p class="col-md-3 col-sm-3 col-xs-12 powered-by">Powered by: <a
                href="https://laravel.com">Laravel</a></p>
    </footer>
<?php } ?>

</div><!--/.fluid-container-->

<?php if(isset($notify)){ ?>
<script>
$(document).ready(function () {
	noty({"text":"<?=$notify?>","layout":"bottomRight","type":"alert","animateOpen": {"opacity": "show"}})
})
</script>
<?php } ?>
<!-- external javascript -->

<script src="<?=URL::to('/')?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- library for cookie management -->
<script src="<?=URL::to('/')?>/js/jquery.cookie.js"></script>
<!-- calender plugin -->
<script src='<?=URL::to('/')?>/bower_components/moment/min/moment.min.js'></script>
<script src='<?=URL::to('/')?>/bower_components/fullcalendar/dist/fullcalendar.min.js'></script>
<script src='<?=URL::to('/')?>/bower_components/fullcalendar/dist/lang-all.js'></script>
<!-- data table plugin -->
<script src='<?=URL::to('/')?>/js/jquery.dataTables.min.js'></script>

<!-- select or dropdown enhancer -->
<script src="<?=URL::to('/')?>/bower_components/chosen/chosen.jquery.min.js"></script>
<!-- plugin for gallery image view -->
<script src="<?=URL::to('/')?>/bower_components/colorbox/jquery.colorbox-min.js"></script>
<!-- notification plugin -->
<script src="<?=URL::to('/')?>/js/jquery.noty.js"></script>
<!-- library for making tables responsive -->
<script src="<?=URL::to('/')?>/bower_components/responsive-tables/responsive-tables.js"></script>
<!-- tour plugin -->
<script src="<?=URL::to('/')?>/bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
<!-- star rating plugin -->
<script src="<?=URL::to('/')?>/js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="<?=URL::to('/')?>/js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="<?=URL::to('/')?>/js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="<?=URL::to('/')?>/js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="<?=URL::to('/')?>/js/jquery.history.js"></script>
<!-- app JS -->
<script src="<?=URL::to('/')?>/js/schoolendar.js"></script>

</body>
</html>
