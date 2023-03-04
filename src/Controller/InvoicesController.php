<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class InvoicesController extends AbstractController
{
    #[Route('/invoices', name: 'all_invoices', methods: ['GET'])]
    public function getAllInvoices(Request $request): JsonResponse
    {
        // Filter Invoices by 'status'
        if ($request->query->has('status'))
        {
            $invoices = 'Filter Invoices by status: ' . $request->query->get('status');
            return $this->json([
                'data' => $invoices
            ]);
        }


        // Return all invoices
        $invoices = "ALL INVOICES";
        return $this->json([
            'data' => $invoices
        ]);
    }

    #[Route('invoices/{id}', name: 'invoice_details', methods: ['GET'])]
    public function getInvoiceById(string $id): JsonResponse
    {
        return $this->json([
            'data' => 'Individual Invoice with ID: ' . $id
        ]);
    }
}
