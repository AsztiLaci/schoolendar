<?php require('elements/header.php'); ?>
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="<?=URL::to('/')?>">Schoolender</a>
            </li>
            <li>
                <a href="<?=URL::to('newslist')?>">Hírek</a>
            </li>
        </ul>
    </div>

    <div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-comment"></i> Hírek lista</h2>

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
        <th>Cím</th>
        <th>Tartalom</th>
        <th>Létrehozva</th>
        <th>Létrehozta</th>
        <th>Műveletek</th>
    </tr>
    </thead>
    <tbody>
	<?php if(!is_null($news)){
		foreach($news as $newse){ ?>
    <tr id="sor_<?=$newse['id']?>">
        <td><?=$newse['title']?></td>
        <td class="center"><?=Str::limit($newse['description'], $limit = 30, $end = '...')?></td>
        <td class="center"><?=$newse['created_at']?></td>
        <td class="center"><?=User::find($newse['published_by'])->displayname;?></td>
        <td class="center">
            <a class="btn btn-info" href="<?=URL::to('newsedit')?>/<?=$newse['id']?>">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Szerkeszt
            </a>
            <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#newsDel" onClick="snewsdel(<?=$newse['id']?>)">
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
		function snewsdel(id){
			//$("#torol").attr("href", "<?=URL::to('newsdel')?>/" + id)
			url="<?=URL::to('newsdel')?>/" + id;
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
					noty({"text":"Hír törölve!","layout":"bottomRight","type":"success","animateOpen": {"opacity": "show"}});

				}
    				});
				
			});
		});
	</script>

	<div class="modal fade" id="newsDel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Hír törlése</h3>
                </div>
                <div class="modal-body">
                    <p>Biztosan törölni szeretné a bejegyzést?</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Mégse</a>
                    <a id="torol" href="#" class="btn btn-danger" data-dismiss="modal">Törlés</a>
                </div>
            </div>
        </div>
    </div>

<?php require('elements/footer.php'); ?>
