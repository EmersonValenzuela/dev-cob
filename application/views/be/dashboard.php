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
                <h4 class="text-themecolor">Registro de Consultas</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
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


        <!-- Row -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-12 col-xlg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Consultas COBIENE</h4>
                        <ul class="nav nav-pills m-t-30 m-b-30">
                            <li class=" nav-item"> <a href="#navpills-1" class="nav-link active" data-bs-toggle="tab" aria-expanded="false">Consultas DAS</a> </li>
                            <li class="nav-item"> <a href="#navpills-2" class="nav-link" data-bs-toggle="tab" aria-expanded="false">Consultas DACE</a> </li>
                        </ul>
                        <div class="tab-content br-n pn">
                            <div id="navpills-1" class="tab-pane active">
                                <div class="table-responsive m-t-40">
                                    <table id="data-das" class="display nowrap table table-hover table-striped border" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Centro Academico</th>
                                                <th>Tipo de Proceso</th>
                                                <th>Beneficiado</th>
                                                <th>Especialidad</th>
                                                <th>Fecha</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Centro Academico</th>
                                                <th>Tipo de Proceso</th>
                                                <th>Beneficiado</th>
                                                <th>Especialidad</th>
                                                <th>Fecha</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            foreach ($univ as $key => $u) {
                                            ?>
                                                <!--- Recorrido Universidad --->
                                                <tr>
                                                    <td>
                                                        UN <?= $u->id_univ ?>
                                                    </td>
                                                    <td>
                                                        <?= $u->name_user . " " . $u->lastname_user ?>
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
                                                        <div class="btn-group">
                                                            <button type="button" class="btn  dropdown-toggle text-black" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="ti-view-list-alt"></i>
                                                            </button>
                                                            <div class="dropdown-menu animated" >
                                                                <a href="<?= base_url('das/pdf-universidad/' . $u->id_univ); ?>" target="_blank" class="btn dropdown-item" type="button" style="color: black;" title="Mostrar PDF"> <i class="far fa-file-pdf text-danger"></i>&nbsp; Mostrar PDF </a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="far fa-envelope text-info"></i>&nbsp; Enviar Email</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="fab fa-whatsapp-square text-primary"></i>&nbsp; Enviar WhatsApp</a>
                                                                <a class="btn btn dropdown-item" type="button" style="color: black;" title="Eliminar"> <i class="far fa-trash-alt text-warning"></i>&nbsp; Eliminar</a>
                                                            </div>
                                                        </div>

                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            foreach ($inst as $key => $i) {
                                            ?>
                                                <!--- Recorrido Instituto --->
                                                <tr>
                                                    <td>
                                                        IN <?= $i->id_ins ?>
                                                    </td>
                                                    <td>
                                                        <?= $i->name_user . " " . $i->lastname_user ?>
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
                                                        <div class="btn-group">
                                                            <button type="button" class="btn  dropdown-toggle text-black" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="ti-view-list-alt"></i>
                                                            </button>
                                                            <div class="dropdown-menu animated" >
                                                                <a href="<?= base_url('das/pdf-instituto/' . $i->id_ins); ?>" target="_blank" class="btn dropdown-item" type="button" style="color: black;" title="Mostrar PDF"> <i class="far fa-file-pdf text-danger"></i>&nbsp; Mostrar PDF </a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="far fa-envelope text-info"></i>&nbsp; Enviar Email</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="fab fa-whatsapp-square text-primary"></i>&nbsp; Enviar WhatsApp</a>
                                                                <a class="btn btn dropdown-item" type="button" style="color: black;" title="Eliminar"> <i class="far fa-trash-alt text-warning"></i>&nbsp; Eliminar</a>
                                                            </div>
                                                        </div>

                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            foreach ($brit as $key => $b) {
                                            ?>
                                                <!--- Recorrido Britanico --->
                                                <tr>
                                                    <td>
                                                        BR <?= $b->id_bri ?>
                                                    </td>
                                                    <td>
                                                        <?= $b->name_user . " " . $b->lastname_user ?>
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
                                                        <div class="btn-group">
                                                            <button type="button" class="btn  dropdown-toggle text-black" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="ti-view-list-alt"></i>
                                                            </button>
                                                            <div class="dropdown-menu animated">
                                                                <a href="<?= base_url('das/pdf-britanico/' . $b->id_bri); ?>" target="_blank" class="btn dropdown-item" type="button" style="color: black;" title="Mostrar PDF"> <i class="far fa-file-pdf text-danger"></i>&nbsp; Mostrar PDF </a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="far fa-envelope text-info"></i>&nbsp; Enviar Email</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="fab fa-whatsapp-square text-primary"></i>&nbsp; Enviar WhatsApp</a>
                                                                <a class="btn btn dropdown-item" type="button" style="color: black;" title="Eliminar"> <i class="far fa-trash-alt text-warning"></i>&nbsp; Eliminar</a>
                                                            </div>
                                                        </div>

                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="navpills-2" class="tab-pane">
                                <div class="table-responsive m-t-40">
                                    <table id="data-dace" class="table table-striped border">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Tipo de Asignación</th>
                                                <th>Fecha</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($list as $key => $row) {
                                            ?>
                                                <tr>
                                                    <td><?= $row->id_formdace ?></td>
                                                    <td><?= $this->session->userdata('user_name') ?></td>
                                                    <td>
                                                        <?php if ($row->assignment_type == "1") {
                                                            echo "Asignación Común";
                                                        } elseif ($row->assignment_type == "2") {
                                                            echo "Asignación Excepcional";
                                                        } elseif ($row->assignment_type == "3") {
                                                            echo "Asignación Especial";
                                                        } else {
                                                            echo "Asignación No Definida";
                                                        } ?>
                                                    </td>
                                                    <td><?= fecha($row->date_create_dace) ?></td>
                                                    <td>
                                                        <a href="<?= base_url('pdf-dace/' . $row->token_formdace); ?>" target="_blank" class="btn btn-danger waves-effect waves-light" type="button" style="color: black;" title="Mostrar PDF"> <i class="far fa-file-pdf"></i> </a>
                                                        <a href=" <?= base_url('editar-DACE/' . $row->token_formdace); ?>" class="btn btn-info waves-effect waves-light" type="button" style="color: black;" title="Editar"> <i class="far fa-edit"></i> </a>
                                                        <button class="btn btn-warning waves-effect waves-light" type="button" style="color: black;" title="Eliminar"> <i class="far fa-trash-alt"></i> </button>
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
            </div>
            <!-- Column -->
        </div>
        <!-- Row -->
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
