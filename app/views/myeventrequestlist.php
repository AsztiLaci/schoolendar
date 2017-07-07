<?php require('elements/header.php'); ?>
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="<?=URL::to('/')?>">Schoolender</a>
            </li>
            <li>
                <a href="<?=URL::to('eventrequests')?>">Időpont kérések</a>
            </li>
        </ul>
    </div>

    <div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-list-alt"></i> Időpont kérések lista</h2>

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
        <th>Tárgy</th>
        <th>Leírás</th>
		<?php if (Auth::user()->type==4) {
			echo "<th>Címzett</th>";
		} else {
			echo "<th>Kérvényező</th>";
		}?>
        <th>Státusz</th>
		<th>Időpont</th>
		<?php if (Auth::user()->type!=4) { ?>
        <th>Műveletek</th>
		<?php } ?>
    </tr>
    </thead>
    <tbody>
	<?php if(!is_null($myevents)){
		foreach($myevents as $event){ ?>
    <tr id="sor_<?=$event['id']?>">
        <td><?=$event['title']?></td>
        <td class="center"><?=Str::limit($event['description'], $limit = 30, $end = '...')?></td>
		<?php if (Auth::user()->type==4) { ?>
			<td class="center"><?=User::find($event['to_id'])->displayname;?></td>
		<?php } else { ?>
			<td class="center"><?=User::find($event['from_id'])->displayname;?></td>
		<?php } ?>
		<td id="<?=$event['id']?>_status"><span class="label-default label <?php if($event['status']==0) { echo "label-danger"; } elseif($event['status']==3) { echo "label-success"; } else { echo "label-default"; } ?>"><?=$status[$event['status']]?></td>
		<td class="center"><?=str_replace(' 00:00:00', '', $event['date']);?></td>
        <?php if (Auth::user()->type!=4) { ?>
		<td class="center">
            <a class="btn btn-info" href="<?=URL::to('eventrequest')?>/<?=$event['id']?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Megtekint
            </a>
			<?php if($event['status']!=0 && $event['status']!=3){ ?>
            <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#eventDel" onClick="seventdel(<?=$event['id']?>)">
                <i class="glyphicon glyphicon-trash icon-white"></i>
                Elutasít
            </a>
			<?php } ?>
        </td>
		<?php } ?>
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
			//$("#torol").attr("href", "<?=URL::to('newsdel')?>/" + id)
			url="<?=URL::to('eventreqdeny')?>/" + id;
			nid=id;
		}
		$(document).ready(function() {
    			$("#torol").click(function() {
				posting = $.ajax({
        			type: "GET",
        			url: url,
        			success: function()
        			{   
        			$('#sor_' + nid + ' .btn-danger').fadeOut();
					$('#'+ nid + '_status').html('Elutasítva');
					noty({"text":"Kérés elutasítva!","layout":"bottomRight","type":"success","animateOpen": {"opacity": "show"}});
					

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
                    <h3>Elutasítás</h3>
                </div>
                <div class="modal-body">
                    <p>Biztosan el szeretné utasítani az érintett időpont kérést?</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Mégse</a>
                    <a id="torol" href="#" class="btn btn-danger" data-dismiss="modal">Elutasít</a>
                </div>
            </div>
        </div>
    </div>

<?php require('elements/footer.php'); ?>
