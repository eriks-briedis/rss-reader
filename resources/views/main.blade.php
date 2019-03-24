<?php
/**
 * @var string $words
 * @var string $articles
 */
?>

@extends('layouts.app')
@section('content')
    <div class="text-right container">
        <a href="/logout">Logout</a>
    </div>
    <words-component :words="{{ $words  }}"></words-component>
    <articles-component :articles="{{ $articles  }}"></articles-component>
@endsection