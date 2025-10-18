@extends('Client.pages.basepage.base')


@section('title', 'Privacy Policy - ' . ($websiteInfo->name ?? ''))

@section('content')
<div class="container my-5">
    <h1 class="mb-4">{{ $websiteInfo->privacy_policy_title ?? 'Privacy Policy' }}</h1>
    <p>{!! $websiteInfo->privacy_policy_description ?? 'Our privacy policy details how we protect your information.' !!}</p>
</div>
@endsection
