<style>
    /* #phone{
        direction: ltr;
        text-align: end;
    } */
    .iti__search-input,
    .select2-search__field{
        margin:0 !important;
        border-radius:5px !important;
        padding-block: 7px !important;
        padding-inline:10px !important; 
        border: 1px solid #eee !important;
        background-color: transparent !important;
    }
    .iti__flag {background-image: url("{{asset('plugins/intl-tel-input/img/flags.png')}}");}
    @media (min-resolution: 2x) {
        .iti__flag {background-image: url("{{asset('plugins/intl-tel-input/img/flags@2x.png')}}");}
    }
    .iti.iti--allow-dropdown{
        display: flex;
    }
    .select2-search--dropdown{
        padding: 0 !important;
    }
    .select2-container{
        width: 100% !important;
    }
    .select2-selection{
        border: none !important;
        height: auto !important;
    }
    .select2-selection__rendered{
        text-align: start !important;
        padding-block: 10px !important;
    }
    .select2-selection__arrow{
        top: 11px !important;
        padding-inline:15px 
    }
    .modal-dialog {
        margin: 1.75em auto;
        min-height: calc(100vh - 60px);
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    #myModal .close {
        position: absolute;
        right: 0.3rem;
    }

    .g-recaptcha div {
        margin: auto;
    }

    .modal-body .contact_form input[type='radio'] {
        width: auto;
        height: auto;
    }

    .modal-body .contact_form textarea {
        background-color: #eeeeee;
        padding: 15px;
        border-radius: 4px;
        margin-bottom: 10px;
        width: 100%;
        border: none
    }

    @media (max-width: 768px) {
        .modal-dialog {
            min-height: calc(100vh - 20px);
        }

        #myModal .modal-body {
            padding: 15px;
        }
    }
</style>
<?php
//$fields = json_decode(config('registration_fields'));
//$inputs = ['text','number','date','gender'];
//dd($fields);
?>

