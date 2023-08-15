$(function () {
	"use strict";
	let mybase_url = $("#url_base").val();
	let t = $("#table_rcvd").DataTable({});
	$("#tb_as, #issue_decree,#issue_decree_prev").autoResize();
	$("#tb_c, #tb_cl").select2({
		dropdownParent: $("#add_correspondence"),
	});

	$("#add").on("submit", (e) => {
		e.preventDefault();
		let rowfrm = $(".form-control");
		let f = $(this);
		var formData = new FormData(document.getElementById("add"));
		formData.append("dato", "valor");
		$.ajax({
			url: "correspondence/saveRcvd",
			type: "post",
			dataType: "json",
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: () => {
				$("#send_add").attr("disabled", "disabled");
				$("#send_add").text("Cargando...");
			},
		})
			.done((res) => {
				if (res.sd == 500) {
					if (res.key == 200) {
						t.row
							.add([
								'<button class="btn btn-info" OnClick="viewRcvd(' +
									res.id +
									", " +
									res.ext +
									')"><i class="fas fa-file-image"></i> ' +
									res.rsp +
									'</button> <a class="btn btn-primary" href="' +
									mybase_url +
									"be/archivos-adjuntos-recibido?id=" +
									res.id +
									'"><i class="fas fa-cloud"></i> </a>',
								rowfrm[0].value,
								rowfrm[1].value,
								rowfrm[2].value,
								rowfrm[3].value,
								rowfrm[4].value,
								rowfrm[6].value,
								rowfrm[5].value,
								'<button class="btn waves-effect waves-light w-100 btn-danger" OnClick="decree(0,' +
									res.id +
									')"> No Decretado</button>',
								'<td><span class="btn btn-danger">No Decretado</span></td>',
							])
							.draw(false);

						successMsg(
							"Correspondecia Agregado",
							"Nueva correspondecia recibida agregado",
							"#ff6849",
							"success"
						);
						close();
					} else if (res.key == 400) {
						successMsg(
							"Error Imagen",
							"Tomar foto a la Correspondencia Recibida",
							"#ff6849",
							"error"
						);
					}
				} else if (res.sd == 600) {
					$("#a_" + res.id).text(rowfrm[0].value);
					$("#b_" + res.id).text(rowfrm[1].value);
					$("#c_" + res.id).text(rowfrm[2].value);
					$("#d_" + res.id).text(rowfrm[3].value);
					$("#e_" + res.id).text(rowfrm[4].value);
					$("#f_" + res.id).text(rowfrm[6].value);
					$("#g_" + res.id).text(rowfrm[5].value);

					successMsg(
						"Correspondecia Editado",
						"La correspondencia se edito correctamente",
						"#ff6849",
						"success"
					);
				}
			})
			.fail((error) => {
				console.log(error.responseText);
			})
			.always(() => {
				$("#send_add").removeAttr("disabled");
				$("#send_add").text("Agregar");
				close();
			});
	});
	$("#btn_cancel").on("click", (e) => {
		e.preventDefault();
		close();
	});
	$("#close").on("click", () => {
		$("#slct_rol").empty();
		$("#slct_decree").empty();
		$("#issue_decree").empty();
		$("#decree").modal("hide");
		$("#urg").prop("checked", false);
		$("#m_urg").prop("checked", false);
	});
	$("#close_prev").on("click", () => {
		$("#slct_rol_prev").empty();
		$("#slct_decree_prev").empty();
		$("#issue_decree_prev").empty();
		$("#add_decree_prev").modal("hide");
		$("#urg_prev").prop("checked", false);
		$("#m_urg_prev").prop("checked", false);
		$("#d_urg_prev").prop("checked", false);
		$("#c_urg_prev").prop("checked", false);
	});
	$("#cancel_add").on("click", (e) => {
		e.preventDefault();
		close();
	});

	$("#btn_decree").on("click", () => {
		let id_rol = $("#slct_rol").val();
		let slcttxt = $("#slct_rol option:selected").html();
		let id_cr = $("#id_cr").val();
		let slct_decree = $("#slct_decree").val(),
			issue = $("#issue_decree").val(),
			radio;

		if ($("#urg").is(":checked")) {
			radio = "1";
		} else if ($("#m_urg").is(":checked")) {
			radio = "2";
		} else if ($("#d_urg").is(":checked")) {
			radio = "3";
		} else if ($("#c_urg").is(":checked")) {
			radio = "4";
		}
		let array_var = {
			id_rol: id_rol,
			id_cr: id_cr,
			radio: radio,
			issue: issue,
			slct_decree: slct_decree,
			slcttxt: slcttxt,
		};
		$.ajax({
			method: "POST",
			url: "correspondence/decreeTeam",
			data: array_var,
			dataType: "JSON",
			async: true,
		}).done((data) => {
			if (data.rsp == 400) {
				successMsg(
					"Advertencia de Permisos",
					"El actual usuario no puede realizar la siguiente acción",
					"#ff6849",
					"warning"
				);
			} else if (data.rsp == 200) {
				$("#table_rcvd")
					.find("tbody")
					.find("td")
					.each(function () {
						if ($(this).attr("id") == "d" + id_cr) {
							$("#d" + id_cr).html(
								'<button class="btn waves-effect waves-light w-100 btn-primary" Onclick="decree(' +
									id_rol +
									"," +
									id_cr +
									"," +
									slct_decree +
									"," +
									radio +
									')">' +
									slcttxt +
									"</button>"
							);
							$("#g_" + id_cr).text(slcttxt);
						}
					});
				successMsg(
					"Modificación Correcta",
					"La correspondencia se decreto correctamente",
					"#ff6849",
					"success"
				);

				$(".mdl_range").fadeOut();
				$("#slct_rol").empty();
				$("#slct_decree").empty();
				$("#decree").modal("hide");
			}
		});
	});

	$("#btn_decree_prev").on("click", () => {
		let id_office = $("#slct_rol_prev").val();
		let slcttxt = $("#slct_rol_prev option:selected").html();
		let decree_id = $("#id_cr_prev").val();
		let id_rol = $("#rol_prev").val();
		let id_sub_decree = $("#id_sub_decree").val();
		let slct_decree = $("#slct_decree_prev").val(),
			issue = $("#issue_decree_prev").val(),
			radio;

		if ($("#urg_prev").is(":checked")) {
			radio = "1";
		} else if ($("#m_urg_prev").is(":checked")) {
			radio = "2";
		} else if ($("#d_urg_prev").is(":checked")) {
			radio = "3";
		} else if ($("#c_urg_prev").is(":checked")) {
			radio = "4";
		}
		let array_var = {
			id_office: id_office,
			decree_id: decree_id,
			id_sub_decree: id_sub_decree,
			radio: radio,
			issue: issue,
			slct_decree: slct_decree,
			slcttxt: slcttxt,
		};

		$.ajax({
			method: "POST",
			url: "correspondence/decreeOffice",
			data: array_var,
			dataType: "JSON",
			async: true,
		}).done((data) => {
			if (data.rsp == 400) {
				successMsg(
					"Advertencia de Permisos",
					"El actual usuario no puede realizar la siguiente acción",
					"#ff6849",
					"warning"
				);
			} else if (data.rsp == 200) {
				$("#table_rcvd")
					.find("tbody")
					.find("td")
					.each(function () {
						if ($(this).attr("id") == "prev" + decree_id) {
							$("#prev" + decree_id).html(
								'<button class="btn waves-effect waves-light w-100 btn-primary" Onclick="decree_ad(' +
									id_rol +
									"," +
									decree_id +
									"," +
									slct_decree +
									"," +
									radio +
									')">' +
									slcttxt.substring(0, 10) +
									"</button>"
							);
						}
					});
				successMsg(
					"Modificación Correcta",
					"La correspondencia se decreto correctamente",
					"#ff6849",
					"success"
				);

				$(".mdl_range").fadeOut();
				$("#slct_decree_prev").empty();
				$("#slct_decree_prev").empty();
				$("#add_decree_prev").modal("hide");
			}
		});
	});
});

