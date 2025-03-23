<?php 
namespace App\Service;
use App\Entity\Client;
use App\Repository\ClientRepository;

class NormalClientService
{
    private ClientRepository $clientRepository ;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
        // $this->entityManager = $entityManager;
    }
    // public function getNormalClient(int $id): ?Client
    // {
    //     return $this->clientRepository->find($id);
    // }
    public function addClient(string $username, string $name, string $email, string $address, string $plainPassword): Client
    {
        // Vérifier si un client existe déjà avec cet email
        // $existingClient = $this->clientRepository->findOneByEmail($email);
        // if ($existingClient) {
        //     throw new \Exception("Un client avec cet email existe déjà.");
        // }

        // Créer une instance de Client
        $client = new Client();
        $client->setUsername($username);
        $client->setName($name);
        $client->setEmail($email);
        $client->setAddress($address);
        // $client->setRoles(['ROLE_USER']); // Définir un rôle par défaut (exemple)

        // Encoder le mot de passe
        $encodedPassword = $this->passwordEncoder->encodePassword($client, $plainPassword);
        $client->setPassword($encodedPassword);

        // Persister l'entité Client dans la base de données
        $this->entityManager->persist($client);
        $this->entityManager->flush();

        // Retourner l'objet Client ajouté
        return $client;
    }


}