$(document).ready(function () {

    $('.accept').on('click',function(){
        
        var accept = $(this);
        var jobId = $(this).data('jobid');
        console.log(jobId);
        var active = accept.data('active');
        var rejected = accept.data('rejected');
        console.log(active)
        console.log(rejected)
        // var description = accept.data('description');
        // console.log(tradesId)
        // var name = accept.data('name');
        // console.log("Testt")
        // var description = accept.data('description');
        var applyId = accept.data('applyid');
        console.log(applyId)
        

        $.ajax({
            url: 'process/application.php',
            type: 'POST',
            data: {
                job_id: jobId,
                id :  applyId,
                process: 'process', 
                process: active == false && rejected== true? 'edit' :active == true && rejected == false ?'reject' : ''
                
            },
            success: function (json) {
                $data = $.parseJSON(JSON.stringify(json));
                if ($data.response == 'success') {
						Swal.fire({
							title: 'do You Want to Accept invitation?',
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
                                // document.location.reload();
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
