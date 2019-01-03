<?php
class PostListSC
{
  const SCTAG = 'postlist';

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
            'template' => 'list',
            'cat' => false
          )
      );
      /* Parse the arguments. */
      $attr = shortcode_atts( $defaults, $attr );

      $meta_query = array();

      $param = array(
        'post_type' => 'post',
        'posts_per_page' => $attr['limit'],
      );


      if ($attr['cat']) {
        $param['tax_query'] = array(
          array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $attr['cat']
          )
        );
      }

      $datas = new WP_Query( $param );

      $attr['list'] = $datas;
      $pass_data = $attr;

      $output = '<div class="'.self::SCTAG.'-holder">';
      $output .= (new ShortcodeTemplates('PostList'))->load_template( $pass_data );
      $output .= '</div>';

      /* Return the output of the tooltip. */
      return apply_filters( self::SCTAG, $output );
  }
}

new TermekListSC();

?>
