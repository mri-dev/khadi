<?php
class CustomMenuWalker extends Walker_Nav_Menu
{
  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    $object = $item->object;
    $type = $item->type;
    $title = $item->title;
    $description = $item->description;
    $permalink = $item->url;

    $output .= "<li class='" .  implode(" ", $item->classes) . "'>";
    if ($permalink != '' && $permalink != '#') {
      $output .= '<a href="'.$permalink.'">';
    }
    $output .= $title;
    if ($permalink != '' && $permalink != '#') {
      $output .= '</a>';
    }

    // Submenü a termék kategóriáknak
    // TODO: egyelőre nem kell, mert nincs benne a menü szerkezet tervezetben
    if ($item->type == 'taxonomy' && $item->object == 'kategoria') {
      $objid = $item->object_id;
    }

    $output .= '</li>';
  }
}
