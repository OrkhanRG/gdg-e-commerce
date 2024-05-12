@extends('layouts.admin')
@section('title', 'Brendlər')

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
                        <th>Logo</th>
                        <th>Sıra №</th>
                        <th>Brend Adı</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Önə Çıxarılsın?</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($brands as $brand)
                        <tr>
                            <td>{{ $brand->id }}</td>
                            <td>
                                <img src="{{ asset($brand->logo) }}" width="100" alt="{{ $brand->name }}">
                            </td>
                            <td>{{ $brand->order }}</td>
                            <td>{{ $brand->name }}</td>
                            <td>{{ $brand->slug }}</td>
                            <td>
                                @if($brand->status)
                                    <a href="javascript:void(0)" class="btn btn-inverse-success btn-change-status" data-id="{{ $brand->id }}">Aktiv</a>
                                @else
                                    <a href="javascript:void(0)" class="btn btn-inverse-danger btn-change-status" data-id="{{ $brand->id }}">Passiv</a>
                                @endif
                            </td>
                            <td>
                                @if($brand->is_featured)
                                    <a href="javascript:void(0)" class="btn btn-inverse-success btn-change-is-featured" data-id="{{ $brand->id }}">Hə</a>
                                @else
                                    <a href="javascript:void(0)" class="btn btn-inverse-danger btn-change-is-featured" data-id="{{ $brand->id }}">Yox</a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.brand.edit', ['brand' => $brand->id]) }}" class="text-warning">
                                    <i data-feather="edit"></i>
                                </a>
                                <a href="javascript:void(0)" class="text-danger">
                                    <i data-id="{{ $brand->id }}" data-name="{{ $brand->name }}" class="btn-delete-brand" data-feather="trash"></i>
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
                    {{ $brands->links() }}
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

                if (element.classList.contains('btn-delete-brand'))
                {
                    let name = element.getAttribute('data-name');
                    let brandID = element.getAttribute('data-id');
                    let action = "{{ route('admin.brand.delete', ['brand' => 'brandID']) }}";
                    action = action.replace('brandID', brandID);
                    formDelete.action = action;

                    Swal.fire({
                        title: name + " brendini silmək istədiyinizə əminsiniz?",
                        showCancelButton: true,
                        cancelButtonText: "Ləğv Et",
                        confirmButtonText: "Sil",
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            formDelete.submit();
                        } else if (result.isDenied) {
                            Swal.fire("Brend Silinmədi!", "", "info");
                        }
                    });
                }

                if (element.classList.contains('btn-change-status'))
                {
                    let id = element.getAttribute('data-id');

                    fetch("{{ route('admin.brand.change-status') }}", {
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
                            Swal.fire("Status Dəyişdirilmədi.", "Diqqət.", "info");
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
                        Swal.fire("Status " + element.textContent + " olaraq güncəlləndi", "Uğurlu!", "success")
                    });
                }

                if (element.classList.contains('btn-change-is-featured'))
                {
                    let id = element.getAttribute('data-id');

                    fetch("{{ route('admin.brand.change-is-featured') }}", {
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
                            Swal.fire("Önə çıxarılma status dəyişdirilmədi.", "Diqqət.", "info");
                            console.log(response.json());
                        }

                        return response.json();
                    }).then(data => {
                        element.textContent = data.is_featured ? 'Hə' : 'Yox';

                        if (data.is_featured)
                        {
                            element.classList.remove('btn-inverse-danger');
                            element.classList.add('btn-inverse-success');
                        }
                        else
                        {
                            element.classList.remove('btn-inverse-success');
                            element.classList.add('btn-inverse-danger');
                        }
                        Swal.fire("Önə çıxarılma status " + element.textContent + " olaraq güncəlləndi", "Uğurlu!", "success")
                    });
                }
            })
        })
    </script>
@endpush
