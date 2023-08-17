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
                <h4 class="text-themecolor">FORMULARIO INSCRIPCION MCSSTS</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url(); ?>">Inicio </a>
                        </li>
                        <li class="breadcrumb-item active">Datos Adicionales</li>
                        <a href="<?= base_url('ficha-cmsts/' . $this->session->userdata('user_id') . ''); ?> " target="_blank" class="btn btn-danger d-none d-lg-block m-l-15 text-white"><i class="fa  fa-file-pdf"></i> Descargar</a>
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
                        <div class="card">
                            <div class="card-header text-white bg-info">
                                <a class="text-white" data-action="collapse"><b>DATOS PERSONALES </b>
                                    <div class="card-actions">
                                        <i id="icon_general" class="ti-minus"></i>
                                    </div>
                                </a>
                            </div>
                            <div id="div_general" class="card-body collapse show">
                                <form id="general_data">
                                    <div class="row">
                                        <div class="row p-t-20">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label">Nombres y Apellidos </label>
                                                    <input type="text" class="form-control" placeholder="" value="<?= $this->session->userdata('user_lastname') ?> <?= $this->session->userdata('user_name') ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label">CIP </label>
                                                    <input type="text" class="form-control" placeholder="" value="<?= $this->session->userdata('user_cip') ?> " disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label">DNI </label>
                                                    <input type="text" class="form-control" placeholder="" value="<?= $this->encryption->decrypt($this->session->userdata('user_dni')) ?> " disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Estado Civil <code>*</code>
                                                    </label>
                                                    <select name="civil_status" id="civil_status" class="form-control form-select">
                                                        <option value="Soltero">Soltero</option>
                                                        <option value="Casado">Casado</option>
                                                        <option value="Viudo">Viudo</option>
                                                        <option value="Divorciado">Divorciado</option>
                                                        <option value="Separado">Separado</option>
                                                        <option value="Conviviente">Conviviente</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-label">Género</label>
                                                <select name="gender" id="gender" class="form-control form-select">
                                                    <option value="M">MASCULINO</option>
                                                    <option value="F">FEMENINO</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Ubigeo de Nacimiento</label>
                                                <select name="place_birth" id="place_birth" class="select2 form-control form-select">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-label">Fecha de Nacimiento</label>
                                                <input name="date_birthday" id="date_birthday" type="date" class="form-control" placeholder="Ingresar Fecha de Inscripción">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Ubigeo de Vivienda</label>
                                                <select name="place_housing" id="place_housing" class="select2 form-control form-select">
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Urbanización </label>
                                                <input name="urbanization" id="urbanization" type="text" class="form-control" placeholder="Ingresar urbanización">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Dirección (Calle, N°, Mz, Lte) </label>
                                                <input name="address" id="address" type="text" class="form-control" placeholder="Ingresar Dirección">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Celular de Emergencia </label>
                                                <input name="emergency" id="emergency" type="text" class="form-control" placeholder="Ingresar Celular de Emergencia">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <button id="btn_general" type="submit" class="btn btn-success float-end  btn-rounded text-white">
                                                Guardar datos generales
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header text-white bg-info">
                                <a class="text-white" data-action="collapse"> <b>COMPOSICION FAMILIAR</b>
                                    <div class="card-actions">
                                        <i id="icon_family" class="ti-plus"></i>
                                    </div>
                                </a>
                            </div>
                            <div id="div_family" class="card-body collapse show">
                                <form id="form_family">
                                    <input type="hidden" class="form-control" id="idFamily" name="id_family" value="" placeholder="Ingrese nombres">

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-label">Nombres del Familiar</label>
                                                <input type="text" class="form-control input_txt" id="nameFamily" name="name" value="" placeholder="Ingrese nombres">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Apellidos del Familiar</label>
                                                <input type="text" class="form-control input_txt" id="lastNameFamily" name="lastname" value="" placeholder="Ingrese apellidos">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-label">Parentesco</label>
                                                <select name="relationship" id="relationship" class="department m-b-10 form-control form-select" style="width: 100%">
                                                    <option value="Hijo (a)">Hijo (a)</option>
                                                    <option value="Esposo (a)">Esposo (a)</option>
                                                    <option value="Hermano (a)">Hermano (a)</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label class="form-label">Edad</label>
                                                <input name="age" id="age" type="text" class="form-control input_numb" value="" placeholder="Edad" maxlength="3">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-label"> CCIIFFS</label>
                                                <input name="CCIIFFS" id="CCIIFFS" type="text" class="form-control input_numb" value="" placeholder="Ingrese CCIFFS">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-label"> DNI</label>
                                                <input name="dni" id="dni" type="text" class="form-control input_numb" value="" placeholder="Ingrese DNI">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <button id="btn_family" disabled type="submit" class="btn btn-success float-end  btn-rounded text-white">
                                                Añadir Familiar
                                            </button>
                                            <button id="btn_pre" style="display: none;" type="button" class="btn btn-success float-end  btn-rounded text-white" disabled>
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                Cargando...
                                            </button>
                                            <button id="btn_mdf" style="display: none;" type="submit" class="btn btn-success float-end  btn-rounded text-white">
                                                Editar Datos Familiar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-responsive m-t-40">
                                    <table id="data-family" class="nowrap table table-striped border" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Apellidos y Nombres</th>
                                                <th>Parentesco</th>
                                                <th>Edad</th>
                                                <th>CCIIFFS</th>
                                                <th>Dni</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
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