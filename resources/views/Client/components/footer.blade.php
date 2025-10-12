<!-- Footer -->
<footer class="bg-light text-dark pt-5 pb-4 mt-auto shadow-sm">
    <div class="container">
        <div class="row">

            <!-- About / Logo -->
            <div class="col-md-4 mb-4">
                <div class="d-flex align-items-center mb-2">
                    <h5 class="fw-bold mb-0">
                        {{ $websiteInfo->name ?? 'Electronics' }}
                    </h5>
                </div>
                <p class="small text-muted mb-0">
                    {{ $websiteInfo->about_description ?? 'High-quality electronics and gadgets at your fingertips. Shop with ease and confidence.' }}
                </p>
            </div>

            <!-- Quick Links -->
            <div class="col-md-4 mb-4">
                <h6 class="fw-bold">Quick Links</h6>
                <ul class="list-unstyled">
                    <li><a href="/about" class="text-decoration-none text-dark">About Us</a></li>
                    <li><a href="/contact" class="text-decoration-none text-dark">Contact</a></li>
                    <li><a href="/faq" class="text-decoration-none text-dark">FAQ</a></li>
                    <li><a href="/privacy" class="text-decoration-none text-dark">Privacy Policy</a></li>
                    <li><a href="/terms" class="text-decoration-none text-dark">Terms of Service</a></li>
                </ul>
            </div>

            <!-- Contact / Social -->
            <div class="col-md-4 mb-4">
                <h6 class="fw-bold">Contact Us</h6>
                <p class="small mb-1">
                    <i class="bi bi-telephone me-2"></i>
                    {{ $websiteInfo->phone ?? '+1 234 567 890' }}
                </p>
                <p class="small mb-1">
                    <i class="bi bi-envelope me-2"></i>
                    {{ $websiteInfo->email ?? 'support@electronics.com' }}
                </p>
                <p class="small mb-3">
                    <i class="bi bi-geo-alt me-2"></i>
                    {{ $websiteInfo->address ?? '123 Main Street, City, Country' }}
                </p>

                <div>
                    @if(isset($websiteInfo) && !empty($websiteInfo->facebook))
                        <a href="{{ $websiteInfo->facebook }}" class="text-dark me-3"><i class="bi bi-facebook"></i></a>
                    @endif
                    @if(isset($websiteInfo) && !empty($websiteInfo->twitter))
                        <a href="{{ $websiteInfo->twitter }}" class="text-dark me-3"><i class="bi bi-twitter"></i></a>
                    @endif
                    @if(isset($websiteInfo) && !empty($websiteInfo->instagram))
                        <a href="{{ $websiteInfo->instagram }}" class="text-dark me-3"><i class="bi bi-instagram"></i></a>
                    @endif
                    @if(isset($websiteInfo) && !empty($websiteInfo->linkedin))
                        <a href="{{ $websiteInfo->linkedin }}" class="text-dark"><i class="bi bi-linkedin"></i></a>
                    @endif
                </div>
            </div>

        </div>

        <hr class="mt-3">

        <!-- Copyright -->
        <div class="text-center small text-muted">
            &copy; {{ date('Y') }} {{ $websiteInfo->name ?? 'Electronics' }}. All rights reserved.
        </div>
    </div>
</footer>