function decree(dec, id_cr, mode_decree, urg) {
	$("#decree").modal({ backdrop: "static", keyboard: false });
	$("#title_decree").text("Decretar Correspondencia Recibida");
	let select = $("#slct_rol").select2({
		dropdownParent: $("#decree"),
	});
	let slct_decree = $("#slct_decree").select2({
		dropdownParent: $("#decree"),
	});
	$.ajax({
		method: "post",
		url: "correspondence/userView",
		data: { id_corr: id_cr },
		dataType: "json",
	}).done((data) => {
		$("#id_cr").val(id_cr);
		let rols = data.rol,
			decrees = data.decree;
		rols.forEach((rol) => {
			if (rol.id_rol == dec) {
				select.append(
					'<option selected value="' +
						rol.id_rol +
						'">' +
						rol.name_rol +
						"</option>"
				);
			} else if (rol.name_rol == "SJAPE") {
			} else {
				select.append(
					'<option value="' + rol.id_rol + '">' + rol.name_rol + "</option>"
				);
			}
		});
		decrees.forEach((decre) => {
			if (decre.id_decree == mode_decree) {
				slct_decree.append(
					'<option selected value="' +
						decre.id_decree +
						'">' +
						decre.name_decree +
						"</option>"
				);
			} else {
				slct_decree.append(
					'<option value="' +
						decre.id_decree +
						'">' +
						decre.name_decree +
						"</option>"
				);
			}
		});
		if (urg == "1") {
			$("#urg").prop("checked", true);
		} else if (urg == "2") {
			$("#m_urg").prop("checked", true);
		} else if (urg == "3") {
			$("#d_urg").prop("checked", true);
		} else if (urg == "4") {
			$("#c_urg").prop("checked", true);
		}
		$("#issue_decree").val(data.corr[0]["issue_decree"]);
		$("#decree").modal("show");
	});
}
function decree_ad(dec, id_cr, mode_decree, urg) {
	$("#add_decree_prev").modal({ backdrop: "static", keyboard: false });
	let select = $("#slct_rol_prev").select2({
		dropdownParent: $("#add_decree_prev"),
	});
	let slct_decree = $("#slct_decree_prev").select2({
		dropdownParent: $("#add_decree_prev"),
	});
	$.ajax({
		method: "post",
		url: "correspondence/officeView",
		data: { id_corr: id_cr, dec: dec },
		dataType: "json",
	}).done((data) => {
		$("#id_cr_prev").val(id_cr);
		let rols = data.rol,
			decrees = data.decree;
		rols.forEach((rol) => {
			if (rol.id_office == data.corr[0]["office_decree"]) {
				select.append(
					'<option selected value="' +
						rol.id_office +
						'">' +
						rol.name_office +
						"</option>"
				);
			} else {
				select.append(
					'<option value="' +
						rol.id_office +
						'">' +
						rol.name_office +
						"</option>"
				);
			}
		});
		decrees.forEach((decre) => {
			if (decre.id_decree == data.corr[0]["mode_sub_decree"]) {
				slct_decree.append(
					'<option selected value="' +
						decre.id_decree +
						'">' +
						decre.name_decree +
						"</option>"
				);
			} else {
				slct_decree.append(
					'<option value="' +
						decre.id_decree +
						'">' +
						decre.name_decree +
						"</option>"
				);
			}
		});
		if (data.corr[0]["sub_urg"] == "1") {
			$("#urg_prev").prop("checked", true);
		} else if (data.corr[0]["sub_urg"] == "2") {
			$("#m_urg_prev").prop("checked", true);
		} else if (data.corr[0]["sub_urg"] == "3") {
			$("#d_urg_prev").prop("checked", true);
		} else if (data.corr[0]["sub_urg"] == "4") {
			$("#c_urg_prev").prop("checked", true);
		}
		$("#issue_decree_prev").val(data.corr[0]["issue_sub_decree"]);
		$("#id_sub_decree").val(data.corr[0]["id_sub_decree"]);
		$("#rol_prev").val(dec);
		$("#add_decree_prev").modal("show");
	});
}
function viewRcvd(id, ext) {
	let mybase_url = $("#url_base").val();

	if (ext == "png" || ext == "jpg" || ext == "jpeg") {
		$("#tooltipmodals").modal({ backdrop: "static", keyboard: false });
		$("#tooltipmodals").modal("show");
		setTimeout(() => {
			$("#spinn_img").attr("style", "display: none");
			$("#view_img").removeAttr("style");
			$("#view_img").attr(
				"src",
				mybase_url + "assets/images/cr_recvd/" + id + "." + ext
			);
		}, 800);
	} else {
		$("#view_pdf").modal("show");
		$("#object_pdf").removeAttr("style");
		$("#object_pdf").attr(
			"data",
			mybase_url + "assets/images/cr_recvd/" + id + "." + ext
		);
	}
}
function editDecree(id, ext) {
	let mybase_url = $("#url_base").val();

	$.ajax({
		method: "post",
		url: "correspondence/editDecree",
		data: { id: id },
		dataType: "json",
		beforeSend: () => {
			if ($("#crd_form").hasClass("card-body collapse")) {
				$("#crd_form").addClass("show");
				$("#icon_form").removeClass("ti-plus").addClass("ti-minus");
				$("#btn_rcvd").css("display", "none");
				$("#btn_cancel").removeAttr("style");
				$("#btn_edit").removeAttr("style");
			}
		},
	}).done((r) => {
		document.querySelector("#file-1-preview img").src =
			mybase_url + "assets/images/cr_recvd/" + id + "." + ext;
		$("#tb_r").val(r.row[0]["sender_rcvd"]).focus();

		$("#tb_c").val(r.row[0]["class_rcvd"]).trigger("change");
		$("#tb_i").val(r.row[0]["indicative_rcvd"]);
		$("#name_form").val("edit");
		$("#tb_d").val(r.row[0]["date_rcvd"]);
		$("#tb_cl").val(r.row[0]["clasif_rcvd"]).trigger("change");
		$("#tb_rp").val(r.row[0]["rcvd_by"]);
		$("#tb_as").val(r.row[0]["issue_rcvd"]);
		$("#id_received").val(id);
		$("#extension").val(ext);
	});
}
function closeRcvd() {
	$("#tooltipmodals").modal("hide");
	$("#view_img").attr("style", "display: none");
	$("#spinn_img").removeAttr("style");
}
function recortaDatos(dato, longitud) {
	var respuesta = dato;
	if (dato.length > longitud) {
		respuesta = dato.substring(0, longitud - 3) + "...";
	}
	return respuesta;
}
function close() {
	$("#add").trigger("reset");
	$("#tb_c").val("Oficios").trigger("change.select2");
	$("#tb_cl").val("Común").trigger("change.select2");
	$("#add_correspondence").modal("hide");
}
function addCorres() {
	$("#add_correspondence").modal({ backdrop: "static", keyboard: false });
	$("#add_correspondence").modal("show");
}
