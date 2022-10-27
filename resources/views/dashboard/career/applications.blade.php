@extends('layouts.default')
@section('content')
    <div id="applications"></div>
    <div class="modal fade hide" id="ApplyStatusModal" tabindex="-1" aria-modal="false" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Status yenilənməsi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="updateApplyStatusForm">
                    @csrf
                    <input type="hidden" name="uniq_id">
                    <div class="modal-body">
                        <div class="boxel">
                            <div class="form-group">
                                <label for="inputStateApply"
                                       class="f-sm form-label font-weight-bold text-muted text-uppercase">Status</label>
                                <select id="inputStateApply" class="form-select form-control">
                                    <option value="Gözləmədə">Gözləmədə</option>
                                    <option value="Yönləndirildi">Yönləndirildi</option>
                                    <option value="Ləğv edildi">Ləğv edildi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{--  Apply View  /--}}
    <div class="modal fade pr-0" id="applicationUniq" role="dialog">
        <div class="modal-dialog modal-xl vertical-align-center">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title">Müraciət formu</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-block">
                                    <div class="profile-card mb-0 rounded">
                                        <img src="https://www.blexar.com/avatar.png" alt="profile-bg"
                                             class="avatar-100 rounded d-block mx-auto img-fluid mb-3">
                                        <h3 class="font-600 text-white text-center mt-5 mb-1 scholarModal" id="scholarName">
                                        </h3>
                                        <p class="text-white text-center" >
                                            <span id="name"></span>
                                        </p>

                                    </div>
                                </div>
                                <div class="p-card rounded">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="p-icon mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="20"
                                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76">
                                                </path>
                                            </svg>
                                        </div>
                                        <p class="mb-0 eml scholarModal" id="email"></p>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="p-icon mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="20"
                                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                            </svg>
                                        </div>
                                        <p class="mb-0 scholarModal" id="phone"></p>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="p-icon mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="20"
                                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <p class="mb-0 scholarModal" id="adress"></p>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="p-icon mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="20"
                                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <p class="mb-0 scholarModal" id="birthdate"></p>
                                    </div>
                                    <div class="d-flex align-items-center mb-3" id="linkedinDiv">
                                        <div class="p-icon mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="20"
                                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                            </svg>
                                        </div>
                                        <p class="mb-0 scholarModal" id="linkedin"></p>
                                    </div>
                                    <div class="d-flex align-items-center mb-3" id="portfolioDiv">
                                        <div class="p-icon mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="20"
                                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                            </svg>
                                        </div>
                                        <p class="mb-0 scholarModal" id="portfolio"></p>
                                    </div>
                                    <div class="d-flex align-items-center mb-3" id="telegramDiv">
                                        <div class="p-icon mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="20"
                                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                            </svg>
                                        </div>
                                        <p class="mb-0 scholarModal" id="telegram"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="card mb-0">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item p-3" >
                                        <h5 class="font-weight-bold pb-2">CV</h5>
                                        <div class="row fieldList" id="cv">

                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="card mb-0">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item p-3" >
                                        <h5 class="font-weight-bold pb-2">Vakansiya İstiqaməti</h5>
                                        <div class="row fieldList" id="vacancy_source">
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="card mb-0">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item p-3" >
                                        <h5 class="font-weight-bold pb-2">Təhsil</h5>
                                        <div class="row fieldList"  id="educationField">

                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="card mb-0" id="workDiv">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item p-3" >
                                        <h5 class="font-weight-bold pb-2">İş</h5>
                                        <div class="row fieldList" id="workField">

                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="card mb-0" id="languageDiv">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item p-3" >
                                        <h5 class="font-weight-bold pb-2">Dil</h5>
                                        <div class="row fieldList" id="languageField">

                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="card mb-0" id="sertificateDiv">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item p-3" >
                                        <h5 class="font-weight-bold pb-2">Sertifikatlar</h5>
                                        <div class="row fieldList" id="sertificateField">

                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
