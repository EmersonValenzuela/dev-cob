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
                        <h4 class="text-themecolor">Ordenes de Servicio</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                                <li class="breadcrumb-item active">Ordenes de Servicio</li>
                            </ol>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="content-utilities">
                                    <!--<div class="page-nav">
                                        <a href="<?= base_url('be/agregar-personal-civil'); ?>" class="btn btn-primary btn-rounded waves-effect waves-light"><i class="fas fa-plus"></i> Agregar Personal Civil</a>
                                    </div>
                                    <br>-->
                                </div>
                                <div class="row">
                                    <div class="table-responsive m-t-40">
                                        <table id="data-inspection" class="table table-striped border">
                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th> Apellidos y Nombre </th>
                                                    <th> CIP </th>
                                                    <th> DNI </th>
                                                    <th>Unidad</th>
                                                    <th>Grado</th>
                                                    <th>Especialidad</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                <?php
                                                $c = 1;
                                                foreach ($rows as $key => $row) {
                                                ?>
                                                    <tr>
                                                        <th><?= $c++; ?></th>
                                                        <th><?= $row->lastname_user . " " . $row->name_user ?></th>
                                                        <th><?= $this->encryption->decrypt($row->cip_user) ?></th>
                                                        <th><?= $this->encryption->decrypt($row->dni_user) ?></th>
                                                        <th><?= $row->name_rol ?></th>
                                                        <th><?= $row->name_grade_staff ?></th>
                                                        <th><?= $row->name_specialty ?></th>
                                                        <th>
                                                            <a href="<?= base_url('be/editar-personal-civil/' . $row->id_user); ?>" target="_blank" class="btn btn-warning waves-effect waves-light" type="button" title="Mostrar PDF"><i class="far fa-edit"></i> </a>&nbsp;
                                                            <a href="<?= base_url('be/perfil-personal/' . $row->id_user); ?>" target="_blank" class="btn btn-danger waves-effect waves-light" type="button" title="Mostrar PDF"><i class="fas fa-file-pdf"></i> </a>
                                                        </th>
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
            </div>
        </div>
