<?php

namespace app\services;

use Illuminate\Support\Collection;

class ListFormatterService
{
    const MOST_COMMON_WORDS = [
        "the",
        "be",
        "to",
        "of",
        "and",
        "a",
        "in",
        "that",
        "have",
        "I",
        "it",
        "for",
        "not",
        "on",
        "with",
        "he",
        "as",
        "you",
        "do",
        "at",
        "this",
        "but",
        "his",
        "by",
        "from",
        "they",
        "we",
        "say",
        "her",
        "she",
        "or",
        "an",
        "will",
        "my",
        "one",
        "all",
        "would",
        "there",
        "their",
        "what",
        "so",
        "up",
        "out",
        "if",
        "about",
        "who",
        "get",
        "which",
        "go",
        "me",
    ];
    const ORDER_DESC = 'DESC';
    const ORDER_ASC = 'ASC';

    /**
     * @var int
     */
    private $totalCount = 10;

    /**
     * @var string
     */
    private $order = self::ORDER_DESC;

    public function setTotalCount(int $count): self
    {
        $this->totalCount = $count;

        return $this;
    }

    public function setOrder(string $order): self
    {
        $this->order = $order;

        return $this;
    }

    public function getWordCounts(array $dataRows): Collection
    {
        $filteredRows = $this->getRowsToProcess($dataRows);
        $wordCounts = collect();
        foreach ($filteredRows as $row) {
            $words = $this->explode($row);
            // Remove most common words
            $words = $this->filter($words);
            $wordCounts = $wordCounts->merge($words);
        }

        $uniqueWordCounts = collect(array_count_values($wordCounts->toArray()));
        $uniqueWordCounts = $uniqueWordCounts->sort();
        if ($this->order === self::ORDER_DESC) {
            $uniqueWordCounts = $uniqueWordCounts->reverse();
        }

        return $uniqueWordCounts->slice(0, $this->totalCount);
    }

    private function getRowsToProcess(array $dataRows, array $re = []): array
    {
        foreach ($dataRows as $key => $row) {
            if (is_array($row)) {
                $re = $this->getRowsToProcess($row, $re);
                continue;
            }
            if (!in_array($key, ['name', 'title', 'subtitle', 'summary'])) {
                continue;
            }
            $re[] = $row;
        }

        return $re;
    }

    private function explode(string $string): Collection
    {
        // Remove HTML tags
        $string = strip_tags($string);
        // Remove special characters
        $string = preg_replace("/[^a-zA-Z' ]/", "", $string);

        $words = explode(' ',  $string);

        return collect(array_filter($words));
    }

    public function filter(Collection $list): Collection
    {
        return $list->filter(function ($word) {
                return self::isValid($word);
            });
    }

    public static function isValid(string $word): bool
    {
        return !in_array(strtolower($word), self::MOST_COMMON_WORDS);
    }
}