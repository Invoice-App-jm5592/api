<?php

namespace App\Service;

use App\Entity\AppUser;
use App\Entity\Invoice;
use App\Utils\InvoiceUtils;
use Doctrine\ORM\EntityManagerInterface;

class InvoiceService
{
    /**
     * @param EntityManagerInterface $entityManager
     * @param int $userId
     * @return Invoice[]|array
     */
    public function getAllInvoices(EntityManagerInterface $entityManager, int $userId): array
    {
        $userRepository = $entityManager->getRepository(AppUser::class);
        $user = $userRepository->find($userId);
        $invoices = $user->getInvoices();
        return InvoiceUtils::transformCollectionToArray($invoices);
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @param int $userId
     * @param string $status
     * @return Invoice[]|array
     */
    public function getInvoicesByStatus(EntityManagerInterface $entityManager, int $userId, string $status): array
    {
        $invoiceRepository = $entityManager->getRepository(Invoice::class);
        $invoices = $invoiceRepository->findByStatusAndUserId(strtoupper($status), $userId);
        return InvoiceUtils::transformCollectionToArray($invoices);
    }
}