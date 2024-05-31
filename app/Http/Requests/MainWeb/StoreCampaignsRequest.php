<?php

namespace App\Http\Requests\MainWeb;

use Illuminate\Foundation\Http\FormRequest;

class StoreCampaignsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'campaign_title_input' => ['required','min:3'],
            'image_campaign_input' => ['required_if:condition,require','mimes:png,jpg,jpeg,webp,avif'],
            'image_mobile_campaign_input' => ['required_if:condition,require','mimes:png,jpg,jpeg,webp,avif'],
            'campaign_lastdate_input' => ['required','min:3'],
            'CampaignModalEditor_input' => ['required','min:3'],
            'CampaignPartnerModalEditor_input' => ['required','min:3'],
            "campaign_status_input" => ['required']
        ];
    }
}
