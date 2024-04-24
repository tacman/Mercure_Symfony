<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController {

    #[Route('/', name: 'app_index')]
    public function index()
    : Response {

        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/sse', name: 'app_sse')]
    public function sse()
    : Response {
        $data = [
            'event' => 'MessageEvent',
            'data' => '<i>A mess</i>age! from sse'
        ];
        return $this->json($data);
    }

    #[Route('/publish', name: 'publish')]
    public function publish(HubInterface $hub)
    : JsonResponse {

        $data = [
            'event' => 'MessageEvent',
            'data' => '<i>A mess</i>age!'
            ];
        $update = new Update(
            '/test',
            json_encode($data)
        );

        $hub->publish($update);

        return $this->json($data);
    }
}
