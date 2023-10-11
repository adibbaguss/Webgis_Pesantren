<div class="container-fluid mt-5 pt-5 h-100">
    <div class="mb-3">
        <h2 class="mb-3 text-secondary ">{{ 'Panduan Penggunaan' }}</h2>
        <small class="text-justify">Gambar dan informasi yang terdapat dalam aset panduan bukanlah representasi yang
            akurat dari informasi yang sebenarnya dari pondok pesantren. Gambar dan informasi yang digunakan dimaksudkan
            untuk keperluan pengujian sistem.</small>
    </div>

    <div class="row">
        {{-- panduan One --}}
        @if (!Auth::User())
        @elseif (Auth::User()->user_role == 'admin kemenag')
            <div class="col-12 mb-3">
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header " id="panelsStayOpen-headingOne">
                            <button class="accordion-button fw-bold bg-light" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseOne">
                                {{ 'Panduan Admin Kemenag' }}
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse  "
                            aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body pt-3 px-1 pb-1">
                                <div id="pdf-container">
                                    <iframe id="pdf-iframe" src="{{ asset('pdf/panduan/panduan akun admin kemenag.pdf') }}"
                                        frameborder="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif



        @if (!Auth::User())
        @elseif (Auth::User()->user_role == 'admin kemenag' ||
                Auth::User()->user_role == 'admin pesantren' ||
                Auth::User()->user_role == 'admin madin')
            {{-- panduan Two --}}
            <div class="col-12 mb-3">
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header " id="panelsStayOpen-headingTwo">
                            <button class="accordion-button fw-bold bg-light" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseTwo">
                                {{ 'Panduan Admin Ponpes, Madin & TPQ' }}
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse  "
                            aria-labelledby="panelsStayOpen-headingTwo">
                            <div class="accordion-body pt-3 px-1 pb-1">
                                <div id="pdf-container">
                                    <iframe id="pdf-iframe" src="{{ asset('pdf/panduan/panduan akun admin pesantren, madin dan TPQ.pdf') }}"
                                        frameborder="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif


        {{-- panduan Three --}}
        <div class="col-12 mb-3">
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header " id="panelsStayOpen-headingThree">
                        <button class="accordion-button fw-bold bg-light" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="true"
                            aria-controls="panelsStayOpen-collapseThree">
                            {{ 'Panduan Pengguna & Pelapor' }}
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse  "
                        aria-labelledby="panelsStayOpen-headingThree">
                        <div class="accordion-body pt-3 px-1 pb-1">
                            <div id="pdf-container">
                                <iframe id="pdf-iframe" src="{{ asset('pdf/panduan/panduan akun pelapor.pdf') }}"
                                    frameborder="0"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>
