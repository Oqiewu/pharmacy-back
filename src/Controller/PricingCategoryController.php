<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\PricingCategory;
use App\Repository\PricingCategoryRepository;
use Symfony\Component\Serializer\SerializerInterface;

class PricingCategoryController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
        private PricingCategoryRepository $pricing_category_repository
    ) {}

    #[Route('/pricingcategory', name: 'app_add_pricing_category', methods: ['POST'])]
    public function addPricingCategory(Request $request): Response
    {
        $pricing_category = $this->serializer->deserialize($request->getContent(), PricingCategory::class, 'json');

        $this->pricing_category_repository->save($pricing_category, true);

        return $this->json($pricing_category);
    }

    #[Route('/pricingcategory/{id}', name: 'app_delete_pricing_category', methods: ['DELETE'])]
    public function deletePricingCategory(int $id): Response
    {
        $pricing_category = $this->pricing_category_repository->findById($id);

        $this->pricing_category_repository->remove($pricing_category, true);

        return $this->json($pricing_category);
    }

    #[Route('/pricingcategory/all', name: 'app_all_pricing_category', methods:['GET'])]
    public function getAllPricingCategory(): Response
    {
        return $this->json($this->pricing_category_repository->findAllPricingCategory());
    }

    #[Route('/pricingcategory/{id}', name: 'app_edit_pricing_category', methods: ['PUT'])]
    public function editPricingCategory(int $id, Request $request): Response
    {
        $editable_data = $this->serializer->deserialize($request->getContent(), PricingCategory::class, 'json');


        // Getting new values
        $category_name           = $editable_data->getCategoryName();
        $pricing_percentage      = $editable_data->getPricingPercentage();
        $stretch_option          = $editable_data->getStretchOption();
        $is_stretch_to           = $editable_data->isStretchTo();
        $stretch_to              = $editable_data->getStretchTo();
        $is_stretch_over_border  = $editable_data->isStretchOverBorder();
        
        
        $pricing_category = $this->pricing_category_repository->findById($id);
        

        // Setting new values
        !$category_name          ?: $pricing_category->setCategoryName($category_name);
        !$pricing_percentage     ?: $pricing_category->setPricingPercentage($pricing_percentage);
        !$stretch_option         ?: $pricing_category->setStretchOption($stretch_option);
        !$is_stretch_to          ?: $pricing_category->setIsStretchTo($is_stretch_to);
        !$stretch_to             ?: $pricing_category->setStretchTo($stretch_to);
        !$is_stretch_over_border ?: $pricing_category->setStretchOverBorder($is_stretch_over_border);

        $this->pricing_category_repository->save($pricing_category, true);

        return $this->json($pricing_category);
    }
}
