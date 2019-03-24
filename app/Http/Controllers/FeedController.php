<?php

namespace App\Http\Controllers;

use app\services\ListFormatterService;
use App\Services\RssRetrievalService;

class FeedController extends Controller
{
    /**
     * @var RssRetrievalService
     */
    private $rssRetrievalService;

    /**
     * @var ListFormatterService
     */
    private $formatterService;

    public function __construct(
        RssRetrievalService $rssRetrievalService,
        ListFormatterService $formatterService
    ) {
        $this->rssRetrievalService = $rssRetrievalService;
        $this->formatterService = $formatterService;

        $this->middleware('auth');
    }

    public function index()
    {
        $articles = $this->rssRetrievalService->load();
        $words = $this->formatterService
            ->setTotalCount(10)
            ->setOrder(ListFormatterService::ORDER_DESC)
            ->getWordCounts($articles);

        return view('main', [
            'words' => $words->toJson(),
            'articles' => json_encode($articles),
        ]);
    }
}