@extends('layouts.default')
@section('content')
    <div class="row justify-content-between ml-0 mr-0">
        <div class="header-title">
            <h4 class="card-title">Testimonial Career</h4>
        </div>
        <button class="btn btn-primary addTestimnlCarerBTN" type="button">
            <i class="mr-1" style="position: relative; top: -1px;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" height="20" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </i>
            Əlavə et
        </button>
    </div>
    <div id="gridtestimnlCarer"></div>
    <div class="modal fade hide pr-0" id="NewTestimnlCarerModal" tabindex="-1" aria-modal="false" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Əlavə et</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="modal-body" id="TestimnlCarerForm" enctype=multipart/form-data>
                    @csrf
                    <input type="hidden" value="require" name="condition" />
                    <div class="row" id="testimnl">
                        <div class="col-md-4 mb-3">
                            <label for="title" class="f-sm form-label font-weight-bold text-muted text-uppercase">Fullname
                                Aze</label>
                            <input type="text" class="form-control border border-light" id="fullname_az" name="fullname_az"
                                minlength="2" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="title" class="f-sm form-label font-weight-bold text-muted text-uppercase">Fullname
                                Eng</label>
                            <input type="text" class="form-control border border-light" id="fullname_en" name="fullname_en"
                                minlength="2" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">Text
                                Aze</label>
                            <textarea type="text" class="form-control border border-light" id="text_az" name="text_az" minlength="2" required></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">Text
                                Eng</label>
                            <textarea type="text" class="form-control border border-light" id="text_en" name="text_en" minlength="2" required></textarea>
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
    <div class="modal fade hide pr-0" id="TestimnlCarerModal" tabindex="-1" aria-modal="false" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Dəyişiklik et</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="modal-body" id="UpdateTestimnlCarer" enctype=multipart/form-data>
                    @csrf
                    <input type="hidden" name="uniq_id" value="">
                    <div class="row" id="testimnl">
                        <div class="col-md-4 mb-3">
                            <label for="title" class="f-sm form-label font-weight-bold text-muted text-uppercase">Fullname
                                Aze</label>
                            <input type="text" class="form-control border border-light" id="fullname_az" name="fullname_az"
                                minlength="2" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="title" class="f-sm form-label font-weight-bold text-muted text-uppercase">Fullname
                                Eng</label>
                            <input type="text" class="form-control border border-light" id="fullname_en" name="fullname_en"
                                minlength="2" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">Text
                                Aze</label>
                            <textarea type="text" class="form-control border border-light" id="text_az" name="text_az" minlength="2" required></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">Text
                                Eng</label>
                            <textarea type="text" class="form-control border border-light" id="text_en" name="text_en" minlength="2" required></textarea>
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
@endsection
