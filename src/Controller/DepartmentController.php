<?php

// src/Controller/DepartmentController.php

namespace App\Controller;

use App\Entity\Department;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DepartmentController extends AbstractController
{
    /**
     * @Route("/departments", methods={"GET"})
     */
    public function index()
    {
        // Retrieve all departments from the database
        $departments = $this->getDoctrine()->getRepository(Department::class)->findAll();

        // Return a JSON response
        return new JsonResponse($departments);
    }

    /**
     * @Route("/departments/{id}", methods={"GET"})
     */
    public function show($id)
    {
        // Retrieve a department by its ID from the database
        $department = $this->getDoctrine()->getRepository(Department::class)->find($id);

        // Return a JSON response
        return new JsonResponse($department);
    }

    /**
     * @Route("/departments", methods={"POST"})
     */
    public function create(Request $request)
    {
        // Parse the JSON data from the request body
        $data = json_decode($request->getContent(), true);

        // Create a new Department object and set its properties
        $department = new Department();
        // Set the properties of the department using the $data array

        // Persist the department to the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($department);
        $entityManager->flush();

        // Return a JSON response with the created department
        return new JsonResponse($department);
    }

    /**
     * @Route("/departments/{id}", methods={"PUT"})
     */
    public function update(Request $request, $id)
    {
        // Retrieve the department by its ID from the database
        $department = $this->getDoctrine()->getRepository(Department::class)->find($id);

        // Parse the JSON data from the request body
        $data = json_decode($request->getContent(), true);

        // Update the properties of the department using the $data array
        // ...

        // Persist the updated department to the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        // Return a JSON response with the updated department
        return new JsonResponse($department);
    }

    /**
     * @Route("/departments/{id}", methods={"DELETE"})
     */
    public function delete($id)
    {
        // Retrieve the department by its ID from the database
        $department = $this->getDoctrine()->getRepository(Department::class)->find($id);

        // Remove the department from the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($department);
        $entityManager->flush();

        // Return a JSON response indicating success
        return new JsonResponse(['message' => 'Department deleted']);
    }
}
