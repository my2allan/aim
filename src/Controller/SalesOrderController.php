<?php
// src/Controller/SalesOrderController.php

namespace App\Controller;

use App\Entity\SalesOrder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SalesOrderController extends AbstractController
{
    /**
     * @Route("/sales_orders", methods={"GET"})
     */
    public function index()
    {
        // Retrieve all sales orders from the database
        $salesOrders = $this->getDoctrine()->getRepository(SalesOrder::class)->findAll();

        // Return a JSON response
        return new JsonResponse($salesOrders);
    }

    /**
     * @Route("/sales_orders/{id}", methods={"GET"})
     */
    public function show($id)
    {
        // Retrieve a sales order by its ID from the database
        $salesOrder = $this->getDoctrine()->getRepository(SalesOrder::class)->find($id);

        // Return a JSON response
        return new JsonResponse($salesOrder);
    }

    /**
     * @Route("/sales_orders", methods={"POST"})
     */
    public function create(Request $request)
    {
        // Parse the JSON data from the request body
        $data = json_decode($request->getContent(), true);

        // Create a new SalesOrder object and set its properties
        $salesOrder = new SalesOrder();
        // Set the properties of the sales order using the $data array

        // Persist the sales order to the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($salesOrder);
        $entityManager->flush();

        // Return a JSON response with the created sales order
        return new JsonResponse($salesOrder);
    }

    /**
     * @Route("/sales_orders/{id}", methods={"PUT"})
     */
    public function update(Request $request, $id)
    {
        // Retrieve the sales order by its ID from the database
        $salesOrder = $this->getDoctrine()->getRepository(SalesOrder::class)->find($id);

        // Parse the JSON data from the request body
        $data = json_decode($request->getContent(), true);

        // Update the properties of the sales order using the $data array
        // ...

        // Persist the updated sales order to the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        // Return a JSON response with the updated sales order
        return new JsonResponse($salesOrder);
    }

    /**
     * @Route("/sales_orders/{id}", methods={"DELETE"})
     */
    public function delete($id)
    {
        // Retrieve the sales order by its ID from the database
        $salesOrder = $this->getDoctrine()->getRepository(SalesOrder::class)->find($id);

        // Remove the sales order from the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($salesOrder);
        $entityManager->flush();

        // Return a JSON response indicating success
        return new JsonResponse(['message' => 'Sales order deleted']);
    }
}
