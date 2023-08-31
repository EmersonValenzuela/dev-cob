$(() => {
	$("#tbl_das").dataTable({
		responsive: true,
		search: true,
	});
	$("#form_das").on("submit", (e) => {
		$("#submit_send").attr("disabled", true);
	});
});
