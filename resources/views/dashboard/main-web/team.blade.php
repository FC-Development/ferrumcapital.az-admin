@extends('layouts.default')
@section('content')
    <div class="row justify-content-between ml-0 mr-0">
        <div class="header-title">
            <h4 class="card-title">Team</h4>
        </div>
        <button class="btn btn-primary addNewTeamBTN" type="button">
            <i class="mr-1" style="position: relative; top: -1px;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" height="20" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </i>
            Əlavə et
        </button>
    </div>
    <div id="gridteam"></div>
    <div class="modal fade hide pr-0" id="NewTeamModal" tabindex="-1" aria-modal="false" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Əlavə et</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="modal-body" id="TeamForm" enctype=multipart/form-data>
                    @csrf
                    <input type="hidden" value="require" name="condition" />
                    <div class="row" id="testimnl">
                        <div class="col-md-3 mb-3">
                            <label for="fullname_az"
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Fullname AZE</label>
                            <input type="text" class="form-control border border-light" id="fullname_az" name="fullname_az"
                                minlength="2" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="fullname_en"
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Fullname ENG</label>
                            <input type="text" class="form-control border border-light" id="fullname_en" name="fullname_en"
                                minlength="2" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="title"
                                   class="f-sm form-label font-weight-bold text-muted text-uppercase">Vəzifə Az</label>
                            <input type="text" class="form-control border border-light" id="title_az" name="title_az"
                                   minlength="2" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="title"
                                   class="f-sm form-label font-weight-bold text-muted text-uppercase">Vəzifə En</label>
                            <input type="text" class="form-control border border-light" id="title_en" name="title_en"
                                   minlength="2" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="linkedin"
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Linkedin</label>
                            <input type="url" class="form-control border border-light" id="linkedin" name="linkedin"
                                minlength="2" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="activity"
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Fəaliyyət Az</label>
                            <textarea  class="form-control border border-light" id="activity_az" name="activity_az"
                                      minlength="2" required></textarea>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="activity"
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Fəaliyyət En</label>
                            <textarea  class="form-control border border-light" id="activity_en" name="activity_en"
                                      minlength="2" required></textarea>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="another_link"
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Another
                                link</label>
                            <input type="url" class="form-control border border-light" id="another_link" name="another_link"
                                minlength="2">
                        </div>
                        <div class="col-md-4 mb-3">
                            <span class="f-sm form-label font-weight-bold text-muted text-uppercase">Cover şəkli</span>
                            <div class="custom-file mt-8">
                                <input type="file" class="custom-file-input" id="cover_photo" name="cover_photo">
                                <label for="image" class="custom-file-label  file_upl">Seçim edin</label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 last_another_img">
                            <span class="f-sm form-label font-weight-bold text-muted text-uppercase">Digər
                                şəkil</span>
                            <div class="custom-file mt-8">
                                <input type="file" class="custom-file-input image_field" id="another_image"
                                    name="another_image">
                                <label for="another_image" class="custom-file-label  file_upl">Seçim edin</label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 last_another_img_2">
                            <span class="f-sm form-label font-weight-bold text-muted text-uppercase">Digər
                                şəkil 2</span>
                            <div class="custom-file mt-8">
                                <input type="file" class="custom-file-input image_field" id="another_image_2"
                                    name="another_image_2">
                                <label for="another_image_2" class="custom-file-label  file_upl">Seçim edin</label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="value" class="f-sm form-label font-weight-bold text-muted text-uppercase">About
                                text Aze</label>
                            <textarea class="form-control border border-light" id="about_text_az" name="about_text_az" minlength="2" required></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="value" class="f-sm form-label font-weight-bold text-muted text-uppercase">About
                                text Eng</label>
                            <textarea class="form-control border border-light" id="about_text_en" name="about_text_en" minlength="2" required></textarea>
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
    <div class="modal fade hide pr-0" id="UpdateTeamModal" tabindex="-1" aria-modal="false" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Əlavə et</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="modal-body" id="TeamUpdate" enctype=multipart/form-data>
                    @csrf
                    <input type="hidden" value="" name="uniq_id" />
                    <div class="row" id="testimnl">
                        <div class="col-md-3 mb-3">
                            <label for="fullname_az"
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Fullname AZE</label>
                            <input type="text" class="form-control border border-light" id="fullname_az" name="fullname_az"
                                minlength="2" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="fullname_en"
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Fullname ENG</label>
                            <input type="text" class="form-control border border-light" id="fullname_en" name="fullname_en"
                                minlength="2" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="title"
                                   class="f-sm form-label font-weight-bold text-muted text-uppercase">Vəzifə Az</label>
                            <input type="text" class="form-control border border-light" id="title_az" name="title_az"
                                   minlength="2" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="title"
                                   class="f-sm form-label font-weight-bold text-muted text-uppercase">Vəzifə En</label>
                            <input type="text" class="form-control border border-light" id="title_en" name="title_en"
                                   minlength="2" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="linkedin"
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Linkedin</label>
                            <input type="url" class="form-control border border-light" id="linkedin" name="linkedin"
                                minlength="2" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="activity"
                                   class="f-sm form-label font-weight-bold text-muted text-uppercase">Fəaliyyət Az</label>
                            <textarea  class="form-control border border-light" id="activity_az" name="activity_az"
                                       minlength="2" required></textarea>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="activity"
                                   class="f-sm form-label font-weight-bold text-muted text-uppercase">Fəaliyyət En</label>
                            <textarea  class="form-control border border-light" id="activity_en" name="activity_en"
                                       minlength="2" required></textarea>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="another_link"
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Another
                                link</label>
                            <input type="url" class="form-control border border-light" id="another_link" name="another_link"
                                minlength="2">
                        </div>
                        <div class="col-md-4 mb-3">
                            <span class="f-sm form-label font-weight-bold text-muted text-uppercase">Cover şəkli</span>
                            <div class="custom-file mt-8">
                                <input type="file" class="custom-file-input" id="cover_photo" name="cover_photo">
                                <label for="image" class="custom-file-label  file_upl">Seçim edin</label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 last_another_img">
                            <span class="f-sm form-label font-weight-bold text-muted text-uppercase">Digər
                                şəkil</span>
                            <div class="custom-file mt-8">
                                <input type="file" class="custom-file-input image_field" id="another_image"
                                    name="another_image">
                                <label for="another_image" class="custom-file-label  file_upl">Seçim edin</label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 last_another_img_2">
                            <span class="f-sm form-label font-weight-bold text-muted text-uppercase">Digər
                                şəkil 2</span>
                            <div class="custom-file mt-8">
                                <input type="file" class="custom-file-input image_field" id="another_image_2"
                                       name="another_image_2">
                                <label for="another_image_2" class="custom-file-label  file_upl">Seçim edin</label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="value" class="f-sm form-label font-weight-bold text-muted text-uppercase">About
                                text Aze</label>
                            <textarea class="form-control border border-light" id="about_text_az" name="about_text_az" minlength="2" required></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="value" class="f-sm form-label font-weight-bold text-muted text-uppercase">About
                                text Eng</label>
                            <textarea class="form-control border border-light" id="about_text_en" name="about_text_en" minlength="2" required></textarea>
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
