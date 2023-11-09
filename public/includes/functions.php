<?php

function truncate($text, $chars = 40)
{
	echo mb_strimwidth($text, 0, $chars, "...");
}

function redirectTo($url)
{
	echo "<script type='text/javascript'>document.location.href='{$url}';</script>";
	echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $url . '">';
	exit();
}

function _404()
{
	redirectTo(APP_PATH . '404');
	exit();
}

function redirect($url)
{
	require_once 'redirect.php';
}

function setMetaTags($entry)
{
	if ($entry->getMetaTitle() != null) {
		global $metaTitle;
		$metaTitle = $entry->getMetaTitle();
	}

	if ($entry->getMetaDescription() != null) {
		global $metaDescription;
		$metaDescription = $entry->getMetaDescription();
	}

	if ($entry->getMetaKeywords() != null) {
		global $metaKeywords;
		$metaKeywords = $entry->getMetaKeywords();
	}
}

function get_contractor_id()
{
	$service = new PHPSupabase\Service(
		"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InprcXhuY3pvdWp3cGJ6bWJiaGhsIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODg1MzIxNDYsImV4cCI6MjAwNDEwODE0Nn0.-on7BPN5u1hfMU2VT5NEUdMxgXtpC5QBEeARQt2LpVw",
		"https://zkqxnczoujwpbzmbbhhl.supabase.co/rest/v1"
	);


	$query = $service->initializeQueryBuilder();
	$profiles = $query->select('id')
		->from('jobs')
		->where('contractor_id', 'eq.' . $_SESSION['id'])
		->execute()
		->getResult();

	$contractorIds = [];
	foreach ($profiles as $profile) {
		$contractorIds[] = $profile->id;
	}

	return $contractorIds;
}
function get_profile($trades_id)
{
	$service = new PHPSupabase\Service(
		"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InprcXhuY3pvdWp3cGJ6bWJiaGhsIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODg1MzIxNDYsImV4cCI6MjAwNDEwODE0Nn0.-on7BPN5u1hfMU2VT5NEUdMxgXtpC5QBEeARQt2LpVw",
		"https://zkqxnczoujwpbzmbbhhl.supabase.co/rest/v1"
	);


	$query = $service->initializeQueryBuilder();
	$profiles = $query->select('*')
		->from('profiles')
		->where('id', 'eq.' . $trades_id)
		->execute()
		->getResult();

	try {
		if (count($profiles) == 0) {
			$profiles = ['response' => 'error', 'status' => 400, 'message' => "Failed Create Data"];
		} else {
			$profiles = ['response' => 'success', 'status' => 200, 'data' => $profiles];
		}
	} catch (Exception $e) {
		$profiles = ['response' => 'error', 'status' => 400, 'message' => "Failed Create Data"];
	}
	return $profiles;
}
function wishlistcheck($jobId)
{
	$service = new PHPSupabase\Service(
		"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InprcXhuY3pvdWp3cGJ6bWJiaGhsIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODg1MzIxNDYsImV4cCI6MjAwNDEwODE0Nn0.-on7BPN5u1hfMU2VT5NEUdMxgXtpC5QBEeARQt2LpVw",
		"https://zkqxnczoujwpbzmbbhhl.supabase.co/rest/v1"
	);


	$query = $service->initializeQueryBuilder();
	$wishlist = $query->select('*')
		->from('wishlist')
		->where('job_id', 'eq.' . $jobId)
		->execute()
		->getResult();

	try {
		if (count($wishlist) == 0) {
			$wishlist = ['response' => 'error', 'status' => 400, 'message' => "Failed Create Data"];
		} else {
			$wishlist = ['response' => 'success', 'status' => 200, 'data' => $wishlist];
		}
	} catch (Exception $e) {
		$wishlist = ['response' => 'error', 'status' => 400, 'message' => "Failed Create Data"];
	}
	return $wishlist;
}
function wishlistchecktrades($tradesId)
{
	$service = new PHPSupabase\Service(
		"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InprcXhuY3pvdWp3cGJ6bWJiaGhsIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODg1MzIxNDYsImV4cCI6MjAwNDEwODE0Nn0.-on7BPN5u1hfMU2VT5NEUdMxgXtpC5QBEeARQt2LpVw",
		"https://zkqxnczoujwpbzmbbhhl.supabase.co/rest/v1"
	);


	$query = $service->initializeQueryBuilder();
	$wishlist = $query->select('*')
		->from('wishlist')
		->where('trades_id', 'eq.' . $tradesId)
		->execute()
		->getResult();

	try {
		if (count($wishlist) == 0) {
			$wishlist = ['response' => 'error', 'status' => 400, 'message' => "Failed Create Data"];
		} else {
			$wishlist = ['response' => 'success', 'status' => 200, 'data' => $wishlist];
		}
	} catch (Exception $e) {
		$wishlist = ['response' => 'error', 'status' => 400, 'message' => "Failed Create Data"];
	}
	return $wishlist;

	// if ($wishlist > 0 && $wishlist[0]->mark = true) {
	// 	return 'bookmarked';
	// } elseif ($wishlist > 0 && $wishlist[0]->mark = false) {
	// 	return 'available';
	// } else
	// 	('create');

}

