$(function () {
	"use strict";

	$("#tb_ca, #tb_di").autoResize();

	$("#ubigeo_birthday, #ubigeo_home, #ubigeo_atencion").select2({
		placeholder: "Buscar Código de Ubigeo",
		minimumInputLength: 2,
		ajax: {
			url: "cgi/data_ubigeo",
			dataType: "json",
			type: "GET",
			delay: 250,
			data: function (params) {
				return {
					q: params.term,
				};
			},
			processResults: function (data) {
				return {
					results: data,
				};
			},
			cache: true,
		},
	});

	$("#general_data").on("submit", (e) => {
		e.preventDefault();
		$("#btn_general").attr("disabled", "disabled");
		$("#btn_general").html("Cargando...");
		$.ajax({
			url: "cgi/insert_general",
			method: "post",
			dataType: "json",
			data: $("#general_data").serialize(),
		})
			.done((i) => {
				Swal.fire({
					title: "Datos generales guardados",
					text: "Los datos generales han sido guardados, Puede darle al botón de siguiente si aún no ha rellenado el Motivo de Invalidez.",
					type: "success",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
					cancelButtonText: "Cancelar",
					confirmButtonText: "Siguiente",
				}).then((result) => {
					if (result.value) {
						$("#events_ej").focus();
						$("#icon_general").removeClass("ti-minus").addClass("ti-plus");
						$("#div_general").removeClass("show");
					}
				});
			})
			.fail((e) => {
				Swal.fire({
					title: "Error",
					text: "No se pudo guardar los datos generales",
					type: "error",
				});
			})
			.fail((e) => {
				console.error(e.responseText);
			})
			.always(() => {
				$("#btn_general").removeAttr("disabled");
				$("#btn_general").html("Guardar Datos Generales");
			});
	});

	$("#disability_reason").on("submit", (e) => {
		e.preventDefault();
		$("#btn_reason").attr("disabled", "disabled");
		$("#btn_reason").html("Cargando...");
		$.ajax({
			url: "cgi/insert_reason",
			method: "post",
			dataType: "json",
			data: $("#disability_reason").serialize(),
		})
			.done((i) => {
				Swal.fire({
					title: "Datos generales guardados",
					text: "Los datos generales han sido guardados, Puede darle al botón de siguiente si aún no ha rellenado el Requerimientos.",
					type: "success",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
					cancelButtonText: "Cancelar",
					confirmButtonText: "Siguiente",
				}).then((result) => {
					if (result.value) {
						$("#ubigeo_atencion").focus();
						$("#icon_reason").removeClass("ti-minus").addClass("ti-plus");
						$("#div_reason").removeClass("show");
					}
				});
			})
			.fail((e) => {
				console.error(e.responseText);
			})
			.always(() => {
				$("#btn_reason").removeAttr("disabled");
				$("#btn_reason").html("Guardar Motivo de Invalidez");
			});
	});

	$("#require_disability").on("submit", (e) => {
		e.preventDefault();
		$("#btn_require").attr("disabled", "disabled");
		$("#btn_require").html("Cargando...");
		$.ajax({
			url: "cgi/insert_general",
			method: "post",
			dataType: "json",
			data: $("#require_disability").serialize(),
		})
			.done((i) => {
				Swal.fire({
					title: "Datos generales guardados",
					text: "Los datos generales han sido guardados, Puede darle al botón de siguiente si aún no ha rellenado el Motivo de Invalidez.",
					type: "success",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
					cancelButtonText: "Cancelar",
					confirmButtonText: "Siguiente",
				}).then((result) => {
					if (result.value) {
						$("#hospital").focus();
						$("#icon_require").removeClass("ti-minus").addClass("ti-plus");
						$("#div_require").removeClass("show");
					}
				});
			})
			.fail((e) => {
				console.error(e.responseText);
			})
			.always(() => {
				$("#btn_require").removeAttr("disabled");
				$("#btn_require").html("Guardar Requerimientos");
			});
	});

	// Family Process
	let table = $("#data-family").DataTable({
		caches: true,
		order: [[3, "desc"]],
		paging: false,
		searching: false,
		language: {
			sEmptyTable: "No se encontraron familiares",
			sZeroRecords: "No se encontraron familiares",
		},
		ajax: {
			method: "POST",
			url: "admin/CGI/data_table",
		},
		iDisplayLength: 7,
		columns: [
			{
				render: function (data, type, row) {
					return row.lastname_family + " " + row.name_family;
				},
			},
			{
				data: "relationship_family",
			},
			{
				data: "age_family",
			},
			/*{
				data: "cciiffs",
			},*/
			{
				data: "dni_family",
			},
			{
				data: "id_family",
				fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
					$(nTd).html(
						"<button type='button' class='btn btn-warning waves-effect waves-light' OnClick='edit_family(" +
							oData.id_family +
							")'><i class='fas fa-edit'></i> </button> " +
							"<button type='button' class='btn btn-danger waves-effect waves-light' OnClick='delete_family(" +
							oData.id_family +
							")'><i class='fas fa-trash-alt'></i> </button>"
					);
				},
			},
		],
	});
	$("#form_family input").keyup(function () {
		var form = $("#form_family").find(':input[type="text"]');
		var check = checkCampos(form);
		console.log(check);
		if (check) {
			$("#btn_family").prop("disabled", false);
			$("#btn_mdf").prop("disabled", false);
		} else {
			$("#btn_family").prop("disabled", true);
			$("#btn_mdf").prop("disabled", true);
		}
	});

	$("#btn_family").on("click", (e) => {
		e.preventDefault();

		var formData = new FormData(document.getElementById("form_family"));
		formData.append("dato", "valor");

		$.ajax({
			url: "admin/CGI/up_cm",
			method: "POST",
			dataType: "json",
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: () => {
				$("#btn_family").css("display", "none");
				$("#bt_pre").css("display", "block");
			},
		})
			.done((i) => {
				successMsg(
					"Familiar agregado",
					"Nuevo familiar agregado corretamente",
					"#ff6849",
					"success"
				);
				$("#form_family")[0].reset();
				$("#relationship").val("Hijo (a)").trigger("change");

				table.ajax.reload(null, false);
			})
			.fail((e) => {
				console.log(e.responseText);
			})
			.always(() => {
				$("#btn_family").css("display", "block");
				$("#btn_family").attr("disabled", "disabled");
				$("#bt_pre").css("display", "none");
			});
	});

	$("#btn_mdf").on("click", (e) => {
		e.preventDefault();

		let f = $(this);
		var formData = new FormData(document.getElementById("form_family"));
		formData.append("dato", "valor");

		$.ajax({
			url: "admin/CGI/edit_cm",
			method: "POST",
			dataType: "json",
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: () => {
				$("#btn_mdf").css("display", "none");
				$("#bt_pre").css("display", "block");
			},
		})
			.done((i) => {
				successMsg(
					"Familiar Editado",
					"Familiar editado corretamente",
					"#ff6849",
					"success"
				);
				table.ajax.reload(null, false);
				$("#form_family")[0].reset();
				$("#relationship").val("Hijo (a)").trigger("change");
			})
			.fail((e) => {
				console.error(err.responseText);
			})
			.always(() => {
				$("#btn_family").css("display", "block");
				$("#bt_pre").css("display", "none");
			});
	});
});
function edit_family(id) {
	$.post("admin/cgi/get_family", { id: id })
		.done((i) => {
			let result = i.result;
			result.forEach((row) => {
				$("#nameFamily").val(row.name_family);
				$("#lastNameFamily").val(row.lastname_family);
				$("#relationship").val(row.relationship_family).trigger("change");
				$("#age").val(row.age_family);
				$("#CCIIFFS").val(row.cciiffs);
				$("#idFamily").val(row.id_family);
				$("#dni").val(row.dni_family);
				$("#btn_family").css("display", "none");
				$("#btn_mdf").css("display", "block");
			});
		})
		.always(() => {});
}
function delete_family(id) {
	let table = $("#data-family").DataTable();
	$.post("admin/CGI/delete_family", { id: id })
		.done((i) => {
			if ((i.q = true)) {
				table.ajax.reload(null, false);
				successMsg(
					"Datos del familiar Eliminado",
					"Datos del familiar Eliminado corretamente",
					"#ff6849",
					"warning"
				);
			}
		})
		.fail((e) => {
			console.error(e.responseText);
		});
}
function checkCampos(obj) {
	var camposRellenados = true;
	obj.each(function () {
		var $this = $(this);
		if ($this.val().length <= 0) {
			camposRellenados = false;
			return false;
		}
	});
	if (camposRellenados == false) {
		return false;
	} else {
		return true;
	}
}
