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
                        <h4 class="text-themecolor">Departamento de Apoyo Social</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Inicio</a></li>
                                <li class="breadcrumb-item active">Formulario Universidad</li>
                            </ol>

                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- Start Page Content -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-12">


                            <form id="form_das" action="<?= base_url('editar-solicitud-universidad'); ?>" method="post" enctype="multipart/form-data">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">SOLICITUD PARA RECATEGORIZACIÓN EN UNIVERSIDAD</h4>
                                    </div>
                                    <div class="card-body" style="text-align: right;">
                                        <label for=""><strong>TITULAR </strong></label>
                                        <input type="checkbox" class="js-switch" data-color="#7F9E47" data-size="small" id="test" name="person" <?= $d['check'] ?> />
                                        <label for=""><strong> FAMILIAR</strong></label>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header text-white bg-info">
                                        <b>Datos Titular</b>
                                        <div class="card-actions">
                                            <a class="text-white" data-action="collapse"><i class="ti-minus"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body collapse show">
                                        <hr>
                                        <h3 class="card-title">TITULAR</h3>
                                        <hr>
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Nombres</label>
                                                    <input name="name_user" type="text" class="form-control" placeholder="" value="<?= $this->session->userdata('user_name') ?>" disabled>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Apellidos</label>
                                                    <input name="lastname_user" type="text" class="form-control" placeholder="" value="<?= $this->session->userdata('user_lastname') ?>" disabled>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">N° CIP</label>
                                                    <input name="cip_user" type="text" class="form-control" placeholder="" value="<?= $this->session->userdata('user_cip') ?>" disabled>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Grado</label>
                                                    <input name="range" type="text" class="form-control" placeholder="" value="<?= $range->name_range ?>" disabled>
                                                    <input name="range_user" type="hidden" class="form-control" placeholder="" value="<?= $range->id_range ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Celular</label>
                                                    <input name="phone_user" type="text" class="form-control" placeholder="Celular" value="<?= $this->session->userdata('user_phone') ?>" disabled>
                                                </div>
                                            </div>
                                            <!--/span-->

                                            <!--/span-->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Actual Servicio</label>
                                                    <input name="service" type="text" class="form-control" placeholder="Actual servicio" value="<?= $r->service ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Correo Electrónico</label>
                                                    <input name="email_user" type="text" class="form-control" placeholder="Correo Electrónico" value="<?= $this->session->userdata('user_email') ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card" id="data_fam" <?= $d['style'] ?>>
                                    <div class="card-header text-white bg-info">
                                        <b>Datos Familiar</b>
                                        <div class="card-actions">
                                            <a class="text-white" data-action="collapse"><i class="ti-minus"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body collapse show">
                                        <hr>
                                        <h3 class="card-title">FAMILIAR</h3>
                                        <hr>
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Nombres</label>
                                                    <input name="uni_name_fam" type="text" class="form-control" placeholder="Nombres" value="<?= $r->uni_name_fam ?>">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Apellidos</label>
                                                    <input name="uni_last_fam" type="text" class="form-control" placeholder="Apellidos" value="<?= $r->uni_last_fam ?>">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">N° CIF </label>
                                                    <input name="uni_cift_fam" type="text" class="form-control" placeholder="N° CIF" value="<?= $r->uni_cift_fam ?>">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Correo Electrónico</label>
                                                    <input name="uni_email_fam" type="text" class="form-control" placeholder="Correo Electrónico" value="<?= $r->uni_email_fam ?>">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Parentesco</label>
                                                    <select name="relationship" class="select2 form-control form-select" style="width: 100%; height:36px;">
                                                        <option value="0">Seleccione Parentesco</option>
                                                        <optgroup label="Parentesco">
                                                            <?php
                                                            foreach ($rlt as $rt) {
                                                                if ($rt->name_rt == $r->relationship) {
                                                                    echo '<option value="' . $rt->name_rt . '"selected>' . $rt->name_rt . '</option>';
                                                                } else {
                                                                    echo '<option value="' . $rt->name_rt . '">' . $rt->name_rt . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header text-white bg-info">
                                        <b>Datos Universidad</b>
                                        <div class="card-actions">
                                            <a class="text-white" data-action="collapse"><i class="ti-minus"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body collapse show">
                                        <div class="row p-t-20">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Tipo de Proceso</label>
                                                    <select name="type_process" id="proceso" onChange="pagoOnChange(this)" class="form-control form-select" style="width: 100%; height:36px;">
                                                        <?php
                                                        if ($r->type_process == "1") {
                                                        ?>
                                                            <option value="1" selected>Ingresante</option>
                                                            <option value="2">Antiguo</option>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <option value="1">Ingresante</option>
                                                            <option value="2" selected>Antiguo</option>

                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Universidad</label>
                                                    <select name="university" class="select2 form-control form-select" style="width: 100%; height:36px;">

                                                        <optgroup label="Universidades">
                                                            <?php
                                                            foreach ($universities as $university) {

                                                                if ($university->id_university == $r->university) {
                                                                    echo '<option value="' . $university->id_university . '" selected>' . $university->name_university . '</option>';
                                                                } else {
                                                                    echo '<option value="' . $university->id_university . '">' . $university->name_university . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </optgroup>

                                                    </select>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Especialidad</label>
                                                    <input name="uni_specialty" type="text" class="form-control" placeholder="" value="<?= $r->uni_specialty ?>">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                    </div>
                                </div>


                                <div class="card" id="data_ingr">
                                    <div class="card-header text-white bg-info">
                                        <b id="titleCard">Documentos de
                                            <?php
                                            if ($r->type_process == "1") {
                                            ?>
                                                Ingresante
                                            <?php
                                            } else {
                                            ?>
                                                Antiguo

                                            <?php } ?></b>
                                        <div class="card-actions">
                                            <a class="text-white" data-action="collapse"><i class="ti-minus"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body collapse show">
                                        <div class="row p-t-20">
                                            <div class="col-md-6" id="data_trasl" <?= $s['Cdn'] ?>>
                                                <div class="card center">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Copias de Consolidado de notas (último ciclo)</h4>
                                                        <input type="file" name="uni_grades" id="input-file-now1" class="dropify" data-default-file="<?= $d['path'] . "" . $r->uni_grades ?>" value="<?= $r->uni_grades ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6" id="d_settlement" <?= $s['Cdi'] ?>>
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Copia de Constancia de Ingreso de la Univ.</h4>
                                                        <input type="file" name="uni_settlement" id="input-file-now1" class="dropify" data-default-file="<?= $d['path'] . "" . $r->uni_settlement ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6" id="d_tuition">
                                                <div class="card center">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Copia de boleta pago matricula de la Univ</h4>
                                                        <input type="file" name="uni_tuition" id="input-file-now1" class="dropify" data-default-file="<?= $d['path'] . "" . $r->uni_tuition ?>" value="<?= $r->uni_tuition ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>

                                        <div class="row p-t-20" id="doc_fam" <?= $d['style'] ?>>
                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                <div class="card center">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Copia CIF (Familiar)</h4>
                                                        <input type="file" name="uni_cif_fam" id="input-file-now1" class="dropify" data-default-file="<?= $d['path'] . "" . $r->uni_cif_fam ?>" value="<?= $r->uni_cif_fam ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-lg-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Copia de DNI (Familiar)</h4>
                                                        <input type="file" name="uni_dni_fam" id="input-file-now1" class="dropify" data-default-file="<?= $d['path'] . "" . $r->uni_dni_fam ?>" value="<?= $r->uni_dni_fam ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="id_univ" value="<?= $r->id_univ ?>">
                                <div class="offset-sm-10 col-md-2">
                                    <button id="submit_send type=" submit" class="btn waves-effect waves-light w-100 btn-success text-white">GUARDAR</button>
                                </div>
                            </form>

                        </div>
                        <!-- ============================================================== -->
                        <!-- Start Card User -->
                        <!-- ============================================================== -->

                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
        <!-- script page  -->
        <!-- ============================================================== -->

        <script>
            function pagoOnChange(sel) {
                let d_tuition = document.getElementById("d_tuition");
                let d_settlement = document.getElementById("d_settlement");
                let n = document.getElementById("titleCard");
                if (sel.value == "1") {
                    document.getElementById("data_trasl").style.display = "none";
                    document.getElementById("d_settlement").style.display = "block";

                    n.innerHTML = "Documentos de Ingresante";


                } else {
                    document.getElementById("d_settlement").style.display = "none";
                    document.getElementById("data_trasl").style.display = "block";

                    n.innerHTML = "Documentos de Antiguo";

                }
            }

            var checkbox = document.getElementById('test');
            checkbox.addEventListener("change", validaCheckbox, false);

            function validaCheckbox() {
                var checked = checkbox.checked;
                if (checked) {
                    document.getElementById("data_fam").style.display = "";
                    document.getElementById("doc_fam").style.display = "";

                } else {
                    document.getElementById("data_fam").style.display = "none";
                    document.getElementById("doc_fam").style.display = "none";
                }
            }
        </script>

        <!-- ============================================================== -->
        <!-- End script page  -->
        <!-- ============================================================== -->