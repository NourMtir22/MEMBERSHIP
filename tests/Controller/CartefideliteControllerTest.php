<?php

namespace App\Test\Controller;

use App\Entity\Cartefidelite;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CartefideliteControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/cartefidelite/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Cartefidelite::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Cartefidelite index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'cartefidelite[pointmerci]' => 'Testing',
            'cartefidelite[dateexpiration]' => 'Testing',
            'cartefidelite[idUser]' => 'Testing',
            'cartefidelite[ida]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Cartefidelite();
        $fixture->setPointmerci('My Title');
        $fixture->setDateexpiration('My Title');
        $fixture->setIdUser('My Title');
        $fixture->setIda('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Cartefidelite');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Cartefidelite();
        $fixture->setPointmerci('Value');
        $fixture->setDateexpiration('Value');
        $fixture->setIdUser('Value');
        $fixture->setIda('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'cartefidelite[pointmerci]' => 'Something New',
            'cartefidelite[dateexpiration]' => 'Something New',
            'cartefidelite[idUser]' => 'Something New',
            'cartefidelite[ida]' => 'Something New',
        ]);

        self::assertResponseRedirects('/cartefidelite/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getPointmerci());
        self::assertSame('Something New', $fixture[0]->getDateexpiration());
        self::assertSame('Something New', $fixture[0]->getIdUser());
        self::assertSame('Something New', $fixture[0]->getIda());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Cartefidelite();
        $fixture->setPointmerci('Value');
        $fixture->setDateexpiration('Value');
        $fixture->setIdUser('Value');
        $fixture->setIda('Value');

        $$this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/cartefidelite/');
        self::assertSame(0, $this->repository->count([]));
    }
}
