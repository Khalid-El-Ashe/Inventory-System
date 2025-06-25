@extends('dashboard.parent')

@section('content')
<div class="container py-4">
    <div class="card shadow rounded-4 border-0 overflow-hidden">
        <div class="row g-0">
            <div class="col-md-4 p-0">
                <div style="width: 100%; height: 100%; overflow: hidden;">
                    @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                        style="width: 100%; height: 100%; object-fit: cover;" alt="Product Image">
                    @else
                    <img src="{{ asset('storage/broken-image.png') }}"
                        style="width: 100%; height: 100%; object-fit: cover;" alt="No Image">
                    @endif
                </div>
            </div>

            <div class="col-md-8">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="fw-bold badge bg-secondary fs-6 fs-6">{{ $product->name }}<strong> :إسم
                                المنتج</strong>
                        </h4>
                        <span class="badge bg-secondary fs-6">{{ $product->category?->name ??
                            'غير مصنف' }}<strong> :النوع</strong></span>
                    </div>

                    <div class="row mb-2">
                        <div class="col-12 fs-5">
                            <strong>الوصف:</strong><br>
                            {{ $product->description ?? 'لا يوجد وصف لهذا المنتج.' }}
                        </div>
                    </div>
                    {{-- <p class="text-muted mb-3">{{ $product->description ?? }}</p> --}}

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="badge bg-success fs-7 p-2 ms-2"><strong>السعر:</strong> ${{
                                number_format($product->price, 2) }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="badge bg-success fs-7 p-2 ms-2"><strong>الكمية:</strong> {{ $product->quantity }}
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="badge bg-success fs-7 p-2 ms-2"><strong>الكمية المتبقية:</strong> <span>50</span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="badge bg-success fs-7 p-2 ms-2"><strong>العائدات:</strong> 20</p>
                        </div>
                    </div>

                    <div class="col mb-3">
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0"
                                aria-valuemax="100" style="width: 57%">
                            </div>
                        </div>
                        <small>
                            57% نسبة الطلب
                        </small>
                    </div>

                    {{-- التواريخ --}}
                    <div class="border-top pt-2 mt-2 text-muted small d-flex justify-content-between">
                        <span class="fw-bold">تاريخ الإنشاء: {{ $product->created_at->format('Y-m-d') }}</span>
                        {{-- <span>آخر تعديل: {{ $product->updated_at->format('Y-m-d') }}</span> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection