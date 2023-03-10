<?php

namespace App\Controller;

use App\Entity\AppUser;
use App\Entity\Invoice;
use App\Service\InvoiceService;
use App\Utils\InvoiceUtils;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class InvoiceController extends AbstractController
{
    // TODO: Change later when implementing authentication
    const USER_ID = 7;

    private InvoiceService $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    #[Route('/invoices', name: 'all_invoices', methods: ['GET'])]
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

    #[Route('invoices/{id}', name: 'invoice_details', methods: ['GET'])]
    public function getInvoiceById(EntityManagerInterface $entityManager, string $id): JsonResponse
    {
        $response = $this->invoiceService->getInvoiceById($entityManager, self::USER_ID, intval($id));
        return $this->json([
            'data' => $response
        ]);
    }
}
