<?php
  global $taxonomy;
  get_header();
  $taxonomy = get_queried_object();
  $termopt = get_option('taxonomy_term_'.$taxonomy->term_id);
?>
<div id="content" <?php Avada()->layout->add_class( 'content_class' ); ?> <?php Avada()->layout->add_style( 'content_style' ); ?>>
  <div class="borito" style="<?php if (isset($termopt) && !empty($termopt['boritokep'])): ?>background-image: url('<?=$termopt['boritokep']?>');<?php endif; ?>">
    <div class="wrapper">
      <div class="felirat">
        <h1><?php echo __('Termékeink',TD); ?></h1>
        <div class="desc">
          <?php echo $taxonomy->description; ?>
        </div>
      </div>
    </div>

  </div>

  <div class="fusion-row">
    <?php echo get_template_part('termeklista'); ?>
  </div>
</div>
<?php do_action( 'avada_after_content' ); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
