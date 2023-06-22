<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\GoodsMargin;
use App\Repository\GoodsMarginRepository;
use App\Repository\PricingCategoryRepository;
use Symfony\Component\Serializer\SerializerInterface;

class GoodsMarginController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
        private GoodsMarginRepository $goods_margin_repository,
        private PricingCategoryRepository $pricing_category_repository
    ) {}

    #[Route('/goodsmargin', name: 'app_add_goods_margin', methods: ['POST'])]
    public function addGoodsMargin(Request $request): Response
    {
        $goods_margin = $this->serializer->deserialize($request->getContent(), GoodsMargin::class, 'json');
        $data = json_decode($request->getContent(), true);

        $category = $this->pricing_category_repository->findById($data['category']);

        $goods_margin->setCategory($category);

        $this->goods_margin_repository->save($goods_margin, true);

        return $this->json($goods_margin);
    }

    #[Route('/goodsmargin/{id}', name: 'app_delete_goods_margin', methods: ['DELETE'])]
    public function deleteGoodsMargin(int $id): Response
    {
        $goods_margin = $this->goods_margin_repository->findById($id);

        $this->goods_margin_repository->remove($goods_margin, true);

        return $this->json($goods_margin);
    }

    #[Route('/goodsmargin/all', name: 'app_all_goods_margins', methods:['GET'])]
    public function getAllGoodsMargins(): Response
    {
        return $this->json($this->goods_margin_repository->findAllGoodsMargins());
    }

    #[Route('/goodsmargin/{id}', name: 'app_edit_goods_margin', methods: ['PUT'])]
    public function editGoodsMargin(int $id, Request $request): Response
    {
        $editable_data = $this->serializer->deserialize($request->getContent(), GoodsMargin::class, 'json');
        $data = json_decode($request->getContent(), true);

        // Getting new values
        $category           = $this->pricing_category_repository->findById($data['category']);
        $lower_limit        = $editable_data->getLowerLimit();
        $upper_limit        = $editable_data->getUpperLimit();
        $markup_percentage  = $editable_data->getMarkupPercentage();
        
        
        $goods_margin = $this->goods_margin_repository->findById($id);
        

        // Setting new values
        $category          ?: $goods_margin->setCategory($category);
        $lower_limit       ?: $goods_margin->setLowerLimit($lower_limit);
        $upper_limit       ?: $goods_margin->setUpperLimit($upper_limit);
        $markup_percentage ?: $goods_margin->setMarkupPercentage($markup_percentage);

        $this->goods_margin_repository->save($goods_margin, true);

        return $this->json($goods_margin);
    }
}
