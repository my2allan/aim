<?php
// src/Controller/FinancialTransactionController.php

namespace App\Controller;

use App\Entity\FinancialTransaction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FinancialTransactionController extends AbstractController
{
    /**
     * @Route("/financial_transactions", methods={"GET"})
     */
    public function index()
    {
        // Retrieve all financial transactions from the database
        $financialTransactions = $this->getDoctrine()->getRepository(FinancialTransaction::class)->findAll();

        // Return a JSON response
        return new JsonResponse($financialTransactions);
    }

    /**
     * @Route("/financial_transactions/{id}", methods={"GET"})
     */
    public function show($id)
    {
        // Retrieve a financial transaction by its ID from the database
        $financialTransaction = $this->getDoctrine()->getRepository(FinancialTransaction::class)->find($id);

        // Return a JSON response
        return new JsonResponse($financialTransaction);
    }

    /**
     * @Route("/financial_transactions", methods={"POST"})
     */
    public function create(Request $request)
    {
        // Parse the JSON data from the request body
        $data = json_decode($request->getContent(), true);

        // Create a new FinancialTransaction object and set its properties
        $financialTransaction = new FinancialTransaction();
        // Set the properties of the financial transaction using the $data array

        // Persist the financial transaction to the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($financialTransaction);
        $entityManager->flush();

        // Return a JSON response with the created financial transaction
        return new JsonResponse($financialTransaction);
    }

    /**
     * @Route("/financial_transactions/{id}", methods={"PUT"})
     */
    public function update(Request $request, $id)
    {
        // Retrieve the financial transaction by its ID from the database
        $financialTransaction = $this->getDoctrine()->getRepository(FinancialTransaction::class)->find($id);

        // Parse the JSON data from the request body
        $data = json_decode($request->getContent(), true);

        // Update the properties of the financial transaction using the $data array
        // ...

        // Persist the updated financial transaction to the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        // Return a JSON response with the updated financial transaction
        return new JsonResponse($financialTransaction);
    }

    /**
     * @Route("/financial_transactions/{id}", methods={"DELETE"})
     */
    public function delete($id)
    {
        // Retrieve the financial transaction by its ID from the database
        $financialTransaction = $this->getDoctrine()->getRepository(FinancialTransaction::class)->find($id);

        // Remove the financial transaction from the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($financialTransaction);
        $entityManager->flush();

        // Return a JSON response indicating success
        return new JsonResponse(['message' => 'Financial transaction deleted']);
    }
}
