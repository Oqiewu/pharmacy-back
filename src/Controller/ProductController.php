<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Repository\ActiveSubstanceRepository;
use App\Repository\TypeRepository;
use App\Repository\SubtypeRepository;
use App\Repository\ManufacturerRepository;
use App\Services\UploadPhoto;

class ProductController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
        private ProductRepository $product_repository,
        private ActiveSubstanceRepository $active_substance_repository,
        private TypeRepository $type_repository,
        private SubtypeRepository $subtype_repository,
        private UploadPhoto $upload_photo,
        private ManufacturerRepository $manufacturer_repository
    ) {}

    #[Route('/product', name: 'app_add_product', methods:['POST'])]
    public function add_product(Request $request): Response
    {
        $product = $this->serializer->deserialize($request->getContent(), Product::class, 'json');
        $data = json_decode($request->getContent(), true);

        $type = $this->type_repository->findById($data['type']);
        $subtype = $this->subtype_repository->findById($data['subtype']);
        $active_substance = $this->active_substance_repository->findById($data['active_substance']);
        $photoFileName = $this->upload_photo->upload($data['photo']);

        $product->setPhoto($photoFileName);
        $product->setType($type);
        $product->setSubType($subtype);
        $product->setActiveSubstance($active_substance);

        $this->product_repository->save($product, true);

        return $this->json($product);
    }

    #[Route('/product/{id}', name: 'app_delete_product', methods:['DELETE'])]
    public function delete_product(int $id): Response
    {
        $product = $this->product_repository->findById($id);

        $this->product_repository->remove($product, true);

        return $this->json($product);
    }

    #[Route('/product/all', name: 'app_all_product', methods:['GET'])]
    public function getProducts(Request $request): Response
    {
        return $this->json($this->product_repository->findAllProducts());
    }

    #[Route('/product/{id}', name: 'app_edit_product', methods: ['PUT'])]
    public function editProduct(int $id, Request $request): Response
    {
        $editable_data = $this->serializer->deserialize($request->getContent(), Product::class, 'json');
        $data = json_decode($request->getContent(), true);

        // Getting new values
        $product_name                                                            = $editable_data->getProductName();
        $vital_necessity                                                         = $editable_data->isVitalNecessity();
        $total                                                                   = $editable_data->getTotal();
        $free                                                                    = $editable_data->getFree();
        $reserve                                                                 = $editable_data->getReserve();
        !array_key_exists('type', $data)             ? $type                     = '' : $type = $this->type_repository->findById($data['type']);
        !array_key_exists('subtype', $data)          ? $subtype                  = '' : $subtype = $this->subtype_repository->findById($data['subtype']);
        !array_key_exists('active_substance', $data) ? $active_substance         = '' :$active_substance = $this->active_substance_repository->findById($data['active_substance']);
        $obligatory_1                                                            = $editable_data->getIsObligatory1();
        $obligatory_2                                                            = $editable_data->getIsObligatory2();
        $top_sales                                                               = $editable_data->isTopSales();
        $mandatory_assortyment                                                   = $editable_data->isMandatoryAssortyment();
        $label_printing                                                          = $editable_data->getLabelPrinting();
        $tax                                                                     = $editable_data->getTax();
        $stop_sales                                                              = $editable_data->isIsStopSales();
        $is_not_public                                                           = $editable_data->isIsNotPublic();
        $batch                                                                   = $editable_data->getBatch();
        !array_key_exists('manufacturer', $data) ? $manufacturer         = '' :$manufacturer = $this->manufacturer_repository->findById($data['manufacturer']);
        $manufacturer = $this->manufacturer_repository->findById($data['manufacturer']);
        $price_in_register                                                       = $editable_data->getPriceInRegister();
        $date_of_registration                                                    = $editable_data->getDateOfRegistration();
        $is_close_division                                                       = $editable_data->getIsCloseDivision();
        $conversation_factor                                                     = $editable_data->getConversationFactor();
        $grouping                                                                = $editable_data->getGrouping();
        $is_grouping                                                             = $editable_data->getIsGrouping();
        $plan_pharmacy                                                           = $editable_data->getPlanPharmacy();
        $is_included_plan                                                        = $editable_data->getIsIncludedPlan();        
        $is_custom                                                               = $editable_data->getIsCustom();
        $plan_group                                                              = $editable_data->getPlanGroup();
        $abc_group                                                               = $editable_data->getABCGroup();
        $minimum_balance                                                         = $editable_data->getMinimumBalance();
        $minimum_lot_order                                                       = $editable_data->getMinimumLotOrder();
        $goods_margin                                                            = $editable_data->getGoodsMargins();
        $type_markup                                                             = $editable_data->getTypeMarkup();
        $price                                                                   = $editable_data->getPrice();
        !array_key_exists('photo', $data) ? $photoFileName = '' : $photoFileName = $this->upload_photo->upload($data['photo']);

        $product = $this->product_repository->findById($id);
        
        $array_photo = $product->getPhoto();

        $array_photo->array_push($photoFileName);

        // Setting new values
        !$photoFileName                    ?: $product->setPhoto($array_photo);
        !$product_name                     ?: $product->setProductName($product_name);
        !$vital_necessity                  ?: $product->setVitalNecessity($vital_necessity);
        !$total                            ?: $product->setTotal($total);
        !$free                             ?: $product->setFree($free);
        !$reserve                          ?: $product->setReserve($reserve);
        !$type                             ?: $product->setType($type);
        !$subtype                          ?: $product->setSubtype($subtype);
        !$active_substance                 ?: $product->setActiveSubstance($active_substance);
        !$obligatory_1                     ?: $product->setIsObligatory1($obligatory_1);
        !$obligatory_2                     ?: $product->setIsObligatory2($obligatory_2);
        !$top_sales                        ?: $product->setTopSales($top_sales);
        !$mandatory_assortyment            ?: $product->setMandatoryAssortyment($mandatory_assortyment);
        !$label_printing                   ?: $product->setLabelPrinting($label_printing);
        !$tax                              ?: $product->setTax($tax);
        !$stop_sales                       ?: $product->setIsStopSales($stop_sales);
        !$is_not_public                    ?: $product->setIsNotPublic($is_not_public);
        !$batch                            ?: $product->setBatch($batch);
        !$manufacturer                     ?: $product->setManufacturer($manufacturer);
        !$price_in_register                ?: $product->setPriceInRegister($price_in_register);
        !$date_of_registration             ?: $product->setDateOfRegistration($date_of_registration);
        !$is_close_division                ?: $product->setIsCloseDivision($is_close_division);
        !$conversation_factor              ?: $product->setConversationFactor($conversation_factor);
        !$grouping                         ?: $product->setGrouping($grouping);
        !$is_grouping                      ?: $product->setIsGrouping($is_grouping);
        !$plan_pharmacy                    ?: $product->setPlanPharmacy($plan_pharmacy);
        !$is_included_plan                 ?: $product->setIsIncludedPlan($is_included_plan);
        !$is_custom                        ?: $product->setIsCustom($is_custom);
        !$plan_group                       ?: $product->setPlanGroup($plan_group);
        !$abc_group                        ?: $product->setABCGroup($abc_group);
        !$minimum_balance                  ?: $product->setMinimumBalance($minimum_balance);
        !$minimum_lot_order                ?: $product->setMinimumLotOrder($minimum_lot_order);
        !$goods_margin                     ?: $product->setGoodsMargins($goods_margin);
        !$type_markup                      ?: $product->setTypeMarkup($type_markup);
        !$price                            ?: $product->setPrice($price);

        $this->product_repository->save($product, true);

        return $this->json($product);
    }

    #[Route('/product/analogues/{active_substance}', name: 'app_get_analogues', methods:['GET'])]
    public function getAnalogues(int $active_substance): Response
    {
        return $this->json($this->product_repository->findByActiveSubstance($active_substance));
    }
    #[Route('/product/price/{active_substance}', name: 'app_get_price_of_product', methods:['GET'])]
    public function getPrice(int $active_substance): Response
    {
        $product = $this->json($this->product_repository->findByActiveSubstance($active_substance));

        return $this->json($product);
    }

    #[Route('/product/{id}/manufacturer', name: 'app_get_manufacturer_by_product', methods:['GET'])]
    public function getManufacturerByProduct(int $id): Response
    {
        $product = $this->product_repository->findById($id);

        $manufacturer = $product->getManufacturer();

        return $this->json($manufacturer);
    }

    #[Route('/product/{id}', name: 'app_get_product_by_id', methods:['GET'])]
    public function getProductById(int $id): Response
    {
        $product = $this->product_repository->findById($id);

        return $this->json($product);
    }
}
