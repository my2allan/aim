<?php

// src/Controller/CustomerController.php

namespace App\Controller;

use App\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    /**
     * @Route("/customers", methods={"GET"})
     */
    public function index()
    {
        // Retrieve all customers from the database
        $customers = $this->getDoctrine()->getRepository(Customer::class)->findAll();

        // Return a JSON response
        return new JsonResponse($customers);
    }

    /**
     * @Route("/customers/{id}", methods={"GET"})
     */
    public function show($id)
    {
        // Retrieve a customer by their ID from the database
        $customer = $this->getDoctrine()->getRepository(Customer::class)->find($id);

        // Return a JSON response
        return new JsonResponse($customer);
    }

    /**
     * @Route("/customers", methods={"POST"})
     */
    public function create(Request $request)
    {
        // Parse the JSON data from the request body
        $data = json_decode($request->getContent(), true);

        // Create a new Customer object and set its properties
        $customer = new Customer();
        // Set the properties of the customer using the $data array

        // Persist the customer to the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($customer);
        $entityManager->flush();

        // Return a JSON response with the created customer
        return new JsonResponse($customer);
    }

    /**
     * @Route("/customers/{id}", methods={"PUT"})
     */
    public function update(Request $request, $id)
    {
        // Retrieve the customer by their ID from the database
        $customer = $this->getDoctrine()->getRepository(Customer::class)->find($id);

        // Parse the JSON data from the request body
        $data = json_decode($request->getContent(), true);

        // Update the properties of the customer using the $data array
        // ...

        // Persist the updated customer to the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        // Return a JSON response with the updated customer
        return new JsonResponse($customer);
    }

    /**
     * @Route("/customers/{id}", methods={"DELETE"})
     */
    public function delete($id)
    {
        // Retrieve the customer by their ID from the database
        $customer = $this->getDoctrine()->getRepository(Customer::class)->find($id);

        // Remove the customer from the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($customer);
        $entityManager->flush();

        // Return a JSON response indicating success
        return new JsonResponse(['message' => 'Customer deleted']);
    }
}
