$(function () {
	let mybase_url = $("#url_base").val(),
		id = $("#user_staff").val();
	$("#id_pr").val(id);

	$("#civil_status, #condition_staff, #group_occup,#type_bck ").select2();
	$("#grade_staff").select2({
		placeholder: "Buscar Grado",
		minimumInputLength: 1,
		ajax: {
			url: mybase_url + "be/staff/data_grade",
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
	$("#speciality").select2({
		placeholder: "Buscar Especialidad",
		minimumInputLength: 1,
		ajax: {
			url: mybase_url + "be/staff/data_specialty",
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
	$("#unit_staff").select2({
		placeholder: "Buscar Unidad de Origen",
		minimumInputLength: 2,
		ajax: {
			url: mybase_url + "be/staff/data_origin",
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

	$.ajax({
		url: mybase_url + "be/staff/data_personal",
		method: "post",
		dataType: "json",
		data: { id: id },
		beforeSend: () => {},
	})
		.done((i) => {
			let row = i.row;
			$("#n_staff").val(i.name);
			$("#ls_staff").val(i.lastname);
			$("#cip").val(i.cip);
			$("#dni").val(i.dni);
			$("#cell_holder").val(i.phone);

			row.forEach((row) => {
				$("#place_birth").val(row.place_staff);
				$("#date_birth").val(row.birthday_staff);
				$("#home_address").val(row.address);
				$("#civil_status").val(row.status_staff).trigger("change");
				$("#number_children").val(row.sons_staff);
				$("#condition_staff").val(row.condition_staff).trigger("change");
				$("#date_contracted").val(row.hired_staff);
				$("#date_named").val(row.named_staff);
				$("#date_ascent").val(row.ascent_staff);
				$("#group_occup").val(row.ocupation_staff).trigger("change");
				$("#position").val(row.position_staff);
				$("#grade_staff").append(
					"<option value='" +
						row.grade_staff +
						"'>" +
						row.name_grade_staff +
						"</option>"
				);
				$("#unit_staff").append(
					"<option value='" + row.unit_staff + "'>" + row.name_rol + "</option>"
				);
				$("#speciality").append(
					"<option value='" +
						row.specialty_staff +
						"'>" +
						row.name_specialty +
						"</option>"
				);
			});
		})
		.fail((err) => {
			console.log(err.responseText);
		});

	$("#data-background").DataTable({
		order: [[3, "desc"]],
		paging: false,
		searching: false,
		language: {
			sEmptyTable: "Ningún Antecedente",
			sZeroRecords: "No se encontraron resultados",
		},
		ajax: {
			method: "POST",
			url: mybase_url + "be/staff/data_table",
			data: { id: id },
		},
		iDisplayLength: 3,
		columns: [
			{
				data: "type_bck",
			},
			{
				data: "name_bck",
			},
			{
				data: "doc_bck",
				fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
					$(nTd).html(
						"<a target='_blank' href='assets/images/bck_images/" +
							oData.doc_bck +
							"'>" +
							oData.doc_bck +
							"</a>"
					);
				},
			},
			{
				data: "id_bck",
				fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
					$(nTd).html(
						"<button type='button' class='btn btn-warning waves-effect waves-light' OnClick='edit_bck(" +
							oData.id_bck +
							")'><i class='far fa-edit'></i> </button>&nbsp; <button type='button' class='btn btn-danger waves-effect waves-light' OnClick='delete_bck(" +
							oData.id_bck +
							")'><i class='fas fa-trash-alt'></i> </button>"
					);
				},
			},
		],
	});

	$("#send_personal").on("submit", (e) => {
		e.preventDefault();
		$("#btn_send").attr("disabled", "disabled");
		$("#btn_send").html("Cargando...");
		$.ajax({
			url: mybase_url + "be/staff/gp_personal",
			method: "post",
			dataType: "json",
			data: $("#send_personal").serialize(),
		})
			.done((i) => {
				console.log(i.last);
				successMsg(
					"Personal Civil Editado",
					"Personal civil editado corretamente",
					"#ff6849",
					"success"
				);
			})
			.always(() => {
				$("#btn_send").removeAttr("disabled");
				$("#btn_send").html("Guardar Personal");
			})
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

	$("#btn_bck").on("click", (e) => {
		e.preventDefault();

		let f = $(this);
		var formData = new FormData(document.getElementById("form_bck"));
		formData.append("dato", "valor");
		$.ajax({
			url: mybase_url + "be/staff/up_bck",
			method: "POST",
			dataType: "json",
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: () => {
				$("#btn_bck").css("display", "none");
				$("#btn_pre").css("display", "block");
			},
		})
			.done((a) => {
				let json = a.data,
					id = a.up_id;
				successMsg(
					"Antecedente Agregado",
					"Nuevo Antecedente agregado corretamente",
					"#ff6849",
					"success"
				);
				$("#form_bck")[0].reset();
				$("#doc_bck").val(null);
				let table = $("#data-background").DataTable();
				table.ajax.reload(null, false);
			})
			.always(() => {
				$("#btn_bck").css("display", "block");
				$("#btn_pre").css("display", "none");
			})
			.fail((err) => {
				console.error(err.responseText);
			});
	});

});

function delete_bck(id) {
	let mybase_url = $("#url_base").val(),
		table = $("#data-background").DataTable();
	$.post(mybase_url + "be/staff/delete_bck", { id: id }, "json")
		.done((i) => {
			table.ajax.reload(null, false);
			successMsg(
				"Antecedente Eliminado",
				"Antecedente Eliminado corretamente",
				"#ff6849",
				"warning"
			);
		})
		.fail((err) => {
			console.error(err.responseText);
		});
}
