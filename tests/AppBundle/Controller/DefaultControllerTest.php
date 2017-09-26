<?php

namespace tests\appbundle\controller;

use symfony\bundle\frameworkbundle\test\webtestcase;

class defaultcontrollertest extends webtestcase
{
    public function testindex()
    {
        $client = static::createclient();

        $crawler = $client->request('get', '/login');

        $this->assertequals(200, $client->getresponse()->getstatuscode());
        $this->assertcontains('comin', $crawler->filter('.logo h2')->text());
    }
}
