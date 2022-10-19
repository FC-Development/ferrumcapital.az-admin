@extends('layouts.default')
@section('content')
    <div class="row justify-content-between ml-0 mr-0">
        <div class="header-title">
            <h4 class="card-title">Müştəri kabineti slider</h4>
        </div>
        <button class="btn btn-primary addNewCustomerSliderBTN" type="button">
            <i class="mr-1" style="position: relative; top: -1px;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" height="20" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </i>
            Əlavə et
        </button>
    </div>
    <div id="grid_mkSlider"></div>
    <div class="modal fade hide pr-0" id="NewCustomerSliderModal" tabindex="-1" aria-modal="false" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Yeni slider əlavə et</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="modal-body" id="NewCustomerSliderForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="title" class="f-sm form-label font-weight-bold text-muted text-uppercase">Başlıq</label>
                            <input type="text" class="form-control border border-light"  name="title" minlength="2" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">Açıqlama</label>
                            <textarea type="text" class="form-control border border-light" id="customer_new_slider_quote" name="description" minlength="2" required=""></textarea>
                        </div>
                    </div>
                    <div class="row mt-4" style="float: right;">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">Əlavə et</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
