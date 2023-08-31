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
                                <li class="breadcrumb-item active">Formulario Instituto</li>
                            </ol>

                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- Start Page Content -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-12">


                            <form id="form_das" action="<?= base_url('guardar-registro-britanico'); ?>" method="post" enctype="multipart/form-data">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">SOLICITUD PARA TARIFA PREFERENCIAL EN EL INSTITUTO BRITANICO </h4>
                                    </div>
                                    <div class="card-body" style="text-align: right;">
                                        <label for=""><strong>TITULAR </strong></label>
                                        <input type="checkbox" class="js-switch" data-color="#7F9E47" data-size="small" id="test" name="person" />
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

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Actual Servicio</label>
                                                    <input name="service" type="text" class="form-control" placeholder="Actual servicio" value="" required>
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
                                <div class="card" id="data_fam" style="display: none;">
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
                                                    <input name="bri_name_fam" type="text" class="form-control" placeholder="Nombres" value="">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Apellidos</label>
                                                    <input name="bri_last_fam" type="text" class="form-control" placeholder="Apellidos" value="">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">N° CIF </label>
                                                    <input name="bri_cift_fam" type="text" class="form-control" placeholder="N° CIF" value="">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Correo Electrónico</label>
                                                    <input name="bri_email_fam" type="text" class="form-control" placeholder="Correo Electrónico" value="">
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
                                                                echo '<option value="' . $rt->name_rt . '">' . $rt->name_rt . '</option>';
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
                                        <b>Datos Britanico</b>
                                        <div class="card-actions">
                                            <a class="text-white" data-action="collapse"><i class="ti-minus"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body collapse show">
                                        <div class="row p-t-20">
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Especialidad o Carrera</label>
                                                    <input name="bri_specialty" type="text" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                    </div>
                                </div>


                                <div class="card" id="data_ingr">
                                    <div class="card-header text-white bg-info">
                                        <b id="titleCard">Documentos de Ingresante</b>
                                        <div class="card-actions">
                                            <a class="text-white" data-action="collapse"><i class="ti-minus"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body collapse show">
                                        <div class="row p-t-20">
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Copia de Liquidación de Haberes del Titular</h4>
                                                        <input type="file" name="bri_settlement" id="input-file-now1" class="dropify" />
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4 col-sm-6 col-lg-4" id="doc_fam" style="display: none;">
                                                <div class="card center">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Copia CIF (Familiar)</h4>
                                                        <input type="file" name="bri_cif_fam" id="input-file-now1" class="dropify" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-lg-4">
                                                <div class="card">
                                                    <div class="card-body" id="doc_fam2" style="display: none;">
                                                        <h4 class="card-title">Copia de DNI (Familiar)</h4>
                                                        <input type="file" name="bri_dni_fam" id="input-file-now1" class="dropify" />
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>


                                    </div>
                                </div>
                                <div class="offset-sm-10 col-md-2">
                                    <button id="submit_send" type="submit" class="btn waves-effect waves-light w-100 btn-success text-white">ENVIAR</button>
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
            var checkbox = document.getElementById('test');
            checkbox.addEventListener("change", validaCheckbox, false);

            function validaCheckbox() {
                var checked = checkbox.checked;
                if (checked) {
                    document.getElementById("data_fam").style.display = "";
                    document.getElementById("doc_fam").style.display = "";
                    document.getElementById("doc_fam2").style.display = "";

                } else {
                    document.getElementById("data_fam").style.display = "none";
                    document.getElementById("doc_fam").style.display = "none";
                    document.getElementById("doc_fam2").style.display = "none";
                }
            }
        </script>

        <!-- ============================================================== -->
        <!-- End script page  -->
        <!-- ============================================================== -->