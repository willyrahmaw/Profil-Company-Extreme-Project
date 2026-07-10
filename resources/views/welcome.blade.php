@php
$coils = $products->filter(fn($p) => $p->category === 'coil');
$cottons = $products->filter(fn($p) => $p->category === 'cotton');
@endphp

@extends('layouts.app')

@section('content')
@include('partials.header')

<main class="flex-grow">
    @include('partials.hero')
    <div id="products" class="scroll-mt-24"></div>
    @include('partials.catalog-coil')
    @include('partials.catalog-cotton')
    @include('partials.compare-table')
    @include('partials.pillars')
    @include('partials.reviews')
    @include('partials.faq')
    @include('partials.shops')
</main>



<!-- Toast Notification -->
<div class="fixed bottom-6 left-6 z-50 pointer-events-none" x-show="showToast" x-transition x-cloak>
    <div class="bg-black text-white border border-industrial-orange text-[10px] font-mono tracking-widest uppercase p-4 shadow-[4px_4px_0px_rgba(255,64,129,0.25)]">
        [ <span x-text="toastMessage" class="text-zinc-350 font-bold"></span> ]
    </div>
</div>

{{-- ═══════════════════════════════════════════════
         GOOGLE PRODUCT SCHEMA JSON-LD
    ═══════════════════════════════════════════════ --}}
@php
$productSchemas = [];
foreach ($products as $product) {
$productUrl = url('/#products');
$price = $product->price;
$inStock = $product->stock > 0;

$itemSchema = [
'@context' => 'https://schema.org',
'@type' => 'Product',
'name' => $product->title,
'image' => strpos($product->image_path, 'http') === 0 ? $product->image_path : url($product->image_path),
'description' => $product->character_description ?? $product->title,
'sku' => $product->slug,
'offers' => [
'@type' => 'Offer',
'url' => $productUrl,
'priceCurrency' => 'IDR',
'price' => $price,
'availability' => $inStock ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
'priceValidUntil' => now()->addYear()->format('Y-m-d'),
]
];

if ($product->category === 'coil' && !empty($product->specifications)) {
$addSpecs = [];
if (!empty($product->specifications['resistance'])) {
$addSpecs[] = [
'@type' => 'PropertyValue',
'name' => 'Resistance',
'value' => $product->specifications['resistance']
];
}
if (!empty($product->specifications['diameter'])) {
$addSpecs[] = [
'@type' => 'PropertyValue',
'name' => 'Diameter',
'value' => $product->specifications['diameter']
];
}
if (!empty($product->specifications['material'])) {
$addSpecs[] = [
'@type' => 'PropertyValue',
'name' => 'Material',
'value' => $product->specifications['material']
];
}
if (count($addSpecs) > 0) {
$itemSchema['additionalProperty'] = $addSpecs;
}
}

$productSchemas[] = $itemSchema;
}
@endphp

@if(count($productSchemas) > 0)
<script type="application/ld+json">
{!! json_encode($productSchemas, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif
@endsection