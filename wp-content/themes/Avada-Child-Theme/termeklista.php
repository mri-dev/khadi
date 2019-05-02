<?php
  global $taxonomy;

  $orderby = 'name';
  $ord = 'ASC';
  $current_page = 1;
  $current_page = (!empty($_GET['page'])) ? (int)$_GET['page'] : $current_page;

  function getUsableTagIDS()
  {
    $xtrim = (!empty($_GET['src'])) ? explode(" ", $_GET['src']) : array();
    $usabe_tag_id = array();

    foreach ((array)$xtrim as $ctag) {
      $ctag = trim($ctag);
      $tag = get_term_by('name', $ctag, 'post_tag', ARRAY_A);

      if ($tag) {
        $usabe_tag_id[] = $tag['term_id'];
      }
    }

    return $usabe_tag_id;
  }

  function custom_searching( $src)
  {
    global $wpdb;
    $nsrc = '';
    $xtrim = (!empty($_GET['src'])) ? explode(" ", $_GET['src']) : array();
    $tagids = getUsableTagIDS();

    $firsttext = $xtrim[0];

    $donothing = true;
    $dotagsrc = false;

    $nsrc .= " AND (";

    if (!empty($tagids) && $tagids) {
      $dotagsrc = true;
      $nsrc .= " (".$wpdb->term_relationships.".term_taxonomy_id IN(".implode(',', $tagids).")) ";
      $donothing = false;
    } else {
      $donothing = true;
    }

    // SRC title
    if ($firsttext != '') {
      $donothing = false;
      if ($dotagsrc) {
        $nsrc .= " OR";
      }
      $nsrc .= " (".$wpdb->posts.".post_title LIKE '%".$firsttext."%')";

      // Cikkszám keresés
      if (count($xtrim)) {
        $nsrc .= " OR (mt1.meta_key = '".METAKEY_PREFIX."cikkszam' AND mt1.meta_value = '".$firsttext."')";
      }
    } else {
      $donothing = true;
    }

    $nsrc .= ") ";

    if ($donothing) {
      $nsrc = '';
    }

    return $nsrc;
    //return $src;
  }
  add_filter( 'posts_search', 'custom_searching' );

  function custom_qry_join( $join )
  {
    global $wpdb;
    $tagids = getUsableTagIDS();
    $xtrim = (!empty($_GET['src'])) ? explode(" ", $_GET['src']) : array();
    $firsttext = sanitize_title($xtrim[0]);

    if ($firsttext != '') {
      $njoin = " INNER JOIN ".$wpdb->postmeta." AS mt1 ON (".$wpdb->posts.".ID = mt1.post_id) ";
    }

    if (!empty($tagids) && $tagids) {
      $njoin .= " LEFT JOIN ".$wpdb->term_relationships." ON (".$wpdb->posts.".ID = ".$wpdb->term_relationships.".object_id) ";
    }

    $njoin .= $join;

    return $njoin;
  }
  add_filter('posts_join', 'custom_qry_join');

  function custom_qry_groupby( $groupby )
  {
    global $wpdb;
    $groupby = "{$wpdb->posts}.ID";

    return $groupby;
  }
  add_filter( 'posts_groupby', 'custom_qry_groupby' );

  if (isset($_GET['order']) && !empty($_GET['order'])) {
    $xord = explode("-", $_GET['order']);
    $orderby = $xord[0];
    $ord = $xord[1];
  }

  $pages = array(
    'current' => 1,
    'max' => 1,
    'items' => 0
  );

  $arg = array(
    'post_type' => 'termekek',
    'posts_per_page' => 12,
    'paged' => $current_page,
    'orderby' => $orderby,
    'order' => $ord
  );
  if (isset($taxonomy->taxonomy)) {
    $arg['tax_query'] = array(
      array(
        'taxonomy' => $taxonomy->taxonomy,
        'field'    => 'term_id',
        'terms'    => $taxonomy->term_id
      ),
    );
  }

  if (isset($_GET['src']) && $_GET['src'] != '') {
    $src = explode(" ", $_GET['src']);
    $is_searched = implode(",",$src);
    //$arg['tag'] = $is_searched;
    $arg['s'] = $_GET['src'];
  }

  /* * /
  $arg['meta_query'] = array(
  	'relation' => 'AND', // Optional, defaults to "AND"
  	array(
  		'key'     => METAKEY_PREFIX.'cikkszam',
  		'value'   => 'BOR',
  		'compare' => '='
  	),
    array(
  		'key'     => METAKEY_PREFIX.'osszetevok',
  		'value'   => 'BOT',
  		'compare' => 'LIKE'
  	)
  );
  /* */


  $products = new WP_Query($arg);

  /* * /
  echo $products->request;
  echo '<pre>';
  print_r($products);
  echo '</pre>';
  /* */


  $pages['current'] = $current_page;
  $pages['max'] = (int)$products->max_num_pages;
  $pages['items'] = (int)$products->found_posts;

  function pagination( $tax, $pages )
  {
    if (isset($tax->taxonomy)) {
      $href = get_term_link($tax);
    } else {
      $href = '/termekek/';
    }

    $param = array();
    unset($_GET['page']);
    $param = $_GET;
    $qry = build_query($param);
    if ( $qry == '') {
      $href .= '?';
    } else {
      $href .= '?'.$qry.'&';
    }

    $t = '<div class="pagination">';
      $t .= '<ul>';
      for( $p = 1; $p <= $pages[max]; $p++ ){
        $t .= '<li class="'. ( ($p == $pages[current])?'active':'' ) .'"><a href="'.$href.'page='.$p.'">'.$p.'</a></li>';
      }
      $t .= '</ul>';
    $t .= '</div>';

    return $t;
  }

  function tax_nav( $tax )
  {
    $taxarr = array();
    $ct = $tax;
    $taxoname = $tax->taxonomy;
    $has_parent = ($ct->parent != 0) ? true : false;

    if ($has_parent) {
      while( $has_parent )
      {
        if( $ct->parent == 0 ) $has_parent = false;
        $taxarr[] = $ct;
        $ct = get_term($ct->parent, $taxoname);
      }
    } else {
      $taxarr[] = $ct;
    }

    $taxarr = array_reverse($taxarr);

    return $taxarr;
  }

  $tax_nav = tax_nav( $taxonomy );
