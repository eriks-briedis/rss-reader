<?php

namespace Tests\Unit;

use app\services\ListFormatterService;
use Tests\TestCase;

class ListFormatterServiceTest extends TestCase
{
    /**
     * @var ListFormatterService
     */
    protected $service;

    public function __construct()
    {
        $this->service = new ListFormatterService();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetWordCounts()
    {
        $sampleData = [
            'title' => 'John Apple: Group FaceTime allows up to 32 people! Skype: Hold my beer',
            'name' => 'John Doe',
            'summary' => 'John Apple. When you first install the Chromium version of Edge, Microsoft will prompt you to import ' .
                'favorites, passwords, and John browsing history from Chrome or Edge (depending on your default). The setup ' .
                'screen also prompts you to pick John a style for the default tab page before you start browsing. Apple',
            'plot' => 'rss',
        ];

        $re = $this->service
            ->setTotalCount(10)
            ->getWordCounts($sampleData);

        $this->assertCount(10, $re);
        $this->assertGreaterThan(reset($re), end($re));
        $this->assertArrayNotHasKey('the', $re);
        $this->assertArrayNotHasValue('rss', $re);
    }
}
