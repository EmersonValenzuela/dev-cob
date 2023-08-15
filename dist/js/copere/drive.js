$(function () {
	let extensiones = [];

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
		formData.append("id_frwrd", id);
		// Los enviamos
		const respuestaRaw = await fetch("correspondence/saveFiles", {
			method: "post",
			body: formData,
		});
		const respuesta = await respuestaRaw.json();
		$inputArchivos.value = null;

		console.log(totalFicheros);

		$.ajax({
			url: "correspondence/viewFiles",
			type: "post",
			dataType: "json",
			data: { amount: totalFicheros, id: id },
		}).done((r) => {
			console.log(r.rows);
			for (let i = 0; i < r.rows.length; i++) {
				let name = "'" + r.rows[i]["name"] + "'";
				$("#div_one").append(
					'<div class="drive-item module text-center" id="f_' +
						r.rows[i]["id_file"] +
						'">' +
						'<div class="drive-item-inner module-inner><div class="drive-item-title"><a href="#">' +
						r.rows[i]["name"] +
						'</a><div class="drive-item-thumb"><a href="#"><i class="fa fa-check-circle text-success"></i></a></div></div>' +
						'<div class="drive-item-footer module-footer"><ul class="utilities list-inline">' +
						'<li><a class="text-dark" href="' +
						base_url +
						"assets/files/forwarded/" +
						id +
						"/" +
						r.rows[i]["name"] +
						'" data-toggle="tooltip"' +
						'data-placement="top" title="" data-original-title="Download" download="' +
						r.rows[i]["name"] +
						'"><i class="fa fa-download"></i></a></li>' +
						'<li><button style="border:none; background:transparent" onclick="deleteFile(' +
						r.rows[i]["id_file"] +
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

	$("#answer_response").on("click", () => {
		$("#answer").modal({ backdrop: "static", keyboard: false });
		$("#answer").modal("show");
		id = $("#answer_response").data("id");
		$("#id_frwd").val(id);
	});

	$("#file_answer").on("change", async () => {
		let $input = document.querySelector("#file_answer");
		const achivos = $input.files;

		const formData = new FormData();
		for (const archivo of achivos) {
			formData.append("archivos[]", archivo);
		}
		formData.append("id_frwrd", $("#id_frwd").val());
		formData.append("id_rcvd", $("#id_rcvd").val());

		const respuestaRaw = await fetch("correspondence/saveAnswer", {
			method: "post",
			body: formData,
		});

		const respuesta = await respuestaRaw.json();
		$("#answer").modal("hide");
		$("#answer_response").css("display", "none");
		successMsg(
			"Archivo Agregado",
			"Archivo agregado correctamente",
			"#ff6849",
			"success"
		);
		$("#div_two").append(
			'<div class="drive-item module text-center" id="ans' +
				$("#id_frwd").val() +
				'">' +
				'<div class="drive-item-inner module-inner><div class="drive-item-title"><a href="#">Archivo Firmado' +
				'</a><div class="drive-item-thumb"><a href="#"><img class="img-responsive" src="' +
				base_url +
				"assets/images/cr_forwarded/" +
				respuesta +
				'"></a></div></div>' +
				'<div class="drive-item-footer module-footer"><ul class="utilities list-inline">' +
				'<li><a class="text-dark" href="' +
				base_url +
				"assets/images/cr_forwarded/" +
				respuesta +
				'" data-toggle="tooltip"' +
				'data-placement="top" title="" data-original-title="Download" download="' +
				respuesta +
				'"><i class="fa fa-download"></i></a></li>' +
				'<li><button style="border:none; background:transparent" onclick="deleteAnswer(' +
				respuesta +
				"," +
				$("#id_frwd").val() +
				"," +
				$("#id_rcvd").val() +
				')" class="text-dark"' +
				'data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></button></li>' +
				"</ul></div></div>"
		);
	});
});
function deleteFile(id, id_frwrd, name) {
	$.ajax({
		url: "correspondence/deleteFile",
		data: { id: id, id_frwrd: id_frwrd, name: name },
		type: "post",
		dataType: "json",
	}).done((r) => {
		if (r.rsp == 200) {
			$("#f_" + id).remove();
			successMsg(
				"Archivo Eliminado",
				"Archivo correctamente eliminado",
				"#ff6849",
				"warning"
			);
		}
	});
}
function deleteAnswer(name, id_frwd, id_rcvd) {
	$.ajax({
		url: "correspondence/deleteAnswer",
		data: { id_rcvd: id_rcvd, id_frwd: id_frwd, name: name },
		type: "post",
		dataType: "json",
	}).done((r) => {
		$("#answer_response").css("display", "block");

		$("#ans" + id_frwd).remove();
		successMsg(
			"Archivo Eliminado",
			"Archivo correctamente eliminado",
			"#ff6849",
			"warning"
		);
	});
}
