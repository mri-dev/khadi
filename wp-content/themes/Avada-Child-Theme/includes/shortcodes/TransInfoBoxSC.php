<?php
class TransInfoBoxSC
{
  const SCTAG = 'trans-infobox';

  public function __construct()
  {
      add_action( 'init', array( &$this, 'register_shortcode' ) );
  }

  public function register_shortcode() {
      add_shortcode( self::SCTAG, array( &$this, 'do_shortcode' ) );
  }

  public function do_shortcode( $attr, $content = null )
  {
      $output = '<div class="deliver-infos '.self::SCTAG.'-holder">';
      $output .= (new ShortcodeTemplates('TransInfoBox'))->load_template( $pass_data );
      $output .= '</div>';

      /* Return the output of the tooltip. */
      return apply_filters( self::SCTAG, $output );
  }
}

new TransInfoBoxSC();

?>
