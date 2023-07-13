$(function () {
	$("#data-inspection").DataTable({
		responsive: true,
		ordering: true,
	});
	$("#mdl_status").modal({
		backdrop: "static",
		keyboard: false,
	});
	$("#btn_bck").on("click", (e) => {
		e.preventDefault();

		let f = $(this);
		var formData = new FormData(document.getElementById("form_bck"));
		formData.append("dato", "valor");
		$.ajax({
			url: "staff/up_bck",
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

				close();
			})
			.always(() => {
				$("#btn_bck").css("display", "block");
				$("#btn_pre").css("display", "none");
			})
			.fail((err) => {
				console.error(err.responseText);
			});
	});

	$("#btn_up_bck").on("click", (e) => {
		e.preventDefault();
		let table = $("#data-background").DataTable();

		let f = $(this);
		var formData = new FormData(document.getElementById("form_bck"));
		formData.append("dato", "valor");
		$.ajax({
			url: "staff/update_bck",
			method: "POST",
			dataType: "json",
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: () => {
				$("#btn_up_bck").css("display", "none");
				$("#btn_pre").css("display", "block");
			},
		})
			.done((a) => {
				let json = a.data,
					id = a.up_id;
				table.ajax.reload(null, false);
				$("#form_bck")[0].reset();
				$("#doc_bck").val(null);
				successMsg(
					"Antecedente Modificado",
					"Antecedente Modificado corretamente",
					"#ff6849",
					"success"
				);
				close();
			})
			.always(() => {
				$("#btn_bck").css("display", "block");
				$("#btn_pre").css("display", "none");
			})
			.fail((err) => {
				console.error(err.responseText);
			});
	});

	$("#btn_cancel").on("click", (e) => {
		e.preventDefault();
		close();
	});
	$(".btn-close").on("click", (e) => {
		close();
		let table = $("#data-background").DataTable();
		table.destroy();
	$("#mdl_status").modal("hide");

	});
});

function background(id) {
	$("#id_pr").val(id);
	$("#data-background").DataTable({
		order: [[3, "desc"]],
		ajax: {
			method: "POST",
			url: "staff/data_table",
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
						"<button class='btn btn-warning waves-effect waves-light' OnClick='edit_bck(" +
							oData.id_bck +
							")'><i class='far fa-edit'></i> </button>&nbsp; <button class='btn btn-danger waves-effect waves-light' OnClick='delete_bck(" +
							oData.id_bck +
							")'><i class='fas fa-trash-alt'></i> </button>"
					);
				},
			},
		],
	});
}
function edit_bck(id) {
	$.post("staff/get_bck", { id: id }, "json").done((i) => {
		let data = i.data;
		data.forEach((row) => {
			$("#type_bck option[value=" + row.type_bck + "]").attr("selected", true);
			$("#name_bck").val(row.name_bck);
			$(".sp_file").text(row.doc_bck);
		});
		$("#btn_bck").css("display", "none");
		$("#btn_up_bck").css("display", "block");
		$("#id_bck").val(id);
	});
}
function delete_bck(id) {
	let table = $("#data-background").DataTable();
	$.post("staff/delete_bck", { id: id }, "json")
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

function close() {
	$("#btn_bck").css("display", "block");
	$("#btn_up_bck").css("display", "none");
	$("#form_bck")[0].reset();
	$("#type_bck option[value='']").attr("selected", true);
	$("#type_bck option[value='MEDICO']").attr("selected", false);
	$("#type_bck option[value='SANCION']").attr("selected", false);
	$("#doc_bck").val(null);
	$("#id_bck").val(null);
	$(".sp_file").html('<i class="fas fa-upload"></i> Cargar Documento');
}
