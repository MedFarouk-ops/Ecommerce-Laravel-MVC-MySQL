<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteInfo extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'about_description',
        'hero_title',
        'hero_description',
        'phone',
        'email',
        'address',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',

        // New info sections
        'shipping_info',
        'secure_payment_info',
        'easy_returns_info',

        // Website pages
        'about_us_title',
        'about_us_description',
        'contact_title',
        'contact_description',
        'faq_title',
        'faq_description',
        'privacy_policy_title',
        'privacy_policy_description',
        'terms_service_title',
        'terms_service_description',

        // Website currency
        'currency',
        'shipping_fee',
        'free_shipping_threshhold',
    ];
}
