<?php
namespace Cope\GalleryBundle\Image;

class Image
{
    protected $current;
    protected $previous;
    protected $next;
    
    public function __construct($current, $previous, $next)
    {
        $this->current = $current;
        $this->previous = $previous;
        $this->next = $next;
    }
    
    public function getCurrent()
    {
        return $this->current;
    }

    public function getPrevious()
    {
        return $this->previous;
    }

    public function getNext()
    {
        return $this->next;
    }
}