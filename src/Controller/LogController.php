<?php

// src/Controller/LogController.php

namespace App\Controller;

use App\Entity\Log;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LogController extends AbstractController
{
    /**
     * @Route("/logs", methods={"GET"})
     */
    public function index()
    {
        // Retrieve all logs from the database
        $logs = $this->getDoctrine()->getRepository(Log::class)->findAll();

        // Return a JSON response
        return new JsonResponse($logs);
    }

    /**
     * @Route("/logs/{id}", methods={"GET"})
     */
    public function show($id)
    {
        // Retrieve a log by its ID from the database
        $log = $this->getDoctrine()->getRepository(Log::class)->find($id);

        // Return a JSON response
        return new JsonResponse($log);
    }

    /**
     * @Route("/logs", methods={"POST"})
     */
    public function create(Request $request)
    {
        // Parse the JSON data from the request body
        $data = json_decode($request->getContent(), true);

        // Create a new Log object and set its properties
        $log = new Log();
        // Set the properties of the log using the $data array

        // Persist the log to the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($log);
        $entityManager->flush();

        // Return a JSON response with the created log
        return new JsonResponse($log);
    }

    /**
     * @Route("/logs/{id}", methods={"PUT"})
     */
    public function update(Request $request, $id)
    {
        // Retrieve the log by its ID from the database
        $log = $this->getDoctrine()->getRepository(Log::class)->find($id);

        // Parse the JSON data from the request body
        $data = json_decode($request->getContent(), true);

        // Update the properties of the log using the $data array
        // ...

        // Persist the updated log to the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        // Return a JSON response with the updated log
        return new JsonResponse($log);
    }

    /**
     * @Route("/logs/{id}", methods={"DELETE"})
     */
    public function delete($id)
    {
        // Retrieve the log by its ID from the database
        $log = $this->getDoctrine()->getRepository(Log::class)->find($id);

        // Remove the log from the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($log);
        $entityManager->flush();

        // Return a JSON response indicating success
        return new JsonResponse(['message' => 'Log deleted']);
    }
}
