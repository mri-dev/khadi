<?php
  class ProductsMetaboxSave implements MetaboxSaver
  {
    public function __construct()
    {
    }
    public function saving($post_id, $post)
    {
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'cikkszam', $_POST[METAKEY_PREFIX . 'cikkszam'] );
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'kiszereles', $_POST[METAKEY_PREFIX . 'kiszereles'] );

      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'ico_cleanyourhair', ((isset($_POST[METAKEY_PREFIX . 'ico_cleanyourhair'])) ? 1 : false) );
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'ico_cleanyourhair_text', $_POST[METAKEY_PREFIX . 'ico_cleanyourhair_text'] );
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'ico_heat', ((isset($_POST[METAKEY_PREFIX . 'ico_heat'])) ? 1 : false) );
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'ico_heat_text', $_POST[METAKEY_PREFIX . 'ico_heat_text'] );
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'ico_exptimming', ((isset($_POST[METAKEY_PREFIX . 'ico_exptimming'])) ? 1 : false) );
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'ico_exptimming_text', $_POST[METAKEY_PREFIX . 'ico_exptimming_text'] );

      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'badge_vegan', ((isset($_POST[METAKEY_PREFIX . 'badge_vegan'])) ? 1 : false) );
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'badge_bdih', ((isset($_POST[METAKEY_PREFIX . 'badge_bdih'])) ? 1 : false) );
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'badge_nature', ((isset($_POST[METAKEY_PREFIX . 'badge_nature'])) ? 1 : false) );

      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'productprofil', $_POST[METAKEY_PREFIX . 'productprofil'] );
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'leiras_hasznalat', $_POST[METAKEY_PREFIX . 'leiras_hasznalat'] );
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'leiras_osszetevok', $_POST[METAKEY_PREFIX . 'leiras_osszetevok'] );
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'leiras_hatoanyagok', $_POST[METAKEY_PREFIX . 'leiras_hatoanyagok'] );
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'leiras_kombinaciok', $_POST[METAKEY_PREFIX . 'leiras_kombinaciok'] );
      auto_update_post_meta( $post_id, METAKEY_PREFIX . 'leiras_bulettpoints', $_POST[METAKEY_PREFIX . 'leiras_bulettpoints'] );
    }
  }
?>
