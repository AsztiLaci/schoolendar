<?php include('elements/header.php'); ?>


<div>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo(URL::to('/')) ?>">Schoolender</a>
        </li>
        <li>
            <a href="<?=Route::current()->getPath()?>">Saját profil</a>
        </li>
    </ul>
</div>
<div class="row">
   <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Profil adatok</h2>

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
                        <label for="">Email cím:</label>
                        <p><?php echo(Auth::user()->email); ?></p>
                    </div>
		    <div class="form-group">
                        <label for="">Név:</label>
                        <p><?php echo(Auth::user()->displayname); ?></p>
                    </div>
                    <div class="form-group">
                        <label for="password">Jelszó</label>
			<p><?php echo Form::password('password', array('class' => 'form-control', 'id' => 'password'));?></p>
                    </div>
                    <div class="form-group">
                        <label for="password-check">Jelszó megerősítése</label>
			<p><?php echo Form::password('password-check', array('class' => 'form-control', 'id' => 'password-check'));?></p>
                    </div>
                    <button type="submit" id="mentes" class="btn btn-default">Mentés</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    $("#mentes").click(function(){
	
        $(".passwarn").remove();
        var hasError = false;
        var passwordVal = $("#password").val();
        var checkVal = $("#password-check").val();
        if (passwordVal == '') {
            $("#password").after('<span class="passwarn label label-warning">Kérjük adja meg jelszavát.</span>');
            hasError = true;
	} else if (passwordVal.length < 6) {
            $("#password").after('<span class="passwarn label label-warning">A jelszónak legalább 6 karakternek kell lennie.</span>');
            hasError = true;
        } else if (checkVal == '') {
            $("#password-check").after('<span class="passwarn label label-warning">Kérjük erősítse meg jelszavát.</span>');
            hasError = true;
        } else if (passwordVal != checkVal ) {
            $("#password-check").after('<span class="passwarn label label-warning">A jelszavak nem egyeznek.</span>');
            hasError = true;
        }
        if(hasError == true) {return false;}
    });
</script>
<?php include('elements/footer.php'); ?>
