<?php
  get_header();
?>
<div id="content" <?php Avada()->layout->add_class( 'content_class' ); ?> <?php Avada()->layout->add_style( 'content_style' ); ?>>
  <?php while (have_posts()): the_post();
    $pid = get_the_ID();
    $vidID = getYoutubeID(get_the_excerpt($pid));
    $img = "//img.youtube.com/vi/".$vidID."/mqdefault.jpg";
  ?>
  <div class="content-wrapper">
    <div class="nav">
      <ul class="nav">
        <li><a href="/"><?php echo __('Főoldal', TD); ?></a></li>
        <li><a href="/videok"><?php echo __('Videók', TD); ?></a></li>
        <li><?php the_title(); ?></li>
      </ul>
    </div>
    <div class="cont">
      <div class="prod-body">
        <h1><?php echo the_title(); ?></h1>
        <?php if ($vidID): ?>
        <div class="video">
          <iframe id="ytplayer" type="text/html" width="1150" src="https://www.youtube.com/embed/<?=$vidID?>?showinfo=0" frameborder="0" allowfullscreen></iframe>
        </div>
        <?php endif; ?>
        <div class="description">
          <?php echo the_content(); ?>
        </div>
        <div class="terms">
          <?php if ($kat_terms): ?>
            <div class="term">
              <?=__('Termék kategória', TD)?>: <?php foreach ($kat_terms as $t): ?>
                <a href="<?=get_term_link($t)?>"><?=$t->name?></a>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
          <?php if ($csop_terms): ?>
            <div class="term">
              <?=__('Termék csoport', TD)?>: <?php foreach ($csop_terms as $t): ?>
                <a href="<?=get_term_link($t)?>"><?=$t->name?></a>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
          <?php if ($tags): ?>
            <?php $itag = ''; foreach ($tags as $tag) { $itag .= '<a href="/termekek/?src='.$tag->name.'">'.$tag->name.'</a>, '; } $itag = rtrim($itag, ', '); ?>
            <div class="term">
              <?=__('Kulcsszavak', TD)?>: <?=$itag?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <?php endwhile; wp_reset_postdata(); ?>
</div>
<?php do_action( 'avada_after_content' ); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
