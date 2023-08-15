$(function () {
	let extensiones = [];
	let mybase_url = $("#url_base").val();

	const value = window.location.search;
	const urlParams = new URLSearchParams(value);
	let id = urlParams.get("id");
	let $inputArchivos = document.querySelector("#inputArchivos");
	$inputArchivos.addEventListener("change", async () => {
		const archivosParaSubir = $inputArchivos.files;
		const totalFicheros = $inputArchivos.files.length;

		if (archivosParaSubir.length <= 0) {
			// Si no hay archivos, no continuamos
			return;
		}
		// Preparamos el formdata
		const formData = new FormData();
		// Agregamos cada archivo a "archivos[]". Los corchetes son importantes
		for (const archivo of archivosParaSubir) {
			formData.append("archivos[]", archivo);
		}
		formData.append("id_rcvd", id);
		// Los enviamos
		const respuestaRaw = await fetch("correspondence/saveFilesRcvd", {
			method: "post",
			body: formData,
		});
		const respuesta = await respuestaRaw.json();
		$inputArchivos.value = null;

		console.log(totalFicheros);

		$.ajax({
			url: "correspondence/viewFilesRcvd",
			type: "post",
			dataType: "json",
			data: { amount: totalFicheros, id: id },
		}).done((r) => {
			console.log(r.rows);
			for (let i = 0; i < r.rows.length; i++) {
				let name = "'" + r.rows[i]["name_rcvd"] + "'";
				$("#div_one").append(
					'<div class="drive-item module text-center" id="r_' +
						r.rows[i]["id_file_rcvd"] +
						'">' +
						'<div class="drive-item-inner module-inner><div class="drive-item-title"><a href="#">' +
						r.rows[i]["name_rcvd"] +
						'</a><div class="drive-item-thumb"><a href="#"><i class="fa fa-check-circle text-success"></i></a></div></div>' +
						'<div class="drive-item-footer module-footer"><ul class="utilities list-inline">' +
						'<li><a class="text-dark" href="' +
						mybase_url +
						"assets/files/received/" +
						id +
						"/" +
						r.rows[i]["name_rcvd"] +
						'" data-toggle="tooltip"' +
						'data-placement="top" title="" data-original-title="Download" download="' +
						r.rows[i]["name_rcvd"] +
						'"><i class="fa fa-download"></i></a></li>' +
						'<li><button style="border:none; background:transparent" onclick="deleteFile(' +
						r.rows[i]["id_file_rcvd"] +
						"," +
						id +
						"," +
						name +
						')" class="text-dark"' +
						'data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></button></li>' +
						"</ul></div></div>"
				);
			}
		});

		successMsg(
			"Archivos Agregados",
			"Archivos agregados correctamente",
			"#ff6849",
			"success"
		);
	});
});
function deleteFile(id, id_rcvd, name_rcvd) {
	$.ajax({
		url: "correspondence/deleteFileRcvd",
		data: { id: id, id_rcvd: id_rcvd, name_rcvd: name_rcvd },
		type: "post",
		dataType: "json",
	}).done((r) => {
		if (r.rsp == 200) {
			$("#r_" + id).remove();
			successMsg(
				"Archivo Eliminado",
				"Archivo correctamente eliminado",
				"#ff6849",
				"warning"
			);
		}
	});
}
