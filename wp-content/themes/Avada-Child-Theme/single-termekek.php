<?php
  global $taxonomy;
  get_header();
  $taxonomy = get_queried_object();
  $termopt = get_option('taxonomy_term_'.$taxonomy->term_id);

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
?>
<div id="content" <?php Avada()->layout->add_class( 'content_class' ); ?> <?php Avada()->layout->add_style( 'content_style' ); ?>>
  <?php while (have_posts()): the_post();
      $img = get_the_post_thumbnail_url(get_the_ID());
      findProductUploadedImage($img, get_the_ID());
      $img = ($img) ?: IMG.'/no-product-image.png';
      $kat_terms = wp_get_post_terms(get_the_ID(), 'kategoria');
      $csop_terms = wp_get_post_terms(get_the_ID(), 'csoportok');
      $tags = wp_get_post_terms(get_the_ID(), 'post_tag');
      $cikkszam = get_post_meta( get_the_ID(), METAKEY_PREFIX.'cikkszam', true);
      $kiszereles = get_post_meta( get_the_ID(), METAKEY_PREFIX.'kiszereles', true);
      $termekcsoportok = array();

      if ($csop_terms) {
        foreach ((array)$csop_terms as $cs) {
          if ($cs->parent == 0) {
            continue;
          } else {
            $parent = get_term($cs->parent);
            $cs->name = $parent->name. ' / '.$cs->name;
          }
          $termekcsoportok[] = $cs;
        }
      }

      //$csop_terms_nav = tax_nav( $csop_terms[0] );
  ?>
  <div class="content-wrapper">
    <?php if (false): ?>
      <div class="nav">
        <ul class="nav">
          <li><a href="/"><?php echo __('Főoldal', TD); ?></a></li>
          <li><a href="/termekek"><?php echo __('Termékek', TD); ?></a></li>
          <?php if ($csop_terms_nav): ?>
            <?php foreach ($csop_terms_nav as $tn): ?>
            <li><a href="<?=get_term_link($tn)?>"><?php echo $tn->name; ?></a></li>
            <?php endforeach; ?>
          <?php endif; ?>
          <?php if ($kat_terms): ?>
          <li><a href="<?=get_term_link($kat_terms[0])?>"><?=$kat_terms[0]->name?></a></li>
          <?php endif; ?>
          <li><?php the_title(); ?></li>
        </ul>
      </div>
    <?php endif; ?>
    <div class="cont">
      <div class="image">
        <div class="wrapper autocorrett-height-by-width">
          <img src="<?=$img?>" alt="<?php the_title(); ?>">
        </div>
      </div>
      <div class="prod-body">
        <div class="cat"><?php echo $kat_terms[0]->name ?><?=($kiszereles)?' '.$kiszereles:''?></div>
        <h1><?php echo the_title(); ?></h1>
        <?php
          $leiras_bulettpoints = get_post_meta(get_the_ID(), METAKEY_PREFIX . 'leiras_bulettpoints', true);
          $leiras_osszetevok = get_post_meta(get_the_ID(), METAKEY_PREFIX . 'leiras_osszetevok', true);
          $leiras_tanacsok = get_post_meta(get_the_ID(), METAKEY_PREFIX . 'leiras_tanacsok', true);
          $leiras_hasznalat = get_post_meta(get_the_ID(), METAKEY_PREFIX . 'leiras_hasznalat', true);
          $leiras_kombinaciok = get_post_meta(get_the_ID(), METAKEY_PREFIX . 'leiras_kombinaciok', true);
          $leiras_hatoanyagok = get_post_meta(get_the_ID(), METAKEY_PREFIX . 'leiras_hatoanyagok', true);

          $badge_vegan = get_post_meta( get_the_ID(), METAKEY_PREFIX.'badge_vegan', true);
          $badge_bdih = get_post_meta( get_the_ID(), METAKEY_PREFIX.'badge_bdih', true);
          $badge_nature = get_post_meta( get_the_ID(), METAKEY_PREFIX.'badge_nature', true);
        ?>
        <?php if ($badge_vegan || $badge_bdih || $badge_nature): ?>
        <div class="badges">
          <? if($badge_vegan):?><div class="badge"><img src="<?=IMG?>/vegan-badge.svg" alt="Vegan"></div><? endif; ?>
          <? if($badge_bdih):?><div class="badge"><img src="<?=IMG?>/bdih-badge.svg" alt="BDIH"></div><? endif; ?>
          <? if($badge_nature):?><div class="badge"><img src="<?=IMG?>/natural-badge.svg" alt="Nature"></div><? endif; ?>
        </div>
        <?php endif; ?>
        <?php if ($leiras_bulettpoints): ?>
        <div class="bulettpoints">
          <?php echo $leiras_bulettpoints; ?>
        </div>
        <?php endif; ?>
        <?php
          $ico_cleanyourhair = get_post_meta( get_the_ID(), METAKEY_PREFIX.'ico_cleanyourhair', true);
          $ico_cleanyourhair_text = get_post_meta( get_the_ID(), METAKEY_PREFIX.'ico_cleanyourhair_text', true);
          $ico_heat = get_post_meta( get_the_ID(), METAKEY_PREFIX.'ico_heat', true);
          $ico_heat_text = get_post_meta( get_the_ID(), METAKEY_PREFIX.'ico_heat_text', true);
          $ico_exptimming = get_post_meta( get_the_ID(), METAKEY_PREFIX.'ico_exptimming', true);
          $ico_exptimming_text = get_post_meta( get_the_ID(), METAKEY_PREFIX.'ico_exptimming_text', true);
        ?>
        <?php if ($ico_cleanyourhair || $ico_heat || $ico_exptimming): ?>
        <div class="ico-pres">
          <?php if ($ico_cleanyourhair): ?>
          <div class="icop">
            <img src="<?=IMG?>/bottle.svg" alt="">
            <div class="t">
              <?php echo __('Tisztítsa meg haját', TD); ?>
            </div>
          </div>
          <?php endif; ?>
          <?php if ($ico_heat): ?>
          <div class="icop">
            <img src="<?=IMG?>/temperature.svg" alt="">
            <div class="t">
              <? if($ico_heat_text): echo $ico_heat_text; endif; ?>
            </div>
          </div>
          <?php endif; ?>
          <?php if ($ico_exptimming): ?>
          <div class="icop">
            <img src="<?=IMG?>/clock.svg" alt="">
            <div class="t">
              <? if($ico_exptimming_text): echo $ico_exptimming_text; endif; ?>
            </div>
          </div>
          <?php endif; ?>
        </div>
        <?php endif; ?>
        <div class="div-sep"></div>
        <div class="terms">
          <?php if ($cikkszam): ?>
          <div class="term">
            <?=__('Cikkszám', TD)?>: <?php echo $cikkszam; ?>
          </div>
          <?php endif; ?>
          <?php if ($kat_terms): ?>
            <div class="term">
              <?=__('Termék kategória', TD)?>:
              <?php
              foreach ($kat_terms as $t): ?>
                <a href="<?=get_term_link($t)?>"><?=$t->name?></a>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
          <?php if ($termekcsoportok): ?>
            <div class="term">
              <?=__('Termék csoport', TD)?>: <?php
              $csopnav = '';
              foreach ($termekcsoportok as $t): $csopnav .= '<a href="'.get_term_link($t).'">'.$t->name.'</a>, '; endforeach; ?>
              <?php $csopnav = rtrim($csopnav,", "); echo $csopnav; ?>
            </div>
          <?php endif; ?>
          <?php if ($tags): ?>
            <?php $itag = ''; foreach ($tags as $tag) { $itag .= '<a href="/termekek/?src='.$tag->name.'">'.$tag->name.'</a>, '; } $itag = rtrim($itag, ', '); ?>
            <div class="term">
              <?=__('Kulcsszavak', TD)?>: <?=$itag?>
            </div>
          <?php endif; ?>
        </div>
        <script type="text/javascript">
          (function($){
            $(function($){
              var anchor_tag = window.location.hash.substr(1);

              if (anchor_tag) {
                switchTab(anchor_tag);
              }
            });
          })(jQuery);
          function switchTab( tab ) {
            jQuery('ul.tabs li.active').removeClass('active');
            jQuery('ul.tabs li.'+tab).addClass('active');

            jQuery('.tab-content.active').removeClass('active');
            jQuery('.tab-content.'+tab).addClass('active');
          }
        </script>
      </div>
    </div>
    <ul class="tabs">
      <li class="desc active"><a href="#desc" onclick="switchTab('desc')"><?=__('Termék leírás', TD)?></a></li>
      <?php if ($leiras_hasznalat!=''): ?>
      <li class="hasznalat"><a href="#hasznalat" onclick="switchTab('hasznalat')"><?=__('Használati utasítás', TD)?></a></li>
      <?php endif; ?>
      <?php if ($leiras_kombinaciok!=''): ?>
      <li class="kombinaciok"><a href="#kombinaciok" onclick="switchTab('kombinaciok')"><?=__('Kombinálja ezekkel', TD)?></a></li>
      <?php endif; ?>
      <?php if ($leiras_osszetevok!=''): ?>
      <li class="osszetevok"><a href="#osszetevok" onclick="switchTab('osszetevok')"><?=__('Összetevők', TD)?></a></li>
      <?php endif; ?>
      <?php if ($leiras_hatoanyagok!=''): ?>
      <li class="hatoanyagok"><a href="#hatoanyagok" onclick="switchTab('hatoanyagok')"><?=__('Hatóanyagok', TD)?></a></li>
      <?php endif; ?>
      <?php if ($leiras_tanacsok!=''): ?>
      <li class="tanacsok"><a href="#tanacsok" onclick="switchTab('tanacsok')"><?=__('Tanácsok', TD)?></a></li>
      <?php endif; ?>
    </ul>
    <div class="desc tab-content active">
      <?php echo the_content(); ?>
    </div>
    <?php if ($leiras_osszetevok!=''): ?>
    <div class="tab-content osszetevok">
      <?php echo apply_filters( 'the_content', $leiras_osszetevok); ?>
    </div>
    <?php endif; ?>
    <?php if ($leiras_hasznalat!=''): ?>
    <div class="tab-content hasznalat">
      <?php echo apply_filters( 'the_content', $leiras_hasznalat); ?>
    </div>
    <?php endif; ?>
    <?php if ($leiras_tanacsok!=''): ?>
    <div class="tab-content tanacsok">
      <?php echo apply_filters( 'the_content', $leiras_tanacsok); ?>
    </div>
    <?php endif; ?>
    <?php if ($leiras_kombinaciok!=''): ?>
    <div class="tab-content kombinaciok">
      <?php echo apply_filters( 'the_content', $leiras_kombinaciok); ?>
    </div>
    <?php endif; ?>
    <?php if ($leiras_hatoanyagok!=''): ?>
    <div class="tab-content hatoanyagok">
      <?php echo apply_filters( 'the_content', $leiras_hatoanyagok); ?>
    </div>
    <?php endif; ?>

  </div>
  <?php endwhile; wp_reset_postdata(); ?>
</div>
<?php do_action( 'avada_after_content' ); ?>
</div> <!-- fusion-row break -->
<div class="deliver-infos">
  <div class="fusion-row">
    <div class="block">
      <div class="img">
        <img src="<?=IMG?>/gift.svg" alt="<?=__('Ajándék', TD)?>">
      </div>
      <div class="t">
        <strong><?=__('Ajándék', TD)?></strong><br>
        <?=__('minden rendelés mellé', TD)?>
      </div>
    </div>
    <div class="block">
      <div class="img">
        <img src="<?=IMG?>/delivery.svg" alt="<?=__('Szállítás', TD)?>">
      </div>
      <div class="t">
        <strong><?=__('Ingyenes és gyors szállítás', TD)?></strong><br>
        <?=__('az egész ország területére', TD)?>
      </div>
    </div>
    <div class="block">
      <div class="img">
        <img src="<?=IMG?>/phone.svg" alt="<?=__('Tanácsadás', TD)?>">
      </div>
      <div class="t">
        <strong><?=__('Ingyenes tanácsadás', TD)?></strong><br>
        <?=__('kérdezzen bátran szakértőinktől', TD)?>
      </div>
    </div>
  </div>
</div>
<div class="fusion-row"> <!-- fusion-row re -->
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
