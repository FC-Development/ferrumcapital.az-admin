@extends('layouts.default')
@section('content')
    <div class="row justify-content-between ml-0 mr-0">
        <div class="header-title">
            <h4 class="card-title">Brand Sector</h4>
        </div>
        <button class="btn btn-primary addNewBrandSecBTN" type="button">
            <i class="mr-1" style="position: relative; top: -1px;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" height="20" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </i>
            Əlavə et
        </button>
    </div>
    <div id="gridBrandSec"></div>
    <div class="modal fade hide pr-0" id="NewBrandSecModal" tabindex="-1" aria-modal="false" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Əlavə et</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="modal-body" id="BrandSecForm" enctype=multipart/form-data>
                    @csrf
                    <input type="hidden" value="require" name="condition" />
                    <div class="row" id="testimnl">
                        <div class="col-md-4 mb-3">
                            <label for="title" class="f-sm form-label font-weight-bold text-muted text-uppercase">Title
                                Az</label>
                            <input type="text" class="form-control border border-light" id="title_az" name="title_az"
                                minlength="2" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="title" class="f-sm form-label font-weight-bold text-muted text-uppercase">Title
                                Eng</label>
                            <input type="text" class="form-control border border-light" id="title_en" name="title_en"
                                minlength="2" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <span class="f-sm form-label font-weight-bold text-muted text-uppercase">Cover</span>
                            <div class="custom-file mt-8">
                                <input type="file" class="custom-file-input" id="cover" name="cover" required>
                                <label for="cover" class="custom-file-label">Seçim edin</label>
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
    <div class="modal fade hide pr-0" id="BrandSecModal" tabindex="-1" aria-modal="false" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Dəyişiklik et</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="modal-body" id="UpdateBrandSec" enctype=multipart/form-data>
                    @csrf
                    <input type="hidden" name="uniq_id" value="">
                    <div class="row" id="brandsec">
                        <div class="col-md-4 mb-3">
                            <label for="title" class="f-sm form-label font-weight-bold text-muted text-uppercase">Title
                                Az</label>
                            <input type="text" class="form-control border border-light" id="title_az" name="title_az"
                                minlength="2" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="title" class="f-sm form-label font-weight-bold text-muted text-uppercase">Title
                                Eng</label>
                            <input type="text" class="form-control border border-light" id="title_en" name="title_en"
                                minlength="2" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <span class="f-sm form-label font-weight-bold text-muted text-uppercase">Cover</span>
                            <div class="custom-file mt-8">
                                <input type="file" class="custom-file-input" id="cover" name="cover">
                                <label for="cover" class="custom-file-label">Seçim edin</label>
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
@endsection
