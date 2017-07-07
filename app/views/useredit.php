<?php include('elements/header.php'); ?>


<div>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo(URL::to('/')) ?>">Schoolender</a>
        </li>
	<li>
            <a href="<?php echo(URL::to('userlist')) ?>">Felhasználók</a>
        </li>
        <li>
            <a href="<?=URL::current()?>"><?php if(!is_null($user["id"])){echo $user["displayname"];} else {echo "Új felhasználó";}?></a>
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
                        <label for="email">Email cím:</label>
			<?php if(!is_null($user["id"])){ ?>
                        <p><?php echo($user['email']); ?></p>
			<?php } else {
			echo Form::text('email', $user["email"], array('class' => 'form-control')); }?> 
                    </div>
		    <div class="form-group">
                        <label for="displayname">Név:</label>
                        <?php echo Form::text('displayname', $user["displayname"], array('class' => 'form-control'));?>
                    </div>
		    <div class="form-group">
			<label for="type">Típus:</label>
			<?php echo Form::select('type', $usertypes, $user["type"], array('class' => 'form-control'));?>
		    </div>
                    <div class="form-group">
                        <label for="password">Jelszó</label>
                        <input type="text" class="form-control" id="password" name="password" placeholder="Jelszó">
                    </div>
                    <div class="form-group">
                        <a href="#" class="passworder btn btn-default" data-length="10" data-target="#password">Jelszó generálás</a>
                    </div>
                    <button type="submit" id="mentes" class="btn btn-default">Mentés</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    (function () {
  var rand = function (str) {
    return str[Math.floor (Math.random () * str.length)];
  };

  var get = function (source, len, a) {
    for (var i = 0; i < len; i++)
      a.push (rand (source));
    return a;
  };

  var alpha  = function (len, a) {
    return get ("A1BCD2EFG3HIJ4KLM5NOP6QRS7TUV8WXY9Z", len, a);
  };
  var symbol = function (len, a) {
    return get ("-:;_$!", len, a);
  };

  $('.passworder').click(function(event){
    event.preventDefault ();

    var widget = $(this);
    var target = $(widget.data ('target'));

    var length = widget.data ('length') - 1;

    // Alpha{ceil((length-1)/2))} Symbol Alpha{floor((length-1)/(2))}
    var l = Math.floor (length/2), r = Math.ceil (length/2);
    var ret = alpha (l, symbol (1, alpha (r, []))).join('');

    target.val (ret);
  });
}) ();
</script>
<?php include('elements/footer.php'); ?>
