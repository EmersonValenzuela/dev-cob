!(function ($) {
	"use strict";



	var SweetAlert = function () {};

	//examples
	(SweetAlert.prototype.init = function () {
		$("#sa-confirm").click(function () {
			Swal.fire({
				title: "Estas seguro?",
				text: "¡No podrás revertir esto!!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				cancelButtonText: "Cancelar",
				confirmButtonText: "¡Sí, elimínalo!",
			}).then((result) => {
				if (result.value) {
					document.form_u.submit();
				}
			});
		});
	}),
		//init
		($.SweetAlert = new SweetAlert()),
		($.SweetAlert.Constructor = SweetAlert);
})(window.jQuery),
	//initializing
	(function ($) {
		"use strict";
		$.SweetAlert.init();
	})(window.jQuery);
