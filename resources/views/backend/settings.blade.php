<x-admin-header/>

<div id="main_content">
    <div id="header_top" class="header_top">
        <div class="container">
            <div class="hleft">
                <a class="header-brand" href="index.html"><i class="fa fa-graduation-cap brand-logo"></i></a>
                <div class="dropdown">
                    <a href="javascript:void(0)" class="nav-link icon menu_toggle"><i class="fe fe-align-center"></i></a>
                    <a href="page-search.html" class="nav-link icon"><i class="fe fe-search" data-toggle="tooltip" title="Search..."></i></a>
                    <a href="app-email.html" class="nav-link icon app_inbox"><i class="fe fe-inbox" data-toggle="tooltip" title="Inbox"></i></a>
                    <a href="app-filemanager.html" class="nav-link icon app_file xs-hide"><i class="fe fe-folder" data-toggle="tooltip" title="File Manager"></i></a>
                    <a href="app-social.html" class="nav-link icon xs-hide"><i class="fe fe-share-2" data-toggle="tooltip" title="Social Media"></i></a>
                    <a href="javascript:void(0)" class="nav-link icon theme_btn"><i class="fe fe-feather"></i></a>
                    <a href="{{ route('settings') }}" class="nav-link icon settingbar"><i class="fe fe-settings"></i></a>
                </div>
            </div>
            <div class="hright">
                <a href="javascript:void(0)" class="nav-link icon right_tab"><i class="fe fe-align-right"></i></a>
                <a href="login.html" class="nav-link icon settingbar"><i class="fe fe-power"></i></a>                
            </div>
        </div>
    </div>

    <div id="rightsidebar" class="right_sidebar">
        <a href="javascript:void(0)" class="p-3 settingbar float-right"><i class="fa fa-close"></i></a>
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#Settings" aria-expanded="true">Settings</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#activity" aria-expanded="false">Activity</a></li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fadeIn active" id="Settings" aria-expanded="true">
                <form method="POST" action="{{ route('settings.save') }}">
                    @csrf

                    {{-- Theme Color --}}
                    <div class="mb-4">
                        <h6 class="font-14 font-weight-bold text-muted">Theme Color</h6>
                        <ul class="choose-skin list-unstyled mb-0">
                            @php
                                $colors = ['azure', 'indigo', 'purple', 'orange', 'green', 'cyan', 'blush'];
                            @endphp
                            @foreach($colors as $color)
                                <li data-theme="{{ $color }}" class="{{ $setting->theme_color == $color ? 'active' : '' }}">
                                    <div class="{{ $color }}">
                                        <input type="radio" name="theme_color" value="{{ $color }}" {{ $setting->theme_color == $color ? 'checked' : '' }} hidden>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Font Style --}}
                    <div class="mb-4">
                        <h6 class="font-14 font-weight-bold text-muted">Font Style</h6>
                        <div class="custom-controls-stacked font_setting">
                            @php
                                $fonts = ['font-muli' => 'Muli Google Font', 'font-montserrat' => 'Montserrat Google Font', 'font-poppins' => 'Poppins Google Font', 'font-ptsans' => 'PT Sans Google Font'];
                            @endphp

                            @foreach($fonts as $fontValue => $fontLabel)
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="font_style" value="{{ $fontValue }}" {{ $setting->font_style == $fontValue ? 'checked' : '' }}>
                                    <span class="custom-control-label">{{ $fontLabel }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h6 class="font-14 font-weight-bold mt-4 text-muted">General Settings</h6>
                        <ul class="setting-list list-unstyled mt-1 setting_switch">

                            @php
                                $toggles = [
                                    'night_mode' => 'Night Mode',
                                    'fix_navbar' => 'Fix Navbar top',
                                    'header_dark' => 'Header Dark',
                                    'min_sidebar' => 'Min Sidebar Dark',
                                    'sidebar_dark' => 'Sidebar Dark',
                                    'icon_color' => 'Icon Color',
                                    'gradient_color' => 'Gradient Color',
                                    'box_shadow' => 'Box Shadow',
                                    'rtl_support' => 'RTL Support',
                                    'box_layout' => 'Box Layout',
                                ];
                            @endphp

                            @foreach($toggles as $field => $label)
                                <li>
                                    <label class="custom-switch">
                                        <span class="custom-switch-description">{{ $label }}</span>
                                        <input type="checkbox" name="{{ $field }}" class="custom-switch-input" {{ $setting->$field ? 'checked' : '' }}>
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <hr>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Save Settings</button>
                    </div>
                </form>
            </div>

            <div role="tabpanel" class="tab-pane fadeIn" id="activity" aria-expanded="false">
                <p>Activity log can go here...</p>
            </div>
        </div>
    </div>
</div>

<x-admin-footer/>
