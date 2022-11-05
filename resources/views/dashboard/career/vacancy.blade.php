@extends('layouts.default')
@section('content')
    <div class="row justify-content-between ml-0 mr-0">
        <div class="header-title">
            <h4 class="card-title">Vakansiya Elani</h4>
        </div>
        <button class="btn btn-primary addNewVacancyBTN" type="button">
            <i class="mr-1" style="position: relative; top: -1px;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" height="20" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </i>
            Əlavə et
        </button>
    </div>
    <div id="VacanciesTable"></div>
    <div class="modal fade hide pr-0" id="NewVacancyModal" tabindex="-1" aria-modal="false" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Əlavə et</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="modal-body" id="Vacancy1Form" enctype=multipart/form-data>
                    @csrf
                    <input type="hidden" value="require" name="condition" />
                    <div class="row" id="testimnl">
                        <div class="col-md-4 mb-3">
                            <label for="title"
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Vakansiya başlığı</label>
                            <input type="text" class="form-control border border-light" id="title" name="title"
                                minlength="2" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="value"
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Departament/Şöbə</label>
                            <select type="text" class="form-control border border-light" id="department" name="department_id"
                                    minlength="2" required>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="f-sm form-label font-weight-bold text-muted text-uppercase" for="awards">İş qrafiki</label>
                            <input type="text" class="form-control border border-light mr-1" id="time_duration"
                                name="time_duration" minlength="2" required>
                        </div>
                        <div class="font-weight-bold col-lg-12 mb-2">
                            <label for="hyperlink" class="text-secondary font-weight-bold">Vakansiya haqqında</label>
                            <input type="text" name="description" id="description"
                                class="form-control w-100 border border-light">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="hyperlink" class="text-secondary font-weight-bold">Nə iş görür?</label>
                                    <div class="row">
                                        <input type="text"
                                            class="form-control col-lg-3 ml-2  desc_punkt border border-light"
                                            id="desc_punkt" name="desc_punkt" minlength="2" required>
                                        <button class="btn btn-sm addDescPunkt">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="red"
                                                class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path
                                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="font-weight-bold col-lg-12 mb-2">
                            <label for="hyperlink" class="text-secondary font-weight-bold">Nə iş görür başlıq</label>
                            <input type="text" name="responsibility" id="responsibility"
                                class="form-control w-25 border border-light">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="hyperlink" class="text-secondary font-weight-bold">Tələblər
                                        </label>
                                    <div class="row">
                                        <input type="text"
                                            class="form-control col-lg-3 w-25 respons_punkt border border-light"
                                            id="respons_punkt" name="respons_punkt" minlength="2" required>
                                        <button class="btn btn-sm addResponsPunkt">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="red"
                                                class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path
                                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="font-weight-bold col-lg-12 mb-4">
                            <label for="hyperlink" class="text-secondary font-weight-bold">Extra info</label>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="salary">Əmək haqqı</label>
                                    <input type="text" class="form-control border border-light" id="salary" name="salary"
                                        minlength="2">
                                </div>
                                <div class="col-lg-4">
                                    <label for="special">Son müraciət tarixi</label>
                                    <input type="text" class="form-control border border-light" id="deadline"
                                        name="deadline" minlength="2">
                                </div>
                                <div class="col-lg-8">
                                    <label for="special">Xüsusi tələblər</label>
                                    <textarea type="text" class="form-control border border-light" id="special_req"
                                        name="special_req" minlength="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4" style="float: right;">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary" id="add-cat">
                                Əlavə et
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade hide pr-0" id="EditVacancyModal" tabindex="-1" aria-modal="false" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Əlavə et</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="modal-body" id="VacancyUpdate" enctype=multipart/form-data>
                    @csrf
                    <input type="hidden" name="uniq_id" value="">
                    <div class="row" id="testimnl">
                        <div class="col-md-4 mb-3">
                            <label for="title"
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Vakansiya başlığı</label>
                            <input type="text" class="form-control border border-light" id="title" name="title"
                                minlength="2" >
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="value"
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Departament/Şöbə</label>
                            <select type="text" class="form-control border border-light" id="department_id" name="department_id"
                                minlength="2" ></select>
                        </div>
                        <!--<div class="col-md-4 mb-3">
                            <label for="value" class="f-sm form-label font-weight-bold text-muted text-uppercase">Son müraciət tarixi</label>
                            <input type="text" class="form-control border border-light" id="date_duration"
                                name="date_duration" minlength="2" >
                        </div>-->
                        <div class="col-md-4 mb-3" id="responsibility_div">
                            <label for="value" class="f-sm form-label font-weight-bold text-muted text-uppercase">Responsibility</label>
                            <input type="text" class="form-control border border-light" id="responsibility"
                                name="responsibility" minlength="2" >
                        </div>
                        <div class="col-md-4 mb-3" id="description_div">
                            <label for="value" class="f-sm form-label font-weight-bold text-muted text-uppercase">Vakansiya haqqında</label>
                            <input type="text" class="form-control border border-light" id="description"
                                name="description" minlength="2" >
                        </div>
                        <div class="font-weight-bold col-lg-12 mb-4">
                            <label for="hyperlink" class="text-secondary font-weight-bold">Extra info</label>
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="salary">Əmək haqqı</label>
                                    <input type="text" class="form-control border border-light" id="salary" name="salary"
                                        minlength="2" >
                                </div>
                                <div class="col-lg-2">
                                    <label for="awards">Time duration</label>
                                    <input type="text" class="form-control border border-light mr-1" id="time"
                                        name="time" minlength="2" >
                                </div>
                                <div class="col-lg-3">
                                    <label for="special">Son müraciət tarixi</label>
                                    <input type="text" class="form-control border border-light" id="deadline"
                                        name="deadline" minlength="2" >
                                </div>
                                <div class="col-lg-3">
                                    <label for="special">Xüsusi tələblər</label>
                                    <textarea type="text" class="form-control border border-light" id="requirement"
                                        name="requirement" minlength="2" ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4" style="float: right;">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary" id="add-cat">
                                Əlavə et
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade hide" id="vacancyStatusModal" tabindex="-1" aria-modal="false" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Status yenilənməsi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="updateVacancyStatusForm">
                    <input type="hidden" name="uniq_id">
                    <div class="modal-body">
                        <div class="boxel">
                            <div class="form-group">
                                <label for="inputState"
                                    class="f-sm form-label font-weight-bold text-muted text-uppercase">Status</label>
                                <select id="inputState" class="form-select form-control">
                                    <option value="active">Aktiv</option>
                                    <option value="deactive">Deaktiv</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
