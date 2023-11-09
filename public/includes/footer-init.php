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
				<a href=""><i class="fab fa-facebook-square is-size-2 mr-2 is-size-3-mobile"></i></a>
				<a href=""><i class="fab fa-twitter is-size-2 mr-2 is-size-3-mobile"></i></a>
				<a href=""><i class="fab fa-linkedin is-size-2 mr-2 is-size-3-mobile"></i></a>
				<a href=""><i class="fab fa-instagram-square is-size-2 is-size-3-mobile"></i></a>
			</div>

		</div>
	</div>
</footer>