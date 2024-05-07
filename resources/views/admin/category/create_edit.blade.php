@extends('layouts.admin')
@section('title', 'Yeni Kateqoriya Yarat')

@push('css')
@endpush

@section('content')
    <div class="card">
        <div class="card-body">

            <h6 class="card-title">KATEQORIYA YARAT</h6>

            <form class="forms-sample" action="{{ route('admin.category.store') }}" method="POST" id="formCategory">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Kateqoriya Adı</label>
                    <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="Kateqoriya Adı">
                    @error('name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" autocomplete="off" placeholder="Slug">
                    @error('slug')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="status" name="status">
                    <label class="form-check-label" for="status">
                        Aktiv olsun?
                    </label>
                </div>
                <div class="mb-3">
                    <label for="short_description" class="form-label">Qısa Açığlama</label>
                    <textarea class="form-control" id="short_description" name="short_description" rows="4" placeholder="Qısa Açığlama"> </textarea>
                    @error('short_description')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Açığlama</label>
                    <textarea class="form-control" id="description" name="description" rows="5" placeholder="Açığlama"> </textarea>
                    @error('description')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="parent_id" class="form-label">Üst Kateqoriya</label>
                    <select class="form-select mb-3" name="parent_id" id="parent_id">
                        <option selected="selected" value="-1">Üst Kateqoriya Seçin</option>
                        @foreach($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="button" class="btn btn-primary me-2" id="btn-submit">Kateqoriya Yarat</button>
            </form>

        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let btnSubmit = document.querySelector('#btn-submit');
            let name = document.querySelector('#name');
            let formCategory = document.querySelector('#formCategory');

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
