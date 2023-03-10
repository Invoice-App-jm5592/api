<?php

namespace App\Utils;

use App\Entity\Invoice;
use Doctrine\Common\Collections\Collection;

class InvoiceUtils
{
    /**
     * @param Collection $collection
     * @return Invoice[]|array
     */
    public static function transformCollectionToArray(Collection $collection)
    {
        if (!$collection->forAll(fn($key, $invoice) => $invoice instanceof Invoice)) {
            return [];
        }

        $invoices = $collection->toArray();

        /** @var Invoice[] $result */
        $result = [];

        foreach($invoices as $invoice) {
            $result[] = [
                'id' => $invoice->getId(),
                'invoice_number' => $invoice->getNumberPrefix() . $invoice->getNumberInt(),
                'status' => $invoice->getStatus(),
                'bill_from' => [
                    'id' => $invoice->getUserId()->getId(),
                    'name' => $invoice->getUserId()->getName(),
                    'email' => $invoice->getUserId()->getEmail(),
                    'address' => $invoice->getUserId()->getAddress(),
                    'phone' => $invoice->getUserId()->getPhone(),
                    'city' => $invoice->getUserId()->getCity(),
                    'code' => $invoice->getUserId()->getCityCode(),
                    'country' => $invoice->getUserId()->getCountry()
                ],
                'bill_to' => [
                    'id' => $invoice->getClientId()->getId(),
                    'name' => $invoice->getClientId()->getName(),
                    'email' => $invoice->getClientId()->getEmail(),
                    'address' => $invoice->getClientId()->getAddress(),
                    'phone' => $invoice->getClientId()->getPhone(),
                    'city' => $invoice->getClientId()->getCity(),
                    'code' => $invoice->getClientId()->getCityCode(),
                    'country' => $invoice->getClientId()->getCountry()
                ],
                'issue_date' => $invoice->getIssueDate(),
                'payment_terms' => $invoice->getPaymentTerms(),
                'description' => $invoice->getDescription(),
                'items' => $invoice->getLineItems(),
                'total' => $invoice->getTotalAmount()
            ];
        }

        return $result;
    }
}