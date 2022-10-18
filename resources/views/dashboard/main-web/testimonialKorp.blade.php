@extends('layouts.default')
@section('content')
    <div class="row justify-content-between ml-0 mr-0">
        <div class="header-title">
            <h4 class="card-title">Testimonial</h4>
        </div>
        <button class="btn btn-primary addNewTestimnlBTN" type="button">
            <i class="mr-1" style="position: relative; top: -1px;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" height="20" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </i>
            Əlavə et
        </button>
    </div>
    <div id="gridtestmnl"></div>
    <div class="modal fade hide pr-0" id="NewTestimnlModal" tabindex="-1" aria-modal="false" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Əlavə et</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="modal-body" id="TestimnlForm" enctype=multipart/form-data>
                    @csrf
                    <input type="hidden" value="require" name="condition" />
                    <div class="row" id="testimnl">
                        <div class="col-md-4 mb-3">
                            <label for="title"
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Fullname
                                Az</label>
                            <input type="text" class="form-control border border-light" id="fullname_az"
                                name="fullname_az" minlength="2" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="title"
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Fullname
                                Eng</label>
                            <input type="text" class="form-control border border-light" id="fullname_en"
                                name="fullname_en" minlength="2" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="title" class="f-sm form-label font-weight-bold text-muted text-uppercase">Job
                                title
                                Aze</label>
                            <input type="text" class="form-control border border-light" id="title_az" name="title_az"
                                minlength="2" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="title" class="f-sm form-label font-weight-bold text-muted text-uppercase">Job
                                title
                                Eng</label>
                            <input type="text" class="form-control border border-light" id="title_en" name="title_en"
                                minlength="2" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="title" class="f-sm form-label font-weight-bold text-muted text-uppercase">Youtube
                                URL</label>
                            <input type="url" class="form-control border border-light" id="youtube_url"
                                name="youtube_url" minlength="2" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <span class="f-sm form-label font-weight-bold text-muted text-uppercase">Image</span>
                            <div class="custom-file mt-8">
                                <input type="file" class="custom-file-input" id="image" name="image" required>
                                <label for="image" class="custom-file-label">Seçim edin</label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <span class="f-sm form-label font-weight-bold text-muted text-uppercase">Company logo</span>
                            <div class="custom-file mt-8">
                                <input type="file" class="custom-file-input" id="company_logo" name="company_logo"
                                    required>
                                <label for="image" class="custom-file-label">Seçim edin</label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">Quote
                                Azerbaijan</label>
                            <textarea type="text" class="form-control border border-light" id="quote_az" name="quote_az" minlength="2"
                                required></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">Quote
                                English</label>
                            <textarea type="text" class="form-control border border-light" id="quote_en" name="quote_en" minlength="2"
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
    <div class="modal fade hide pr-0" id="TestimnlModal" tabindex="-1" aria-modal="false" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Dəyişiklik et</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="modal-body" id="UpdateTestimnl" enctype=multipart/form-data>
                    @csrf
                    <input type="hidden" name="uniq_id" value="">
                    <div class="row" id="testimnl">
                        <div class="col-md-4 mb-3">
                            <label for="title"
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Fullname
                                Az</label>
                            <input type="text" class="form-control border border-light" id="fullname_az"
                                name="fullname_az" minlength="2" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="title"
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Fullname
                                Eng</label>
                            <input type="text" class="form-control border border-light" id="fullname_en"
                                name="fullname_en" minlength="2" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <span class="f-sm form-label font-weight-bold text-muted text-uppercase">Image</span>
                            <div class="custom-file mt-8">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label for="image" class="custom-file-label">Seçim edin</label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="title" class="f-sm form-label font-weight-bold text-muted text-uppercase">Job
                                title
                                Aze</label>
                            <input type="text" class="form-control border border-light" id="title_az"
                                name="title_az" minlength="2" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="title" class="f-sm form-label font-weight-bold text-muted text-uppercase">Job
                                title
                                Eng</label>
                            <input type="text" class="form-control border border-light" id="title_en"
                                name="title_en" minlength="2" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <span class="f-sm form-label font-weight-bold text-muted text-uppercase">Company logo</span>
                            <div class="custom-file mt-8">
                                <input type="file" class="custom-file-input" id="company_logo" name="company_logo">
                                <label for="image" class="custom-file-label">Seçim edin</label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">Quote
                                Azerbaijan</label>
                            <textarea type="text" class="form-control border border-light" id="quote_az" name="quote_az" minlength="2"
                                required></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">Quote
                                English</label>
                            <textarea type="text" class="form-control border border-light" id="quote_en" name="quote_en" minlength="2"
                                required></textarea>
                        </div>
                    </div>
                    <div class="row mt-4" style="float: right;">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary" id="add-cat">
                                Saxla
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade hide" id="testimnlStatusModal" tabindex="-1" aria-modal="false" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Status yenilənməsi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="updateTestimnlStatusForm">
                    <input type="hidden" name="uniq_id">
                    <div class="modal-body">
                        <div class="boxel">
                            <div class="form-group">
                                <label for="inputState"
                                    class="f-sm form-label font-weight-bold text-muted text-uppercase">Status</label>
                                <select id="inputState" class="form-select form-control">
                                    <option value="active">Aktiv</option>
                                    <option value="deactive">Deaktiv</option>
                                    <option value="none">Seçim edilməyib</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
