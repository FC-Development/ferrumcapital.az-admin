<div class="data-scrollbar" data-scroll="1">
    <nav class="iq-sidebar-menu">
        <ul id="iq-sidebar-toggle" class="side-menu" style="max-height:620px;overflow-y:scroll;">
            {{-- <li class="sidebar-layout">
            <a href="{{ route('admin.about') }}" class="svg-icon">
                <i class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </i>
                <span class="ml-2">Haqqımızda</span>
            </a>
        </li> --}}
            <li class="px-3 pt-3 pb-2">
                <span class="text-uppercase small font-weight-bold">Ferrum CapItal</span>
            </li>
            @can('viewMarketing',auth()->user())
            <li class="sidebar-layout">
                <a href="{{ route('admin.blog') }}" class="svg-icon">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                    </i>
                    <span class="ml-2">Blog</span>
                </a>
            </li>
            @endcan
            @can('viewMarketing',auth()->user())
            <li class="sidebar-layout">
                <a href="{{ route('admin.mkslider') }}" class="svg-icon">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                        </svg>
                    </i>
                    <span class="ml-2">MK Slider</span>
                </a>
            </li>
            @endcan
            @can('viewMarketing',auth()->user())
            <li class="sidebar-layout">
                <a href="{{ route('admin.businessApply') }}" class="svg-icon">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </i>
                    <span class="ml-2">Faktorinq müraciətləri</span>
                </a>
            </li>
            @endcan
            @can('viewMarketing',auth()->user())
            <li class="sidebar-layout">
                <a href="{{ route('admin.subscription') }}" class="svg-icon">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </i>
                    <span class="ml-2">Abonəlik</span>
                </a>
            </li>
            @endcan
            @can('viewMarketing',auth()->user())
            <li class="sidebar-layout">
                <a href="{{ route('admin.media') }}" class="svg-icon">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </i>
                    <span class="ml-2">Xəbərlər</span>
                </a>
            </li>
            @endcan
            <!--<li class="sidebar-layout">
                <a href="{{ route('admin.tool') }}" class="svg-icon">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </i>
                    <span class="ml-2">Tools</span>
                </a>
            </li>
            <li class="sidebar-layout">
                <a href="{{ route('admin.guide') }}" class="svg-icon">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </i>
                    <span class="ml-2">Guide</span>
                </a>
            </li>-->
            @can('viewMarketing',auth()->user())
            <li class="sidebar-layout">
                <a href="{{ route('admin.faq') }}" class="svg-icon">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </i>
                    <span class="ml-2">FAQ</span>
                </a>
            </li>
            @endcan
            @can('viewMarketing',auth()->user())
            <li class="sidebar-layout">
                <a href="{{ route('admin.testimonial-korp') }}" class="svg-icon">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </i>
                    <span class="ml-2">Partnyor rəyi</span>
                </a>
            </li>
            @endcan
            @can('viewMarketing',auth()->user())
            <li class="sidebar-layout">
                <a href="{{ route('admin.testimonial-custmr') }}" class="svg-icon">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </i>
                    <span class="ml-2">Müştəri rəyi</span>
                </a>
            </li>
            @endcan
            @can('viewMarketing',auth()->user())
            <li class="sidebar-layout">
                <a href="{{ route('admin.bfstatistic') }}" class="svg-icon">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </i>
                    <span class="ml-2">Biznes rəqəmlərlə</span>
                </a>
            </li>
            @endcan
            @can('viewMarketing',auth()->user())
            <li class="sidebar-layout">
                <a href="{{ route('admin.pfstatistic') }}" class="svg-icon">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </i>
                    <span class="ml-2">Partnyor rəqəmlərlə</span>
                </a>
            </li>
            @endcan
            @can('viewMarketing',auth()->user())
            <li class="sidebar-layout">
                <a href="{{ route('admin.brandsector') }}" class="svg-icon">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </i>
                    <span class="ml-2">Partnyor kateqoriyaları</span>
                </a>
            </li>
            @endcan
            @can('viewMarketing',auth()->user())
            <li class="sidebar-layout">
                <a href="{{ route('admin.brand') }}" class="svg-icon">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </i>
                    <span class="ml-2">Partnyorlar</span>
                </a>
            </li>
            @endcan
            @can('viewMarketing',auth()->user())
            <li class="sidebar-layout">
                <a href="{{ route('admin.team') }}" class="svg-icon">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </i>
                    <span class="ml-2">Komandamız</span>
                </a>
            </li>
            @endcan
            @can('viewHR',auth()->user())
            <li class="sidebar-layout">
                <a href="{{ route('admin.statistic') }}" class="svg-icon">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </i>
                    <span class="ml-2">Karyera rəqəmlərlə</span>
                </a>
            </li>
            @endcan
            @can('viewHR',auth()->user())
            <li class="sidebar-layout">
                <a href="{{ route('admin.life_gallery') }}" class="svg-icon">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </i>
                    <span class="ml-2">Karyera qalereyası</span>
                </a>
            </li>
            @endcan
            @can('viewMarketing',auth()->user())
            <li class="sidebar-layout">
                <a href="{{ route('admin.corp_gallery') }}" class="svg-icon">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </i>
                    <span class="ml-2">Korporativ qalereya</span>
                </a>
            </li>
            @endcan
            @can('viewHR',auth()->user())
            <li class="sidebar-layout">
                <a href="{{ route('admin.career_blog') }}" class="svg-icon">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </i>
                    <span class="ml-2">Bloq</span>
                </a>
            </li>
            @endcan
            @can('viewHR',auth()->user())
            <li class="sidebar-layout">
                <a href="{{ route('admin.vacancy') }}" class="svg-icon">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </i>
                    <span class="ml-2">Vakansiyalar</span>
                </a>
            </li>
            @endcan
            @can('viewHR',auth()->user())
            <li class="sidebar-layout">
                <a href="{{ route('admin.careerfaq') }}" class="svg-icon">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </i>
                    <span class="ml-2">FAQ</span>
                </a>
            </li>
            @endcan
            @can('viewHR',auth()->user())
            <li class="sidebar-layout">
                <a href="{{ route('admin.career_testimnl') }}" class="svg-icon">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </i>
                    <span class="ml-2">Rəylər</span>
                </a>
            </li>
            @endcan
            @can('viewHR',auth()->user())
            <li class="sidebar-layout">
                <a href="{{ route('admin.department') }}" class="svg-icon">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </i>
                    <span class="ml-2">Departament/Bölmə</span>
                </a>
            </li>
            @endcan
            @can('viewHR',auth()->user())
            <li class="sidebar-layout">
                <a href="{{ route('admin.applications') }}" class="svg-icon">
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </i>
                    <span class="ml-2">Müraciətlər</span>
                </a>
            </li>
            @endcan
        </ul>
    </nav>
</div>
