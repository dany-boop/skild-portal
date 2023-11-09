<footer class="footer">
	<div class="container">
		<div class="columns is-multiline is-mobile is-align-items-flex-end">
			<div class="column is-full-mobile is-1-tablet pt-0">
				<a href="<?= $home; ?>">
					<img src="<?= $setting->getLogo()->getFile()->getUrl() ?>" align="left" class="logo-footer">
				</a>
			</div>
			<div class="column is-full-mobile is-2-tablet">
				<p> &#xa9 SKILD
					<?= date('Y') ?>
				</p>
			</div>
			<div class="column is-full-mobile is-9-tablet has-text-right-tablet">
				<a href=""><i class="fab fa-facebook-square is-size-3 mr-2 is-size-3-mobile"></i></a>
				<a href=""><i class="fab fa-twitter is-size-3 mr-2 is-size-3-mobile"></i></a>
				<a href=""><i class="fab fa-linkedin is-size-3 mr-2 is-size-3-mobile"></i></a>
				<a href=""><i class="fab fa-instagram-square is-size-3 is-size-3-mobile"></i></a>
			</div>

		</div>
	</div>
</footer>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="assets/js/main.js"></script>
<script type="text/javascript" src="assets/js/login.js"></script>
<script type="text/javascript" src="assets/js/signup.js"></script>
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
</script>
<!-- <script>
	let table = new DataTable('#myTable', {
		responsive: true
	});
</script> -->
<script>
	$(document).ready(function() {
		$('.select2').select2();
	});
</script>
</body>

</html>