$(function ($) {
	"use strict";

	let mybase_url = $("#url_base").val();
	$(".input_numb").on("input", function () {
		this.value = this.value.replace(/[^0-9.]/g, "");
	});
	$(".input_txt").on("input", function () {
		this.value = this.value.replace(/[^a-zA-Z ]/g, "");
	});
	$("#a_uni").on("click", (e) => {
		e.preventDefault();

		if ($("#a_uni").data("user") == "1") {
			Swal.fire({
				type: "error",
				title: "Error de Datos",
				text: "Al parecer no has rellenado todos los datos en perfil. Importante agregar las imagenes de FIRMA, DNI y CIP!",
				confirmButtonText: "Dirigirme a Perfil",
			}).then((result) => {
				if (result.value) {
					location.href = mybase_url + "mi-perfil";
				}
			});
		} else {
			location.href = $("#a_uni").data("url");
		}
	});

	$("#a_ins").on("click", (e) => {
		e.preventDefault();

		if ($("#a_ins").data("user") == "1") {
			Swal.fire({
				type: "error",
				title: "Error de Datos",
				text: "Al parecer no has rellenado todos los datos en perfil. Importante agregar las imagenes de FIRMA, DNI y CIP!",
				confirmButtonText: "Dirigirme a Perfil",
			}).then((result) => {
				if (result.value) {
					location.href = mybase_url + "mi-perfil";
				}
			});
		} else {
			location.href = $("#a_ins").data("url");
		}
	});

	$("#a_bri").on("click", (e) => {
		e.preventDefault();

		if ($("#a_bri").data("user") == "1") {
			Swal.fire({
				type: "error",
				title: "Error de Datos",
				text: "Al parecer no has rellenado todos los datos en perfil. Importante agregar las imagenes de FIRMA, DNI y CIP!",
				confirmButtonText: "Dirigirme a Perfil",
			}).then((result) => {
				if (result.value) {
					location.href = mybase_url + "mi-perfil";
				}
			});
		} else {
			location.href = $("#a_bri").data("url");
		}
	});
	$.fn.buttonLoader = (action, id) => {
		if (action == "start") {
			$(id).attr("disabled","disabled");
			$(id).html(
				'<span class="spinner"><i class="fa fa-spinner fa-spin" title="button-loader"></i></span> Cargando información'
			);
		}
		$(id).removeAttr('disabled');

	};
});
var base_url = "http://localhost/dev-cob/";

/* Whatsapp Chat Widget by www.idblanter.com */

$(document).on("click", "#send-it", function () {
	var a = document.getElementById("chat-input");
	if ("" != a.value) {
		var b = $("#get-number").text(),
			c = document.getElementById("chat-input").value,
			d = "https://web.whatsapp.com/send",
			e = b,
			f = "&text=" + c;
		if (
			/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
				navigator.userAgent
			)
		)
			var d = "whatsapp://send";
		var g = d + "?phone=" + e + f;
		window.open(g, "_blank");
	}
}),
	$(document).on("click", ".informasi", function () {
		(document.getElementById("get-number").innerHTML = $(this)
			.children(".my-number")
			.text()),
			$(".start-chat,.get-new").addClass("show").removeClass("hide"),
			$(".home-chat,.head-home").addClass("hide").removeClass("show"),
			(document.getElementById("get-nama").innerHTML = $(this)
				.children(".info-chat")
				.children(".chat-nama")
				.text()),
			(document.getElementById("get-label").innerHTML = $(this)
				.children(".info-chat")
				.children(".chat-label")
				.text());
	}),
	$(document).on("click", ".close-chat", function () {
		$("#whatsapp-chat").addClass("hide").removeClass("show");
	}),
	$(document).on("click", ".blantershow-chat", function () {
		$("#whatsapp-chat").addClass("show").removeClass("hide");
	});

function getFileExt(filename) {
	return filename.slice(((filename.lastIndexOf(".") - 1) >>> 0) + 2);
}

function dangerAlert() {
	Swal.fire({
		type: "error",
		title: "Oops...",
		text: "Seleccione una Imagen por favor",
	});
}
function successMsg(d, f, g, h) {
	$.toast({
		heading: d,
		text: f,
		position: "top-right",
		loaderBg: g,
		icon: h,
		hideAfter: 3500,
		stack: 1,
	});
}
function get_date(i) {
	let dia = i.substr(8, 2),
		mes = i.substr(5, 2),
		año = i.substr(0, 4);
	switch (mes) {
		case "01":
			mes = "Enero";
			break;
		case "02":
			mes = "Febrero";
			break;
		case "03":
			mes = "Marzo";
			break;
		case "04":
			mes = "Abril";
			break;
		case "05":
			mes = "Mayo";
			break;
		case "06":
			mes = "Junio";
			break;
		case "07":
			mes = "Julio";
			break;
		case "08":
			mes = "Agosto";
			break;
		case "09":
			mes = "Septiembre";
			break;
		case "10":
			mes = "Octubre";
			break;
		case "11":
			mes = "Noviembre";
			break;
		case "12":
			mes = "Diciembre";
			break;
		default:
			break;
	}
	return dia + " de " + mes + " de " + año;
}
$.fn.button = function (action) {
	if (action === "loading" && this.data("loading-text")) {
		this.data("original-text", this.html())
			.html(this.data("loading-text"))
			.prop("disabled", true);
	}
	if (action === "reset" && this.data("original-text")) {
		this.html(this.data("original-text")).prop("disabled", false);
	}
};
$.fn.autoResize = function () {
	let r = (e) => {
		e.style.height = "";
		e.style.height = e.scrollHeight + "px";
	};
	return this.each((i, e) => {
		e.style.overflow = "hidden";
		r(e);
		$(e).bind("input", (e) => {
			r(e.target);
		});
	});
};
