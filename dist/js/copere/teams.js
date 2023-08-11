$(function () {
	$("#mdl_team").modal({
		backdrop: "static",
		keyboard: false,
	});

	$(".select2").on("change", () => {
		$(".boss").empty();
		$(".select2 :selected").each(function () {
			$(".boss").append(
				$("<option>", {
					value: this.value,
					text: this.text,
				})
			);
		});
	});

	$("#btn_send").on("click", (e) => {
		e.preventDefault();
		let n = $("#n_dp").val(),
			d = $("#d_dp").val(),
			j = $("#j_dp").val(),
			js = $("#js_dp").val(),
			m = $("#m_dp").val(),
			mcount = m.length;
		core = $("#core").val();
		let data = { n: n, d: d, j: j, m: m, js: js, core: core };
		
		$.ajax({
			url: "team/teamIn",
			type: "post",
			dataType: "json",
			data: data,
			beforeSend: () => {
				$("#btn_send").attr("disabled", true);
			},
		})
			.done((r) => {
				if (r.rsp == 200) {
					$("#mdl_team").modal("hide");
					data.length = 0;
					$(".select2").empty();
					$(".boss").empty();
					$("#send_team")[0].reset();

					$("#list_team").append(
						'<li id="l_' +
							r.id +
							'" class="media">' +
							'<div><i class="fas fa-users" style="font-size: 3em; margin-right:0.3em;"></i></div>' +
							'<div class="media-body"> ' +
							'<h6 class="card-title">' +
							n +
							"</h6>" +
							'<h6 class="card-subtitle">' +
							d +
							"</h6>" +
							"</div>" +
							'<button OnClick="deleteTeam(' +
							r.id +
							')" style="box-shadow: 0px 2px rgba(0,0,0,0.5);" data-toggle="tooltip" data-placement="top" title="Eliminar" type="button" class="btn btn-light float-end  btn-rounded"><i class="fa fa-trash"></i></button> &nbsp;' +
							'<button  OnClick="modifyTeam(' +
							r.id +
							')" style="box-shadow: 0px 2px rgba(0,0,0,0.5);" data-toggle="tooltip" data-placement="top" title="Gestionar" title="gestionar" type="button" class="btn btn-success float-end  btn-rounded text-white"><i class="fas fa-cog"></i></button>' +
							'</li> <hr id="r_' +
							r.id +
							'">'
					);

					successMsg(
						"Departamento Agregado",
						"Nuevo departamento agregado corretamente",
						"#ff6849",
						"success"
					);
				} else {
					successMsg(
						"Departamento ¡No agregado!",
						"Error del sistema contactarse con soporte",
						"#ff6849",
						"error"
					);
				}
			})
			.fail((err) => {
				console.error(err.responseText);
			})
			.always(() => {
				$("#btn_send").attr("disabled", false);
			});
	});

	$("#btn_modify").on("click", (e) => {
		e.preventDefault();
		let n = $("#n_dp").val(),
			d = $("#d_dp").val(),
			j = $("#j_dp").val(),
			js = $("#js_dp").val(),
			m = $("#m_dp").val(),
			i = $("#id_r").val();
		core = $("#core").val();

		let data = { n: n, d: d, j: j, m: m, i: i, js: js, core: core };
		$.ajax({
			url: "team/teamUp",
			type: "post",
			dataType: "json",
			data: data,
			beforeSend: () => {},
		})
			.done((r) => {
				if (r.rsp == 200) {
					$("#mdl_team").modal("hide");
					data.length = 0;
					$(".select2").empty();
					$(".boss").empty();
					$("#send_team")[0].reset();
					console.log(r.array);
					successMsg(
						"Departamento " + n + " Modificado",
						"Departamento  Modificado corretamente",
						"#ff6849",
						"success"
					);
				} else {
					successMsg(
						"Departamento ¡No Modificado!",
						"Error del sistema contactarse con soporte",
						"#ff6849",
						"error"
					);
				}
			})
			.fail((err) => {
				console.error(err.responseText);
			});
	});

	$("#btn_close").on("click", () => {
		$(".select2").empty();
		$(".boss").empty();
		$("#send_team")[0].reset();
		$("#mdl_team").modal("hide");
	});
});

