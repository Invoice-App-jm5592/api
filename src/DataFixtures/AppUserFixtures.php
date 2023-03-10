<?php

namespace App\DataFixtures;

use App\Entity\AppUser;
use App\Entity\Client;
use App\Entity\Invoice;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppUserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $appUser = new AppUser();
        $appUser->setName('Jean-Marc Möckel');
        $appUser->setEmail('jeanmarc@example.com');
        $appUser->setPassword('MyPassword');
        $appUser->setAddress('Some-Street-Name 33');
        $appUser->setCityCode('12345');
        $appUser->setCity('Some City');
        $appUser->setCountry('Germany');
        $manager->persist($appUser);

        $client = new Client();
        $client->setName('Dr. Martin Trankovic');
        $client->setEmail('docmarting@example.com');
        $client->setAddress('Some-Client-Street 334');
        $client->setCityCode('123456');
        $client->setCity('Any City');
        $client->setCountry('France');
        $client->setPhone('039234-3423233');
        $client->setUserId($appUser);
        $manager->persist($client);

        $invoice = new Invoice();
        $nameParts = explode(' ', $appUser->getName());
        $numPrefix = '';
        foreach($nameParts as $part) {
            $numPrefix .= substr($part, 0, 1);
        }
        $invoice->setNumberPrefix(strtoupper($numPrefix));
        $invoice->setNumberInt(2300);
        $invoice->setUserId($appUser);
        $invoice->setClientId($client);
        $invoice->setStatus('PENDING');
        $invoice->setIssueDate(new DateTime());
        $invoice->setPaymentTerms('Next 30 days');
        $invoice->setLineItems([
            [
                'name' => 'App Icon Design',
                'quantity' => 1,
                'price' => 156,
                'total' => 156
            ],
            [
                'name' => 'App Screen Design',
                'quantity' => 9,
                'price' => 840,
                'total' => 7560
            ],
            [
                'name' => 'App Development',
                'quantity' => 1,
                'price' => 20000,
                'total' => 20000
            ]
        ]);
        $invoice->setDescription('Design & Development of Mobile App');
        $invoice->setTotalAmount(27760);
        $manager->persist($invoice);

        $manager->flush();
    }
}
