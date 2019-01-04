<?php if ($data): ?>
  <?php foreach ((array)$data as $p): $img = get_the_post_thumbnail_url($p->ID); ?>
  <div class="page autocorrett-height-by-width" data-image-ratio="1:1">
    <div class="wrapper" style="background-image:url('<?=$img?>');">
      <a href="<?=get_permalink($p)?>">
        <div class="lab">
          <?=$p->post_title?>
        </div>
      </a>
    </div>
  </div>
  <?php endforeach; ?>
<?php endif; ?>
