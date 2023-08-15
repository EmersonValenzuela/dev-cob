$(function () {
	$("#mdl_team").modal({
		backdrop: "static",
		keyboard: false,
	});
	$("#btn_close").on("click", () => {
		$(".select2").empty();
		$(".boss").empty();
		$(".department").empty();
		$("#send_team")[0].reset();
		$("#mdl_team").modal("hide");
	});
	$("#m_dp").on("change", () => {
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
	$("#de_dp").on("change", () => {
		let select = $("#m_dp");
		$("#m_dp").empty();
		$(".boss").empty();
		$(".boss").append(
			$("<option>", {
				value: "0",
				text: "Primero seleccione a los miembros",
			})
		);
		let id_rol = $("#de_dp").val();

		$.ajax({
			method: "post",
			data: { id: id_rol },
			url: "team/getUser",
			dataType: "json",
		}).done((data) => {
			for (let i = 0; i < data.users.length; i++) {
				let id = data.users[i]["id_user"],
					depa = data.users[i]["rol"],
					name = data.users[i]["name_user"],
					last = data.users[i]["lastname_user"];

				if (depa == 1) {
				} else if (depa == id_rol && data.users[i]["team_depart"] == "") {
					select.append(
						'<option value="' + id + '">' + last + " " + name + "</option>"
					);
				}
			}
			for (let i = 0; i < data.office.length; i++) {
				if (id_rol == data.office[i]["rol"]) {
					let $optgroup = $(
						'<optgroup label="' + data.office[i]["name_office"] + '">'
					);
					$.ajax({
						method: "post",
						url: "team/dep_user",
						dataType: "json",
						data: { id: data.office[i]["id_office"] },
					}).done(function (d) {
						for (let i = 0; i < d.off.length; i++) {
							let op =
								'<option disabled value="' +
								d.off[i]["id_user"] +
								'">' +
								d.off[i]["name_user"] +
								" " +
								d.off[i]["lastname_user"] +
								"</option>";
							$optgroup.append(op);
						}
						select.append($optgroup);
					});
				}
			}
		});
	});

	$("#btn_send").on("click", (e) => {
		e.preventDefault();
		let d = $("#de_dp").val(),
			n = $("#n_dp").val(),
			dp = $("#d_dp").val(),
			j = $("#j_dp").val(),
			m = $("#m_dp").val();
		let data = { n: n, d: d, j: j, m: m, dp: dp };
		console.log($("#send_team").serialize());
		$.ajax({
			url: "team/officeIn",
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
					$(".department").empty();
					$("#send_team")[0].reset();
					$("#mdl_team").modal("hide");

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
							dp +
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
						"Sección Agregado",
						"Nueva Sección agregado corretamente",
						"#ff6849",
						"success"
					);
				} else {
					successMsg(
						"Sección ¡No agregado!",
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
		let d = $("#de_dp").val(),
			n = $("#n_dp").val(),
			dp = $("#d_dp").val(),
			j = $("#j_dp").val(),
			m = $("#m_dp").val(),
			i = $("#id_r").val();
		let data = { n: n, d: d, j: j, m: m, i: i, dp: dp };
		$.ajax({
			url: "team/officeUp",
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
						"Sección " + n + " Modificado",
						"Sección  Modificado corretamente",
						"#ff6849",
						"success"
					);
				} else {
					successMsg(
						"Sección ¡No Modificado!",
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
});

function createTeam() {
	let select = $("#m_dp").select2({
		dropdownParent: $("#mdl_team .modal-body"),
	});
	$(".department").select2({
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
		dataType: "json",
		url: "team/getUser",
		dataType: "json",
	}).done((data) => {
		let rols = data.rols;

		rols.forEach((rol) => {
			$(".department").append(
				$("<option>", {
					value: rol.id_rol,
					text: rol.name_rol,
				})
			);
		});
		let id_rol = $(".department").val();
		for (let i = 0; i < data.users.length; i++) {
			let id = data.users[i]["id_user"],
				depa = data.users[i]["rol"],
				name = data.users[i]["name_user"],
				last = data.users[i]["lastname_user"];

			if (depa == 1) {
			} else if (depa == id_rol && data.users[i]["team_depart"] == "") {
				select.append(
					'<option value="' + id + '">' + last + " " + name + "</option>"
				);
			}
		}
		for (let i = 0; i < data.office.length; i++) {
			if (id_rol == data.office[i]["rol"]) {
				let $optgroup = $(
					'<optgroup label="' + data.office[i]["name_office"] + '">'
				);
				$.ajax({
					method: "post",
					url: "team/dep_user",
					dataType: "json",
					data: { id: data.office[i]["id_office"] },
				}).done(function (d) {
					for (let i = 0; i < d.off.length; i++) {
						let op =
							'<option disabled value="' +
							d.off[i]["id_user"] +
							'">' +
							d.off[i]["name_user"] +
							" " +
							d.off[i]["lastname_user"] +
							"</option>";
						$optgroup.append(op);
					}
					select.append($optgroup);
				});
			}
		}
	});
	$("#mdl_team").modal("show");
}

function modifyOffice(id_office) {
	$("#mdl_team").removeClass("zoomOut animated");
	$("#mdl_team").addClass("zoomIn animated");
	$.ajax({
		method: "post",
		url: "team/getUser",
		data: { id: id_office },
		dataType: "json",
	}).done((data) => {
		$("#btn_send").attr("style", "display:none");
		$("#btn_modify").removeAttr("style", "display:none");
		$("#id_r").val(id_office);
		$("#m_r").val(data.off["members_office"]);
		let select = $("#m_dp").select2({
			dropdownParent: $("#mdl_team .modal-body"),
		});
		$(".department").select2({
			dropdownParent: $("#mdl_team .modal-body"),
		});
		$("#mdl_team").modal("show");
		console.log(data.off);
		$("#n_dp").val(data.off["name_office"]);
		$("#d_dp").val(data.off["descrip_office"]);
		for (let i = 0; i < data.rols.length; i++) {
			if (data.rols[i]["id_rol"] == data.off["rol"]) {
				$(".department").append(
					'<option selected value="' +
						data.rols[i]["id_rol"] +
						'">' +
						data.rols[i]["name_rol"] +
						"</option>"
				);
			} else {
				$(".department").append(
					'<option value="' +
						data.rols[i]["id_rol"] +
						'">' +
						data.rols[i]["name_rol"] +
						"</option>"
				);
			}
		}

		for (let i = 0; i < data.users.length; i++) {
			let id = data.users[i]["id_user"],
				depa = data.users[i]["rol"],
				name = data.users[i]["name_user"],
				last = data.users[i]["lastname_user"];

			if (depa == 1) {
			} else if (data.users[i]["team_depart"] == id_office) {
				select.append(
					'<option selected value="' +
						id +
						'">' +
						last +
						" " +
						name +
						"</option>"
				);
			} else if (
				depa == data.off["rol"] &&
				data.users[i]["team_depart"] == ""
			) {
				select.append(
					'<option value="' + id + '">' + last + " " + name + "</option>"
				);
			}
		}

		$(".select2 :selected").each(function () {
			if (this.value == data.off["first_office"]) {
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
		});
	});
}
