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
                                                            <a onclick="background(<?= $row->id_user ?>)" target="_blank" class="btn btn-primary waves-effect waves-light" type="button" title="Mostrar PDF"><i class="fas fa-notes-medical"></i> </a>
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

        <div id="mdl_status" class="modal zoomIn animated" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="card-title">Antecedentes Medicos / sanciones :</h3>
                        <button type="button" class="btn-close" onclick="close()" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form_bck" enctype="multipart/form-data">
                            <div class="row">
                                <input type="hidden" id="id_pr" name="id_pr">
                                <input type="hidden" id="id_bck" name="id_bck">
                                <div class="col-md-3">
                                    <div class="form-group mb-2">
                                        <label>Tipo de Antecedente<code>*</code>
                                        </label>
                                        <select name="type_bck" id="type_bck" class="form-control form-select">
                                            <option value="">-- Tipo de Antecedente --</option>
                                            <option value="MEDICO">MEDICO</option>
                                            <option value="SANCION">SANCION</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group mb-2">
                                        <label for="tb-i">Descripción de la Sanción<code>*</code>
                                        </label>
                                        <input type="text" class="form-control" name="name_bck" id="name_bck" placeholder="Ingrese Descripción">
                                    </div>
                                </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-2">
                                            <label for="tb-i">Selecciona documento<code>*</code>
                                            </label>
                                            <div class="fileupload btn btn-primary btn-rounded waves-effect waves-light">
                                                <span class="sp_file"><i class="fas fa-upload"></i> Cargar Documento</span>
                                                <input type="file" class="upload" name="doc_bck" id="doc_bck">

                                            </div>
                                        </div>
                                    </div>
                                <div class="col-md-12 text-left">
                                    <div class="form-group mb-3">
                                        <div class="col-xs-12">
                                            <button id="btn_bck" type="submit" class="btn btn-success float-end  btn-rounded text-white">
                                                <i class=" fas fa-plus"></i> Añadir Antecendete
                                            </button>
                                            <button id="btn_up_bck" type="submit" style="display: none;" class="btn btn-success float-end  btn-rounded text-white">
                                                <i class=" fas fa-plus"></i> Modificar Antecendete
                                            </button>
                                            <button id="btn_pre" style="display: none;" type="button" class="btn btn-success float-end  btn-rounded text-white" disabled>
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                Cargando...
                                            </button>
                                            <button id="btn_cancel" type="submit" class="btn btn-danger float-end  btn-rounded text-white">
                                                <i class="fas fa-times"></i> Cancelar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive m-t-40">
                            <table id="data-background" class="nowrap table table-striped border" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Tipo de Antecedente</th>
                                        <th>Descripción</th>
                                        <th>Url Archivo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Tipo de Antecedente</th>
                                        <th>Descripción</th>
                                        <th>Url Archivo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>