@if (!auth()->check())

    <div class="modal fade" id="myModal" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">


                <!-- Modal Header -->
                <div class="modal-header backgroud-style">

                    <div class="gradient-bg"></div>
                    <div class="popup-logo">
                        <img src="{{ asset('storage/logos/' . config('logo_popup')) }}" alt="">
                    </div>
                    <div class="popup-text text-center">
                        {{-- <h2>@lang('labels.frontend.modal.login_now') </h2> --}}
                        {{-- <p>@lang('labels.frontend.modal.login_register')</p> --}}
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="tab-content">
                        <div class="tab-pane container active" id="login">

                            <span class="error-response text-danger"></span>
                            <span class="success-response text-success">{{ session()->get('flash_success') }}</span>
                            <form class="contact_form" id="loginForm" action="{{ route('frontend.auth.login.post') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <a href="#" class="go-register float-left text-info pl-0" id="go-to-register">
                                    @lang('labels.frontend.modal.new_user_note')
                                </a>
                                <div class="contact-info mb-2">
                                    {{ html()->email('email')->class('form-control mb-0')->placeholder(__('validation.attributes.frontend.email'))->attribute('maxlength', 191) }}
                                    <span id="login-email-error" class="text-danger"></span>

                                </div>
                                <div class="contact-info mb-2">
                                    {{ html()->password('password')->class('form-control mb-0')->placeholder(__('validation.attributes.frontend.password')) }}
                                    <span id="login-password-error" class="text-danger"></span>

                                    <a class="text-info p-0 d-block text-right my-2"
                                        href="{{ route('frontend.auth.password.reset') }}">@lang('labels.frontend.passwords.forgot_password')</a>

                                </div>

                                @if (config('access.captcha.registration'))
                                    <div class="contact-info mb-2 text-center">
                                        {{ no_captcha()->display() }}
                                        {{ html()->hidden('captcha_status', 'true') }}
                                        <span id="login-captcha-error" class="text-danger"></span>

                                    </div><!--col-->
                                @endif

                                <div class="text-capitalize">
                                    <button class="btn btn-primary w-100" type="submit"
                                        value="Submit">@lang('labels.frontend.modal.login_now')</button>
                                </div>

                            </form>

                            <div id="socialLinks" class="text-center">
                            </div>

                        </div>
                        <div class="tab-pane container fade" id="register">

                            <form id="registerForm" class="contact_form" action="#" method="post">
                                {!! csrf_field() !!}
                                <a href="#" class="go-login float-right text-info pr-0">@lang('labels.frontend.modal.already_user_note')</a>
                                <div class="contact-info mb-2">


                                    {{ html()->text('first_name')->class('form-control mb-0')->placeholder(__('validation.attributes.frontend.first_name'))->attribute('maxlength', 191) }}
                                    <span id="first-name-error" class="text-danger"></span>
                                </div>
                                <div class="contact-info mb-2">
                                    {{ html()->text('last_name')->class('form-control mb-0')->placeholder(__('validation.attributes.frontend.last_name'))->attribute('maxlength', 191) }}
                                    <span id="last-name-error" class="text-danger"></span>

                                </div>

                                <div class="contact-info mb-2">
                                    {{ html()->email('email')->class('form-control mb-0')->placeholder(__('validation.attributes.frontend.email'))->attribute('maxlength', 191) }}
                                    <span id="email-error" class="text-danger"></span>

                                </div>
                                <div class="contact-info mb-2">
                                    {{ html()->password('password')->class('form-control mb-0')->placeholder(__('validation.attributes.frontend.password')) }}
                                    <span id="password-error" class="text-danger"></span>
                                </div>
                                <div class="contact-info mb-2">
                                    {{ html()->password('password_confirmation')->class('form-control mb-0')->placeholder(__('validation.attributes.frontend.password_confirmation')) }}
                                </div>
                                @if (config('registration_fields') != null)
                                    @php
                                        $fields = json_decode(config('registration_fields'));
                                        $inputs = ['text', 'number', 'date'];
                                    @endphp

                                    @foreach ($fields as $item)
                                        @if (in_array($item->type, $inputs))
                                            @if ($item->name != 'phone')
                                            <div class="contact-info mb-2">
                                                <input type="{{ $item->type }}" class="form-control mb-0"
                                                    value="{{ old($item->name) }}" name="{{ $item->name }}"
                                                    placeholder="{{ __('labels.backend.general_settings.user_registration_settings.fields.' . $item->name) }}"
                                                    style="transition: ease all 0.3s">
                                                </div>
                                            @else
                                            <input id="d-code" hidden name="dial-code">
                                            <div class="contact-info mb-2">
                                                <input type="tel" class="form-control mb-0 w-100" id="{{ $item->name }}"
                                                    value="{{ old($item->name) }}" name="{{ $item->name }}"
                                                    placeholder="{{ __('labels.backend.general_settings.user_registration_settings.fields.' . $item->name) }}"
                                                    style="transition: ease all 0.3s">
                                            </div>
                                            @endif
                                        @elseif($item->type == 'select')
                                            <div class="contact-info mb-2">
                                                <select class="form-control w-100 p-2 border-0 js-example-placeholder-single-{{$item->name}} select2"
                                                    name="{{ $item->name }}" id="{{ $item->name }}">
                                                    <option value="" >
                                                        {{ __('labels.backend.general_settings.user_registration_settings.fields.' . $item->name) }}
                                                    </option>
                                                </select>
                                            </div>
                                        @elseif($item->type == 'radio')
                                            <div class="contact-info mb-2 text-start">
                                                <label class="radio-inline mr-3 mb-0">
                                                    <input type="radio" name="{{ $item->name }}" value="male">
                                                    {{ __('validation.attributes.frontend.male') }}
                                                </label>
                                                <label class="radio-inline mr-3 mb-0">
                                                    <input type="radio" name="{{ $item->name }}" value="female">
                                                    {{ __('validation.attributes.frontend.female') }}
                                                </label>
                                            </div>
                                        @elseif($item->type == 'textarea')
                                            <div class="contact-info mb-2">
                                                <textarea name="{{ $item->name }}"
                                                    placeholder="{{ __('labels.backend.general_settings.user_registration_settings.fields.' . $item->name) }}"
                                                    class="form-control mb-0">{{ old($item->name) }}</textarea>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif

                                @if (config('access.captcha.registration'))
                                    <div class="contact-info mt-3 text-center">
                                        {{ no_captcha()->display() }}
                                        {{ html()->hidden('captcha_status', 'true')->id('captcha_status') }}
                                        <span id="captcha-error" class="text-danger"></span>

                                    </div><!--col-->
                                @endif


                                <div class="contact-info mb-2 py-4">
                                    <div class="text-capitalize">
                                        <button class="btn btn-primary w-100" id="registerButton" type="submit"
                                            value="Submit">@lang('labels.frontend.modal.register_now')</button>
                                    </div>
                                </div>


                                <a href="{{ route('frontend.auth.teacher.register') }}"
                                    class="fgo-register float-left text-info mt-2">
                                    @lang('labels.teacher.teacher_register')
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@push('after-scripts')
    @if (session('openModel'))
        <script>
            $('#myModal').modal('show');
        </script>
    @endif


    @if (config('access.captcha.registration'))
        {{ no_captcha()->script() }}
    @endif

    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).ready(function() {
                $(document).on('click', '.go-login', function() {
                    $('#register').removeClass('active').addClass('fade')
                    $('#login').addClass('active').removeClass('fade')

                });
                $(document).on('click', '.go-register', function() {
                    $('#login').removeClass('active').addClass('fade')
                    $('#register').addClass('active').removeClass('fade')
                });

                $(document).on('click', '#openLoginModal', function(e) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('frontend.auth.login') }}",
                        success: function(response) {
                            $('#socialLinks').html(response.socialLinks)
                            $('#myModal').modal('show');
                        },
                    });
                });

                $('#loginForm').on('submit', function(e) {
                    e.preventDefault();

                    var $this = $(this);
                    $('.success-response').empty();
                    $('.error-response').empty();

                    $.ajax({
                        type: $this.attr('method'),
                        url: $this.attr('action'),
                        data: $this.serializeArray(),
                        dataType: $this.data('type'),
                        success: function(response) {
                            $('#login-email-error').empty();
                            $('#login-password-error').empty();
                            $('#login-captcha-error').empty();

                            if (response.errors) {
                                if (response.errors.email) {
                                    $('#login-email-error').html(response.errors.email[
                                        0]);
                                }
                                if (response.errors.password) {
                                    $('#login-password-error').html(response.errors
                                        .password[0]);
                                }

                                var captcha = "g-recaptcha-response";
                                if (response.errors[captcha]) {
                                    $('#login-captcha-error').html(response.errors[
                                        captcha][0]);
                                }
                            }
                            if (response.success) {
                                $('#loginForm')[0].reset();
                                if (response.redirect == 'back') {
                                    location.reload();
                                } else {
                                    window.location.href =
                                        "{{ route('admin.dashboard') }}"
                                }
                            }
                        },
                        error: function(jqXHR) {
                            var response = $.parseJSON(jqXHR.responseText);
                            console.log(jqXHR)
                            if (response.message) {
                                $('#login').find('span.error-response').html(response
                                    .message)
                            }
                        }
                    });
                });

                $(document).on('submit', '#registerForm', function(e) {
                    e.preventDefault();
                    console.log('he')
                    var $this = $(this);

                    $.ajax({
                        type: $this.attr('method'),
                        url: "{{ route('frontend.auth.register.post') }}",
                        data: $this.serializeArray(),
                        dataType: $this.data('type'),
                        success: function(data) {
                            $('#first-name-error').empty()
                            $('#last-name-error').empty()
                            $('#email-error').empty()
                            $('#password-error').empty()
                            $('#captcha-error').empty()
                            if (data.errors) {
                                if (data.errors.first_name) {
                                    $('#first-name-error').html(data.errors.first_name[
                                        0]);
                                }
                                if (data.errors.last_name) {
                                    $('#last-name-error').html(data.errors.last_name[
                                    0]);
                                }
                                if (data.errors.email) {
                                    $('#email-error').html(data.errors.email[0]);
                                }
                                if (data.errors.password) {
                                    $('#password-error').html(data.errors.password[0]);
                                }

                                var captcha = "g-recaptcha-response";
                                if (data.errors[captcha]) {
                                    $('#captcha-error').html(data.errors[captcha][0]);
                                }
                            }
                            if (data.success) {
                                $('#registerForm')[0].reset();
                                $('#register').removeClass('active').addClass('fade')
                                $('.error-response').empty();
                                $('#login').addClass('active').removeClass('fade')
                                $('.success-response').empty().html(
                                "@lang('labels.frontend.modal.registration_message')");
                            }
                        }
                    });
                });
            });

        });
    </script>
    <script>
        // ?\tesss
        $(document).ready(function() {
            $('#go-to-register').on('click', function() {
                $('#country').empty().append('<option value="" disabled selected>' +
                    '{{ __('labels.backend.general_settings.user_registration_settings.fields.country') }}' +
                    '</option>');
                    $.ajax({
                        url: '/country/',
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $.each(data, function(key, value) {
                                $('#country').append('<option value="' + value.id + '">' + value.name_{{app()->getLocale()}} + '</option>');
                            });
                            $('#country').prop('disabled', false);
                        },
                        error: function(error) {
                            console.error('Error fetching cities:', error);
                        }
                    });
            });
            $('#country').on('change', function() {
                var countryId = $(this).val();
                var citiesUrl = $('#country option:selected').data('url');
                $('#city').empty().append('<option value="" disabled selected>' +
                    '{{ __('labels.backend.general_settings.user_registration_settings.fields.city') }}' +
                    '</option>');

                    if (countryId) {
                        $.ajax({
                            url: '/city/' + countryId,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                $.each(data, function(key, value) {
                                    $('#city').append('<option value="' + value.id + '">' + value.name_{{app()->getLocale()}} + '</option>');
                                });
                                $('#city').prop('disabled', false);
                            },
                            error: function(error) {
                                console.error('Error fetching cities:', error);
                            }
                        });
                    } else {
                        $('#city').prop('disabled', true);
                    }
            });
        });
    </script>
