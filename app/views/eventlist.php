<?php require('elements/header.php'); ?>
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="<?=URL::to('/')?>">Schoolender</a>
            </li>
            <li>
                <a href="<?=URL::to('eventlist')?>">Események</a>
            </li>
        </ul>
    </div>

    <div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-calendar"></i> Események lista</h2>

        <div class="box-icon">
        <!-- <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a> -->
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        <th>Név</th>
        <th>Leírás</th>
        <th>Típus</th>
        <th>Időpont</th>
        <th>Műveletek</th>
    </tr>
    </thead>
    <tbody>
	<?php if(!is_null($events)){
		foreach($events as $event){ ?>
    <tr id="sor_<?=$event['id']?>">
        <td><?=$event['title']?></td>
        <td class="center"><?=Str::limit($event['description'], $limit = 30, $end = '...')?></td>
        <td class="center"><?=$eventtypes[$event['type']]?></td>
        <td class="center"><?=$event['start'];?> - <?=$event['end'];?></td>
        <td class="center">
            <a class="btn btn-info" href="<?=URL::to('eventedit')?>/<?=$event['id']?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Szerkeszt
            </a>
            <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#eventDel" onClick="seventdel(<?=$event['id']?>)">
                <i class="glyphicon glyphicon-trash icon-white"></i>
                Töröl
            </a>
        </td>
    </tr>
    <?php }} ?>
	</tbody>
    </table>
    </div>
    </div>
    </div>
    <!--/span-->
    </div><!--/row-->
	<script>
		var url;
		var nid;
		function seventdel(id){
			//$("#torol").attr("href", "<?=URL::to('eventdel')?>/" + id)
			url="<?=URL::to('eventdel')?>/" + id;
			nid=id;
		}
		$(document).ready(function() {
    			$("#torol").click(function() {
				posting = $.ajax({
        			type: "GET",
        			url: url,
        			success: function()
        			{   
        				$('#sor_' + nid).fadeOut();
					noty({"text":"Esemény törölve!","layout":"bottomRight","type":"success","animateOpen": {"opacity": "show"}});

				}
    				});
				
			});
		});
	</script>

	<div class="modal fade" id="eventDel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Esemény törlése</h3>
                </div>
                <div class="modal-body">
                    <p>Biztosan törölni szeretné az eseményt?</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Mégse</a>
                    <a id="torol" href="#" class="btn btn-danger" data-dismiss="modal">Törlés</a>
                </div>
            </div>
        </div>
    </div>

<?php require('elements/footer.php'); ?>
