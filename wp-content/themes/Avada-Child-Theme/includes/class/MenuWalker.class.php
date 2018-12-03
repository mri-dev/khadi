<?php
class CustomMenuWalker extends Walker_Nav_Menu
{
  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    $object = $item->object;
    $type = $item->type;
    $title = $item->title;
    $description = $item->description;
    $permalink = $item->url;

    if ($title == 'Minden család') {
      $item->classes[] = 'menu-item-has-children';
    }

    $output .= "<li class='" .  implode(" ", $item->classes) . "'>";
    // _menu_item_fusion_megamenu_icon
    $icon = get_post_meta( $item->ID, '_menu_item_fusion_megamenu_icon', true);

    //Add SPAN if no Permalink
    if( $permalink) {
      $output .= '<a href="' . $permalink . '">';
    } else {
      $output .= '<span>';
    }

    /*
    if ( $depth == 0 ) {
      if ( $icon ) {
        $output .= '<div class="ico"><i class="fa fa-'.$icon.'"></i></div>';
      } else {
        $output .= '<div class="ico"><i class="fa fa-circle-o"></i></div>';
      }
    }
    */

    $output .= $title;
    if( $description != '' && $depth == 0 ) {
      $output .= '<small class="description">' . $description . '</small>';
    }
    if( $permalink && $permalink != '#' ) {
      $output .= '</a>';
    } else {
      $output .= '</span>';
    }

    if ($title == 'Minden család')
    {
      $kats = get_terms( 'kategoria', array(
        'hide_empty' => false
      ) );

      if ($kats) {
        $output .= '<ul class="sub-menu col2menu">';
          foreach ((array)$kats as $kat) {
            $output .= '<li class="menu-item"><a href="'.get_term_link($kat).'">'.$kat->name.'</a></li>';
          }
        $output .= '</ul>';
      }
    }
  }
}
