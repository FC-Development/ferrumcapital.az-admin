<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Career\FaqController;
use App\Http\Controllers\Career\VacancyController;
use App\Http\Controllers\Career\LifegController;
use App\Http\Controllers\Career\CorpBlogController;
use App\Http\Controllers\Career\StatisticController;
use App\Http\Controllers\Career\ApplicationsController;
use App\Http\Controllers\Career\CorpGalleryController;
use App\Http\Controllers\Career\CareerTestimnlController;
use App\Http\Controllers\Career\DepartmentController;
use App\Http\Controllers\Career\SubscriptionController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\MainWeb\BlogController;
use App\Http\Controllers\MainWeb\MediaController;
use App\Http\Controllers\MainWeb\ToolsController;
use App\Http\Controllers\MainWeb\GuidesController;
use App\Http\Controllers\MainWeb\FAQController as MainWebFaq;
use App\Http\Controllers\MainWeb\TestimonialKorpController;
use App\Http\Controllers\MainWeb\TestimonialCstmrController;
use App\Http\Controllers\MainWeb\BfStatisticController;
use App\Http\Controllers\MainWeb\PfStatisticController;
use App\Http\Controllers\MainWeb\BrandSecController;
use App\Http\Controllers\MainWeb\PartnerApplyController;
use App\Http\Controllers\MainWeb\BusinessApplyController;
use App\Http\Controllers\MainWeb\PartnerBusinessController;
use  App\Http\Controllers\MainWeb\BrandController;
use App\Http\Controllers\MainWeb\TeamController;
use App\Http\Controllers\MainWeb\MkSliderController;
use App\Http\Middleware\SetIpAddress;

