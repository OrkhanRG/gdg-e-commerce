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
                                <a href="javascript:void(0)" class="text-danger">
                                    <i data-id="{{ $category->id }}" data-name="{{ $category->name }}" class="btn-delete-category" data-feather="trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <form action="" method="POST" id="formDelete">
                    @csrf
                    @method('DELETE')
                </form>

                <div class="col-6 mx-auto mt-3">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let formDelete = document.querySelector('#formDelete');
            let table = document.querySelector('.table')

            table.addEventListener('click', function (event) {
                let element = event.target;

                if (element.classList.contains('btn-delete-category'))
                {
                    let name = element.getAttribute('data-name');
                    let categoryID = element.getAttribute('data-id');
                    let action = "{{ route('admin.category.destroy', ['category' => 'categoryID']) }}";
                    action = action.replace('categoryID', categoryID);
                    formDelete.action = action;

                    Swal.fire({
                        title: name + " kateqoriyasını silmək istədiyinizə əminsiniz?",
                        showCancelButton: true,
                        cancelButtonText: "Ləğv Et",
                        confirmButtonText: "Sil",
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            formDelete.submit();
                        } else if (result.isDenied) {
                            Swal.fire("Kateqoriya Silinmədi!", "", "info");
                        }
                    });
                }

                if (element.classList.contains('btn-change-status'))
                {
                    let id = element.getAttribute('data-id');

                    fetch("{{ route('admin.category.change-status') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id: id
                        })
                    }).then(response => {
                        if (!response.ok)
                        {
                            Swal.fire("Kateqoriya silinmədi.", "Diqqət.", "info");
                            console.log(response.json());
                        }

                        return response.json();
                    }).then(data => {
                        element.textContent = data.status ? 'Aktiv' : 'Passiv';

                        if (data.status)
                        {
                            element.classList.remove('btn-inverse-danger');
                            element.classList.add('btn-inverse-success');
                        }
                        else
                        {
                            element.classList.remove('btn-inverse-success');
                            element.classList.add('btn-inverse-danger');
                        }
                        Swal.fire("Status " + element.textContent + " olara güncəlləndi", "Uğurlu!", "success")
                    });
                }
            })
        })
    </script>
@endpush
