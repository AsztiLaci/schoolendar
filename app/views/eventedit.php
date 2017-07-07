<?php include('elements/header.php'); ?>


<div>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo(URL::to('/')) ?>">Schoolender</a>
        </li>
	<li>
            <a href="<?php echo(URL::to('eventrequests')) ?>">Események</a>
        </li>
        <li>
            <a href="<?=URL::current()?>"><?php if(!is_null($event["id"])){echo $event["title"];} else {echo "Új esemény";}?></a>
        </li>
    </ul>
</div>
<div class="row">
   <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> <?php if(!is_null($event["id"])){echo "Esemény szerkesztése"; } else {echo "Új esemény adatai"; } ?></h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
		
		<form role="form" method="post">
		    <div class="form-group">
                        <label for="type">Esemény neve:</label>
			 <?php echo Form::select('type', $eventtypes, $event["type"], array('class' => 'form-control'));?>
		    </div>
                    <div class="form-group">
                        <label for="title">Esemény neve:</label>
			<?php echo Form::text('title', $event["title"], array('class' => 'form-control'));?> 
                    </div>
		    <div class="form-group">
                        <label for="description">Leírás:</label>
                        <?php echo Form::textArea('description', $event["description"], array('class' => 'form-control'));?>
                    </div>
		    <div class="form-group">
                        <label for="from">Kezdés:</label>
                        <?php echo Form::text('start', $event["start"], array('class' => 'form-control dtpicker'));?>
                    </div>
		    <div class="form-group">
                        <label for="to">Vége:</label>
                        <?php echo Form::text('end', $event["end"], array('class' => 'form-control dtpicker'));?>
                    </div>
                    <button type="submit" id="mentes" class="btn btn-default">Mentés</button>
                </form>

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
			defaultDate: new Date(),
			onGenerate: function(current_time,$input){}
		});	
		</script>

<?php include('elements/footer.php'); ?>
