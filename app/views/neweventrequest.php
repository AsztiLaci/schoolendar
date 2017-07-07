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
            <a href="<?=Route::current()->getPath()?>">Új időpont kérés</a>
        </li>
    </ul>
</div>
<div class="row">
   <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Új időpont kérés</h2>

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
                        <label for="to">Címzett:</label>
			<p>
			<select id="to" name="to" data-rel="chosen" class="">
                        <?php 
				foreach($tanarikar as $tkelem){
				//echo Form::select('to', $tanarikar, '', array('class' => 'form-control chosen-container chosen-container-single'));?>
                    		<option value="<?=$tkelem['id']?>"><?=$tkelem['displayname']?> (<?=$usertypes[$tkelem['type']]?>)</option>	 
			<?php } ?>
			</select>
			</p>
		    </div>
                    <div class="form-group">
                        <label for="title">Tárgy:</label>
			<?php echo Form::text('title', '', array('class' => 'form-control'));?> 
                    </div>
		    <div class="form-group">
                        <label for="displayname">Megjegyzés:</label>
                        <?php echo Form::textArea('description', '', array('class' => 'form-control'));?>
                    </div>
		    <div class="form-group">
                        <label for="date">Időpont:</label>
                        <?php echo Form::text('date', '', array('class' => 'form-control dtpicker'));?>
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
			format:'Y-m-d',
			defaultDate: new Date(),
			timepicker:false,
			onGenerate: function(current_time,$input){}
		});	
		</script>

<?php include('elements/footer.php'); ?>
