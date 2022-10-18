@extends('layouts.default')
@section('content')

    <div class="row justify-content-between ml-0 mr-0">
        <div class="header-title">
            <h4 class="card-title">Bloq</h4>
        </div>
        <button class="btn btn-primary addNewCareerBlogBTN" type="button">
            <i class="mr-1" style="position: relative; top: -1px;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" height="20" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </i>
            Əlavə et
        </button>
    </div>
    
    
    <div id="gridCareerblog"></div>
    <div class="modal fade hide pr-0" id="NewCareerBlogModal" tabindex="-1" aria-modal="false" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Əlavə et</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="modal-body" id="CareerBlogForm" enctype=multipart/form-data>
                    @csrf
                    <input type="hidden" name="condition" value="require">
                    <div class="row" id="blog">
                        <div class="col-md-3 mb-3">
                            <label for="title"
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Başlıq</label>
                            <input type="text" class="form-control border border-light" id="title" name="title"
                                minlength="2" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <span class="f-sm form-label font-weight-bold text-muted text-uppercase">Cover şəkli</span>
                            <div class="custom-file mt-8">
                                <input type="file" class="custom-file-input" id="cover" name="cover">
                                <label for="image" class="custom-file-label">Seçim edin</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <span class="f-sm form-label font-weight-bold text-muted text-uppercase">Include
                                image</span>
                            <div class="custom-file mt-8">
                                <input type="file" class="custom-file-input" id="cinclude_image" name="include_image">
                                <label for="image" class="custom-file-label">Seçim edin</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">Tips
                                Text</label>
                            <input type="text" class="form-control border border-light" id="tips_text" name="tips_text"
                                minlength="2" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">Blog
                                sektor</label>
                            <input type="text" class="form-control border border-light" id="blog_sector" name="blog_sector"
                                minlength="2" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">Blog
                                Meta description</label>
                            <input type="text" class="form-control border border-light" id="meta_description" name="meta_description"
                                minlength="2" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">Blog
                                body</label>
                            <textarea type="text" class="form-control border border-light" id="blog_body" name="blog_body" minlength="2" required></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">Blog
                                Language</label>
                            <select type="text" class="form-control border border-light" id="blog_lang" name="blog_lang" minlength="2" required>
                                <option value="az">AZ</option>
                                <option value="en">EN</option>
                            </select>
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

    {{-- Grid --}}
    <div class="modal fade" id="CareerModalUpd" role="dialog">
     
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title">Dəyişiklik et</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="UpdateCareerBlog" enctype=multipart/form-data>
                        @csrf
                        <input type="hidden" name="uniq_id" value="">
                        <div class="row" id="blog">
                            <div class="col-md-3 mb-3">
                                <label for="title"
                                    class="f-sm form-label font-weight-bold text-muted text-uppercase">Başlıq</label>
                                <input type="text" class="form-control border border-light" id="title_edit" name="title"
                                    minlength="2" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <span class="f-sm form-label font-weight-bold text-muted text-uppercase">Cover şəkli</span>
                                <div class="custom-file mt-8">
                                    <input type="file" class="custom-file-input" id="cover_edit" name="cover">
                                    <label for="image" class="custom-file-label  file_upl">Seçim edin</label>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <span class="f-sm form-label font-weight-bold text-muted text-uppercase">Include
                                    image</span>
                                <div class="custom-file mt-8">
                                    <input type="file" class="custom-file-input" id="include_image_edit"
                                        name="include_image">
                                    <label id="file_upl" for="image" class="custom-file-label">Seçim edin</label>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">Tips
                                    Text</label>
                                <input type="text" class="form-control border border-light" id="tips_text_edit"
                                    name="tips_text" minlength="2" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">Blog
                                    Meta description</label>
                                <input type="text" class="form-control border border-light" id="meta_description" name="meta_description"
                                    minlength="2" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">Blog
                                    body</label>
                                <textarea type="text" class="form-control border border-light" id="blog_body_edit" name="blog_body_edit" minlength="2"
                                    required></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">Blog
                                    Language</label>
                                <select type="text" class="form-control border border-light" id="blog_lang" name="blog_lang" minlength="2" required>
                                    <option value="az">AZ</option>
                                    <option value="en">EN</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-4" style="float: right;">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary" id="add-cat">
                                    Yadda saxla
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade hide" id="CblogStatusModal" tabindex="-1" aria-modal="false" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Status yenilənməsi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="updateCBlogStatusForm">
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