Route::prefix('dashboard')->group( function(){
       Route::get('/main',function(){
              return view('includes.dashboard.welcome');
       })->name('login_page')->middleware('guest');
       Route::post('/login',[UserController::class,'store'])->name('login');
       Route::middleware(['auth'])->group(function() {
              Route::post('/logout',[UserController::class,'destroy'])->name('logout');
              /** hr */
              Route::get("/career_blog",[CorpBlogController::class,'blogPage'])->name('admin.career_blog');
              Route::get("/vacancy",[VacancyController::class,'vacancyPage'])->name('admin.vacancy');
              Route::get("/department",[DepartmentController::class,'departmentPage'])->name('admin.department');
              Route::get("/careerfaq",[FaqController::class,'faqPage'])->name('admin.careerfaq');
              Route::get("/applications",[ApplicationsController::class,'index'])->name('admin.applications');
              Route::get("/career_testimnl",[CareerTestimnlController::class,'testimonialPage'])->name('admin.career_testimnl');
              


              Route::get("/mkslider", [MkSliderController::class,'mksliderPage'])->name('admin.mkslider');  
              Route::get('/business_partner_apply',[PartnerBusinessController::class,'returnView'])->name('admin.businessApply');
              Route::get('/subscription',[SubscriptionController::class,'getSubsPage'])->name('admin.subscription');
              
              Route::get("/statistic_career",[StatisticController::class,'statisticPage'])->name('admin.statistic');
              Route::get('/userPage',[UserController::class,'registerPage'])->name('admin.userPage');
              Route::get("/life_gallery",[LifegController::class,'lifePage'])->name('admin.life_gallery');
              Route::get("/corp_gallery",[CorpGalleryController::class,'galleryPage'])->name('admin.corp_gallery');
              
              Route::get("/blog",[BlogController::class,'blogPage'])->name('admin.blog');
              Route::get("/media",[MediaController::class,'mediaPage'])->name('admin.media');
              Route::get("/tool",[ToolsController::class,'toolsPage'])->name('admin.tool');
              Route::get("/guide",[GuidesController::class,'guidePage'])->name('admin.guide');
              Route::get("/faq",[MainWebFaq::class,'faqPage'])->name('admin.faq');
              Route::get("/testimonialKorporativ",[TestimonialKorpController::class,'testimonialPage'])->name('admin.testimonial-korp');
              Route::get("/testimonialCustomer",[TestimonialCstmrController::class,'testimonialPage'])->name('admin.testimonial-custmr');
              Route::get("/bfstatistic",[BfStatisticController::class,'bfStatsPage'])->name('admin.bfstatistic');
              Route::get("/pfstatistic",[PfStatisticController::class,'pfStatsPage'])->name('admin.pfstatistic');
              Route::get("/brandsector",[BrandSecController::class,'brandSecPage'])->name('admin.brandsector');
              Route::get("/brand",[BrandController::class,'brandPage'])->name('admin.brand');
              Route::get("/team",[TeamController::class,'teamPage'])->name('admin.team');
              Route::prefix('csapi')->group(function(){
                     Route::get('/get/business/partner/all/apply',[PartnerBusinessController::class,'returnAll']);
                     Route::get('/get/partner/apply/{uniq_id}',[PartnerApplyController::class,'getApplyByUniqID']);
                     Route::get('/get/business/apply/{uniq_id}',[BusinessApplyController::class,'getBusinessByUniqID']);
                     Route::get('/get/partner/apply',[PartnerApplyController::class,'getPartnerApply']);
                     Route::get('/get/business/apply',[BusinessApplyController::class,'getBusinessApply']);
                     Route::get('/get/subscribers',[SubscriptionController::class,'getSubscribers']);
                     Route::get('/user/list',[UserController::class,'GetUsers']);
                     Route::post('/user/delete',[UserController::class,'deleteUser']);
                     Route::post('/user/update/role',[UserController::class,'updateUserRole']);
                     Route::post('/create/user',[UserController::class,'registerUser']);
                     Route::get("/cstatistic/get",[StatisticController::class,'getCstatistic']);
                     Route::post("/cstatistic/post",[StatisticController::class,'postCstatistic']);
                     Route::post("/cstatistic/update",[StatisticController::class,'updateStats']);
                     Route::post("/cstatistic/find",[StatisticController::class,'findStats']);
                     Route::post("/cstatistic/delete",[StatisticController::class,'deleteStats']);

                     Route::get("/life_gallery/get",[LifegController::class,'getLifeG']);
                     Route::post("/life_gallery/post",[LifegController::class,'postLifeG']);
                     Route::post("/life_gallery/delete",[LifegController::class,'deleteLifeG']);
                     /* MK Slider  */
                     Route::post("/create/FerrumCapital/MusteriKabineti/slider",[MkSliderController::class,'postData']);
                     Route::get("/get/FerrumCapital/MusteriKabineti/slider",[MkSliderController::class,'getData']);
                     Route::post("/delete/FerrumCapital/MusteriKabineti/slider",[MkSliderController::class,'deleteData']);

                     Route::get("/corp_gallery/get",[CorpGalleryController::class,'getCorpGal']);
                     Route::post("/corp_gallery/post",[CorpGalleryController::class,'postCorpGal']);
                     Route::post("/corp_gallery/delete",[CorpGalleryController::class,'deleteCorpGal']);

                     Route::post("/careerblog/post",[CorpBlogController::class,'postBlog']);
                     Route::get("/careerblog/get",[CorpBlogController::class,'getBlog']);
                     Route::post("/careerblog/delete",[CorpBlogController::class,'deleteBlog']);
                     Route::post("/careerblog/find",[CorpBlogController::class,'findBlog']);
                     Route::post("/careerblog/update",[CorpBlogController::class,'updateBlog']);
                     Route::post("/careerblog/status/update/{id}",[CorpBlogController::class,'updateBlogStatus']);

                     Route::post("/vacancy/post",[VacancyController::class,'postVacancy']);
                     Route::get("/vacancy/get",[VacancyController::class,'getVacancy']);
                     Route::post("/vacancy/delete",[VacancyController::class,'deleteVacancy']);
                     Route::post("/vacancy/find",[VacancyController::class,'findVacancy']);
                     Route::post("/vacancy/update",[VacancyController::class,'updateVacancy']);
                     Route::post("/vacancy/status/update/{id}",[VacancyController::class,'updateVacancyStatus']);

                     Route::post("/careerfaq/post",[FaqController::class,'postFaq']);
                     Route::get("/careerfaq/get",[FaqController::class,'getFaq']);
                     Route::post("/careerfaq/delete",[FaqController::class,'deleteFaq']);
                     Route::post("/careerfaq/find",[FaqController::class,'findFaq']);
                     Route::post("/careerfaq/update",[FaqController::class,'updateFaq']);
                     Route::post("/careerfaq/status/update/{id}",[FaqController::class,'updateFaqStatus']);


                     Route::post("/career_testimnl/post",[CareerTestimnlController::class,'postTestimonial']);
                     Route::get("/career_testimnl/get",[CareerTestimnlController::class,'getTestimonial']);
                     Route::post("/career_testimnl/delete",[CareerTestimnlController::class,'deleteTestimonial']);
                     Route::post("/career_testimnl/find",[CareerTestimnlController::class,'findTestimonial']);
                     Route::post("/career_testimnl/update",[CareerTestimnlController::class,'updateTestimonial']);
                     Route::post("/career_testimnl/status/update/{id}",[CareerTestimnlController::class,'updateTestimonialStatus']);

                     Route::get('/career/applications/get',[ApplicationsController::class,'getVacancy']);
                     Route::post('/career/applications/post',[ApplicationsController::class,'postVacancy']);
                     Route::post("/application/status/update/{id}",[ApplicationsController::class,'updateApplyStatus']);
                     Route::get("/application/find/{uniq_id}",[ApplicationsController::class,'findData']);

                     Route::post("/blog/post",[BlogController::class,'postBlog']);
              Route::get("/blog/get",[BlogController::class,'getBlog']);
              Route::post("/blog/delete",[BlogController::class,'deleteBlog']);
              Route::post("/blog/find",[BlogController::class,'findBlog']);
              Route::post("/blog/update",[BlogController::class,'updateBlog']);
              Route::post("/blog/status/update/{id}",[BlogController::class,'updateBlogStatus']);

              /** Media */
              Route::post("/media/post",[MediaController::class,'postMedia']);
              Route::get("/media/get",[MediaController::class,'getMedia']);
              Route::post("/media/delete",[MediaController::class,'deleteMedia']);
              Route::post("/media/find",[MediaController::class,'findMedia']);
              Route::post("/media/update",[MediaController::class,'updateMedia']);
              Route::post("/media/status/update/{id}",[MediaController::class,'updateMediaStatus']);

              /** Tools */
              Route::post("/tools/post",[ToolsController::class,'postTools']);
              Route::get("/tools/get",[ToolsController::class,'getTools']);
              Route::post("/tools/delete",[ToolsController::class,'deleteTools']);
              Route::post("/tools/find",[ToolsController::class,'findTools']);
              Route::post("/tools/update",[ToolsController::class,'updateTools']);
              Route::post("/tools/status/update/{id}",[ToolsController::class,'updateToolStatus']);
              /** Guides */
              Route::post("/guides/post",[GuidesController::class,'postGuides']);
              Route::get("/guides/get",[GuidesController::class,'getGuides']);
              Route::post("/guides/delete",[GuidesController::class,'deleteGuides']);
              Route::post("/guides/find",[GuidesController::class,'findGuides']);
              Route::post("/guides/update",[GuidesController::class,'updateGuide']);
              Route::post("/guides/status/update/{id}",[GuidesController::class,'updateGuideStatus']);

              /** FAQ */
              Route::post("/faq/post",[MainWebFaq::class,'postFaq']);
              Route::get("/faq/get",[MainWebFaq::class,'getFaq']);
              Route::post("/faq/delete",[MainWebFaq::class,'deleteFaq']);
              Route::post("/faq/find",[MainWebFaq::class,'findFaq']);
              Route::post("/faq/update",[MainWebFaq::class,'updateFaq']);
              /** Testimonial Korporativ */
              Route::post("/testimonial-korp/post",[TestimonialKorpController::class,'postTestimonial']);
              Route::get("/testimonial-korp/get",[TestimonialKorpController::class,'getTestimonial']);
              Route::post("/testimonial-korp/delete",[TestimonialKorpController::class,'deleteTestimonial']);
              Route::post("/testimonial-korp/find",[TestimonialKorpController::class,'findTestimonial']);
              Route::post("/testimonial-korp/update",[TestimonialKorpController::class,'updateTestimonial']);
              Route::post("/testimonial-korp/status/update/{id}",[TestimonialKorpController::class,'updateTestimonialStatus']);
              /** Testimonial Customer */
              Route::post("/testimonial-cstmr/post",[TestimonialCstmrController::class,'postTestimonial']);
              Route::get("/testimonial-cstmr/get",[TestimonialCstmrController::class,'getTestimonial']);
              Route::post("/testimonial-cstmr/delete",[TestimonialCstmrController::class,'deleteTestimonial']);
              Route::post("/testimonial-cstmr/find",[TestimonialCstmrController::class,'findTestimonial']);
              Route::post("/testimonial-cstmr/update",[TestimonialCstmrController::class,'updateTestimonial']);
              Route::post("/testimonial-cstmr/status/update/{id}",[TestimonialCstmrController::class,'updateTestimonialStatus']);

              // Busines Factoring Statistic
              Route::get("/bf-statistic/get",[BfStatisticController::class,'getBfStats']);
              Route::post("/bf-statistic/post",[BfStatisticController::class,'postBfStats']);
              Route::post("/bf-statistic/delete",[BfStatisticController::class,'deleteBfStats']);
              Route::post("/bf-statistic/find",[BfStatisticController::class,'findBfStats']);
              Route::post("/bf-statistic/update",[BfStatisticController::class,'updateBfStats']);
              // Partner Factoring Statistic
              Route::get("/pf-statistic/get",[PfStatisticController::class,'getPfStats']);
              Route::post("/pf-statistic/post",[PfStatisticController::class,'postPfStats']);
              Route::post("/pf-statistic/delete",[PfStatisticController::class,'deletePfStats']);
              Route::post("/pf-statistic/find",[PfStatisticController::class,'findPfStats']);
              Route::post("/pf-statistic/update",[PfStatisticController::class,'updatePfStats']);

              // Brand Sector 
              Route::get("/brand_sector/get",[BrandSecController::class,'getBrandSec']);
              Route::post("/brand_sector/post",[BrandSecController::class,'postBrandSec']);
              Route::post("/brand_sector/delete",[BrandSecController::class,'deleteBrandSec']);
              Route::post("/brand_sector/find",[BrandSecController::class,'findBrandSec']);
              Route::post("/brand_sector/update",[BrandSecController::class,'updateBrandSec']);

              // Brand
              Route::post("/brand/post",[BrandController::class,'postBrand']);
              Route::get("/brand/get",[BrandController::class,'getBrand']);
              Route::post("/brand/delete",[BrandController::class,'deleteBrand']);
              Route::post("/brand/find",[BrandController::class,'findBrand']);
              Route::post("/brand/update",[BrandController::class,'updateBrand']);
              Route::post("/brand/status/update/{id}",[BrandController::class,'updateBrandStatus']);

              // Team
              Route::post("/team/post",[TeamController::class,'postTeam']);
              Route::get("/team/get",[TeamController::class,'getTeam']);
              Route::post("/team/delete",[TeamController::class,'deleteTeam']);
              Route::post("/team/find",[TeamController::class,'findTeam']);
              Route::post("/team/update",[TeamController::class,'updateTeam']);
              Route::post("/team/status/update/{id}",[TeamController::class,'updateTeamStatus']);
              });
       });
});
