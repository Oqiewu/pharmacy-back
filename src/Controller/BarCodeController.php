<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\BarCode;
use App\Repository\BarCodeRepository;
use App\Repository\ManufacturerRepository;
use Symfony\Component\Serializer\SerializerInterface;

class BarCodeController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
        private BarCodeRepository $bar_code_repository,
        private ManufacturerRepository $manufacturer_repository
    ) {}

    #[Route('/barcode', name: 'app_bar_code', methods: ['POST'])]
    public function add_bar_code(Request $request): Response
    {
        // Получение данных из запроса
        $data = json_decode($request->getContent(), true);

        // Создание объекта BarCode и заполнение его свойств
        $manufacturer = $this->manufacturer_repository->findById($data['manufacturer']);

        $barCode = new BarCode();
        
        $barCode->setBarCode($data['bar_code']);
        $barCode->setUnit($data['unit']);
        $barCode->setManufacturer($manufacturer);

        // Сохранение объекта BarCode
        $this->bar_code_repository->save($barCode, true);
        return $this->json($barCode);
    }

    #[Route('/barcode/{id}', name: 'app_delete_bar_code', methods: ['DELETE'])]
    public function delete_bar_code(int $id): Response
    {
        $bar_code = $this->bar_code_repository->findById($id);

        $this->bar_code_repository->remove($bar_code, true);

        return $this->json($bar_code);
    }

    #[Route('/barcode/all', name: 'app_all_bar_codes', methods:['GET'])]
    public function getAllBarCodes(): Response
    {
        return $this->json($this->bar_code_repository->findAllBarCodes());
    }

    #[Route('/barcode/{id}', name: 'app_edit_bar_code', methods: ['PUT'])]
    public function edit_bar_code(int $id, Request $request): Response
    {
        $editable_data = $this->serializer->deserialize($request->getContent(), BarCode::class, 'json');
        $data = json_decode($request->getContent(), true);

        // Getting new values
        $code          = $editable_data->getBarCode();
        $unit          = $editable_data->getUnit();
        $manufacturer  = $this->manufacturer_repository->findById($data['manufacturer']);
        
        $bar_code = $this->bar_code_repository->findById($id);
        

        // Setting new values
        !$code         ?: $bar_code->setBarCode($code);
        !$unit         ?: $bar_code->setUnit($unit);
        !$manufacturer ?: $bar_code->setManufacturer($manufacturer);

        $this->bar_code_repository->save($bar_code, true);

        return $this->json($bar_code);
    }
}