function getImage($image, $class = '', $alt = '', $title = '', $massive = 0, $large = 1440, $medium = 1028, $small = 720)
{
	$imageSize = new \Contentful\Core\File\ImageOptions();

	// smallest size first
	$imageSize->setFormat('webp')->setWidth($small);
	$src = $image->getFile()->getUrl($imageSize);

	$imageSize->setWidth($medium);
	$srcset = $image->getFile()->getUrl($imageSize) . ' ' . $medium . 'w';

	$imageSize->setWidth($large);
	$srcset .= ', ' . $image->getFile()->getUrl($imageSize) . ' ' . $large . 'w';

	if ($massive > 0) {
		$imageSize->setWidth($massive);
		$srcset .= ', ' . $image->getFile()->getUrl($imageSize) . ' ' . $massive . 'w';
	}
?>

	<img<?php echo $class != '' ? ' class="' . $class . '"' : ''; ?> src="<?php echo $src; ?>" <?php echo $alt != '' ? ' alt="' . $alt . '"' : ''; ?> <?php echo $title != '' ? ' title="' . $title . '"' : ''; ?> rel="nofollow noopener noreferrer" />

<?php
}

function getImageMed($image, $class = '', $alt = '', $title = '', $massive = 0, $large = 960, $medium = 720, $small = 480)
{
	$imageSize = new \Contentful\Core\File\ImageOptions();

	// smallest size first
	$imageSize->setFormat('webp')->setWidth($small);
	$src = $image->getFile()->getUrl($imageSize);

	$imageSize->setWidth($medium);
	$srcset = $image->getFile()->getUrl($imageSize) . ' ' . $medium . 'w';

	$imageSize->setWidth($large);
	$srcset .= ', ' . $image->getFile()->getUrl($imageSize) . ' ' . $large . 'w';

	if ($massive > 0) {
		$imageSize->setWidth($massive);
		$srcset .= ', ' . $image->getFile()->getUrl($imageSize) . ' ' . $massive . 'w';
	}
?>

	<img<?php echo $class != '' ? ' class="' . $class . '"' : ''; ?> src="<?php echo $src; ?>" <?php echo $alt != '' ? ' alt="' . $alt . '"' : ''; ?> <?php echo $title != '' ? ' title="' . $title . '"' : ''; ?> rel="nofollow noopener noreferrer" />

<?php
}

function getImageMini($image, $class = '', $alt = '', $title = '', $massive = 0, $large = 720, $medium = 480, $small = 320)
{
	$imageSize = new \Contentful\Core\File\ImageOptions();

	// smallest size first
	$imageSize->setFormat('webp')->setWidth($small);
	$src = $image->getFile()->getUrl($imageSize);

	$imageSize->setWidth($medium);
	$srcset = $image->getFile()->getUrl($imageSize) . ' ' . $medium . 'w';

	$imageSize->setWidth($large);
	$srcset .= ', ' . $image->getFile()->getUrl($imageSize) . ' ' . $large . 'w';

	if ($massive > 0) {
		$imageSize->setWidth($massive);
		$srcset .= ', ' . $image->getFile()->getUrl($imageSize) . ' ' . $massive . 'w';
	}
?>

	<img<?php echo $class != '' ? ' class="' . $class . '"' : ''; ?> src="<?php echo $src; ?>" <?php echo $alt != '' ? ' alt="' . $alt . '"' : ''; ?> <?php echo $title != '' ? ' title="' . $title . '"' : ''; ?> />

<?php
}

function getCurl($url, $method = 'GET', $timeout = 1000, $fields = '', $key = '', $contenttype = '')
{

	$curl = curl_init();

	curl_setopt_array(
		$curl,
		array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => $timeout,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => '' . $method . '',
			CURLOPT_POSTFIELDS => $fields,
			CURLOPT_HTTPHEADER => array(
				'key: ' . $key . '',
				'Content-Type: ' . $contenttype . ''
			),
		)
	);

	$response = curl_exec($curl);
	curl_close($curl);

	return $response;
}

