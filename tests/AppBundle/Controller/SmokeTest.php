<?php

namespace Tests\AppBundle\Controller;

class SmokeTest extends BootstrapTestSuite
{
    /**
     * @dataProvider explosionProvider
     */
    public function testFunctionalTests($path, $status = 200)
    {
        $this->setupTest($path);
        $this->globalTests($status);
    }

    public function explosionProvider()
    {
        return array(
            array('/'),
            array('/users'),
            array('/users/', 301),
            array('/poll'),
            array('/users/create'),
        );
    }
}
