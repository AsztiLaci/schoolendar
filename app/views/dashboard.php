<?php include('elements/header.php'); ?>


<div>
    <ul class="breadcrumb">
        <li>
            <a href="/">Schoolender</a>
        </li>
    </ul>
</div>
<?php foreach ($news as $newse): ?>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-star-empty"></i> <?php echo $newse->title; ?></h2>

                <div class="box-icon">
		<?php  if ((Auth::user()->type<2)){ ?>
                    <a href="<?=URL::to('newsedit')?>/<?=$newse['id']?>" class="btn btn-round btn-default"><i
                            class="glyphicon glyphicon-cog"></i></a>
		<?php } ?>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <?php echo nl2br($newse->description); ?>
            </div>
        </div>
    </div>
</div><!--/row-->
<?php endforeach; ?>

<?php echo $news->links(); ?>


<?php include('elements/footer.php'); ?>
