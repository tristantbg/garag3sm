<?php

// removes p tags from kirbytext output
field::$methods['ktRaw'] = function($field) {
  $text = $field->kirbytext();
  return preg_replace('/(.*)<\/p>/', '$1', preg_replace('/<p>(.*)/', '$1', $text));
};

page::$methods['hasHero'] = function($page) {
  return $page->heroVideoUrl()->isNotEmpty() || $page->heroImages()->isNotEmpty();
};

// Default fields values
kirby()->hook('panel.page.create', function($page) {
  if(in_array($page->intendedTemplate(), ['post', 'product'])) {
    $data = array("videoToggle" => "no", "heroVideoToggle" => "no");
    try { 
      $page->update($data); 
    }
    catch(Exception $ex) {}
  }
});