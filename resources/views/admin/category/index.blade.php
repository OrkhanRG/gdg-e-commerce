@extends('layouts.admin')
@section('title', 'Kateqoriyalar')

@push('css')
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Kateqoriyalar</h6>
            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Kateqoriya Adı</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                @if($category->status)
                                    <a href="javascript:void(0)" class="btn btn-inverse-success btn-change-status" data-id="{{ $category->id }}">Aktiv</a>
                                @else
                                    <a href="javascript:void(0)" class="btn btn-inverse-danger btn-change-status" data-id="{{ $category->id }}">Passiv</a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.category.edit', ['category' => $category->id]) }}" class="text-warning">
                                    <i data-feather="edit"></i>
                                </a>
                                <a href="{{ route('admin.category.destroy', ['category' => $category->id]) }}" class="text-danger">
                                    <i data-feather="trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="col-6 mx-auto mt-3">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
