<section class="section super-navs header-top">
	<div class="container">
		<div class="columns is-mobile is-vcentered">
			<div class="column is-2-mobile is-2-tablet is-relative">
				<a href="" title="">
					<div class="logo-brand-home">
						<?php include('assets/images/Rectangle 3.svg') ?>
						<span style="display: none;"></span>
					</div>
				</a>
			</div>
			<div class="column is-6-mobile is-6-tablet is-relative input-icon">
				<?php if (isset($_SESSION['id'])) { 	?>
					<form action="jobs/search" method="GET">
						<input class="input inputs-grey" name="keywords" type="search" placeholder="Search.....">
						<button type="submit" style="background: none; border: none; color: transparent;">
							<?php include('assets/images/Loop.svg') ?>
						</button>
					</form>
				<?php } ?>
			</div>
			<div class="column is-4-mobile is-4-tablet is-relative">
				<ul class="horizontal-menu-right">
					<?php if (isset($_SESSION['id'])) {
					?>
						<!-- <li><a href="" class="">Dashboard</a></li> -->
						<?php
						if ($_SESSION['roles'] == 'contractor') {
						?>
							<!-- <li><a href="" class="">Skilled Worker</a></li> -->
						<?php }
						?>

						<?php
						if ($_SESSION['roles'] == 'tradesperson') {
						?>
							<!-- <li><a href="jobs/search" class="">Find Jobs</a></li> -->
						<?php }
						?>
						<!-- <li><a href="" class="">Project Cat</a></li>
						<li><a href="" class="">Project Type</a></li> -->
						<!-- <li><a href="profile" class="">Settings</a></li> -->
						<li>
							<a class="icon-nav2" id="bellIcon">
								<?php include('assets/images/bell.svg') ?>
							</a>
						</li>


						<li><a href="saved/list" class="icon-nav2 "><?php include('assets/images/love.svg') ?></a></li>


						<li><a href="profile" class="icon-nav"><?php include('assets/images/profilr pic.svg') ?></a></li>
					<?php } ?>
					<li>
						<label class="switch">
							<input type="checkbox" class="change-theme" <?= (!isset($_COOKIE['theme']) ? '' : $_COOKIE['theme'] == 'dark') ? 'checked' : '' ?>>
							<span class="slider"></span>
						</label>
					</li>
				</ul>
			</div>
			<div id="notificationContainer" class="notification-container" style="display: none;">
				<div class="notification-header">
					<h3>Notifications</h3>
					<!-- <button id="closeNotification" class="close-notification-btn">Close</button> -->
				</div>
				<ul class="notification-list">
					<li>New Notification 1</li>
					<li>New Notification 2</li>
					<!-- Add notifications dynamically -->
				</ul>
			</div>

			<a id="hamburgericon" class="open-close-btn">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</a>
		</div>
	</div>
	</div>
</section>

<!-- MENU MOBILE -->
<div id="menuMobile" class="overlay-menu ">
	<div class="overlay-content has-text-right pr-5 mt-3">
		<a href="" class="is-active menu-click" title="Home">
			Home
		</a>
		<?php if (isset($_SESSION['id'])) { ?>
			<?php if ($_SESSION['roles'] == 'contractor') { ?>
				<a href="jobs/search" class="menu-click">Skilled Worker</a>
			<?php } else { ?>
				<a href="jobs/search" class="menu-click">Find Jobs</a>
			<?php } ?>
			<a href="profile" class="menu-click">Account</a>
		<?php } ?>
		<label class="switch menu-click">
			<input type="checkbox" class="change-theme" <?= (!isset($_COOKIE['theme']) ? '' : $_COOKIE['theme'] == 'dark') ? 'checked' : '' ?>>
			<span class="slider"></span>
		</label>
		<!-- <a href="#projects" class="menu-click">Projects</a> -->
		<!-- 		<div class="socmed-center mt-2">
				<a href="https://wa.me/+6281393988831?" title=""> <i class="fab fa-whatsapp fa-2x "></i></a>
				<a href="<?= $setting->getInstagram(); ?>"><i class="fab fa-instagram fa-2x " title="instagram"></i></a>
				<a href="mailto:<?= $setting->getEmail(); ?>"><i class="fas fa-envelope fa-2x " title="email"></i></a>
			</div> -->

	</div>
</div>
<script type="text/javascript" src="assets/js/notification.js"></script>