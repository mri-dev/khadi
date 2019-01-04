<?php
class ProdCatSC
{
    const SCTAG = 'product-categories';

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
              'style' => 'boxslide'
            )
        );

        /* Parse the arguments. */
        $attr = shortcode_atts( $defaults, $attr );

        $meta_query = array();

        $datas = get_terms( 'kategoria', array(
          'hide_empty' => false
        ) );
        $attr['datas'] = $datas;

        $pass_data = $attr;

        $output = '<div class="'.self::SCTAG.'-holder style-'.$attr['style'].'">';
        $output .= (new ShortcodeTemplates('ProdCatSlide'))->load_template( $pass_data );
        $output .= '</div>';

        /* Return the output of the tooltip. */
        return apply_filters( self::SCTAG, $output );
    }
}

new ProdCatSC();

?>
