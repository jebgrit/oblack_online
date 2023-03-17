@php
    $setting = App\Models\SiteSetting::find(1);
@endphp

<footer class="page-footer">
    <p class="mb-0">{{ $setting->copyright }}, {{ $setting->company_name }}</p>
</footer>