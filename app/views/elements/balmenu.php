<!-- bal menu -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">Saját</li>
                        <li><a class="ajax-link" href="<?php echo(URL::to('/')) ?>"><i class="glyphicon glyphicon-home"></i><span> Főoldal</span></a>
                        </li>
                        <li><a class="ajax-link" href="<?php echo(URL::to('calendar')) ?>"><i class="glyphicon glyphicon-calendar"></i><span> Naptár</span></a>
                        </li>
			<li><a class="ajax-link" href="<?php echo(URL::to('eventrequests')) ?>"><i class="glyphicon glyphicon-list-alt"></i><span> Időpont kéréseim</span><span class="hidden notification green">4</span></a>
                        </li>
						<?php if(Auth::user()->type==4){ ?>
                        <li><a class="ajax-link" href="<?php echo(URL::to('neweventrequest')) ?>"><i class="glyphicon glyphicon-time"></i><span> Új időpont kérése</span></a>
                        </li>
						<?php } ?>
			<?php if(Auth::user()->type<2){ ?>
                        <li class="nav-header hidden-md">Adminisztráció</li>
                        <li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-user"></i><span> Felhasználók</span></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="<?=URL::to('userlist')?>">Felhasználó lista</a></li>
                                <li><a href="<?=URL::to('useredit/new')?>">Új felhasználó</a></li>
                                <!-- <li><a href="<?=URL::to('grouplist')?>">Csoport lista</a></li> 
                                <li><a href="<?=URL::to('groupedit/new')?>">Új csoport</a></li> -->
                            </ul>
                        </li>
			<li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-comment"></i><span> Hírek</span></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="<?=URL::to('newslist')?>">Hírek lista</a></li>
                                <li><a href="<?=URL::to('newsedit/new')?>">Új hír</a></li>
                            </ul>
                        </li>
			<li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-calendar"></i><span> Események</span></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="<?=URL::to('eventlist')?>">Esemény lista</a></li>
                                <li><a href="<?=URL::to('eventedit/new')?>">Új esemény</a></li>
                            </ul>
                        </li>
			<?php } ?>
                    </ul>
                    <label id="for-is-ajax" for="is-ajax"><input id="is-ajax" type="checkbox"> Ajax engedélyezése</label>
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- EOF bal menu -->
