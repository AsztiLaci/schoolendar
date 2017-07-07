<?php include('elements/header.php'); ?>


<div>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo(URL::to('/')) ?>">Schoolender</a>
        </li>
	<li>
            <a href="<?php echo(URL::to('newslist')) ?>">Hírek</a>
        </li>
        <li>
            <a href="<?=URL::current()?>"><?php if(!is_null($news["id"])){echo $news["title"];} else {echo "Új hír";}?></a>
        </li>
    </ul>
</div>
<div class="row">
   <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Hír adatok</h2>

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
                        <label for="title">Cím:</label>
			<?php
			echo Form::text('title', $news["title"], array('class' => 'form-control')); ?> 
                    </div>
		    <div class="form-group">
                        <label for="description">Hír:</label>
                        <?php echo Form::textarea('description', $news["description"], array('class' => 'form-control'));?>
                    </div>
                    <button type="submit" id="mentes" class="btn btn-default">Mentés</button>
                </form>

            </div>
        </div>
    </div>
</div>

<?php include('elements/footer.php'); ?>
