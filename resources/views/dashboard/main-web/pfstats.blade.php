@extends('layouts.default')
@section('content')
    <div class="row justify-content-between ml-0 mr-0">
        <div class="header-title">
            <h4 class="card-title">Business Factoring</h4>
        </div>
        <button class="btn btn-primary addNewPfStatsBTN" type="button">
            <i class="mr-1" style="position: relative; top: -1px;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" height="20" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </i>
            Əlavə et
        </button>
    </div>
    <div id="gridPfStats"></div>
    <div class="modal fade hide pr-0" id="NewPfStatsModal" tabindex="-1" aria-modal="false" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Əlavə et</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="modal-body" id="PfStatsForm" enctype=multipart/form-data>
                    @csrf
                    <input type="hidden" value="require" name="condition" />
                    <div class="row" id="testimnl">
                        <div class="col-md-4 mb-3">
                            <label for="title" class="f-sm form-label font-weight-bold text-muted text-uppercase">Title
                                Az</label>
                            <input type="text" class="form-control border border-light" id="header_az" name="header_az"
                                minlength="2" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="title" class="f-sm form-label font-weight-bold text-muted text-uppercase">Title
                                Eng</label>
                            <input type="text" class="form-control border border-light" id="header_en" name="header_en"
                                minlength="2" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="value"
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Value</label>
                            <input type="text" class="form-control border border-light" id="value" name="value"
                                minlength="2" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="value" class="f-sm form-label font-weight-bold text-muted text-uppercase">Kateqoriya
                                Aze</label>
                            <input type="text" class="form-control border border-light" id="category_az" name="category_az"
                                minlength="2" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="value" class="f-sm form-label font-weight-bold text-muted text-uppercase">Kateqoriya
                                Eng</label>
                            <input type="text" class="form-control border border-light" id="category_en" name="category_en"
                                minlength="2" required>
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
    <div class="modal fade hide pr-0" id="PfStatsModal" tabindex="-1" aria-modal="false" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Əlavə et</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="modal-body" id="PfStatsUpdate" enctype=multipart/form-data>
                    @csrf
                    <input type="hidden" value="" name="uniq_id" />
                    <div class="row" id="testimnl">
                        <div class="col-md-4 mb-3">
                            <label for="title" class="f-sm form-label font-weight-bold text-muted text-uppercase">Title
                                Az</label>
                            <input type="text" class="form-control border border-light" id="header_az" name="header_az"
                                minlength="2" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="title" class="f-sm form-label font-weight-bold text-muted text-uppercase">Title
                                Eng</label>
                            <input type="text" class="form-control border border-light" id="header_en" name="header_en"
                                minlength="2" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="value"
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Value</label>
                            <input type="text" class="form-control border border-light" id="value" name="value"
                                minlength="2" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="value" class="f-sm form-label font-weight-bold text-muted text-uppercase">Kateqoriya
                                Aze</label>
                            <input type="text" class="form-control border border-light" id="category_az" name="category_az"
                                minlength="2" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="value" class="f-sm form-label font-weight-bold text-muted text-uppercase">Kateqoriya
                                Eng</label>
                            <input type="text" class="form-control border border-light" id="category_en" name="category_en"
                                minlength="2" required>
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
@endsection
