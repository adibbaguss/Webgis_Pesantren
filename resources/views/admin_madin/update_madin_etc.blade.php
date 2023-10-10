@extends('layouts.app')
@section('css')
    <style>
        .img-overflow {
            background: rgb(241, 241, 241);
            width: 100%;
            height: 100px;
            overflow: hidden;

        }

        .img-overflow img {
            width: 100%;
            height: 110px;
        }

        .img-overflow img:hover {
            transform: scale(1.5);
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid mt-5 pt-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row d-flex justify-content-center">
            <div class="col-md-7 d-flex justify-content-between mb-4">

                <div class="d-flex">
                    @if (!$madin->photo_profil)
                        <img class="opacity-50" src="{{ asset('/images/madin/profile/logo_madin_default.jpg') }}"
                            alt="profil Default" style="width: 40px" class="my-auto">
                    @else
                        <img src="{{ asset('/images/ponpes/profile/' . $madin->photo_profil) }}" alt="Profil Pesatren"
                            style="width: 40px" class="my-auto">
                    @endif
                    <h2 class="text-secondary fw-bold my-auto ms-1">{{ $madin->name }}</h2>
                </div>


            </div>


            <div class="col-md-7 bg-white py-5 rounded ">

                <div class="row mb-4">

                    @include('admin_madin.update_etc_madin.tables.images')
                    @include('admin_madin.update_etc_madin.tables.instructors')
                    @include('admin_madin.update_etc_madin.tables.facility')
                    @include('admin_madin.update_etc_madin.tables.activities')
                    @include('admin_madin.update_etc_madin.tables.learning')
                    @include('admin_madin.update_etc_madin.tables.student_count')
                 
                </div>


                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin_madin.madin_view', ['id' => $madin->user_id]) }}"
                        class="btn btn-success">Selesai</a>
                </div>


            </div>

        </div>




        {{-- nenanggil di folder admin_madin/update_etc_madin/modal/ --}}
        @include('admin_madin.update_etc_madin.modal.images')
        @include('admin_madin.update_etc_madin.modal.instructors')
        @include('admin_madin.update_etc_madin.modal.activities')
        @include('admin_madin.update_etc_madin.modal.learning')
        @include('admin_madin.update_etc_madin.modal.facility')
        @include('admin_madin.update_etc_madin.modal.student_count')

        {{-- end nenanggil di folder admin_madin/update_etc_madin/modal/ --}}
    @endsection


    @push('javascript')
        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

        <!-- Script DataTables -->
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>




        {{-- create form activity --}}
        <script>
            function updateCharacterCount(textarea) {
                const maxLength = parseInt(textarea.getAttribute('maxlength'));
                const currentLength = textarea.value.length;
                const remaining = maxLength - currentLength;

                const characterCountElement = document.getElementById('characterCount');
                characterCountElement.textContent = remaining;
            }
        </script>

        {{-- create form learning --}}
        <script>
            function updateCharacterCount_2(textarea) {
                const maxLength = parseInt(textarea.getAttribute('maxlength'));
                const currentLength = textarea.value.length;
                const remaining = maxLength - currentLength;

                const characterCountElement = document.getElementById('characterCount_2');
                characterCountElement.textContent = remaining;
            }
        </script>




        {{-- updaate form --}}
        <script>
            function updateCharacterCountUpdate(textarea, id) {
                const maxLength = 254;
                const currentLength = textarea.value.length;
                const remainingLength = maxLength - currentLength;
                const characterCountElement = document.getElementById('characterCountUpdate_' + id);
                characterCountElement.innerText = remainingLength;
            }

            // Trigger the function on input event for each textarea with name "description"
            const textareas = document.querySelectorAll('textarea[name="description"]');
            textareas.forEach(textarea => {
                const id = textarea.dataset.id; // Add the data-id attribute to each textarea in the HTML
                updateCharacterCountUpdate(textarea, id);
                textarea.addEventListener('input', function() {
                    updateCharacterCountUpdate(this, id);
                });
            });
        </script>
    @endpush
