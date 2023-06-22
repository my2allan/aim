<?php
// src/Controller/OrderStatusController.php

namespace App\Controller;

use App\Entity\OrderStatus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OrderStatusController extends AbstractController
{
    /**
     * @Route("/order_statuses", methods={"GET"})
     */
    public function index()
    {
        // Retrieve all order statuses from the database
        $orderStatuses = $this->getDoctrine()->getRepository(OrderStatus::class)->findAll();

        // Return a JSON response
        return new JsonResponse($orderStatuses);
    }

    /**
     * @Route("/order_statuses/{id}", methods={"GET"})
     */
    public function show($id)
    {
        // Retrieve an order status by its ID from the database
        $orderStatus = $this->getDoctrine()->getRepository(OrderStatus::class)->find($id);

        // Return a JSON response
        return new JsonResponse($orderStatus);
    }

    /**
     * @Route("/order_statuses", methods={"POST"})
     */
    public function create(Request $request)
    {
        // Parse the JSON data from the request body
        $data = json_decode($request->getContent(), true);

        // Create a new OrderStatus object and set its properties
        $orderStatus = new OrderStatus();
        // Set the properties of the order status using the $data array

        // Persist the order status to the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($orderStatus);
        $entityManager->flush();

        // Return a JSON response with the created order status
        return new JsonResponse($orderStatus);
    }

    /**
     * @Route("/order_statuses/{id}", methods={"PUT"})
     */
    public function update(Request $request, $id)
    {
        // Retrieve the order status by its ID from the database
        $orderStatus = $this->getDoctrine()->getRepository(OrderStatus::class)->find($id);

        // Parse the JSON data from the request body
        $data = json_decode($request->getContent(), true);

        // Update the properties of the order status using the $data array
        // ...

        // Persist the updated order status to the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        // Return a JSON response with the updated order status
        return new JsonResponse($orderStatus);
    }

    /**
     * @Route("/order_statuses/{id}", methods={"DELETE"})
     */
    public function delete($id)
    {
        // Retrieve the order status by its ID from the database
        $orderStatus = $this->getDoctrine()->getRepository(OrderStatus::class)->find($id);

        // Remove the order status from the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($orderStatus);
        $entityManager->flush();

        // Return a JSON response indicating success
        return new JsonResponse(['message' => 'Order status deleted']);
    }
}