?>
<div class="term-list">
  <?php if (false): ?>
  <div class="header">
    <div class="nav">
      <ul class="nav">
        <li><a href="/"><?php echo __('Főoldal', TD); ?></a></li>
        <li><a href="/termekek"><?php echo __('Termékek', TD); ?></a></li>
        <?php if ($tax_nav): ?>
          <?php foreach ($tax_nav as $tn): ?>
          <li><a href="<?=get_term_link($tn)?>"><?php echo $tn->name; ?></a></li>
          <?php endforeach; ?>
        <?php endif; ?>
      </ul>
    </div>
    <div class="filters">
      <div class="info">
        <strong><?php echo sprintf(__('%d db termék', TD), $products->found_posts); ?></strong>
        <?php if ($is_searched): ?>
           &bull; <span class="src-result"><?php echo __('Keresési kifejezések:', TD); ?> <span class=srckeys><span><? echo  implode("</span><span>",$src); ?></span></span>
        <?php endif; ?>
      </div>
      <div class="filter">
        <form class="" id="filter" action="" method="get">
        <div class="wrapper">
          <div class="t">
            <?php echo __('Rendezés mint', TD); ?>
          </div>
          <div class="o">
            <div class="wrapper">
              <select class="" name="order" onchange="jQuery('form#filter').submit();">
                <option value="name-ASC" <?=(!isset($_GET['order']) || $_GET['order'] == 'name-ASC')?'selected="selected"':''?>><?php echo __('Név: A-Z', TD); ?></option>
                <option value="name-DESC" <?=(isset($_GET['order']) && $_GET['order'] == 'name-DESC')?'selected="selected"':''?>><?php echo __('Név: Z-A', TD); ?></option>
                <option value="date-ASC" <?=(isset($_GET['order']) && $_GET['order'] == 'date-ASC')?'selected="selected"':''?>><?php echo __('Régi termékek előre', TD); ?></option>
                <option value="date-DESC" <?=(isset($_GET['order']) && $_GET['order'] == 'date-DESC')?'selected="selected"':''?>><?php echo __('Új termékek előre', TD); ?></option>
              </select>
            </div>
          </div>
          <div class="s">
            <input type="text" placeholder="<?=__('Keresés...', TD)?>" name="src" value="<?=$_GET['src']?>">
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
  <?php endif; ?>
  <div class="c">
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
              <?php if (get_post_meta(get_the_ID(), METAKEY_PREFIX.'kiszereles', true) != ''): ?>
                <div class="ev-content">
                  <strong><?=__('Kiszerelés', TD)?>:</strong> <?php echo get_post_meta(get_the_ID(), METAKEY_PREFIX.'kiszereles', true); ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php } wp_reset_postdata(); ?>
      </div>
      <?php echo pagination($taxonomy, $pages); ?>
    <?php else: ?>
      <div class="no-products">
        <h3><?php echo __('Nem találtunk terméket.', TD); ?></h3>
        <?php echo __('A keresési feltételek alapján nem találtunk Önnek termékeket.', TD); ?>
        <?php if ($_GET['src'] != ''): ?>
          <br><br>
          <div class="">
            <?php echo __('Keresési kifejezés', TD); ?>: <strong><?php echo $_GET['src']; ?></strong>
          </div>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
<div class="clr fusion-clearfix clearfix"></div>
