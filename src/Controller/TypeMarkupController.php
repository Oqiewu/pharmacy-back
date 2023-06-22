<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\TypeMarkup;
use App\Repository\TypeMarkupRepository;
use App\Repository\TypeRepository;
use App\Repository\SubtypeRepository;
use App\Repository\PricingCategoryRepository;
use Symfony\Component\Serializer\SerializerInterface;

class TypeMarkupController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
        private TypeMarkupRepository $type_markup_repository,
        private TypeRepository $type_repository,
        private SubtypeRepository $subtype_repository,
        private PricingCategoryRepository $pricing_category_repository
    ) {}

    #[Route('/typemarkup', name: 'app_add_type_markup', methods: ['POST'])]
    public function addTypeMarkup(Request $request): Response
    {
        $type_markup = $this->serializer->deserialize($request->getContent(), TypeMarkup::class, 'json');
        $data = json_decode($request->getContent(), true);

        $type = $this->type_repository->findById($data['type']);
        $subtype = $this->subtype_repository->findById($data['subtype']);
        $pricing_category = $this->pricing_category_repository->findById($data['category']);


        $type_markup
            ->setType($type)
            ->setSubtype($subtype)
            ->setCategory($pricing_category);

        $this->type_markup_repository->save($type_markup, true);

        return $this->json($type_markup);
    }

    #[Route('/typemarkup/{id}', name: 'app_delete_type_markup', methods: ['DELETE'])]
    public function deleteTypeMarkup(int $id): Response
    {
        $type_markup = $this->type_markup_repository->findById($id);

        $this->type_markup_repository->remove($type_markup, true);

        return $this->json($type_markup);
    }

    #[Route('/typemarkup/all', name: 'app_all_type_markups', methods:['GET'])]
    public function getAllTypeMarkups(): Response
    {
        return $this->json($this->type_markup_repository->findAllTypeMarkups());
    }

    #[Route('/typemarkup/{id}', name: 'app_edit_type_markup', methods: ['PUT'])]
    public function editTypeMarkup(int $id, Request $request): Response
    {
        $editable_data = $this->serializer->deserialize($request->getContent(), TypeMarkup::class, 'json');
        $data = json_decode($request->getContent(), true);

        // Getting new values
        $type_product       = $this->type_repository->findById($data['type']);
        $subtype_product    = $this->subtype_repository->findById($data['subtype']);
        $category           = $this->pricing_category_repository->findById($data['category']);
        $lower_limit        = $editable_data->getLowerLimit();
        $upper_limit        = $editable_data->getUpperLimit();
        $markup_percentage  = $editable_data->getMarkupPercentage();
        
        
        $type_markup = $this->type_markup_repository->findById($id);
        

        // Setting new values
        !$type_product      ?: $type_markup->setType($type_product);
        !$subtype_product   ?: $type_markup->setSubtype($subtype_product);
        !$category          ?: $type_markup->setCategory($category);
        !$lower_limit       ?: $type_markup->setLowerLimit($lower_limit);
        !$upper_limit       ?: $type_markup->setUpperLimit($upper_limit);
        !$markup_percentage ?: $type_markup->setMarkupPercentage($markup_percentage);

        $this->type_markup_repository->save($type_markup, true);

        return $this->json($type_markup);
    }
}
