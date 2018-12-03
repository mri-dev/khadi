<div class="top-menu">
	<div class="left-menu">
		<div class="wrapper">
			<div class="">Indiai gyógynövények</div>
			<div class="">Német natúrkozmetikumok</div>
			<div class="">Ayurvédikus formulák</div>
		</div>
	</div>
	<div class="right-menu">
		<div class="searcher">
			<form class="" action="/termekek/" method="get">
				<div class="wrapper">
					<div class="inp">
						<input autocomplete="off" type="text" name="src" value="<?=$_GET['src']?>" placeholder="<?php echo __('Keresés', TD); ?>">
					</div>
					<div class="button">
						<button type="submit"><i class="fa fa-search"></i></button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="fusion-header-sticky-height"></div>
<div class="fusion-header">
		<div class="logo">
      <?php $settings = Avada::settings(); ?>
      <a href="<?php echo get_option('siteurl'); ?>"><img src="<?php echo $settings['logo']['url']; ?>" alt="<?php echo get_option('blogname'); ?>"></a>
    </div>
		<div class="show-on-mobile mobilnav" id="mobilnavtgl">
			<i class="fa fa-bars"></i>
		</div>
    <div class="nav">
      <div class="navmenu">
        <?php
        wp_nav_menu(array(
          'menu' => 'Főmenü',
          'walker' => new CustomMenuWalker()
        ));
      ?>
      </div>
    </div>
</div>
<div class="show-on-mobile mobile-slogan">
	Természet ihlette bioaktív bőrápolás
</div>