function createTeam() {
	let select = $(".select2").select2({
		dropdownParent: $("#mdl_team .modal-body"),
	});
	$("#btn_modify").attr("style", "display:none");
	$("#btn_send").removeAttr("style", "display:none");
	$(".boss").append(
		$("<option>", {
			value: "0",
			text: "Primero seleccione a los miembros",
		})
	);
	$.ajax({
		method: "post",
		url: "team/getUser",
		dataType: "json",
	}).done((data) => {
		for (let i = 0; i < data.users.length; i++) {
			let id = data.users[i]["id_user"],
				depa = data.users[i]["rol"],
				name = data.users[i]["name_user"],
				last = data.users[i]["lastname_user"];

			if (depa == 1) {
			} else if (depa == 2) {
				select.append(
					'<option value="' + id + '">' + last + " " + name + "</option>"
				);
			}
		}
		for (let i = 3; i < data.rols.length; i++) {
			let $optgroup = $('<optgroup label="' + data.rols[i]["name_rol"] + '">');
			$.ajax({
				method: "post",
				url: "team/dep_user",
				dataType: "json",
				data: { id: data.rols[i]["id_rol"] },
			}).done(function (d) {
				for (let i = 0; i < d.dep.length; i++) {
					let op =
						'<option disabled value="' +
						d.dep[i]["id_user"] +
						'">' +
						d.dep[i]["name_user"] +
						" " +
						d.dep[i]["lastname_user"] +
						"</option>";
					$optgroup.append(op);
				}
				select.append($optgroup);
			});
		}
	});
	$("#mdl_team").modal("show");
}
function modifyTeam(id_rol) {
	$("#mdl_team").removeClass("zoomOut animated");
	$("#mdl_team").addClass("zoomIn animated");
	$.ajax({
		method: "post",
		url: "team/getUser",
		data: { id: id_rol },
		dataType: "json",
	}).done((data) => {
		$("#btn_send").attr("style", "display:none");
		$("#btn_modify").removeAttr("style", "display:none");
		$("#id_r").val(id_rol);
		$("#m_r").val(data.rol["array_int"]);
		$("#core").val(data.rol["core_rol"]).trigger("change");
		let select = $(".select2").select2({
			dropdownParent: $("#mdl_team .modal-body"),
		});
		$("#mdl_team").modal("show");
		console.log(data.rol);
		$("#n_dp").val(data.rol["name_rol"]);
		$("#d_dp").val(data.rol["descr_rol"]);

		for (let i = 0; i < data.users.length; i++) {
			let id = data.users[i]["id_user"],
				depa = data.users[i]["rol"],
				name = data.users[i]["name_user"],
				last = data.users[i]["lastname_user"];

			if (depa == 1) {
			} else if (depa == id_rol) {
				select.append(
					'<option selected value="' +
						id +
						'">' +
						last +
						" " +
						name +
						"</option>"
				);
			} else if (depa == 2) {
				select.append(
					'<option value="' + id + '">' + last + " " + name + "</option>"
				);
			}
		}
		for (let i = 3; i < data.rols.length; i++) {
			if (data.rols[i]["id_rol"] == id_rol) {
			} else {
				let $optgroup = $(
					'<optgroup label="' + data.rols[i]["name_rol"] + '">'
				);
				$.ajax({
					method: "post",
					url: "team/dep_user",
					dataType: "json",
					data: { id: data.rols[i]["id_rol"] },
				}).done(function (d) {
					for (let i = 0; i < d.dep.length; i++) {
						let op =
							'<option disabled value="' +
							d.dep[i]["id_user"] +
							'">' +
							d.dep[i]["name_user"] +
							" " +
							d.dep[i]["lastname_user"] +
							"</option>";
						$optgroup.append(op);
					}
					select.append($optgroup);
				});
			}
		}
		$(".select2 :selected").each(function () {
			if (this.value == data.rol["jefe_rol"]) {
				$("#j_dp").append(
					$("<option>", {
						selected: true,
						value: this.value,
						text: this.text,
					})
				);
			} else {
				$("#j_dp").append(
					$("<option>", {
						value: this.value,
						text: this.text,
					})
				);
			}
			if (this.value == data.rol["subjefe_rol"]) {
				$("#js_dp").append(
					$("<option>", {
						selected: true,
						value: this.value,
						text: this.text,
					})
				);
			} else {
				$("#js_dp").append(
					$("<option>", {
						value: this.value,
						text: this.text,
					})
				);
			}
		});
	});
}
function deleteTeam(id_rol) {
	Swal.fire({
		title: "¿Estas Seguro?",
		text: "¡No podrás revertir esto.!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Si, Eliminalo!",
		cancelButtonText: "No, Cancelar!",
	}).then((result) => {
		if (result.value) {
			$.ajax({
				method: "post",
				url: "team/delTeam",
				data: { id: id_rol },
				dataType: "json",
			})
				.done((data) => {
					Swal.fire(
						"Eliminado!",
						"El departamento ha sido eliminado correctamente.",
						"success"
					);
					$("#l_" + id_rol).attr("style", "display:none");
					$("#r_" + id_rol).attr("style", "visibility: hidden");
					$("#h_" + id_rol).attr("style", "display: none");
				})
				.fail((err) => {
					console.error(err.responseText);
				});
		}
	});
}