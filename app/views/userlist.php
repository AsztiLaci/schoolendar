<?php require('elements/header.php'); ?>
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="<?=URL::to('/')?>">Schoolender</a>
            </li>
            <li>
                <a href="<?=URL::to('userlist')?>">Felhasználók</a>
            </li>
        </ul>
    </div>

    <div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> Felhasználó lista</h2>

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
        <th>E-mail cím</th>
        <th>Név</th>
        <th>Típus</th>
        <th>Létrehozva</th>
        <th>Műveletek</th>
    </tr>
    </thead>
    <tbody>
	<?php foreach($users as $user){ ?>
    <tr id="sor_<?=$user['id']?>">
        <td><?=$user['email']?></td>
        <td class="center"><?=$user['displayname']?></td>
        <td class="center"><?=$usertypes[$user['type']]?></td>
        <td class="center"><?=$user['created_at']?></td>
        <td class="center">
	<?php if ((Auth::user()->type==0) && is_null(Session::get('aid'))){ ?>
            <a class="btn btn-success" href="<?=URL::to('loginas')?>/<?=$user['id']?>">
                <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                Megszemélyesít
            </a>
	<?php } ?>
            <a class="btn btn-info" href="<?=URL::to('useredit')?>/<?=$user['id']?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Szerkeszt
            </a>
            <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#userDel" onClick="suserdel(<?=$user['id']?>)">
                <i class="glyphicon glyphicon-trash icon-white"></i>
                Töröl
            </a>
        </td>
    </tr>
    <?php } ?>
	</tbody>
    </table>
    </div>
    </div>
    </div>
    <!--/span-->
    </div><!--/row-->
	<script>
		var url;
		var uid;
		function suserdel(id){
			//$("#torol").attr("href", "<?=URL::to('userdel')?>/" + id)
			url="<?=URL::to('userdel')?>/" + id;
			uid=id;
		}
		$(document).ready(function() {
    			$("#torol").click(function() {
				posting = $.ajax({
        			type: "GET",
        			url: url,
        			success: function()
        			{   
        				$('#sor_' + uid).fadeOut();
					noty({"text":"Felhasználó törölve!","layout":"bottomRight","type":"success","animateOpen": {"opacity": "show"}});

				}
    				});
				
			});
		});
	</script>

	<div class="modal fade" id="userDel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Felhasználó törlése</h3>
                </div>
                <div class="modal-body">
                    <p>Biztosan törölni szeretné a felhasználót?</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Mégse</a>
                    <a id="torol" href="#" class="btn btn-danger" data-dismiss="modal">Törlés</a>
                </div>
            </div>
        </div>
    </div>

<?php require('elements/footer.php'); ?>
