<?php if ($products->have_posts()): ?>
  <div class="products">
    <?php while ( $products->have_posts() ) { $products->the_post(); ?>
    <?php
      $img = get_the_post_thumbnail_url(get_the_ID());
      findProductUploadedImage($img, get_the_ID());
      $img = ($img) ?: IMG.'/no-product-image.png';
      $kat = wp_get_post_terms(get_the_ID(), 'kategoria' );
    ?>
    <div class="product">
      <div class="wrapper">
        <div class="image autocorrett-height-by-width" data-image-ratio="1:1">
          <a href="<?php the_permalink(); ?>"><img src="<?=$img?>" alt="<?php the_title(); ?>"></a>
        </div>
        <div class="datas">
          <div class="title">
            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
          </div>
          <?php if ($kat): $katstr = ''; ?>
          <div class="cat">
          <?php foreach ((array)$kat as $k): $katstr .= '<span>'.$k->name.'</span>, '; endforeach; ?>
          <?php echo rtrim($katstr,', '); ?>
          </div>
          <?php endif; ?>
          <div class="short-desc">
            <?php the_excerpt(); ?>
          </div>
          <div class="ev-content">
            <strong><?=__('Kiszerelés', TD)?>:</strong> <?php echo get_post_meta(get_the_ID(), METAKEY_PREFIX.'kiszereles', true); ?>
          </div>
        </div>
      </div>
    </div>
  <?php } wp_reset_postdata(); ?>
  </div>
<?php endif; ?>

<?php if ($slided): ?>
  <script type="text/javascript">
    (function($){
      $(function(){
        $('.termeklist-holder.style-slide#postlisth<?=$hash?> .products').slick({
          slidesToShow: 3,
          slidesToScroll: 1,
          autoplay: true
        });
      });
    })(jQuery);
  </script>
<?php endif; ?>
