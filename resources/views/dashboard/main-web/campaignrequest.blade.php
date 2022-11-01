@extends('layouts.default')
@section('content')
    <div class="modal fade hide" id="RequestStatusModal" tabindex="-1" aria-modal="false" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Status yenilənməsi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="updateCampaignRequestStatusForm">
                    @csrf
                    <input type="hidden" name="uniq_id">
                    <div class="modal-body">
                        <div class="boxel">
                            <div class="form-group">
                                <label for="inputStateApply"
                                       class="f-sm form-label font-weight-bold text-muted text-uppercase">Status</label>
                                <select id="requestStatus" class="form-select form-control">
                                    <option value="gözləmədə">gözləmədə</option>
                                    <option value="zəng edildi">zəng edildi</option>
                                    <option value="rədd edildi">rədd edildi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<div id="campaign_request_list"></div>
@endsection
