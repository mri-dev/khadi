<table class="inf">
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
    <td>
      <h3>Ikon piktogrammok</h3>
      <?php $metakey = METAKEY_PREFIX . 'ico_cleanyourhair'; ?>
      <?php $value = get_post_meta($post->ID, $metakey, true); ?>
      <input type="checkbox" id="ico_cleanyourhair" value="1" name="<?=$metakey?>" <?=($value == '1')?'checked="checked"':''?>> <label for="ico_cleanyourhair">Clean your hair</label>
      &nbsp;&nbsp;&nbsp;
      <?php $metakey = METAKEY_PREFIX . 'ico_heat'; ?>
      <?php $value = get_post_meta($post->ID, $metakey, true); ?>
      <input type="checkbox" id="ico_heat" value="1" name="<?=$metakey?>" <?=($value == '1')?'checked="checked"':''?>> <label for="ico_heat">Hőfok:
      <?php $metakey = METAKEY_PREFIX . 'ico_heat_text'; ?>
      <?php $value = get_post_meta($post->ID, $metakey, true); ?>
      <input type="text" name="<?=$metakey?>" value="<?=$value?>"></label>
      &nbsp;&nbsp;&nbsp;
      <?php $metakey = METAKEY_PREFIX . 'ico_exptimming'; ?>
      <?php $value = get_post_meta($post->ID, $metakey, true); ?>
      <input type="checkbox" id="ico_exptimming" value="1" name="<?=$metakey?>" <?=($value == '1')?'checked="checked"':''?>> <label for="ico_exptimming">Időtartam:
      <?php $metakey = METAKEY_PREFIX . 'ico_exptimming_text'; ?>
      <?php $value = get_post_meta($post->ID, $metakey, true); ?>
      <input type="text" name="<?=$metakey?>" value="<?=$value?>"></label>
    </td>
  </tr>
  <tr>
    <td colspan="3">
      <h3>Speciális ikonok</h3>
      <?php $metakey = METAKEY_PREFIX . 'badge_vegan'; ?>
      <?php $value = get_post_meta($post->ID, $metakey, true); ?>
      <input type="checkbox" id="badge_vegan" value="1" name="<?=$metakey?>" <?=($value == '1')?'checked="checked"':''?>> <label for="badge_vegan">Vegan</label>
      &nbsp;&nbsp;&nbsp;
      <?php $metakey = METAKEY_PREFIX . 'badge_bdih'; ?>
      <?php $value = get_post_meta($post->ID, $metakey, true); ?>
      <input type="checkbox" id="badge_bdih" value="1" name="<?=$metakey?>" <?=($value == '1')?'checked="checked"':''?>> <label for="badge_bdih">BDIH</label>
      &nbsp;&nbsp;&nbsp;
      <?php $metakey = METAKEY_PREFIX . 'badge_nature'; ?>
      <?php $value = get_post_meta($post->ID, $metakey, true); ?>
      <input type="checkbox" id="badge_nature" value="1" name="<?=$metakey?>" <?=($value == '1')?'checked="checked"':''?>> <label for="badge_nature">100% nature</label>
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

<style media="screen">
  table.inf td {
    padding: 10px;
  }
</style>
