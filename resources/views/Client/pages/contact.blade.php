@extends('Client.pages.basepage.base')


@section('title', 'Contact - ' . ($websiteInfo->name ?? ''))

@section('content')
<div class="container my-5">
    <h1 class="mb-4">{{ $websiteInfo->contact_title ?? 'Contact' }}</h1>
    <p>{{ $websiteInfo->contact_description ?? 'Get in touch with us via phone, email or contact form.' }}</p>
</div>
@endsection
