<?php

namespace App\Controller;

use App\Service\InvoiceService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InvoiceController extends AbstractController
{
    // TODO: Change later when implementing authentication
    const USER_ID = 8;

    private InvoiceService $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    #[Route('api/invoices', name: 'all_invoices', methods: ['GET'])]
    public function getAllInvoices(EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        // Filter Invoices by 'status'
        if ($request->query->has('status'))
        {
            $status = $request->query->get('status');
            $response = $this->invoiceService->getInvoicesByStatus($entityManager, self::USER_ID, strtoupper($status));
            return $this->json([
                'data' => $response
            ]);
        }

        // Return all invoices
        $response = $this->invoiceService->getAllInvoices($entityManager, self::USER_ID);
        return $this->json([
            'data' => $response
        ]);
    }

    #[Route('api/invoices/{id}', name: 'invoice_details', methods: ['GET'])]
    public function getInvoiceById(EntityManagerInterface $entityManager, string $id): JsonResponse
    {
        if (!ctype_digit($id)) {
            return $this->json([
                'error' => 'Invalid id. Only digits are allowed.'
            ], Response::HTTP_BAD_REQUEST);
        }

        $response = $this->invoiceService->getInvoiceById($entityManager, self::USER_ID, intval($id));
        return $this->json([
            'data' => $response
        ]);
    }
}
