<?php

namespace App\Services;

use App\Exceptions\RssException;
use App\Interfaces\DataRetrievalInterface;
use Illuminate\Support\Facades\Cache;
use \SimpleXMLElement;

class RssRetrievalService implements DataRetrievalInterface
{
    const FEED_CACHE_KEY = 'rss-feed';
    const FEED_CACHE_DURATION = 3600;

    /**
     * @param ListFormatterService
     */
    private $formatterService;

    public function __construct(ListFormatterService $formatterService)
    {
        $this->formatterService = $formatterService;
    }

    public function load(): array
    {
        $xml = self::loadXML();

        return array_get(self::formatXMLToArray($xml), 'entry');
    }

    public static function loadXML(): SimpleXMLElement
    {
        $cached = Cache::get(self::FEED_CACHE_KEY);
        if ($cached) {
            return new SimpleXMLElement($cached);
        }

        $feedUrl = env('FEED_URL');
        if (!$feedUrl) {
            throw new RssException('RSS feed not configured');
        }

        $data = file_get_contents($feedUrl);
        Cache::put(self::FEED_CACHE_KEY, $data, self::FEED_CACHE_DURATION);

        return new SimpleXMLElement($data);
    }

    public static function formatXMLToArray(SimpleXMLElement $xml): array
    {
        return json_decode(json_encode($xml), true);
    }
}