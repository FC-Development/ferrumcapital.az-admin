@extends('layouts.default')
@section('content')
    <div class="row justify-content-between ml-0 mr-0">
        <div class="header-title">
            <h4 class="card-title">Kampaniyalar</h4>
        </div>
        <button class="btn btn-primary addNewCampaignBTN" type="button">
            <i class="mr-1" style="position: relative; top: -1px;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" height="20" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </i>
            Əlavə et
        </button>
    </div>
    <div id="CampaignListTable"></div>
    <div class="modal fade hide pr-0" id="CampaignAddModal" tabindex="-1" aria-modal="false" role="dialog">
        <div class="modal-dialog" role="document" style="min-width: 700px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Yeni kampaniya əlavə et</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="modal-body" id="NewCampaignForm" enctype=multipart/form-data>
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="partnerSelectForCampaign">
                                <label for="campaign_partner_input" class="f-sm form-label font-weight-bold text-muted text-uppercase">Partnyor</label>
                                <select class="form-control" id="campaign_partner_input" name="campaign_partner_input" require>
                                    <option value="Seçim edilməyib" selected>Seçim edilməyib</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label
                            for="campaign_title_input"
                            class="f-sm form-label font-weight-bold text-muted text-uppercase">Kampaniya başlıqı</label>
                            <input type="text"
                            id="campaign_title_input"
                            class="form-control border border-light"
                            name="campaign_title_input"
                            inlength="2" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span class="f-sm form-label font-weight-bold text-muted text-uppercase">Şəkil</span>
                            <div class="custom-file mt-8">
                                <input type="file" class="custom-file-input" name="image_campaign_input" accept="image/png, image/jpeg" required>
                                <label for="image" class="custom-file-label">Seçim edin</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span class="f-sm form-label font-weight-bold text-muted text-uppercase">Mobil Şəkil</span>
                            <div class="custom-file mt-8">
                                <input type="file" class="custom-file-input" name="image_mobile_campaign_input" accept="image/png, image/jpeg" required>
                                <label for="image" class="custom-file-label">Seçim edin</label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <span class="f-sm form-label font-weight-bold text-muted text-uppercase">Açıqlama</span>
                            <br>
                            <textarea id="CampaignModalEditor_input"></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="campaign_lastdate_input">Son tarix</label>
                            <input type="date" class="form-control" name="campaign_lastdate_input" id="campaign_lastdate_input">
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="campaign_status_input">Status</label>
                                </div>
                                <select class="custom-select" id="campaign_status_input" name="campaign_status_input">
                                    <option value="0">Aktiv</option>
                                    <option value="1">Deaktiv</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4" style="float: right;">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">Tamamla</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade hide pr-0" id="CampaignEditModal" tabindex="-1" aria-modal="false" role="dialog">
        <div class="modal-dialog" role="document" style="min-width: 700px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Seçilmiş kampaniya məlumatlarını dəyiş</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="modal-body" id="NewCampaignForm" enctype=multipart/form-data>
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="partnerSelectForCampaign">
                                <label for="campaign_partner_input" class="f-sm form-label font-weight-bold text-muted text-uppercase">Partnyor</label>
                                <select class="form-control" id="edit_campaign_partner_input" name="edit_campaign_partner_input" require>
                                    <option value="Seçim edilməyib" selected>Seçim edilməyib</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label
                            for="campaign_title_input"
                            class="f-sm form-label font-weight-bold text-muted text-uppercase">Kampaniya başlıqı</label>
                            <input type="text"
                            id="edit_campaign_title_input"
                            class="form-control border border-light"
                            name="edit_campaign_title_input"
                            inlength="2" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span class="f-sm form-label font-weight-bold text-muted text-uppercase">Şəkil</span>
                            <div class="custom-file mt-8">
                                <input type="file" class="custom-file-input" name="edit_image_campaign_input" accept="image/png, image/jpeg" required>
                                <label for="image" class="custom-file-label">Seçim edin</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <span class="f-sm form-label font-weight-bold text-muted text-uppercase">Mobil Şəkil</span>
                            <div class="custom-file mt-8">
                                <input type="file" class="custom-file-input" name="edit_image_mobile_campaign_input" accept="image/png, image/jpeg" required>
                                <label for="image" class="custom-file-label">Seçim edin</label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <span class="f-sm form-label font-weight-bold text-muted text-uppercase">Açıqlama</span>
                            <br>
                            <textarea id="edit_CampaignModalEditor_input"></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="campaign_lastdate_input">Son tarix</label>
                            <input type="date" class="form-control" name="edit_campaign_lastdate_input" id="edit_campaign_lastdate_input">
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="campaign_status_input">Status</label>
                                </div>
                                <select class="custom-select" id="edit_campaign_status_input" name="edit_campaign_status_input">
                                    <option value="0">Aktiv</option>
                                    <option value="1">Deaktiv</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4" style="float: right;">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">Tamamla</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
@endsection
