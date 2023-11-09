$(document).ready(function () {

	$('body').delegate('#form-submit', 'submit', function (event) {
		event.preventDefault();

		$("#btn-submit").prop('disabled', true);
		$('#btn-submit').html('Loading...');

		$form = $('#form-submit');

		$.ajax({
			url: $form.attr('action'),
			type: 'POST',
			data: $form.serialize(),
			success: function (json) {
				$data = $.parseJSON(JSON.stringify(json));

				if ($data.response == 'success') {
					// toast('Successfully saved!');
					setTimeout(function () {
						document.location.href = $data.url;
					}, 500);

				} else {

					console.log("Update  Error");
					$('#btn-submit').html('Save');
					$("#btn-submit").prop('disabled', false);
					
				}

			},
			error: function (data) {

				console.log("Ajax Error!");
				$('#btn-submit').html('Save');
				$("#btn-submit").prop('disabled', false);


			}
		});

	});
});