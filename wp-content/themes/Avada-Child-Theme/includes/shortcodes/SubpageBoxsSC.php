<?php
class SubpageBoxsSC
{
    const SCTAG = 'subpage-boxs';

    public function __construct()
    {
        add_action( 'init', array( &$this, 'register_shortcode' ) );
    }

    public function register_shortcode() {
        add_shortcode( self::SCTAG, array( &$this, 'do_shortcode' ) );
    }

    public function do_shortcode( $attr, $content = null )
    {
      global $post;
      /* Set up the default arguments. */
      $defaults = apply_filters(
          self::SCTAG.'_defaults',
          array(
          )
      );
      /* Parse the arguments. */
      $attr = shortcode_atts( $defaults, $attr );
      $pass_data = array();
      $param = array(
        //'post_type' => '',
        'posts_per_page' => $attr['limit']
      );
      $my_wp_query = new WP_Query();
      $all_wp_pages = $my_wp_query->query(array('post_type' => 'page', 'posts_per_page' => '-1'));
      $datas = get_page_children($post->ID, $all_wp_pages);
      $pass_data['data'] = $datas;

      $output = '<div class="'.self::SCTAG.'-holder">';
      $output .= (new ShortcodeTemplates('SubpageBoxs'))->load_template( $pass_data );

      $output .= '</div>';

      /* Return the output of the tooltip. */
      return apply_filters( self::SCTAG, $output );
    }
}

new SubpageBoxsSC();

?>
