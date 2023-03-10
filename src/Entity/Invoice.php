<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $number_prefix = null;

    #[ORM\Column(options: ['unsigned' => true])]
    private ?int $number_int = null;

    #[ORM\ManyToOne(inversedBy: 'invoices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AppUser $user = null;

    #[ORM\ManyToOne(inversedBy: 'invoices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    #[ORM\Column(length: 100)]
    private ?string $status = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $issue_date = null;

    #[ORM\Column(length: 50)]
    private ?string $payment_terms = null;

    #[ORM\Column]
    private array $line_items = [];

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $total_amount = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberPrefix(): ?string
    {
        return $this->number_prefix;
    }

    public function setNumberPrefix(string $number_prefix): self
    {
        $this->number_prefix = $number_prefix;

        return $this;
    }

    public function getNumberInt(): ?int
    {
        return $this->number_int;
    }

    public function setNumberInt(int $number_int): self
    {
        $this->number_int = $number_int;

        return $this;
    }

    public function getUserId(): ?AppUser
    {
        return $this->user;
    }

    public function setUserId(?AppUser $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getClientId(): ?Client
    {
        return $this->client;
    }

    public function setClientId(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getIssueDate(): ?\DateTimeInterface
    {
        return $this->issue_date;
    }

    public function setIssueDate(\DateTimeInterface $issue_date): self
    {
        $this->issue_date = $issue_date;

        return $this;
    }

    public function getPaymentTerms(): ?string
    {
        return $this->payment_terms;
    }

    public function setPaymentTerms(string $payment_terms): self
    {
        $this->payment_terms = $payment_terms;

        return $this;
    }

    public function getLineItems(): array
    {
        return $this->line_items;
    }

    public function setLineItems(array $line_items): self
    {
        $this->line_items = $line_items;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTotalAmount(): ?int
    {
        return $this->total_amount;
    }

    public function setTotalAmount(int $total_amount): self
    {
        $this->total_amount = $total_amount;

        return $this;
    }
}
