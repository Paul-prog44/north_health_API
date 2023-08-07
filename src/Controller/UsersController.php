<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UsersController extends AbstractController
{
    //prends en paramètre  l'entity repository et le serializer
    #[Route('/api/users', name: 'users', methods:["GET"])]
    public function getAllUsers(UserRepository $UserRepository, SerializerInterface $serializer): JsonResponse
    {
        $usersList = $UserRepository->findAll();
        $jsonUsersList = $serializer->serialize($usersList, 'json', ['groups' => 'getUsers']);
        
        return new JsonResponse($jsonUsersList, Response::HTTP_OK, [], true);
    }

    #[Route('/api/users/{id}', name: 'detailUser', methods:["GET"])]
    //fonction pour recuperer un utilisateur par son ID, prends en paramètre l'id, l'entity repository et le serializer
    public function getDetailUser(int $id, UserRepository $UserRepository, SerializerInterface $serializer): JsonResponse
    {
        $user = $UserRepository->find($id);
        if ($user) {
            $jsonUser = $serializer->serialize($user, 'json', ['groups' => 'getUsers']);
            return new JsonResponse($jsonUser, Response::HTTP_OK, [], true);
        }
        
        
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }

    #[Route('/api/users/{id}', name: 'deleteUser', methods:["DELETE"])]
    public function deleteUser(int $id, UserRepository $UserRepository, EntityManagerInterface $em): JsonResponse
    {
        $user = $UserRepository->find($id);
        if ($user) {
            $em->remove($user);
            $em->flush(); //Confirmation de la requête
            return new JsonResponse(null, Response::HTTP_NO_CONTENT);

        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }

    #[Route('/api/users', name: 'createUser', methods:["POST"])]
    public function createUser(Request $request, SerializerInterface $serializer, 
    EntityManagerInterface $em) : JsonResponse

    {
        //Conversion du json de la requête dans un objet de la classe user
        $user = $serializer->deserialize($request->getContent(), User::class, 'json');
        $em->persist($user);
        $em->flush();

        //Good practice : Renvoie de l'url de l'objet nouvellement créé dans les headers
        $jsonUser = $serializer->serialize($user, 'json', ['groups' => 'getUsers']);

        // $location = $urlGenerator->generate('detailUser', ['id' => $user->getId()], 
        // UrlGeneratorInterface::ABSOLUTE_URL);

        return new JsonResponse($jsonUser, Response::HTTP_CREATED, [], true);
    }

}
