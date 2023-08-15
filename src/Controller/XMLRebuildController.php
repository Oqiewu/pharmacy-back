<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\XMLRebuild;
use App\Entity\Product;
use App\Repository\ProductRepository;

class XMLRebuildController extends AbstractController
{
    public function __construct(
        private XMLRebuild $xml_rebuild,
        private ProductRepository $product_repository
    ) {}

    #[Route('/xml/product', name: 'app_saving_product', methods: ['POST'])]
    public function saving_product(): Response
    {
        $data = $this->xml_rebuild->xml_convert();

        foreach($data as $d)
        {
            foreach($d as $i)
            {
                $product = new Product();

                $product->setProductName($i['trade_name_rus']);
                !array_key_exists('firms', $i) ?: $product->setManufacturer($i['firms']);

                $this->product_repository->save($product, true);
            }
        }

        return $this->json('Не удалось добавить товар');
    }
}