<?php
  global $taxonomy;
  get_header();
  $taxonomy = get_queried_object();
  $termopt = get_option('taxonomy_term_'.$taxonomy->term_id);
?>
<div id="content" <?php Avada()->layout->add_class( 'content_class' ); ?> <?php Avada()->layout->add_style( 'content_style' ); ?>>
  <div class="borito<?=(!$termopt['boritokep'])?' no-image':''?>" style="<?php if (isset($termopt) && !empty($termopt['boritokep'])): ?>background-image: url('<?=$termopt['boritokep']?>');<?php endif; ?>">
    <div class="wrapper">
      <div class="felirat">
        <h1><?php echo $taxonomy->name; ?></h1>
      </div>
    </div>
  </div>

  <div class="fusion-row">
    <?php if ($taxonomy->description): ?>
      <div class="pre-desc">
        <fieldset>
          <?php if ($termopt['predesc_title']): ?>
            <legend><?=$termopt['predesc_title']?></legend>
          <?php endif; ?>
          <div class="category-pre-desc">
            <?php echo $taxonomy->description; ?>
          </div>
        </fieldset>
      </div>
    <?php endif; ?>
    <?php echo get_template_part('termeklista'); ?>
    <?php if ($termopt['catcontent']): ?>
    <div class="more-description-cat">
      <?php echo stripslashes($termopt['catcontent']); ?>
    </div>
    <?php endif; ?>
  </div>
</div>
<?php do_action( 'avada_after_content' ); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
