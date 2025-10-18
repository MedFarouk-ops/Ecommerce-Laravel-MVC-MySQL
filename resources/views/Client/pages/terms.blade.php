@extends('Client.pages.basepage.base')

@section('title', 'Terms of Service - ' . ($websiteInfo->name ?? ''))

@section('content')
<div class="container my-5">
    <h1 class="mb-4">{{ $websiteInfo->terms_service_title ?? 'Terms of Service' }}</h1>
    <p>{!! $websiteInfo->terms_service_description ?? 'These are the terms and conditions of using our website and services.' !!}</p>
</div>
@endsection
