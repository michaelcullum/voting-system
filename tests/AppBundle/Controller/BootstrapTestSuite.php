<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class BootstrapTestSuite extends WebTestCase
{
    public $client;
    public $crawler;
    public $response;

    protected function setupTest($path)
    {
        $client = static::createClient();

        $this->setClient($client);
        $client->enableProfiler();
        $crawler = $client->request('GET', $path);
        $response = $client->getResponse();
        $this->setupBootstrapping($client, $crawler, $response);

        return array('client' => $client, 'crawler' => $crawler, 'response' => $response);
    }

    public function setupBootstrapping($client, $crawler, $response)
    {
        $this->setClient($client);
        $this->setCrawler($crawler);
        $this->setResponse($response);
    }

    public function globalTests($status = 200)
    {
        if (strpos(strval($status), '2') === 0) {
            $this->assertTrue($this->client->getResponse()->isSuccessful(), 'Response is a sucessful one');
        } else {
            $this->assertEquals($this->response->getStatusCode(), $status, 'Response Code Check');
        }

        if ($status == 200) {
            $this->assertTrue($this->crawler->filter('html:contains("PHP FIG")')->count() > 0, 'Header Check');
        }

        if ($profile = $this->client->getProfile()) {
            $this->profileCheck($profile);
        }
    }

    private function profileCheck($profile)
    {
        $this->assertLessThan(
            50,
            $profile->getCollector('db')->getQueryCount(),
            ('Checks that query count is less than 50 (token '.$profile->getToken().')')
            );

        $this->assertLessThan(
                10000, // ms
                $profile->getCollector('time')->getDuration(),
            ('Checks that time count is '.$profile->getCollector('time')->getDuration().' which is not less than 10000ms (token '.$profile->getToken().')')
            );

        $this->assertLessThan(
                70000000, // 70MB
                $profile->getCollector('memory')->getMemory(),
            ('Checks that memory check is '.$profile->getCollector('memory')->getMemory().' bytes which is not less than 70MB (token '.$profile->getToken().')')
            );
    }

    public function get($dependency)
    {
        $container = $this->client->getContainer();

        return $container->get($dependency);
    }

    /**
     * Gets the value of client.
     *
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Sets the value of client.
     *
     * @param mixed $client the client
     *
     * @return self
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Gets the value of crawler.
     *
     * @return mixed
     */
    public function getCrawler()
    {
        return $this->crawler;
    }

    /**
     * Sets the value of crawler.
     *
     * @param mixed $crawler the crawler
     *
     * @return self
     */
    public function setCrawler($crawler)
    {
        $this->crawler = $crawler;

        return $this;
    }

    /**
     * Gets the value of response.
     *
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Sets the value of response.
     *
     * @param mixed $response the response
     *
     * @return self
     */
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }
}
