<table>
  <tr>
    <td>
      <h3>Cikkszám</h3>
      <?php $metakey = METAKEY_PREFIX . 'cikkszam'; ?>
      <?php $value = get_post_meta($post->ID, $metakey, true); ?>
      <input type="text" name="<?=$metakey?>" value="<?=$value?>">
    </td>
    <td>
      <h3>Kiszerelés</h3>
      <?php $metakey = METAKEY_PREFIX . 'kiszereles'; ?>
      <?php $value = get_post_meta($post->ID, $metakey, true); ?>
      <input type="text" name="<?=$metakey?>" value="<?=$value?>">
    </td>
  </tr>
</table>

<h3>Termék kép elérhetősége (mappa/fájlnév)</h3>
<?php $metakey = METAKEY_PREFIX . 'productprofil'; ?>
<?php $value = get_post_meta($post->ID, $metakey, true); ?>
wp-content / uploads / products / <input style="width: 60%;" type="text" name="<?=$metakey?>" value="<?=$value?>">

<h3>Bulett points</h3>
<?php $metakey = METAKEY_PREFIX . 'leiras_bulettpoints'; ?>
<?php $value = get_post_meta($post->ID, $metakey, true); ?>
<?php wp_editor($value, $metakey ); ?>

<h3>Használat</h3>
<?php $metakey = METAKEY_PREFIX . 'leiras_hasznalat'; ?>
<?php $value = get_post_meta($post->ID, $metakey, true); ?>
<?php wp_editor($value, $metakey ); ?>

<h3>Kombinálja ezekkel</h3>
<?php $metakey = METAKEY_PREFIX . 'leiras_kombinaciok'; ?>
<?php $value = get_post_meta($post->ID, $metakey, true); ?>
<?php wp_editor($value, $metakey ); ?>

<h3>Összetevők</h3>
<?php $metakey = METAKEY_PREFIX . 'leiras_osszetevok'; ?>
<?php $value = get_post_meta($post->ID, $metakey, true); ?>
<?php wp_editor($value, $metakey ); ?>

<h3>Hatóanyagok</h3>
<?php $metakey = METAKEY_PREFIX . 'leiras_hatoanyagok'; ?>
<?php $value = get_post_meta($post->ID, $metakey, true); ?>
<?php wp_editor($value, $metakey ); ?>
