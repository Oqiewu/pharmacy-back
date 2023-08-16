<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\XMLRebuild;

class XMLRebuildController extends AbstractController
{
    public function __construct(
        private XMLRebuild $xml_rebuild
    ) {}

    #[Route('/xml', name: 'app_xml_convert', methods: ['POST'])]
    public function xml_convert(): Response
    {
        return $this->json($this->xml_rebuild->xml_convert());
    }
}