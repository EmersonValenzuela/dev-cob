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
                <h4 class="text-themecolor">Datos Adicionales</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url(); ?>">Inicio </a>
                        </li>
                        <li class="breadcrumb-item active">Datos Adicionales</li>
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
                                <a class="text-white" data-action="collapse"><b>DATOS GENERALES </b>
                                    <div class="card-actions">
                                        <i id="icon_general" class="ti-minus"></i>
                                    </div>
                                </a>
                            </div>
                            <div id="div_general" class="card-body collapse show">
                                <form id="general_data">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Telefono Casa</label>
                                                <input name="home_phone" id="home_phone" type="text" class="form-control" placeholder="Ingresar Telefono Casa" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Fecha de Nacimiento</label>
                                                <input name="birthday" id="birthday" type="date" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Ocupación Actual</label>
                                                <input name="current_oc" id="current_oc" type="text" class="form-control" placeholder="Ingresar Ocupación Actual">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">CONADIS DID</label>
                                                <input name="conadis_did" id="conadis_did" type="text" class="form-control" placeholder="Ingresar Condis Did">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Grado de Instrucción</label>
                                                <select name="level_education" id="level_education" class="form-control form-select">
                                                    <option value="">--Grado de Instrucción--</option>
                                                    <option value="Inicial">Inicial</option>
                                                    <option value="Primaria">Primaria</option>
                                                    <option value="Secundaria">Secundaria</option>
                                                    <option value="Superior Tecnológico">Superior Tecnológico</option>
                                                    <option value="Superior Universitario">Superior Universitario
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Estado Civil</label>
                                                <select name="civil_status" id="civil_status" class="form-control form-select">
                                                    <option value="">--Estado Civil--</option>
                                                    <option value="Soltero">Soltero (a)</option>
                                                    <option value="Casado">Casado (a)</option>
                                                    <option value="Viudo">Viudo (a)</option>
                                                    <option value="Divorciado">Divorciado (a)</option>
                                                    <option value="Separado">Separado (a)</option>
                                                    <option value="Conviviente">Conviviente</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Talla</label>
                                                <select name="size" id="size" class="form-control form-select">
                                                    <option value="">--Tallas--</option>
                                                    <option value="XS">XS</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
                                                    <option value="L">L</option>
                                                    <option value="XL">XL</option>
                                                    <option value="XXL">XXL</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label">Tipo de Efectivo</label>
                                                <select name="type_cash" id="type_cash" class="form-control form-select">
                                                    <option value="">--Tipo de Efectivo--</option>
                                                    <option value="Oficial">Oficial</option>
                                                    <option value="Tecnico">Tecnico</option>
                                                    <option value="Suboficial">Suboficial</option>
                                                    <option value="Tropa">Tropa</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Ubigeo de Nacimiento</label>
                                                <select name="ubigeo_birthday" id="ubigeo_birthday" class="select2 form-control form-select">
                                                    <?php
                                                    if ($ub) {
                                                        echo $ub;
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Ubigeo de Vivienda</label>
                                                <select name="ubigeo_home" id="ubigeo_home" class="select2 form-control form-select">
                                                    <?php
                                                    if ($uh) {
                                                        echo $uh;
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Resolución Alta al CGI</label>
                                                <input name="high_resolution" id="high_resolution" type="text" class="form-control" placeholder="Ingresar Resolución">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Situación</label>
                                                <input name="situation" id="situation" type="text" class="form-control" placeholder="Ingresar Situación">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <button id="btn_general" type="submit" class="btn btn-success float-end  btn-rounded text-white has-spinner">
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
                                <a class="text-white" data-action="collapse"><b>MOTIVO DE INVALIDEZ</b>
                                    <div class="card-actions">
                                        <i id="icon_reason" class="ti-plus"></i>
                                    </div>
                                </a>
                            </div>
                            <div id="div_reason" class="card-body collapse">
                                <form id="disability_reason">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Evento</label>
                                                <select name="events_ej" id="events_ej" class="form-control form-select" style="width: 100% Important!;">
                                                    <option value="">--Eventos--</option>
                                                    <option value="Conflicto de Cenepa">Conflicto de Cenepa</option>
                                                    <option value="Acciones de Terrorismo">Acciones de Terrorismo
                                                    </option>
                                                    <option value="Cordillera del Cóndor">Cordillera del Cóndor</option>
                                                    <option value="Cuanición">Cuanición</option>
                                                    <option value="Campaña de 1933">Campaña de 1933</option>
                                                    <option value="Campaña de 1941">Campaña de 1941</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Fecha de Invalidez </label><a class="mytooltip text-end" href="javascript:void(0)">
                                                    <i class="fas fa-info-circle"></i><span class="tooltip-content5"><span class="tooltip-text3"><span class="tooltip-inner2">Howdy, Ben!<br />
                                                                There are 13 unread messages in your
                                                                inbox.</span></span></span></a>
                                                <input type="date" class="form-control" name="invalidate" id="invalidate">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Lugar de Accidente</label>
                                                <input type="text" class="form-control" name="accident_site" id="accident_site" placeholder="Lugar de Accidente">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Causal</label>
                                                <textarea type="text" class="form-control" name="tb_ca" id="tb_ca" placeholder="Causal" style="overflow: hidden;"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Diagnóstico</label>
                                                <textarea type="text" class="form-control" name="tb_di" id="tb_di" placeholder="Diagnóstico" style="overflow: hidden;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <button id="btn_reason" type="submit" class="btn btn-success float-end  btn-rounded text-white has-spinner">
                                                Guardar Motivo de Invalidez
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
                                <a class="text-white" data-action="collapse"><b>REQUERIMIENTOS DEL DISCAPACITADO</b>
                                    <div class="card-actions">
                                        <i id="icon_require" class="ti-plus"></i>
                                    </div>
                                </a>
                            </div>
                            <div id="div_require" class="card-body collapse">
                                <form id="require_disability">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-4 col-sm-4">
                                            <div class="form-group">
                                                <label class="form-label">Ubigeo Req. de atención</label>
                                                <select name="ubigeo_atention" id="ubigeo_atention" class="form-control form-select" style="width: 100% Important!;">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Centro Hospitalario</label>
                                                <input type="text" class="form-control" name="hospital" id="hospital" placeholder="Ingrese Centro Hospitalario">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Requiere de Sillas de Ruedas</label>
                                                <input type="text" class="form-control" name="wheelchair" id="wheelchair" placeholder="Lugar de Accidente">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Región Militar (RRMM)</label>
                                                <input type="text" class="form-control" name="rrmm" id="rrmm" placeholder="Ingresar Región Militar">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Prótesis</label>
                                                <input type="text" class="form-control" name="prosthesis" id="prosthesis" placeholder="Ingresar prótesis que utiliza">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <button id="btn_require" type="submit" class="btn btn-success float-end  btn-rounded text-white">
                                                Guardar Requerimientos
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
                            <div id="div_family" class="card-body collapse">
                                <form id="form_family">
                                    <input type="hidden" class="form-control" id="idFamily" name="id_family" value="" placeholder="Ingrese nombres">

                                    <div class="row">
                                        <div class="col-md-3">
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
                                        <!--<div class="col-md-2">
                                            <div class="form-group">
                                                <label class="form-label"> CCIIFFS</label>
                                                <input name="CCIIFFS" id="CCIIFFS" type="text" class="form-control input_numb" value="" placeholder="Ingrese CCIFFS">
                                            </div>
                                        </div>-->
                                        <div class="col-md-3">
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
                                                <!--<th>CCIIFFS</th>-->
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