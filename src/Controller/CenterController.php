<?php

namespace App\Controller;

use App\Repository\CenterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CenterController extends AbstractController
{
    #[Route('/api/centers', name: 'centers', methods:["GET"])]
    public function getAllCenters(CenterRepository $CenterRepository, SerializerInterface $serializer): JsonResponse
    {
        $centerList = $CenterRepository->findAll();
        $jsonCenterList = $serializer->serialize($centerList, 'json', ['groups' => 'getCenter']);

        return new JsonResponse($jsonCenterList, Response::HTTP_OK, [], true);
    }
    #[Route('/api/center/{id}', name: 'detailCenter', methods:["GET"])]
    public function getDetailCenter(int $id, CenterRepository $CenterRepository, SerializerInterface $serializer): JsonResponse
    {
        $center = $CenterRepository->find($id);
        if ($center) {
            $jsonCenter = $serializer->serialize($center, 'json',  ['groups' => 'getCenter']);
            return new JsonResponse($jsonCenter, Response::HTTP_OK, [], true);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }

    #[Route('/api/center/{id}', name: 'deleteCenter', methods:["DELETE"])]
    public function deleteCenter(int $id, CenterRepository $CenterRepository, EntityManagerInterface $em): JsonResponse
    {
        $center = $CenterRepository->find($id);
        if ($center) {
            $em->remove($center);
            $em->flush();
            return new JsonResponse(null, Response::HTTP_NO_CONTENT);

        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }
}
