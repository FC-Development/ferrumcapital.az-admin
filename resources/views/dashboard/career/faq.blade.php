@extends('layouts.default')
@section('content')
    <div class="row justify-content-between ml-0 mr-0">
        <div class="header-title">
            <h4 class="card-title">FAQ</h4>
        </div>
        <button class="btn btn-primary addNewCFaqBTN" type="button">
            <i class="mr-1" style="position: relative; top: -1px;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" height="20" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </i>
            Əlavə et
        </button>
    </div>
    <div id="gridCfaq"></div>
    <div class="modal fade hide pr-0" id="NewCFaqModal" tabindex="-1" aria-modal="false" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Əlavə et</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="modal-body" id="CFaqForm" enctype=multipart/form-data>
                    @csrf
                    <div class="row" id="blog">
                        <div class="col-md-12 mb-3">
                            <label for="career_question_az"
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Sual Az</label>
                            <textarea type="text" class="form-control border border-light" id="career_question_az" name="question_az" minlength="2"
                                required></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="career_question_en"
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Sual Eng</label>
                            <textarea type="text" class="form-control border border-light" id="career_question_en" name="question_en" minlength="2"
                                required></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="answer" class="f-sm form-label font-weight-bold text-muted text-uppercase">Cavab
                                Aze</label>
                            <textarea type="text" class="form-control border border-light" id="career_answer_az" name="answer_az" minlength="2"
                                required></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="answer" class="f-sm form-label font-weight-bold text-muted text-uppercase">Cavab
                                Eng</label>
                            <textarea type="text" class="form-control border border-light" id="career_answer_en" name="answer_en" minlength="2"
                                required></textarea>
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
    <div class="modal fade hide pr-0" id="UpdateCFaqModal" tabindex="-1" aria-modal="false" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Əlavə et</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="modal-body" id="UpdateCFaq" enctype=multipart/form-data>
                    @csrf
                    <input type="hidden" name="uniq_id" value="">
                    <div class="col-md-12 mb-3">
                        <label for="career_question_az"
                            class="f-sm form-label font-weight-bold text-muted text-uppercase">Sual Az</label>
                        <textarea type="text" class="form-control border border-light" id="career_question_az" name="question_az" minlength="2"
                            required></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="career_question_en"
                            class="f-sm form-label font-weight-bold text-muted text-uppercase">Sual Eng</label>
                        <textarea type="text" class="form-control border border-light" id="career_question_en" name="question_en" minlength="2"
                            required></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="answer" class="f-sm form-label font-weight-bold text-muted text-uppercase">Cavab
                            Aze</label>
                        <textarea type="text" class="form-control border border-light" id="career_answer" name="answer_az" minlength="2"
                            required></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="answer" class="f-sm form-label font-weight-bold text-muted text-uppercase">Cavab
                            Eng</label>
                        <textarea type="text" class="form-control border border-light" id="career_answer" name="answer_en" minlength="2"
                            required></textarea>
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
@endsection
