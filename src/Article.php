<?php 

class Article {
    public $title;
    public $slug;

    function getSlug() {
        $slug = $this->title;
        $slug =  preg_replace( '/[^\w]+/', ' ', $slug);
        $slug =  preg_replace( '/\s+/', '_', $slug);
        $slug = strtolower($slug);
        $slug = trim($slug, '_');
        return $slug;
    }

}