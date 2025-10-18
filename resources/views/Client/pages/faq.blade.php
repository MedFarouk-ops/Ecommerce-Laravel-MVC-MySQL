@extends('Client.pages.basepage.base')

@section('title', 'FAQ - ' . ($websiteInfo->name ?? ''))

@section('content')
<div class="container my-5">
    <h1 class="mb-4">{{ $websiteInfo->faq_title ?? 'FAQ' }}</h1>
    <p>{{ $websiteInfo->faq_description ?? 'Frequently asked questions about our products and services.' }}</p>
</div>
@endsection
