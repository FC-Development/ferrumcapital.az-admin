@extends('layouts.default')
@section('content')
    <div class="row justify-content-between ml-0 mr-0">
        <div class="header-title">
            <h4 class="card-title">Brend</h4>
        </div>
        <button class="btn btn-primary addNewBrendBTN" type="button">
            <i class="mr-1" style="position: relative; top: -1px;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" height="20" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </i>
            Əlavə et
        </button>
    </div>
    <div id="gridbrand"></div>
    <div class="modal fade hide pr-0" id="NewBrendModal" tabindex="-1" aria-modal="false" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Yeni partnyor əlavə et</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="modal-body" id="BrendForm" enctype=multipart/form-data>
                    @csrf
                    <input type="hidden" value="require" name="condition">
                    <div class="row" id="blog">
                        <div class="col-md-3 mb-3">
                            <label for="title"
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Name</label>
                            <input type="text" class="form-control border border-light" id="name" name="name" minlength="2"
                                >
                        </div>
                        <div class="col-md-3 mb-3">
                            <span class="f-sm form-label font-weight-bold text-muted text-uppercase">Logo</span>
                            <div class="custom-file mt-8">
                                <input type="file" class="custom-file-input" id="logo" name="logo">
                                <label for="image" class="custom-file-label">Seçim edin</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">Phone</label>
                            <input type="text" class="form-control border border-light" id="phone" name="phone"
                                minlength="2" >
                        </div>
                        <div class="col-md-3 mb-3 partnerAddressBox">
                            <label for="adress" class="f-sm form-label font-weight-bold text-muted text-uppercase">Adress</label>
                            <input type="text" class="form-control border border-light" id="adress" name="adress" minlength="2">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">City</label>
                            <select name="city" class='form-control' id="cityForNewPartner"></select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="regionBrandNew" class="f-sm form-label font-weight-bold text-muted text-uppercase">Region</label>
                            <select name="regionBrandNew" class='form-control' id="regionForNewPartner"></select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Instagram</label>
                            <input type="url" class="form-control border border-light" id="ig" name="ig" minlength="2"
                                >
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Facebook</label>
                            <input type="text" class="form-control border border-light" id="fb" name="fb" minlength="2"
                                >
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Website</label>
                            <input type="url" class="form-control border border-light" id="website" name="website" minlength="2"
                                >
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">Sektor</label>
                            <select name="sector_id" class="form-control brand_sector"></select>
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
    <div class="modal fade hide" id="brandStatusModal" tabindex="-1" aria-modal="false" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Status yenilənməsi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="updateBrandStatusForm">
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
    <div class="modal fade hide pr-0" id="BrendModal" tabindex="-1" aria-modal="false" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Dəyişiklik et</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="modal-body" id="BrendUpdate" enctype=multipart/form-data>
                    @csrf
                    <input type="hidden" name="uniq_id" value="">
                    <div class="row" id="blog">
                        <div class="col-md-3 mb-3">
                            <label for="title"
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Name</label>
                            <input type="text" class="form-control border border-light" id="name" name="name" minlength="2"
                                required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <span class="f-sm form-label font-weight-bold text-muted text-uppercase">Logo</span>
                            <div class="custom-file mt-8">
                                <input type="file" class="custom-file-input" id="logo" name="logo">
                                <label for="image" class="custom-file-label">Seçim edin</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <span class="f-sm form-label font-weight-bold text-muted text-uppercase">Slider image</span>
                            <div class="custom-file mt-8">
                                <input type="file" class="custom-file-input" id="BrandSliderImage" name="BrandSliderImage">
                                <label for="BrandSliderImage" class="custom-file-label" >Seçim edin</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <span class="f-sm form-label font-weight-bold text-muted text-uppercase">Slider mobile image</span>
                            <div class="custom-file mt-8">
                                <input type="file" class="custom-file-input" id="BrandSliderMImage" name="BrandSliderMImage">
                                <label for="BrandSliderMImage" class="custom-file-label">Seçim edin</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">Phone</label>
                            <input type="text" class="form-control border border-light" id="phone" name="phone" minlength="2">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="adress" class="f-sm form-label font-weight-bold text-muted text-uppercase">Ünvan</label>
                            <input type="text" class="form-control border border-light" id="adress" placeholder="Adress" name="adress" minlength="2">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase"><span>City</span><span class="flashing-dots"></span></label>
                            <select name="cityUpdateModal" class='form-control' id="cityUpdateModal"></select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase"><span>Region</span><span class="flashing-dots"></span></label>
                            <select name="regionUpdateModal" class='form-control' id="regionUpdateModal"></select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Instagram</label>
                            <input type="url" class="form-control border border-light" id="ig" name="ig" minlength="2">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Facebook</label>
                            <input type="text" class="form-control border border-light" id="fb" name="fb" minlength="2">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Website</label>
                            <input type="url" class="form-control border border-light" id="website" name="website" minlength="2">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">Sektor</label>
                            <select name="sector_id" class="form-control brand_sector"></select>
                        </div>
                    </div>
                    <div class="row mt-4" style="float: right;">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary" id="add-cat">Yenilə</button>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3" style="padding: 0;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="DisplayInSlider" checked>
                            <label class="form-check-label" for="DisplayInSlider">Slider də göstər</label>
                        </div>
                    </div>
                    <span>Qeyd: slider ölçüləri desktop 376x376 <br> mobil 269x210</span>
                    <div id="upload-status" class="mt-2"></div>
                </form>
            </div>
        </div>
    </div>
    <style>
        table.gridjs-table {
            width: 100%;
        }
    </style>
    <style>
    .progress {
        display: none;
        height: 20px;
        width: 300px;
        border-radius: 5px;
        background-color: #f5f5f5;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, .2);
    }

    .progress-bar {
        line-height: 30px;
        color: white;
        font-weight: bold;
        transition: width 0.4s ease;
    }

    #upload-status {
        font-size: 14px;
        margin-top: 10px;
    }
    .flashing-dots::after {
        content: '...';
        animation: dots 1s steps(3, end) infinite;
    }

    @keyframes dots {
        0%, 20% {
            color: rgba(0, 0, 0, 0);
            text-shadow: .25em 0 0 rgba(0, 0, 0, 0),
                         .5em 0 0 rgba(0, 0, 0, 0);
        }
        40% {
            color: black;
            text-shadow: .25em 0 0 rgba(0, 0, 0, 0),
                         .5em 0 0 rgba(0, 0, 0, 0);
        }
        60% {
            text-shadow: .25em 0 0 black,
                         .5em 0 0 rgba(0, 0, 0, 0);
        }
        80%, 100% {
            text-shadow: .25em 0 0 black,
                         .5em 0 0 black;
        }
    }
</style>
@endsection
