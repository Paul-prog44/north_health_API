<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UsersController extends AbstractController
{
    //prends en paramètre  l'entity repository et le serializer
    #[Route('/api/users', name: 'users', methods:["GET"])]
    public function getAllUsers(UsersRepository $UsersRepository, SerializerInterface $serializer): JsonResponse
    {
        $usersList = $UsersRepository->findAll();
        $jsonUsersList = $serializer->serialize($usersList, 'json');
        
        return new JsonResponse([$jsonUsersList, Response::HTTP_OK, [], true]);
    }

    #[Route('/api/users/{id}', name: 'detailUser', methods:["GET"])]
    //fonction pour recuperer un utilisateur par son ID, prends en paramètre l'id, l'entity repository et le serializer
    public function getDetailUser(int $id, UsersRepository $UsersRepository, SerializerInterface $serializer): JsonResponse
    {
        $user = $UsersRepository->find($id);
        if ($user) {
            $jsonUser = $serializer->serialize($user, 'json');
            return new JsonResponse($jsonUser, Response::HTTP_OK, [], true);
        }
        
        
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }


}
