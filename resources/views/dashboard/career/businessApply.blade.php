@extends('layouts.default')
@section('content')
<div id="business_partner_apply"></div>

<div class="modal fade hide pr-0" id="BusinessPartnerApply" tabindex="-1" aria-modal="false" role="dialog">
       <div class="modal-dialog modal-xl" role="document">
           <div class="modal-content">
               <div class="modal-body" enctype=multipart/form-data>
                   @csrf
                   <input type="hidden" value="require" name="condition">
                   <div class="row" id="blog">
                     <div class="col-md-3 mb-3">
                            <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">Ad Soyad</label>
                            <input name="fullname" id="fullname" class="form-control brand_sector">
                        </div>
                       <div class="col-md-3 mb-3 adressDiv">
                           <label for="title"
                               class="f-sm form-label font-weight-bold text-muted text-uppercase">Ünvan</label>
                           <textarea type="text" class="form-control border border-light" id="adress" name="adress" minlength="2"
                               required></textarea>
                       </div>
                       <div class="col-md-3 mb-3">
                           <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">Şəhər</label>
                           <input type="text" class="form-control border border-light" id="city" name="city"
                               minlength="2" required>
                       </div>
                       <div class="col-md-3 mb-3">
                           <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">Rayon</label>
                           <input type="text" class="form-control border border-light" id="region" name="region"
                               minlength="2" required>
                       </div>
                       <div class="col-md-3 mb-3">
                           <label for="" class="f-sm form-label font-weight-bold text-muted text-uppercase">Email</label>
                           <input type="text" class="form-control border border-light" id="email" name="email" minlength="2"
                               required>
                       </div>
                       <div class="col-md-3 mb-3">
                           <label for=""
                               class="f-sm form-label font-weight-bold text-muted text-uppercase">İstiqamət</label>
                           <input type="url" class="form-control border border-light" id="field" name="field" minlength="2"
                               required>
                       </div>
                       <div class="col-md-3 mb-3">
                           <label for=""
                               class="f-sm form-label font-weight-bold text-muted text-uppercase">İnstagram</label>
                           <input type="text" class="form-control border border-light" id="instagram" name="instagram"
                               required>
                       </div>
                       <div class="col-md-3 mb-3">
                            <label for=""
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Qeyd</label>
                            <textarea type="text" class="form-control border border-light" id="note" name="note"
                                required></textarea>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Telefon nömrəsi</label>
                            <input type="text" class="form-control border border-light" id="phone" name="phone"
                                required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Mənbə</label>
                            <input type="text" class="form-control border border-light" id="source" name="source"
                                required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for=""
                                class="f-sm form-label font-weight-bold text-muted text-uppercase">Vebsayt</label>
                            <input type="text" class="form-control border border-light" id="website" name="website"
                                required>
                        </div>
                       
                   </div>
               </div>
           </div>
       </div>
</div>

@endsection