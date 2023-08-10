@extends('layouts.app')

@section('css')
    <style>
        #pdf-container {
            width: 100%;
            height: 600px;
            /* Sesuaikan dengan ketinggian yang diinginkan */
            overflow: auto;
        }

        #pdf-iframe {
            width: 100%;
            height: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid mt-5 pt-5 h-100">
        <div class="mb-3">
            <h2 class="mb-3 text-secondary ">{{ 'Panduan Penggunaan' }}</h2>
            <small class="text-justify">Gambar dan informasi yang terdapat dalam aset panduan bukanlah representasi yang
                akurat dari informasi yang sebenarnya dari pondok pesantren. Gambar dan informasi yang digunakan dimaksudkan
                untuk keperluan pengujian sistem.</small>
        </div>

        <div class="row">
            {{-- panduan admin --}}
            <div class="col-12 mb-3">
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header " id="panelsStayOpen-headingAdmin">
                            <button class="accordion-button fw-bold bg-light" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseAdmin" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseAdmin">
                                {{ 'Panduan Admin' }}
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseAdmin" class="accordion-collapse collapse  "
                            aria-labelledby="panelsStayOpen-headingAdmin">
                            <div class="accordion-body pt-3 px-1 pb-1">
                                <div id="pdf-container">
                                    <iframe id="pdf-iframe" src="{{ asset('pdf/panduan/panduan admin.pdf') }}"
                                        frameborder="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- panduan updater --}}
            <div class="col-12 mb-3">
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header " id="panelsStayOpen-headingUpdater">
                            <button class="accordion-button fw-bold bg-light" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseUpdater" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseUpdater">
                                {{ 'Panduan Updater' }}
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseUpdater" class="accordion-collapse collapse  "
                            aria-labelledby="panelsStayOpen-headingUpdater">
                            <div class="accordion-body pt-3 px-1 pb-1">
                                <div id="pdf-container">
                                    <iframe id="pdf-iframe" src="{{ asset('pdf/panduan/panduan updater.pdf') }}"
                                        frameborder="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- panduan Viewer --}}
            <div class="col-12 mb-3">
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header " id="panelsStayOpen-headingViewer">
                            <button class="accordion-button fw-bold bg-light" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseViewer" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseViewer">
                                {{ 'Panduan Viewer' }}
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseViewer" class="accordion-collapse collapse  "
                            aria-labelledby="panelsStayOpen-headingViewer">
                            <div class="accordion-body pt-3 px-1 pb-1">
                                <div id="pdf-container">
                                    <iframe id="pdf-iframe" src="{{ asset('pdf/panduan/panduan viewer.pdf') }}"
                                        frameborder="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection
