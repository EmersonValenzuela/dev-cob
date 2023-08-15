<style>
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
</style>
<?php
if ($boss == 1) {
    $c = '';
} else {
    $c = 'disabled';
}
?>
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
                <h4 class="text-themecolor">Correspondencias Recibidas</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                        <li class="breadcrumb-item active">C. Recibidas</li>
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
                        <?php if ($depart == 1) : ?>
                            <div class="text-end"><button onclick="addCorres()" class="btn btn-success">Agregar Correspondecia</button></div><br>
                        <?php endif; ?>
                        <div class="row">
                            <table id="table_rcvd" class="table table-responsive table-striped border">
                                <thead>
                                    <tr>
                                        <th style="min-width: 120px;"> N° DE ORDEN</th>
                                        <th style="min-width: 130px;">REMITENTE</th>
                                        <th style="min-width: 100px;">CLASE</th>
                                        <th style="min-width: 100px;">INDICATIVO</th>
                                        <th style="min-width: 100px;">FECHA</th>
                                        <th style="min-width: 100px;">CLASIF. </th>
                                        <th style="min-width: 200px;">ASUNTO</th>
                                        <th style="min-width: 150px;">RECIBIDO POR</th>
                                        <?php if ($depart == true || $boss == 1) { ?>
                                            <th style="min-width: 130px;">DECRETADO</th>
                                        <?php } else { ?>
                                            <th style="min-width: 200px;">ACCIONES</th>
                                        <?php } ?>
                                        <th style="min-width: 130px;">ESTADO</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    <?php
                                    foreach ($rows as $key => $row) {
                                        $ext = "'" . $row->ext_rcvd . "'";
                                    ?>
                                        <tr id="r<?= $row->id_rcvd_cr ?>" class="tr_data" data-id="<?= $row->id_rcvd_cr ?>">
                                            <td> <button class="btn btn-info" OnClick="viewRcvd(<?= $row->id_rcvd_cr . ", '" . $row->ext_rcvd . "'" ?>)"><i class="fas fa-file-image"></i> <?= str_pad($row->id_rcvd_cr, 3, '0', STR_PAD_LEFT) ?></button>
                                                <a class="btn btn-primary" href="<?= base_url('COPERE/archivos-adjuntos-recibido?id=' . $row->id_rcvd_cr) ?>"><i class="fas fa-cloud"></i> </a>
                                            </td>
                                            <td><span id="a_<?= $row->id_rcvd_cr ?>"><?= $row->sender_rcvd ?></span></td>
                                            <td><span id="b_<?= $row->id_rcvd_cr ?>"><?= $row->class_rcvd ?></span></td>
                                            <td><span id="c_<?= $row->id_rcvd_cr ?>"><?= $row->indicative_rcvd ?></span></td>
                                            <td><span id="d_<?= $row->id_rcvd_cr ?>"><?= $row->date_rcvd ?></span></td>
                                            <td><span id="e_<?= $row->id_rcvd_cr ?>"><?= $row->clasif_rcvd ?></span></td>
                                            <td><span id="f_<?= $row->id_rcvd_cr ?>"><?= $row->issue_rcvd ?></span></td>
                                            <td><span id="g_<?= $row->id_rcvd_cr ?>"><?= $row->rcvd_by ?></span></td>
                                            <?php if ($depart == true || $boss == true) { ?>
                                                <td id="d<?= $row->id_rcvd_cr ?>">
                                                    <?php
                                                    if ($row->decree == "0") {
                                                    ?>
                                                        <button <?= $c ?> class="btn waves-effect waves-light w-100 btn-danger" OnClick="decree( 0, <?= $row->id_rcvd_cr ?>,<?= $row->mode_decree ?>,<?= $row->urg ?>)"> No Decretado</button>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <button <?= $c ?> class="btn waves-effect waves-light w-100 btn-primary" OnClick="decree( <?= $row->decree ?>, <?= $row->id_rcvd_cr ?>,<?= $row->mode_decree ?>,<?= $row->urg ?>)"><?= $row->name_rol ?></button>
                                                </td>
                                            <?php
                                                    }
                                            ?>
                                            <?php }

                                            if ($this->session->userdata('user_type') == $row->decree) {
                                                if ($row->rcvd_by == 'PREVISIÓN SOCIAL') {
                                                    if (get_sub_decree($row->id_rcvd_cr) =='') { ?>
                                                    <td id="prev<?= $row->id_rcvd_cr ?>">
                                                        <button class="btn waves-effect waves-light w-100 btn-danger" OnClick="decree_ad(<?= $row->decree ?>, <?= $row->id_rcvd_cr ?>,<?= $row->mode_decree ?>,<?= $row->urg ?>)"> No Decretado</button>
                                                    </td>
                                                <?php } else {
                                                ?>
                                                    <td id="prev<?= $row->id_rcvd_cr ?>">
                                                        <button class="btn waves-effect waves-light w-100 btn-primary" OnClick="decree_ad(<?= $row->decree ?>, <?= $row->id_rcvd_cr ?>,<?= $row->mode_decree ?>,<?= $row->urg ?>)"><?= substr(get_sub_decree($row->id_rcvd_cr),0,15) ?></button>
                                                    </td>
                                                <?php
                                                    }
                                                } else { ?>
                                                <td><a href="<?= base_url('be/correspondecias-remitidas#' . $row->id_rcvd_cr) ?>" class="btn btn-success">Responder</a> </td>
                                        <?php
                                                }
                                            }
                                            $id_frwrd =  remitida($row->id_rcvd_cr);
                                            status_received($row->status, $row->id_rcvd_cr, $id_frwrd, 'COPERE'); ?>
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
        <div id="tooltipmodals" class="modal" tabindex="-1" role="dialog" aria-labelledby="tooltipmodel" aria-hidden="true" style="background:transparent">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Foto Correspondecia Recibida</h4>
                        <button type="button" onclick="closeRcvd()" class="btn-close" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <center>
                            <div id="spinn_img" class="spinner-grow" style="width: 5rem; height: 5rem;" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <img style="display: none;" class="img-fluid" alt="user" id="view_img" />
                        </center>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div id="view_pdf" class="modal" tabindex="-1" role="dialog" aria-labelledby="tooltipmodel" aria-hidden="true" style="background:transparent">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content" style="background-color: transparent; border:0px">
                    <object class="pdfview" type="application/pdf" id="object_pdf"></object>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal" tabindex="-1" role="dialog" aria-labelledby="tooltipmodel" aria-hidden="true" id="decree">
            <div class="modal-dialog modal-dialog-centered zoomIn animated">
                <div class="modal-content">
                    <div class="modal-header bg-secondary">
                        <h4 id="title_decree" class="modal-title"></h4>
                    </div>
                    <div class="modal-body bg-secondary">
                        <form id="send_decree">
                            <div class="form-group">
                                <label id="lbl_user" for="recipient-name" class="form-label"></label>
                                <select id="slct_rol" name="slct_rol" class="select2 form-control form-select" style="width: 100%; height:36px;position:fixed">
                                </select>
                                <input type="hidden" id="id_cr">
                            </div>
                            <div class="form-group">
                                <label id="lbl_user" for="recipient-name" class="form-label"></label>
                                <select id="slct_decree" name="slct_decree" class="select2 form-control form-select" style="width: 100%; height:36px;position:fixed">
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="radio" class="form-check-input" name="urg" id="urg">
                                <label class="label label-warning" for="urg">Urgente</label>

                                <input type="radio" class="form-check-input" name="urg" id="m_urg">
                                <label class="label label-danger" for="m_urg">Muy Urgente</label>

                                <input type="radio" class="form-check-input" name="urg" id="d_urg">
                                <label class="label label-info" for="d_urg">En la Fecha</label>

                                <input type="radio" class="form-check-input" name="urg" id="c_urg">
                                <label class="label label-success" for="c_urg">Conocimiento y Archivo</label>
                            </div>
                            <div class="form-group">
                                <textarea type="text" class="form-control" name="issue_decree" id="issue_decree" placeholder="Observaciones" style="overflow: hidden;"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer bg-secondary">
                        <button type="button" class="btn btn-danger waves-effect" id="close">
                            Cerrar
                        </button>
                        <button id="btn_decree" type="button" class="btn btn-primary waves-effect waves-light text-white">
                            Modificar rol
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <div id="add_correspondence" class="modal" tabindex="-1" role="dialog" aria-labelledby="tooltipmodel" aria-hidden="true" id="decree">
            <div class="modal-dialog zoomIn animated">
                <div class="modal-content">
                    <div class="modal-header bg-secondary">
                        <h4 id="title_decree" class="modal-title">Agregar Correspondencia</h4>
                    </div>
                    <div class="modal-body bg-secondary">
                        <form id="add">
                            <!--- Data hidden --->
                            <input type="hidden" name="name_form" id="name_form" value="save">
                            <!--- End Data hidden --->

                            <div class="form-body">
                                <div class="row pt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Remitente</label>
                                            <input type="text" name="tb_r" id="tb_r" class="form-control" placeholder="Ingresar Remitente" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Indicativo</label>
                                            <input type="text" name="tb_i" id="tb_i" class="form-control" placeholder="Ingresar Indicativo" required>
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Clase</label>
                                            <select id="tb_c" name="tb_c" class="select2 form-control form-select" style="width: 100%; height:36px;position:fixed">
                                                <option value="Oficios">Oficios</option>
                                                <option value="Fax">Fax</option>
                                                <option value="Solicitud">Solicitud</option>
                                                <option value="Directiva">Directiva</option>
                                                <option value="Informe">Informe</option>
                                                <option value="Hoja de Tramite">Hoja de Tramite</option>
                                                <option value="O.G.E">O.G.E</option>
                                                <option value="Hoja de coordinación">Hoja de coordinación</option>
                                                <option value="Oficio Multiple">Oficio Multiple</option>
                                                <option value="Fax Multiple">Fax Multiple</option>
                                                <option value="Otros">Otros</option>
                                                <optgroup label="Empresas">
                                                    <option value="Canta">Canta</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Fecha</label>
                                            <input type="date" name="tb_d" id="tb_d" class="form-control" required>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Clasificación</label>
                                            <select id="tb_cl" name="tb_cl" class="form-control form-select" style="width: 100%; height:36px;position:fixed">
                                                <option value="Común">Común</option>
                                                <option value="Olaya">Olaya</option>
                                                <option value="O.P.E">O.P.E</option>
                                                <option value="E. Inf.">E. Inf.</option>
                                                <option value="Urgente">Urgente</option>
                                                <option value="Muy urgente">Muy urgente</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Recibido Por:</label>
                                            <input type="text" name="tb_rp" id="tb_rp" class="form-control" value="lo decreta JEM" required>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Asunto</label>
                                            <textarea type="text" class="form-control" name="tb_as" id="tb_as" placeholder="Asunto" style="overflow: hidden;" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Agregar Documento o Imagen</label>
                                            <input class="form-control" type="file" id="file-1" name="file_1" required>
                                        </div>
                                    </div>
                                </div>
                                <!--/row-->
                                <div class="form-actions text-end">
                                    <div class="card-body">
                                        <button type="submit" id="send_add" class="btn btn-primary text-white"> <i class="fa fa-check"></i> Agregar</button>
                                        <button type="submit" id="cancel_add" class="btn btn-dark"> Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" aria-labelledby="tooltipmodel" aria-hidden="true" id="add_decree_prev">
            <div class="modal-dialog modal-dialog-centered zoomIn animated">
                <div class="modal-content">
                    <div class="modal-header bg-secondary">
                        <h4 id="title_decree" class="modal-title"></h4>
                    </div>
                    <div class="modal-body bg-secondary">
                        <form id="send_decree_prev">
                            <div class="form-group">
                                <label id="lbl_user_prev" for="recipient-name" class="form-label"></label>
                                <select id="slct_rol_prev" name="slct_rol_prev" class="select2 form-control form-select" style="width: 100%; height:36px;position:fixed">
                                </select>
                                <input type="hidden" id="id_cr_prev">
                                <input type="hidden" id="id_sub_decree">
                                <input type="hidden" id="rol_prev">
                            </div>
                            <div class="form-group">
                                <label id="lbl_user" for="recipient-name" class="form-label"></label>
                                <select id="slct_decree_prev" name="slct_decree_prev" class="select2 form-control form-select" style="width: 100%; height:36px;position:fixed">
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="radio" class="form-check-input" name="urg_prev" id="urg_prev">
                                <label class="label label-warning" for="urg_prev">Urgente</label>

                                <input type="radio" class="form-check-input" name="urg_prev" id="m_urg_prev">
                                <label class="label label-danger" for="m_urg_prev">Muy Urgente</label>

                                <input type="radio" class="form-check-input" name="urg_prev" id="d_urg_prev">
                                <label class="label label-info" for="d_urg_prev">En la Fecha</label>

                                <input type="radio" class="form-check-input" name="urg_prev" id="c_urg_prev">
                                <label class="label label-success" for="c_urg_prev">Conocimiento y Archivo</label>
                            </div>
                            <div class="form-group">
                                <textarea type="text" class="form-control" name="issue_decree_prev" id="issue_decree_prev" placeholder="Observaciones" style="overflow: hidden;"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer bg-secondary">
                        <button type="button" class="btn btn-danger waves-effect" id="close_prev">
                            Cerrar
                        </button>
                        <button id="btn_decree_prev" type="button" class="btn btn-primary waves-effect waves-light text-white">
                            Modificar rol
                        </button>
                    </div>
                </div>
            </div>
        </div>