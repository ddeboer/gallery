<?php
namespace Cope\GalleryBundle\Image;

use Symfony\Component\Finder\Finder;

class ImageCollection
{
    protected $imageDir;
    
    public function __construct($imageDir)
    {
        $this->imageDir = $imageDir;
    }
    
    public function getImages($offset = 0, $limit = 16)
    {
        return \array_slice($this->getFiles(), $offset, $limit);
    }
    
    public function getImage($name)
    {
        $files = \array_values($this->getFiles());
        foreach ($files as $key => $file) {
            if ($name == $file->getRelativePathname()) {
                return new Image(
                    $file, 
                    isset($files[$key-1]) ? $files[$key-1] : null,
                    isset($files[$key+1]) ? $files[$key+1] : null
                );
            }
        }

        throw new \InvalidArgumentException(sprintf('Image %s does not exist', $name));
    }
    
    public function getTotal()
    {
        return count($this->getFiles());
    }
    
    protected function getFiles()
    {
        $finder = new Finder();
        return \iterator_to_array(
            $finder
                ->in($this->imageDir)
                ->sortByName()
                ->files()
        );
    }
}