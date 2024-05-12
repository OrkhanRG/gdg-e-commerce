@extends('layouts.admin')
@section('title', 'Brend' . (isset($brand) ? 'Güncəllə' : 'Yarat'))

@push('css')
@endpush

@section('content')
    <div class="card">
        <div class="card-body">

            <h6 class="card-title">BREND {{ isset($brand) ? 'Güncəllə' : 'Yarat' }}</h6>

            @php
                $current_route = !isset($brand) ? route('admin.brand.store') : route('admin.brand.update', ['brand' => $brand->id])
            @endphp
            <form class="forms-sample" action="{{ $current_route }}" method="POST" id="formBrand" enctype="multipart/form-data">
                @csrf
                @isset($brand)
                    @method('PUT')
                @endisset

                <div class="mb-3">
                    <label for="name" class="form-label">Brend Adı</label>
                    <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="Brend Adı" value="{{ isset($brand) ? $brand->name : old('name')}}">
                    @error('name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" autocomplete="off" placeholder="Slug" value="{{ isset($brand) ? $brand->slug : old('slug')}}">
                    @error('slug')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="status" name="status" {{ isset($brand) ? ($brand->status ? 'checked' : '') : (old('status') ? 'checked' : '')  }}>
                    <label class="form-check-label" for="status">
                        Aktiv olsun?
                    </label>
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" {{ isset($brand) ? ($brand->is_featured ? 'checked' : '') : (old('is_featured') ? 'checked' : '')  }}>
                    <label class="form-check-label" for="is_featured">
                        Brend önə çıxarılsın?
                    </label>
                </div>

                <div class="mb-3">
                    <label for="order" class="form-label">Sıra №</label>
                    <input type="text" class="form-control" id="order" name="order" autocomplete="off" placeholder="Sıra Nömrəsi" value="{{ isset($brand) ? $brand->order : old('order')}}">
                    @error('order')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                @php
                    $logoStatus = isset($brand) && file_exists($brand->logo);
                @endphp
                <div class="mb-3">
                    <div class="row">
                        <div @class([
                                'col-md-6' => isset($brand),
                                'col-md-12' => !isset($brand)
                            ])>
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo" value="{{ isset($brand) ? $brand->logo : old('logo')}}">
                            @error('logo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        @isset($brand)
                            <div class="col-md-6">
                                @if($logoStatus)
                                    <img class="image-fluid" style="max-width: 100px" src="{{ asset($brand->logo) }}" alt="{{ $brand->name }}">
                                @else
                                    <img class="image-fluid" style="max-width: 100px" src="{{ asset('assets/images/default/logo-no_image_avaible.png') }}" alt="no image avaible">
                                @endif
                            </div>
                        @endisset
                    </div>
                </div>

                <button type="button" class="btn btn-primary me-2" id="btn-submit">Brend Yarat</button>
            </form>

        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let btnSubmit = document.querySelector('#btn-submit');
            let name = document.querySelector('#name');
            let formCategory = document.querySelector('#formBrand');

            btnSubmit.addEventListener('click', function () {
                if (name.value.trim().length < 1 )
                {
                    Swal.fire({
                        title: "Diqqət!",
                        text: "Kateqoriya Adı boş buraxıla bilməz və ya ən az 2 simvoldan ibarət olmalıdır.",
                        icon: "warning"
                    });
                }
                else
                {
                    formCategory.submit();
                }
            })
        });
    </script>
@endpush
