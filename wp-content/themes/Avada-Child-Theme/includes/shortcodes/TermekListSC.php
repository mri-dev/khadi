<?php
class TermekListSC
{
  const SCTAG = 'termeklist';

  public function __construct()
  {
      add_action( 'init', array( &$this, 'register_shortcode' ) );
  }

  public function register_shortcode() {
      add_shortcode( self::SCTAG, array( &$this, 'do_shortcode' ) );
  }

  public function do_shortcode( $attr, $content = null )
  {
      /* Set up the default arguments. */
      $defaults = apply_filters(
          self::SCTAG.'_defaults',
          array(
            'limit' => -1,
            'cikkszam' => '',
            'template' => 'list',
            'cat' => false
          )
      );
      /* Parse the arguments. */
      $attr = shortcode_atts( $defaults, $attr );

      $cikkszamok = ($attr['cikkszam'] == '') ? false : explode(",", $attr['cikkszam']);

      $meta_query = array();

      $param = array(
        'post_type' => 'termekek',
        'posts_per_page' => $attr['limit'],
      );

      if ($cikkszamok) {
        $param['meta_query'] = array(
          array(
            'key' => METAKEY_PREFIX. 'cikkszam',
            'compare' => 'IN',
            'value' => $cikkszamok
          )
        );
      }

      if ($attr['cat']) {
        $param['tax_query'] = array(
          array(
            'taxonomy' => 'kategoria',
            'field' => 'slug',
            'terms' => $attr['cat']
          )
        );
      }

      $datas = new WP_Query( $param );

      $attr['products'] = $datas;
      $pass_data = $attr;
      $pass_data['hash'] = uniqid();
      $pass_data['slided'] = ($datas->found_posts > 3) ? true : false;

      $output = '<div class="'.self::SCTAG.'-holder'. (($datas->found_posts > 3)?' style-slide':'') .'" id="postlisth'.$pass_data['hash'].'">';
      $output .= (new ShortcodeTemplates('TermekList'))->load_template( $pass_data );
      $output .= '</div>';

      /* Return the output of the tooltip. */
      return apply_filters( self::SCTAG, $output );
  }
}

new TermekListSC();

?>
