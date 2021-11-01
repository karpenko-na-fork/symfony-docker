<?php

declare(strict_types=1);

namespace App\Controller;

use App\Document\Product;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class DefaultController extends AbstractController
{
    private DocumentManager $documentManager;

    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }

    public function index(): Response
    {
        $product = new Product();
        $product->setName('Foo');
        $product->setPrice('19.99');

        $this->documentManager->persist($product);
        $this->documentManager->flush();

        return $this->json(
            ['hello' => 'world']
        );
    }

    public function all(): Response
    {
        $products = $this->documentManager->getRepository(Product::class)->findAll();
        return $this->json($products);
    }
}
