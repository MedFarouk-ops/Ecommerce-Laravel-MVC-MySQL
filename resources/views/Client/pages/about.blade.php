@extends('Client.pages.basepage.base')

@section('title', 'About Us - ' . ($websiteInfo->name ?? ''))

@section('content')
<div class="container my-5">
    <h1 class="mb-4">{{ $websiteInfo->about_us_title ?? 'About Us' }}</h1>
    <p>{{ $websiteInfo->about_us_description ?? 'Learn more about our company, mission, and vision.' }}</p>
</div>
@endsection
