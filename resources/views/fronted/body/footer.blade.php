

<footer class="main" >

    @php
        $setting = App\Models\SiteSetting::find(1);
    @endphp
    
    
    
    <div class="container pb-30" data-wow-delay="0">
        <div class="row align-items-center">
            <div class="col-12 mb-30">
                <div class="footer-bottom"></div>
            </div>
            <div class="col-xl-2 col-lg-6 col-md-6">
                <p class="font-sm mb-0">
                    {{ $setting->copyright }}, <strong class="text-brand">{{ $setting->company_name }}</strong>
                </p>
            </div>

            <div class="col-xl-8 col-lg-6 text-center d-none d-xl-block">
                     
                <div class="d-lg-inline-flex">
                    <a href="{{ route('contact') }}" class="p-2 text-secondary underline-on-hover">Contact</a>
                    <a href="{{ route('legal') }}" class="p-2 text-secondary underline-on-hover">Mentions légales</a>
                    <a href="{{ route('term') }}" class="p-2 text-secondary underline-on-hover">Conditions d'utilisations</a>
                    <a href="{{ route('cgv') }}" class="p-2 text-secondary underline-on-hover">CGV</a>
                    <a href="{{ route('home.blog') }}" class="p-2 text-secondary underline-on-hover">Blog</a>
                    <a href="{{ route('faq') }}" class="p-2 text-secondary underline-on-hover">FAQ</a>
                    <a href="{{ route('become.vendor') }}" class="p-2 text-secondary underline-on-hover">Business</a>
                </div>
            </div>

            <div class="col-xl-2 col-lg-6 col-md-6 text-end d-none d-md-block">
                <div class="mobile-social-icon">
                    <a href="{{ $setting->facebook }}"><img
                            src="{{ asset('fronted/assets/imgs/theme/icons/icon-facebook-white.svg') }}"
                            alt="" /></a>
                    <a href="{{ $setting->twitter }}"><img
                            src="{{ asset('fronted/assets/imgs/theme/icons/icon-twitter-white.svg') }}"
                            alt="" /></a>
                    <a href="{{ $setting->youtube }}"><img
                            src="{{ asset('fronted/assets/imgs/theme/icons/icon-youtube-white.svg') }}"
                            alt="" /></a>
                </div>
            </div>
        </div>
    </div>
</footer>
