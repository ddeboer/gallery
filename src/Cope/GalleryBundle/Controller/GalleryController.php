<?php

namespace Cope\GalleryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Finder\Finder;
use Cope\GalleryBundle\Image\ImageCollection;

class GalleryController extends Controller
{
    /**
     * @Route("/gallery/{page}/{perPage}", name="cope_gallery", 
     *  requirements={
     *   "page" = "\d+",
         "perPage" = "\d+"
     *  },
     *  defaults={
     *   "page" = 1,
     *   "perPage" = 16
     *  } 
     * )
     * @Template()
     */
    public function indexAction($page = 1, $perPage = 16)
    {
        $collection = $this->getImageCollection();
        
        return array(
            'files'      => $collection->getImages(($page-1) * $perPage, $perPage),
            'page'       => $page,
            'numOfPages' => floor($collection->getTotal() / $perPage),
            'perPage'    => $perPage
        );
    }
    
    /**
     * @Route("/gallery/image/{name}", name="cope_gallery_image")
     * @Template()
     */
    public function imageAction($name)
    {
        $image = $this->getImageCollection()->getImage($name);
        
        return array(
            'current'  => $image->getCurrent(),
            'previous' => $image->getPrevious(),
            'next'     => $image->getNext()
        );
    }
    
    /**
     * @return ImageCollection
     */
    protected function getImageCollection()
    {
        return $this->container->get('cope_gallery.image.collection');
    }
}
