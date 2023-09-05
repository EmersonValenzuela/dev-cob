$(() => {
	let mybase_url = $("#url_base").val();

	$("#data-cmsts").DataTable({
		caches: true,
		order: [[0, "asc"]],
		searching: true,
		language: {
			sEmptyTable: "No se encontraron solicitudes",
			sZeroRecords: "No se encontraron solicitudes",
		},
		ajax: {
			method: "POST",
			url: "be/cmsts/list_cmsts",
		},
		columns: [
			{
				render: function (data, type, row) {
					return row.lastname_user + " " + row.name_user;
				},
			},
			{
				data: "cip_user",
			},
			{
				data: "dni_user",
			},
			/*{
				data: "cciiffs",
			},*/
			{
				data: "isActive",
				fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
					if (oData.isActive == 1) {
						$(nTd).html(
							"<button type='button' class='btn btn-success waves-effect waves-light' OnClick='viewActive(" +
								oData.id_user +
								")'><i class='fas fa-eye'></i> Ver Solicitud Activo</button>"
						);
					} else {
						$(nTd).html(
							"<button type='button' class='btn btn-danger waves-effect waves-light' OnClick='viewInactive(" +
								oData.id_user +
								")'><i class='fas fa-eye'></i> Ver Solicitud Inactivo</button>"
						);
					}
				},
			},
			{
				data: "id_user",
				fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
					$(nTd).html(
						"<button type='button' class='btn btn-danger waves-effect waves-light' OnClick='view_pdf(" +
							oData.id_user +
							")'><i class='fas fa-file-pdf'></i> </button>"
					);
				},
			},
		],
	});
});

const view_pdf = (id) => {
	let mybase_url = $("#url_base").val();

	window.open(mybase_url + "PDF-CMSTS/" + id, "_blank");
};
const viewActive = (id) => {
	let mybase_url = $("#url_base").val();

	window.open(mybase_url + "PDF-CMSTS-ACTIVO/" + id, "_blank");
};
const viewInactive = (id) => {
	let mybase_url = $("#url_base").val();

	window.open(mybase_url + "PDF-CMSTS-INACTIVO/" + id, "_blank");
};
