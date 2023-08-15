<style>
    .zoom {
        display: inline-block;
        position: relative;
    }

    /* magnifying glass icon */
    .zoom:after {
        content: '';
        display: block;
        width: 33px;
        height: 33px;
        position: absolute;
        top: 0;
        right: 0;
        background: url(icon.png);
    }

    .zoom img {
        display: block;
    }

    .zoom img::selection {
        background-color: transparent;
    }

    .form h2 {
        text-align: center;
        color: #acacac;
        font-size: 40px;
        font-weight: 400;
        height: auto;
    }

    .form .grid {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 1rem;
    }

    .form .grid .form-element {
        width: 200px;
        height: 200px;
        box-shadow: 0px 0px 20px 5px rgba(100, 100, 100, 0.1);
    }

    .form .grid .form-element input {
        display: none;
    }

    .form .grid .form-element img {
        width: 200px;
        height: 200px;
        object-fit: cover;
    }

    .form .grid .form-element div {
        position: relative;
        height: 40px;
        margin-top: -40px;
        background: rgba(0, 0, 0, 0.5);
        text-align: center;
        line-height: 40px;
        font-size: 13px;
        color: #f5f5f5;
        font-weight: 600;
    }

    .form .grid .form-element div span {
        font-size: 40px;
    }

    .pdfview {
        /* Centrado */
        margin: auto;
        display: block;
        /* Tamaño */
        width: 850px;
        height: 90vh;
        /* Mejorar aspecto */
        border-radius: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
</style>

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
                <h4 class="text-themecolor">Correspondencias Remitidas</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                        <li class="breadcrumb-item active">Starter Page</li>
                    </ol>
                    <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i> Create New</button>
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
                <form id="send_frwd" enctype="multipart/form-data">
                    <div class="card" id="data_fam">
                        <div class="card-header text-white bg-info">
                            <b>Remitir Correspondencia</b>
                            <div class="card-actions">
                                <a class="text-white" data-action="collapse"><i class="ti-plus"></i></a>
                            </div>
                        </div>
                        <div class="card-body collapse show" id="frwd_form">
                            <h3 class="card-title">Remitir una Correspondencia Del N°: </h3>
                            <hr>
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" required name="tb_ds" id="tb_ds" placeholder="Enter Name here">
                                        <input type="hidden" name="id_rcvd" id="id_rcvd">
                                        <input type="hidden" name="url" id="url" value="<?= base_url() ?>">
                                        <label for="tb-i">Destinatario</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" required name="tb_rp" id="tb_rp" placeholder="Enter Name here">
                                        <label for="tb-i">Recibido Por:</label>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" required name="tb_c" id="tb_c" placeholder="Enter Name here">
                                        <label for="tb-i">Clase</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" required name="tb_d" id="tb_d" value="">
                                        <label for="tb-d">Fecha</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" required name="tb_i" id="tb_i" placeholder="Enter Name here">
                                        <label for="tb-i">Indicativo</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" required name="tb_cl" id="tb_cl" placeholder="Enter Name here">
                                        <label for="tb-cl">Clasificación</label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <textarea type="text" class="form-control" name="tb_as" id="tb_as" placeholder="Asunto" style="overflow: hidden;"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row">
                                <div class="form">
                                    <div class="grid">
                                        <div class="form-element">
                                            <input type="file" id="file-2" name="file_2">
                                            <label for="file-2" id="file-2-preview">
                                                <img id="img_r" src="<?= base_url() ?>assets/images/square_p.jpg" alt="">
                                                <div>
                                                    <span>+</span>
                                                </div>
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">

                                </div>
                                <div class="offset-sm-10 col-md-2">
                                    <button type="submit" class="btn waves-effect waves-light w-100 btn-success text-white" id="btn_frwrd">ENVIAR</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <!-- ============================================================== -->
            <!-- Start Card User -->
            <!-- ============================================================== -->

        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <table id="table_frwrd" class="table table-responsive table-striped border">
                                <thead>
                                    <tr>
                                        <th> N° DE ORDEN</th>
                                        <th style="min-width: 100px;">ORDEN RECIBIDO</th>
                                        <th style="min-width: 100px;">DESTINATARIO</th>
                                        <th style="min-width: 100px;">CLASE</th>
                                        <th style="min-width: 100px;">INDICATIVO</th>
                                        <th style="min-width: 100px;">FECHA</th>
                                        <th style="min-width: 100px;">CLASIF. </th>
                                        <th style="min-width: 200px;">ASUNTO</th>
                                        <th style="min-width: 100px;">RECIBIDO POR</th>
                                        <th style="min-width: 130px;">ARCHIVOS</th>
                                    </tr>
                                </thead>

                                <tbody id="tbody">
                                    <?php
                                    foreach ($rows as $key => $row) {
                                    ?>
                                        <tr id="f<?= $row->id_frwd ?>">
                                            <td><?= str_pad($row->id_frwd, 3, '0', STR_PAD_LEFT) ?></td>
                                            <td><button><?= str_pad($row->rcvd_corr, 3, '0', STR_PAD_LEFT) ?></button></td>
                                            <td><?= $row->destinty_frwd ?></td>
                                            <td><?= $row->class_frwd ?></td>
                                            <td><?= $row->indicative_frwd ?></td>
                                            <td><?= $row->date_frwd ?></td>
                                            <td><?= $row->clasif_frwd ?></td>
                                            <td><?= $row->issue_frwd ?></td>
                                            <td><?= $row->frwd_by ?></td>
                                            <td>
                                                <button class="btn btn-youtube waves-effect waves-light" type="button" onclick='viewPDF(<?= $row->id_frwd ?> ,"<?= $row->ext_frwd ?>")'><i class="far fa-file-pdf"></i></button>
                                                <a href="<?= base_url('be/archivos-adjuntos?id=' . $row->id_frwd) ?>" class="btn btn-info waves-effect waves-light" style="color:black" type="button"><i class="fas fa-cloud"></i></a>
                                            </td>
                                        </tr>
                                    <?php

                                    } ?>
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
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->

        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
<div id="view_pdf" class="modal" tabindex="-1" role="dialog" aria-labelledby="tooltipmodel" aria-hidden="true" style="background:transparent">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content" style="background-color: transparent; border:0px">
            <object class="pdfview" type="application/pdf" id="object_pdf"></object>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div id="view_files" class="modal" tabindex="-1" role="dialog" aria-labelledby="tooltipmodel" aria-hidden="true" style="background:transparent">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="title_files"></h4>
                <button type="button" onclick="closeRcvd()" class="btn-close" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" name="id_frwrd" id="id_frwrd">
                    <input multiple type="file" class="form-control" id="inputArchivos">
                    <br><br>

                </div>
            </div>
            <div class="modal-footer">
                <div class="offset-sm-10 col-md-2">
                    <button type="submit" class="btn waves-effect waves-light w-100 btn-success text-white" id="btnEnviar">ENVIAR</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>