function generateRandomString6($length = 6)
{
	return substr(str_shuffle(str_repeat($x = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
}

function to_currency($number, $prefix = null, $decimal_place = 0)
{
	return "$prefix" . number_format($number, $decimal_place, ",", ".");
}
function inputText($name = '', $placeholder = '', $type = 'text')
{ ?>
	<div class="field">
		<div class="control">
			<input class="input" type="<?= $type ?>" name="<?= $name ?>" placeholder="<?= $placeholder ?>">
		</div>
	</div>
<?php } ?>


<?php function uploadImage($directory = '', $name = '')
{

	$target_dir = $directory;
	$target_file = $target_dir . basename($_FILES[$name]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	$check = getimagesize($_FILES[$name]["tmp_name"]);
	if ($check !== false) {
		$uploadOk = 1;
	} else {
		$data = ['response' => 'error', 'status' => 400, 'message' => 'Sorry, not file'];
		$uploadOk = 0;
	}


	if ($_FILES["uploadFile"]["size"] < 5) {
		$data = ['response' => 'error', 'status' => 400, 'message' => 'Sorry, your file is too small.'];
		$uploadOk = 0;
	}


	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		$data = ['response' => 'error', 'status' => 400, 'message' => 'Sorry, your file was not uploaded.'];
	} else {
		if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) {
			$data = ['response' => 'success', 'status' => 200, 'message' => 'Success', 'data' => $_FILES[$name]["name"]];
		} else {
			$data = ['response' => 'error', 'status' => 400, 'message' => 'Sorry, there was an error uploading your file.'];
		}
	}

	return $data;
} ?>


<?php function component_js($value = "")
{ ?>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
	<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"></script> -->
	<script type="text/javascript" src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://cdn.jsdelivr.net/npm/solid-toast@0.3.5/dist/cjs/index.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script type="text/javascript" src="assets/js/main.js"></script>

	<?= $value ?>
	<script>
		function uploadFile(className) {

			var fileName = $('input[type="file"]')[0].files[0].name;
			$('.' + className).html(fileName);
		}
		$(document).ready(function() {
			$('input[type="file"]').change(function(e) {

				alert('The file "' + fileName + '" has been selected.');
			});
		});
	</script>

	<script type="text/javascript">
		function getCookie(cname) {
			let name = cname + "=";
			let decodedCookie = decodeURIComponent(document.cookie);
			let ca = decodedCookie.split(';');
			for (let i = 0; i < ca.length; i++) {
				let c = ca[i];
				while (c.charAt(0) == ' ') {
					c = c.substring(1);
				}
				if (c.indexOf(name) == 0) {
					return c.substring(name.length, c.length);
				}
			}
			return "";
		}

		$(".change-theme").on("click", function() {
			$("body").toggleClass("theme-dark");
			if (getCookie("theme") == "light") {
				document.cookie = "theme=dark";
			} else if (getCookie("theme") == "dark") {
				document.cookie = "theme=light";
			} else {
				document.cookie = "theme=dark";
			}

			console.log(getCookie("theme"));

		});

		

		$(".menu-click").click(function() {
			$(".overlay-menu").removeClass("overlay-open");
			$('.open-close-btn').removeClass("hamburger-open");
		});


		$('.btn-delete').on('click', function() {
			var action = $(this).data("action");
			var id = $(this).data("id");
			// alert(action);
			$.ajax({
				url: action,
				type: 'POST',
				data: {
					id: id,
					process: "process",
					process: "delete"
				},
				success: function(json) {
					$data = $.parseJSON(JSON.stringify(json));

					if ($data.response == 'success') {
						Swal.fire({
							title: 'Are you sure?',
							text: "You won't be able to revert this!",
							icon: 'warning',
							showCancelButton: true,
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
							confirmButtonText: 'Yes, delete it!'
						}).then((result) => {
							if (result.isConfirmed) {
								Swal.fire({
									title: 'Deleted!',
									icon: 'success',
									text: 'Your file has been deleted.',
									showConfirmButton: false
								});
								document.location.reload();
							}
						});

					} else {
						console.log("Update Failed");
						// document.location.reload();

					}

				},
				error: function(data) {

					console.log("Ajax Error!");
					// document.location.reload();


				}
			});
		});
	</script>
	<script>
		let table = new DataTable('#myTable', {
			responsive: true
		});
	</script>
	<script>
		$(document).ready(function() {
			$('.selectSearch').select2();
			$('.selectSearch1').select2({
				minimumResultsForSearch: -1,
			});
		});
	</script>
	<!-- <script>
		$(document).ready(function() {
			$('.selectSearch').select2();
			$('.selectSearch1').select2({
				minimumResultsForSearch: -1,
			});
		});
	</script> -->
	</body>

	</html>
<?php } ?>