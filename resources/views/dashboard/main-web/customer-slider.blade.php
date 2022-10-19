@extends('layouts.default')
@section('content')
    <div class="row justify-content-between ml-0 mr-0">
        <div class="header-title">
            <h4 class="card-title">Müştəri kabineti slider</h4>
        </div>
        <button class="btn btn-primary addNewMkSliderBTN" type="button">
            <i class="mr-1" style="position: relative; top: -1px;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" height="20" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </i>
            Əlavə et
        </button>
    </div>
    <div class="modal fade hide px-5 pt-2" id="NewSliderModal" tabindex="-1" aria-modal="false" role="dialog">
       <div class="modal-dialog w-50 modal-m" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title">Əlavə et</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">×</span>
                   </button>
               </div>
               <div class="modal-body">
                   <div class="row justify-content-center">
                       <div class="col-12">
                           <form id="UserForm">
                               @csrf
                               <div class="input-group mb-3">
                                   <div class="input-group">
                                       <div class="input-group-prepend">
                                           <span class="input-group-text" id="title">Başlıq: </span>
                                       </div>
                                       <input type="text" name="title" class="form-control">
                                       <span class="help-block"><strong></strong></span>
                                   </div>
                               </div>
                               <div class="input-group mb-3">
                                   <div class="input-group">
                                       <div class="input-group-prepend">
                                           <span class="input-group-text" id="description">Açıqlama:</span>
                                       </div>
                                       <input type="text" name="description" class="form-control">
                                       <span class="help-block"><strong></strong></span>
                                   </div>
                               </div>
                               <button type="submit" class="btn btn-primary btn-block">Tamamla</button>
                           </form>
                       </div>
                   </div>
               </div>
           </div>
       </div>
</div>
@endsection