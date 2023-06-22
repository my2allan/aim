<?php
// src/Controller/InventoryController.php

namespace App\Controller;

use App\Entity\Inventory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class InventoryController extends AbstractController
{
    /**
     * @Route("/inventories", methods={"GET"})
     */
    public function index()
    {
        // Retrieve all inventories from the database
        $inventories = $this->getDoctrine()->getRepository(Inventory::class)->findAll();

        // Return a JSON response
        return new JsonResponse($inventories);
    }

    /**
     * @Route("/inventories/{id}", methods={"GET"})
     */
    public function show($id)
    {
        // Retrieve an inventory by its ID from the database
        $inventory = $this->getDoctrine()->getRepository(Inventory::class)->find($id);

        // Return a JSON response
        return new JsonResponse($inventory);
    }

    /**
     * @Route("/inventories", methods={"POST"})
     */
    public function create(Request $request)
    {
        // Parse the JSON data from the request body
        $data = json_decode($request->getContent(), true);

        // Create a new Inventory object and set its properties
        $inventory = new Inventory();
        // Set the properties of the inventory using the $data array

        // Persist the inventory to the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($inventory);
        $entityManager->flush();

        // Return a JSON response with the created inventory
        return new JsonResponse($inventory);
    }

    /**
     * @Route("/inventories/{id}", methods={"PUT"})
     */
    public function update(Request $request, $id)
    {
        // Retrieve the inventory by its ID from the database
        $inventory = $this->getDoctrine()->getRepository(Inventory::class)->find($id);

        // Parse the JSON data from the request body
        $data = json_decode($request->getContent(), true);

        // Update the properties of the inventory using the $data array
        // ...

        // Persist the updated inventory to the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        // Return a JSON response with the updated inventory
        return new JsonResponse($inventory);
    }

    /**
     * @Route("/inventories/{id}", methods={"DELETE"})
     */
    public function delete($id)
    {
        // Retrieve the inventory by its ID from the database
        $inventory = $this->getDoctrine()->getRepository(Inventory::class)->find($id);

        // Remove the inventory from the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($inventory);
        $entityManager->flush();

        // Return a JSON response indicating success
        return new JsonResponse(['message' => 'Inventory deleted']);
    }
}