@endpush
@section('js')


    <script src="{{asset('js/select2.full.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/intl-tel-input/js/intlTelInput.min.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-placeholder-single-country').select2();
            $('.js-example-placeholder-single-city').select2();
        });
    </script>

<script>
    const input = document.querySelector("#phone");
    const dCode = document.getElementById("d-code");
    var iti = window.intlTelInput(input, {
        utilsScript: "{{asset('plugins/intl-tel-input/js/utils.js')}}",
        showSelectedDialCode:true,
        initialCountry: "auto",
        geoIpLookup: function(callback) {
            fetch("https://ipapi.co/json")
            .then(function(res) { return res.json(); })
            .then(function(data) { callback(data.country_code); })
            .catch(function() { callback("us"); });
        }
    });
    var number = input.value; 
    var selectedCountryData;
    var dialCode; 
    var fullNumber;
    input.addEventListener('input', function() {
        selectedCountryData = iti.getSelectedCountryData();
        dialCode = selectedCountryData.dialCode; 
        input.value = input.value.replace(/\D/g, '');
        dCode.value = '+' + dialCode;
    });

    input.addEventListener('countrychange', function() {
        selectedCountryData = iti.getSelectedCountryData();
        dialCode = selectedCountryData.dialCode; 
        dCode.value = '+' + dialCode;
    });
  </script>
@endsection