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
                        <h4 class="text-themecolor">Registros DAS</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url(); ?>">Inicio</a>
                                </li>
                                <li class="breadcrumb-item active">Registros DAS</li>
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
                                <h4 class="card-title">Registros DAS</h4>
                                <h6 class="card-subtitle">Sus Solicitudes DAS</h6>
                                <div class="m-t-40">
                                    <table id="tbl_das" class="table table-striped border">
                                        <thead>
                                            <tr>
                                                <th style="display: none;"></th>
                                                <th>ID</th>
                                                <th>Centro Academico</th>
                                                <th>Tipo de Proceso</th>
                                                <th>Beneficiado</th>
                                                <th>Especialidad</th>
                                                <th>Fecha</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($univ as $key => $u) {
                                            ?>
                                                <!--- Recorrido Universidad --->
                                                <tr>
                                                    <td style="display:none;"><?= $u->id_univ ?></td>

                                                    <td>
                                                        UN <?= $u->id_univ ?>
                                                    </td>
                                                    <td>
                                                        Universidad <?= $u->name_university ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($u->type_process == "1") {
                                                            echo "Ingresante";
                                                        } elseif ($u->type_process == "2") {
                                                            echo "Traslado";
                                                        } else {
                                                            echo "Error(Puede editar el tipo de proceso)";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($u->person == "1") {
                                                            echo "Titular";
                                                        } elseif ($u->person == "2") {
                                                            echo "Familiar";
                                                        } else {
                                                            echo "Error(Puede editar el tipo de proceso)";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?= $u->uni_specialty ?></td>
                                                    <td><?= fecha($u->uni_create_date) ?></td>
                                                    <td>
                                                        <a href="<?= base_url('das/pdf-universidad/' . $u->id_univ); ?>" target="_blank" class="btn btn-danger waves-effect waves-light" type="button" style="color: black;" title="Mostrar PDF"> <i class="far fa-file-pdf"></i> </a>
                                                        <a href=" <?= base_url('das/editar-solicitud/' . $u->id_univ); ?>" class="btn btn-info waves-effect waves-light" type="button" style="color: black;" title="Editar"> <i class="far fa-edit"></i> </a>
                                                        <a class="btn btn-warning waves-effect waves-light deletebtn" href="#!" style="color: black;" title="Eliminar" data-bs-toggle="modal" data-bs-target="#delete" data-url="<?= base_url(); ?>"> <i class="far fa-trash-alt" data-idd="1"></i> </a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            foreach ($inst as $key => $i) {
                                            ?>
                                                <!--- Recorrido Instituto --->
                                                <tr>
                                                    <td style="display:none;"><?= $i->id_ins ?></td>

                                                    <td>
                                                        IN <?= $i->id_ins ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($i->cat_institute == "1") {
                                                            echo "Instituto " . $i->name_institute;
                                                        } else {
                                                            echo "Academia " . $i->name_institute;
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        Ingresante
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($i->person == "1") {
                                                            echo "Titular";
                                                        } elseif ($i->person == "2") {
                                                            echo "Familiar";
                                                        } else {
                                                            echo "Error(Puede editar el tipo de proceso)";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?= $i->ins_specialty ?></td>
                                                    <td><?= fecha($i->ins_create_date) ?></td>
                                                    <td>
                                                        <a href="<?= base_url('das/pdf-instituto/' . $i->id_ins); ?>" target="_blank" class="btn btn-danger waves-effect waves-light" type="button" style="color: black;" title="Mostrar PDF"> <i class="far fa-file-pdf"></i> </a>
                                                        <a href=" <?= base_url('das/editar-solicitud-instituto/' . $i->id_ins); ?>" class="btn btn-info waves-effect waves-light" type="button" style="color: black;" title="Editar"> <i class="far fa-edit"></i> </a>
                                                        <a class="btn btn-warning waves-effect waves-light deletebtn2" href="#!" style="color: black;" title="Eliminar" data-bs-toggle="modal" data-bs-target="#delete2""data-idd=" 2"> <i class="far fa-trash-alt"></i> </a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            foreach ($brit as $key => $b) {
                                            ?>
                                                <!--- Recorrido Britanico --->
                                                <tr>
                                                    <td style="display:none;"><?= $b->id_bri ?></td>

                                                    <td>
                                                        BR <?= $b->id_bri ?>
                                                    </td>
                                                    <td>
                                                        Inst. Británico
                                                    </td>
                                                    <td>
                                                        Ingresante
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($b->person == "1") {
                                                            echo "Titular";
                                                        } elseif ($b->person == "2") {
                                                            echo "Familiar";
                                                        } else {
                                                            echo "Error(Puede editar el tipo de proceso)";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?= $b->bri_specialty ?></td>
                                                    <td><?= fecha($b->bri_create_date) ?></td>
                                                    <td>
                                                        <a href="<?= base_url('das/pdf-britanico/' . $b->id_bri); ?>" target="_blank" class="btn btn-danger waves-effect waves-light" type="button" style="color: black;" title="Mostrar PDF"> <i class="far fa-file-pdf"></i> </a>
                                                        <a href=" <?= base_url('das/editar-solicitud-britanico/' . $b->id_bri); ?>" class="btn btn-info waves-effect waves-light" type="button" style="color: black;" title="Editar"> <i class="far fa-edit"></i> </a>
                                                        <a class="btn btn-warning waves-effect waves-light deletebtn3" href="#!" style="color: black;" title="Eliminar" data-bs-toggle="modal" data-bs-target="#delete3" data-url="<?= base_url(); ?>"> <i class="far fa-trash-alt" data-idd="3"></i> </a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
        <!-- Modal Delete-->
        <!-- sample modal content -->
        <div id="delete" class="modal" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="title"></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <form action="<?= base_url('eliminar-solicitud-universidad'); ?>" method="post">
                        <div class="modal-body">
                            <input type="hidden" value="" name="delete_id" id="delete_id">
                            <h4 id="dscpt"></h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info waves-effect text-white" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-danger waves-effect text-white" data-bs-dismiss="modal">Eliminar</button>
                        </div>
                    </form>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div id="delete2" class="modal" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="title2"></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <form action="<?= base_url('eliminar-solicitud-instituto'); ?>" method="post" id="formd2">
                        <div class="modal-body">
                            <input type="hidden" value="" name="delete_id2" id="delete_id2">
                            <h4 id="dscpt2"></h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info waves-effect text-white" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-danger waves-effect text-white" data-bs-dismiss="modal">Eliminar</button>
                        </div>
                    </form>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div id="delete3" class="modal" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="title3"></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <form action="<?= base_url('eliminar-solicitud-britanico'); ?>" method="post">
                        <div class="modal-body">
                            <input type="hidden" value="" name="delete_id3" id="delete_id3">
                            <h4 id="dscpt3"></h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info waves-effect text-white" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-danger waves-effect text-white" data-bs-dismiss="modal">Eliminar</button>
                        </div>
                    </form>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>