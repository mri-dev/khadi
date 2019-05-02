<div class="holder">
  <div class="list">
    <?php
    if ( $datas->have_posts() ):
    while ( $datas->have_posts() ):
      $datas->the_post();
      $pid = get_the_ID();

      $img = get_the_post_thumbnail_url($pid, 'post500thumbnail');
      $url = get_the_permalink($pid);
      $desc = get_the_excerpt($pid);
      $catobjs = wp_get_post_categories($pid);
      $cats = array();
      foreach((array)$catobjs as $c){
        $cats[] = get_category( $c );
      }
    ?>
    <div class="item">
      <div class="wrapper">
        <?php if ($img): ?>
          <div class="image">
            <a href="<? echo the_permalink(); ?>"><img src="<?=$img?>" alt="<? echo the_title(); ?>"></a>
          </div>
        <?php endif; ?>
        <div class="cat">
          <?php
          $catlinks = '';
          foreach ((array)$cats as $c): $catlinks .= '<a href="'.get_category_link($c->term_id).'">'.$c->cat_name.'</a>'; endforeach; echo $catlinks; ?>
        </div>
        <div class="title">
          <h3><a href="<? echo the_permalink(); ?>"><? echo the_title(); ?></a></h3>
        </div>
        <div class="desc">
          <?php echo the_excerpt('...'); ?>
        </div>
        <div class="read">
          <a href="<? echo the_permalink(); ?>"><? echo __('Részletek', TD); ?></a>
        </div>
      </div>
    </div>
  <?php endwhile; wp_reset_postdata(); else: ?>
  <? endif; ?>
  </div>
  <script type="text/javascript">
    (function($){
      $('.blog-list-holder.style-slide.wantslide .list').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1000,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
      });
    })(jQuery);
  </script>
</div>
