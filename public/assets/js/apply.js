$(document).ready(function () {

    $('.button1').on('click',function(){
        
        var button1 = $(this);
        var jobId = $(this).data('jobid');
        console.log(jobId);
        var tradesId = button1.data('tradesid');
        console.log(tradesId)
        var name = button1.data('name');
        console.log("Testt")
        var description = button1.data('description');



        $.ajax({
            url: 'process/application.php',
            type: 'POST',
            data: {
                job_id: jobId,
                tradesperson_id: tradesId,
                name: name,
                description: description,
                applied: true,
                process: 'process', 
                process:  'add'
                
            },
            success: function (response) {

                $data = $.parseJSON(JSON.stringify(json));
                // console.log($data)
                
                if ($data.response == 'success') {
						Swal.fire({
							title: 'do You Want to Apply?',
							text: name,
							text: description,
							text: description,
							icon: 'question',
							showCancelButton: true,
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
							confirmButtonText: 'Yes!'
						}).then((result) => {
							if (result.isConfirmed) {
								Swal.fire({
									title: 'Applied!',
									icon: 'success',
									text: 'You Successfully Applied to this Job',
									showConfirmButton: false
								});
                                document.location.reload();
							}
						});
                        
					} else {
						console.log("Update Failed");
						// document.location.reload();
                        console.log(response)
					}
                },
                error: function () {
                    console.log("AJAX Error");
                    // console.log($data)
            }
        });
    });
});
