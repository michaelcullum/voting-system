<?php
namespace Tests\AppBundle\Controller;

class SmokeTest extends BootstrapTestSuite
{
	public function testContainerServices()
	{
		$client = static::createClient();
		foreach ($client->getContainer()->getServiceIds() as $serviceId)
		{
			try {
				//$service = $client->getContainer()->get($serviceId);
				//$this->assertNotNull($service);
			} catch (InactiveScopeException $e) {}
		}
	}

	/**
	 * @dataProvider explosionProvider
	 */
	public function testFunctionalTests($path, $status = 200)
	{
		$objs = $this->setupTest($path);
		$this->globalTests($status);
	}

	public function explosionProvider()
	{
		return array(
			array('/'),
		);
	}
}
