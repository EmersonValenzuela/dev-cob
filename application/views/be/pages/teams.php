        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Departamentos</h4>

                    </div>
                    <div class="col-md-7 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Inicio</a></li>
                                <li class="breadcrumb-item active">Departamentos</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <button class="btn btn-success btn-rounded text-white" OnClick="createTeam()"><i class="fas fa-plus"></i> Añadir Equipo</button>
                                <div class="row">
                                    <div class="col-md-12 mt-4">
                                        <ul class="list-unstyled" id="list_team">
                                            <?php foreach ($rows as $key => $row) {
                                                if ($row->id_rol == 0  || $row->id_rol == 1 || $row->id_rol == 2) {
                                                } else {
                                            ?>
                                                    <li id="l_<?= $row->id_rol ?>" class="media">
                                                        <div><i class="fas fa-users" style="font-size: 3em; margin-right:0.3em;"></i></div>
                                                        <div class="media-body">
                                                            <h6 class="card-title"><?= $row->name_rol ?></h6>
                                                            <h6 class="card-subtitle"><?= $row->descr_rol ?></h6>
                                                        </div>
                                                        <button style="box-shadow: 0px 2px rgba(0,0,0,0.5);" data-toggle="tooltip" OnClick="deleteTeam(<?= $row->id_rol ?>)" data-placement="top" title="Eliminar" type="button" class="btn btn-light float-end   btn-rounded">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        &nbsp;
                                                        <button style="box-shadow: 0px 2px rgba(0,0,0,0.5);" OnClick="modifyTeam(<?= $row->id_rol ?>)" data-toggle="tooltip" data-placement="top" title="Gestionar" title="gestionar" type="button" class="btn btn-success float-end  btn-rounded text-white">
                                                            <i class="fas fa-cog"></i>
                                                        </button>
                                                    </li>
                                                    <hr id="h_<?= $row->id_rol ?>">
                                            <?php }
                                            } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <div id="mdl_team" class="modal zoomIn animated" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-body">
                                <strong>
                                    <h3 class="card-title" id="vcenter">Departamento a Añadir</h3>
                                </strong><br>
                                <p class="card-subtitle">Crear un departamento para agrupar usuarios. Los equipos se pueden utilizar en lugar de los usuarios para compartir recursos como Vistas.</p>
                                <br>

                                <form class="form-horizontal form-material" id="send_team">
                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <label for="">Nombre de Departamento</label>
                                            <input class="form-control" type="text" required="" placeholder="Añadir nombre de departamento aquí Ej. DACE" name="n_dp" id="n_dp">
                                            <input type="hidden" name="id_r" id="id_r">
                                            <input type="hidden" name="m_r" id="m_r">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <label>Descripción de Departamento</label>
                                            <input class="form-control" type="text" required="" placeholder="Añada la descripción del equipo aquí Ej. Ayuda Social" name="d_dp" id="d_dp">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <label for="">Jefe del Equipo</label>
                                            <select name="j_dp" id="j_dp" class="boss m-b-10 form-control form-select" style="width: 100%">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <label for="">Miembros del Equipo</label>
                                            <select name="m_dp" id="m_dp" class="select2 m-b-10 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Choose">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <button id="btn_send" type="button" class="btn btn-success float-end  btn-rounded text-white" >
                                                Guardar
                                            </button>
                                            <button style="display: none;" id="btn_modify" type="button" class="btn btn-success float-end  btn-rounded text-white">
                                                Modificar
                                            </button>

                                            <button id="btn_close" type="button" class="btn btn-light float-end   btn-rounded">
                                                Cancelar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>