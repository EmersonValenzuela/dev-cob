$(function () {
	"use strict";
	load_data();
	$("#civil_status, #relationship").select2();
	$("#place_birth, #place_housing").select2({
		placeholder: "Buscar Código de Ubigeo",
		minimumInputLength: 2,
		ajax: {
			url: "be/staff/data_ubigeo",
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

	// Family Data Aditional
	$("#general_data").on("submit", (e) => {
		e.preventDefault();
		$.ajax({
			url: "admin/mcsts/edit_user",
			method: "post",
			dataType: "json",
			data: $("#general_data").serialize(),
		})
			.done((i) => {
				successMsg(
					"Datos Adicionales Editados",
					"Datos adicionales editados corretamente",
					"#ff6849",
					"success"
				);
			})
			.always(() => {})
			.fail((err) => {
				console.log(err.responseText);
				successMsg(
					"Error",
					"Porfavor Informar sobre este error",
					"#ff6849",
					"error"
				);
			});
	});
	//--->

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
			url: "admin/mcsts/data_table",
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
			{
				data: "cciiffs",
			},
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
			url: "admin/mcsts/up_cm",
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
			url: "admin/mcsts/edit_cm",
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
			.always(() => {
				$("#btn_family").css("display", "block");
				$("#bt_pre").css("display", "none");
			});
	});
});
function edit_family(id) {
	$.post("admin/mcsts/get_family", { id: id })
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
	$.post("admin/mcsts/delete_family", { id: id })
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
		.fail((err) => {
			console.error(err.responseText);
		});
}

function load_data() {
	$.post("admin/mcsts/init_data").done((i) => {
		if (i.status) $("#civil_status").val(i.status).trigger("change");
		if (i.gender) $("#gender").val(i.gender).trigger("change");
		$("#date_birthday").val(i.date_birthday);
		$("#urbanization").val(i.urbanization);
		$("#address").val(i.address);
		$("#emergency").val(i.emergency);
		if (i.birthday)
			$("#place_birth").append(
				"<option value='" + i.ubigeo_birthday + "'>" + i.birthday + "</option>"
			);
		if (i.housing)
			$("#place_housing").append(
				"<option value='" + i.ubigeo_housing + "'>" + i.housing + "</option>"
			);
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
