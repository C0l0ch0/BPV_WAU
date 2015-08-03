<?php include(TEMPLATE.DS.'header.php');?>
<body>
    <?php include(TEMPLATE.DS.'top.php');?>
        
        <?php include(TEMPLATE.DS.'menu.php');?>
        
        <!--********************************* begin #content ********************************************************************-->
        <div id="content" class="content">
            <!-- begin breadcrumb -->
            <ol class="breadcrumb pull-right">

            </ol>
            <!-- end breadcrumb -->
            <!-- begin page-header -->
            <h1 class="page-header">Perfil de Usuario <small></small></h1>
            <!-- end page-header -->
            <div class="row">
                <div  id="DavidMod"></div>


                <div class="box col-md-12">
        <div class="box-inner">

            <div class="box-content">
            
            <!--img class="media-object rounded-corner" alt="" src=<?php echo WEBROOT.DS.'img/users/'.$_SESSION['login'].'.jpg';?> /-->
            <!-- begin col-6 -->
            <?php
                $conexion1 = new MySQL(0);
                $u = $_SESSION['login'];

                $strConsulta = "select usuario,nombre,email 
                                FROM usuario 
                                where usuario = '$u'";

                $consulta1 = $conexion1->consulta($strConsulta);
                $row= $conexion1->fetch_array($consulta1);
            ?>
                <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                            </div>
                            <h4 class="panel-title">Datos de la cuenta</h4>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" method ='POST' autocomplete="off">
                                    <ul class="chats">
                                    <li class="left">
                                        <a href="javascript:;" class="image"><img alt="" src=<?php echo WEBROOT.DS.'img/users/'.$_SESSION['login'].'.jpg';?> /></a>
                                    </li>
                                    </ul>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Usuario</label>
                                    <div class="col-md-9">
                                        <input type="text" value=<?=$row[0]?> class="form-control" placeholder="Disabled input" disabled />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nombre del Usuario</label>
                                    <div class="col-md-9">
                                        <input type="text" value=<?=$row[1]?> class="form-control" placeholder="Disabled input" disabled />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Correo</label>
                                    <div class="col-md-9">
                                        <input type="text" value=<?=$row[2]?> class="form-control" placeholder="Disabled input" disabled />
                                    </div>
                                </div>
                                <h4>Cambio de contraseña</h4>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Contraseña anterior</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="pass2" id="exampleInputPassword1" placeholder="Password" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Contraseña Nueva</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="pass" id="exampleInputPassword1" placeholder="Password" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Repetir Contraseña Nueva</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="pass1" id="exampleInputPassword1" placeholder="Password" />
                                    </div>
                                </div>
                                <?php
                                    if(isset($_SESSION['value'])){$mensaje=$_SESSION['value']; unset($_SESSION['value']);}else{$mensaje=' ';} 
                                    switch ($mensaje){
                                        case "error":
                                ?>
                                <div class="box-content alerts">
                                    <div class="alert alert-danger">
                                        <center><strong>Error!</strong> Uno a varios campos se encuentran vacios.</center>
                                    </div>
                                </div>
                                <?php 
                                    break;
                                    case "error2":
                                ?>
                                <div class="box-content alerts">
                                    <div class="alert alert-danger">
                                        <center><strong>Error!</strong> contraseñas ingresadas son distintas.</center>
                                    </div>
                                </div>
                                <?php
                                    break;
                                    case "error3": 
                                ?>
                                <div class="box-content alerts">
                                    <div class="alert alert-danger">
                                        <center><strong>Error!</strong> La contraseña debe ser distinta a la actual</center>
                                    </div>
                                </div>
                                <?php 
                                    break;
                                    }
                                ?>
                                <center><button type="submit" class="btn btn-sm btn-primary m-r-5" onclick = "this.form.action = 'http://<?=URL.DS;?>usuario/save1'">Guardar Cambios</button></center>
                            </form>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-6 -->
    </div>
    </div>
    
</div>


                <!-- #modal-dialog -->
                <div class="modal fade" id="modal-dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title">Detalle de Alarmas.</h4>
                            </div>
                            <div class="modal-body" id="alerta">
                                todavia no esta mongol!!!!
                                ya eran las 2am
                                sigo al rato,
                                fin del mensaje.....
                                pd: chupela XD
                            </div>
                            <div class="modal-footer">
                                <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>          
        </div>
        <!--********************************* end #content ********************************************************************-->
        
        <!-- begin scroll to top btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
        <!-- end scroll to top btn -->
    </div>
    <!-- end page container -->
    <script src="<?=WEBROOT.DS;?>js/ui-modal-notification.demo.min.js"></script>
</body>
</html>
<script src="<?=WEBROOT.DS;?>js/dashboard-v2.js"></script>
<?php include(TEMPLATE.DS.'footer.php');?>
<script>
        $(document).ready(function() {
            App.init();
            Notification.init();
            TableManageDefault.init();
            var name = "<?php echo $_SESSION['login'];?>";
            <?php if(isset($_SESSION['start'])){
                    unset($_SESSION['start']);
            ?>
            DashboardV2.init(name);
            <?php }?>

        });
</script>