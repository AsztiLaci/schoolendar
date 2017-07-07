<?php include('elements/header.php'); ?>


<div>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo(URL::to('/')) ?>">Schoolender</a>
        </li>
	<li>
            <a href="<?php echo(URL::to('eventrequests')) ?>">Időpont kérések</a>
        </li>
        <li>
            <a href="<?=URL::current()?>"><?php if(!is_null($eventreq["id"])){echo $eventreq["title"];} else {echo "Új kérés";}?></a>
        </li>
    </ul>
</div>
<div class="row">
   <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> <?php if(!is_null($eventreq["id"])){ echo $eventreq["title"]; } else { echo "Új időpont kérés"; } ?></h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
		
		<form role="form" method="post">
			<?php if($eventreq["from_id"]==Auth::user()->id){ ?>
			<div class="form-group">
                <label><h4>Címzett:</h4></label>
				<p><?=User::find($eventreq["to_id"])->displayname;?></p>
		    </div>
			<?php } ?>
		    <div class="form-group">
                <label><h4>Időpont kérés tárgya:</h4></label>
				<p><?=$eventreq["title"];?></p>
		    </div>
            <div class="form-group">
                <label><h4>Leírás:</h4></label>
				<blockquote>
				<p><?=nl2br($eventreq["description"]);?></p>
				<small>
					<a href="#"><?=User::find($eventreq["from_id"])->displayname;?></a>
				</small>
				</blockquote>
		    </div>
			
		    <div class="form-group">
                <label><h4>Találkozó időpontja:</h4></label>
                <p><?=str_replace(' 00:00:00', '', $eventreq['date']);?></p>
            </div>
			<div class="form-group">
                <label><h4>Állapot:</h4></label>
				<p id="reqstatus"><?=$status[$eventreq["status"]];?></p>
		    </div>
			<?php if($eventreq["to_id"]==Auth::user()->id && $eventreq["status"]!=0 && $eventreq['status']!=3){ ?>
			<div id="reqcontroll">
		    <div class="form-group">
                        <label for="start">Kezdés:</label>
                        <?php echo Form::text('start', '', array('class' => 'form-control dtpicker', 'id' => 'start'));?>
                    </div>
		    <div class="form-group">
                        <label for="end">Vége:</label>
                        <?php echo Form::text('end', '', array('class' => 'form-control dtpicker', 'id' => 'end'));?>
                    </div>
                    <button type="submit" id="mentes" class="btn btn-default">Jóváhagy</button>
					<a href="#" data-toggle="modal" data-target="#requestDel" class="btn btn-danger">Elutasít</a>
					<?php } ?>
                </form>

            </div>
			</div>
        </div>
    </div>
</div>


<div class="modal fade" id="requestDel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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

<script type="text/javascript">
		$.datetimepicker.setLocale('hu');
		$('.dtpicker').datetimepicker({
			dayOfWeekStart : 1,
			lang:'hu',
			format:'Y-m-d H:i',
			allowDates: ['<?=str_replace(' 00:00:00', '', $eventreq['date']);?>'], 
			formatDate:'Y-m-d',
			defaultDate: '<?=str_replace(' 00:00:00', '', $eventreq['date']);?>',
			onGenerate: function(current_time,$input){}
		});	
		url="<?=URL::to('eventreqdeny')?>/<?=$eventreq["id"]?>";
		
		$(document).ready(function() {
    			$("#torol").click(function() {
				posting = $.ajax({
        			type: "GET",
        			url: url,
        			success: function()
        			{   
        			$('#reqcontroll').fadeOut();
					$('#reqstatus').html('Elutasítva');
					noty({"text":"Kérés elutasítva!","layout":"bottomRight","type":"success","animateOpen": {"opacity": "show"}});
					

				}
    				});
				
			});
		});
		
		//php oldalról is validalni kell majd
		$("#mentes").click(function(){

        var hasError = false;
        var fromtime = $("#start").val();
        var totime = $("#end").val();
        if (fromtime == '' || totime == '') {
            noty({"text":"A jóváhagyáshoz kérem adja meg a találkozó pontos kezdet és vége időpontját!","layout":"bottomRight","type":"alert","animateOpen": {"opacity": "show"}});
            hasError = true;
        }
        if(hasError == true) {return false;}
		});
		</script>

<?php include('elements/footer.php'); ?>
