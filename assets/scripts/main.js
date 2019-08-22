const alertSession = function () {
	$(".alert").remove();
};
setTimeout(alertSession, 4000);

$(".dele-menu").on("click", function (e) {
	e.preventDefault();
	let link = $(this).attr("href");
	sweet(link);
});

function sweet($id) {
	Swal.fire({
		title: "Are you sure?",
		text: "You won't be able to revert this!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes, delete it!"
	}).then(result => {
		if (result.value) {
			Swal.fire({
				title: "Success",
				type: "success",
				text: "Your imaginary file has been deleted",
				showConfirmButton: false,
				timer: 2000,
			});
			setTimeout(() => {
				location.href = $id;
			}, 1500);
		}
	});
}
$("#add-btn").on("click", function () {
	const x = $(this).attr("data-href");
	const y = $(this).attr("data-met");

	$("#modalTitle").html("Add new " + y);
	$("#menu-modal input").val(null);

	$("#menu-modal input").each(function () {
		let val = $(this).attr("value");
		$(this).val(val);
	});

	$("#menu-modal small.text-danger>p").show();

	$("#menu-modal").attr(
		"action",
		`http://localhost/project/MVC/unpas-full-login/${x}`
	);
});

$(".edit-menu").on("click", function () {
	let getData = [];
	const id = $(this).attr("data-id");
	let x = $(this).attr("data-seg");
	let y = $(this).attr("data-met");
	let z = $(this).attr("data-ajx");

	$("#menu-modal input").each(function () {
		getData.push($(this).attr("id"));
	});
	$("#menu-modal select").each(function () {
		getData.push($(this).attr("id"));
	});

	$("#modalTitle").html("Edit " + x);

	$("#menu-modal").attr(
		"action",
		`http://localhost/project/MVC/unpas-full-login/${x}/${y}`
	);
	$("#menu-modal small.text-danger>p").hide();
	$("#errorBox").remove();
	$.ajax({
		url: `http://localhost/project/MVC/unpas-full-login/${x}/getAjax_${z}`,
		data: {
			id: id
		},
		method: "post",
		dataType: "json",
		success: function (data) {
			console.log(
				`http://localhost/project/MVC/unpas-full-login/${x}/getAjax_${z}`
			);
			const objName = Object.getOwnPropertyNames(data[0]);
			const objVal = Object.values(data[0]);

			getData.forEach(function (e) {
				for (let i = 0; i < objName.length; i++) {
					if (e == objName[i]) {
						console.log(e + " = " + objVal[i]);
						$("#" + e).val(objVal[i]);
					}
				}
			});
		}
	});
});

$("input[id*=checkAcc]").on({
	click: function () {
		const menuId = $(this).data("menu");
		const roleId = $(this).data("role");
		console.log(menuId + " " + roleId);
		console.log("ok");
		$.ajax({
			url: `http://localhost/project/MVC/unpas-full-login/admin/changeAccess`,
			data: {
				menu_id: menuId,
				role_id: roleId
			},
			method: "post",
			success: function () {
				location.href = `http://localhost/project/MVC/unpas-full-login/admin/roleAccess/${roleId}`;
			}
		});
	}
});
$("#msg").on("click", function () {
	let msg = $(this).data("msg");
	let msg_type = $(this).data("type");
	flash_message(msg, msg_type);
});
setTimeout(() => {
	$("#msg").click();
}, 500);

function flash_message(msg, type) {
	let tit, ico;
	if (type == "success") {
		tit = "Success";
		ico = "success";
	} else if (type == "error") {
		tit = "Failed...!!!";
		ico = "error";
	} else if (type == "info") {
		tit = "For your information";
		ico = "info";
	}
	Swal.fire({
		title: tit,
		type: ico,
		text: msg,
		showConfirmButton: false,
		timer: 2000,
		animation: false,
		customClass: {
			popup: 'animated tada'
		}
	});
}

$("#pic").on("change", function () {
	let filename = $(this)
		.val()
		.split("\\")
		.pop();
	$(this)
		.next(".custom-file-label")
		.addClass("selected")
		.html(filename);
});
