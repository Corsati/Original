@extends('admin.layout.master')
@section('content')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <section class="content sectionFor">
        <form action="{{route('admin.users.upgradeToInstructor')}}" method="post" role="form" enctype="multipart/form-data">
            @csrf

            <input type="hidden" value="{{$object->id}}" name="id">
            <div class="modal-body">
                <div class="row" style="margin: 20px">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelFor">{{__('first_name')}}</label>
                            <input type="text" required name="first_name" value="{{$object->first_name}}" class="form-control inputFor">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelFor">{{__('last_name')}}</label>
                            <input type="text" required name="last_name" value="{{$object->last_name}}" class="form-control inputFor">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelFor">{{__('birth_date')}}</label>
                            <input type="text" name="birth_date" class="form-control hijri-date-input" required />

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelFor">{{__('gender')}}</label>
                            <select name="gender" class="form-control inputFor" required>
                                <option value=""  >{{__('choose_gender')}}</option>
                                <option value="male"  >{{__('male')}}</option>
                                <option value="female" >{{__('female')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelFor">{{__('nationality')}}</label>
                            <select   name="nationality" class="form-control inputFor" required>
                                @foreach($nationalities as $nationality)
                                    <option value="{{$nationality->id}}">{{$nationality->getTranslation('name', lang())}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelFor">{{__('language')}}</label>
                            <select class="form-control inputFor"  name="language" id="language"
                                    title="{{__('web.select')}}">
                                <option value="ar">{{__('web.ar')}}</option>
                                <option value="en">{{__('web.en')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group countryForm">
                        <label for="country">{{__('web.country')}} <span class="required-span">*</span></label>
                        <select class="form-control" name="country_id" id="country">
                            <option value="" selected hidden>{{__('web.country')}}</option>
                            @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group cityForm">
                        <label for="" class="d-block">{{__('web.select_city')}} </label>
                        <select class="form-control" name="city_id" id="citiesId">
                            <option value="" hidden>{{__('web.select_city')}}</option>
                        </select>
                    </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelFor">{{__('phone')}}</label>
                            <input type="number" required name="phone"  minlength="10" value="{{$object->phone}}" class="form-control inputFor">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="labelFor">{{__('email')}}</label>
                            <input type="email" required name="email" value="{{$object->email}}" class="form-control inputFor">
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="wrap">
                                <div class="valign-middle">
                                    <div class="custom-file-upload position-relative">
                                        <input type="file"  name="identification_img"  id="file" class="file_upload">
                                        <i class="fas fa-camera"></i>
                                        <label for="file" class="nameUpload">{{__('Identification_photo')}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="labelFor">{{__('bio')}}</label>
                            <textarea required class="form-control inputFor" rows="4" cols="50"name="bio"></textarea>
                        </div>
                    </div>


                    <div class="form-group textAreaDiv ">
                        <label for="fields">{{__('web.interested_fields')}} <span class="required-span">*</span></label>
                        <select class="selectpicker w-100 category" id="fields" name="category_id[]" multiple
                                title="{{__('web.select_category')}}">
                            @foreach($main as $category)
                                <option value="{{$category->id}}">{{$category->getTranslation('name', lang())}}</option>
                            @endforeach
                        </select>
                    </div>

                    <hr>

                    <div class="row" id="academy_container" style="width: 100%;">

                        <div class="col-sm-12">
                            <div class="flex flexSpace clickBtn">
                                <h4 style="color: #F00">{{__('academy')}}</h4>
                                <div id="more-academy">
                                    <i class="fas fa-plus"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="labelFor">{{__('title')}}</label>
                                <input   type="text" name="academy[1][title]" class="form-control inputFor">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="labelFor">{{__('details')}}</label>
                                <input   type="text" name="academy[1][details]" class="form-control inputFor">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="labelFor">{{__('proof')}}</label>

                                <div class="wrap">
                                    <div class="valign-middle">
                                        <div class="custom-file-upload position-relative">
                                            <input   type="file" id="file" name="academy[1][proof_image]" class="file_upload">
                                            <i class="fas fa-camera"></i>
                                            <label for="file" class="nameUpload">{{__('proof')}}</label>
                                        </div>
                                    </div>
                                </div>

                                {{--<input type="file" name="academy[1][proof_image]" class="form-control id-img" id="image" accept="image/*" required>--}}
                            </div>
                        </div>
                    </div>

                    <div class="row more_academy" style="width: 100%;"></div>
                    <div class="row" id="more_Teaching_Categories_container" style="width: 100%;color: #F00">

                        <div class="col-sm-12">
                            <div class="flex flexSpace clickBtn">
                                <h4>{{__('Teaching_Categories')}}</h4>
                                <div id="more_Teaching_Categories">
                                    <i class="fas fa-plus"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="labelFor">{{__('category')}}</label>
                                <select name="experience[1][category_id]" class="form-control inputFor"  >
                                    <option value="" selected hidden>{{__('choose_category')}}</option>
                                    @foreach($categories as$category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="labelFor">{{__('Experience_years')}}</label>
                                <input type="text"   name="experience[1][experience_years]" class="form-control inputFor">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="labelFor">{{__('Level_of_Experience')}}</label>
                                <select name="experience[1][experience_level]" class="form-control inputFor"  >
                                    <option value="" selected hidden>{{__('Level_of_Experience')}}</option>
                                    <option value="junior_level"  >{{__('junior')}}</option>
                                    <option value="mid_level"  >{{__('mid_level')}}</option>
                                    <option value="advanced_level"  >{{__('advanced')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <textarea class="form-control" name="experience[1][description]" placeholder="{{__('web.qualification_skill')}}"></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="row more_Teaching_Categories" style="width: 100%;"></div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-primary">{{__('save')}}</button>
            </div>
        </form>
    </section>
@endsection
<script src="{{asset('dashboard/js/jquery.js')}}"></script>

@section('script')
    <script>

        let x = 2;
        $(document).on('click', '#more-academy', function () {
            var $body = $('.more_academy');
            var ajax  = new XMLHttpRequest();
            ajax      .open("GET"   , "{{url('admin-user-qualifications')}}" + '/'+ x, false);
            ajax      .send();
            $body     .append(ajax.responseText);
            x++;
        });

        $(document).on('click', '#more_Teaching_Categories', function () {
            var $body = $('.more_Teaching_Categories');
            var ajax  = new XMLHttpRequest();
            ajax      .open("GET"   , "{{url('admin-user-teachings')}}" + '/'+ x, false);
            ajax      .send();
            $body     .append(ajax.responseText);
            x++;
        });

        $(document).on('click', '.deleteBtn', function () {
            $(this).parent().closest('.row').remove();
        });

        $('input[type="file"]').each(function() {
            var label        = $(this).parents('.custom-file-upload').find('label').text();
            label            = (label) ? label : '';
            $(this).wrap('<div class="input-file"></div>');
            $(this).before('<span class="file-selected">'+label+'</span>');

            $(this).change(function(e){
                var val = $(this).val();
                var filename  = val.replace(/^.*[\\\/]/, '');
                $(this).siblings('.file-selected').text(filename);
                $(this).siblings('.file-selected').addClass('color_blue');
            });
        });

        $('.input-file .btn').click(function() {
            $(this).siblings('input[type="file"]').trigger('click');
        });

    </script>

{{--------------Hijri Date----------------}}
    <script type="text/javascript">
        $(function () {
            initHijrDatePicker();
            initHijrDatePickerDefault();
            $('.disable-date').hijriDatePicker({
                minDate:"2020-01-01",
                maxDate:"2021-01-01",
                viewMode:"years",
                hijri:true,
                debug:true
            });
        });
        function initHijrDatePicker() {
            $(".hijri-date-input").hijriDatePicker({
                locale: "ar-sa",
                format: "DD-MM-YYYY",
                hijriFormat:"iYYYY-iMM-iDD",
                dayViewHeaderFormat: "MMMM YYYY",
                hijriDayViewHeaderFormat: "iMMMM iYYYY",
                showSwitcher: true,
                allowInputToggle: true,
                showTodayButton: false,
                useCurrent: true,
                isRTL: false,
                viewMode:'months',
                keepOpen: false,
                hijri: false,
                debug: true,
                showClear: true,
                showTodayButton: true,
                showClose: true
            });
        }

        function initHijrDatePickerDefault() {

            $(".hijri-date-default").hijriDatePicker();
        }

    </script>
    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-36251023-1']);
        _gaq.push(['_setDomainName', 'jqueryscript.net']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>
    <script>
        try {
            fetch(new Request("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", { method: 'HEAD', mode: 'no-cors' })).then(function(response) {
                return true;
            }).catch(function(e) {
                var carbonScript = document.createElement("script");
                carbonScript.src = "//cdn.carbonads.com/carbon.js?serve=CK7DKKQU&placement=wwwjqueryscriptnet";
                carbonScript.id = "_carbonads_js";
                document.getElementById("carbon-block").appendChild(carbonScript);
            });
        } catch (error) {
            console.log(error);
        }

        $('select#country').on('change', function (e) {
            var $CITYS          = $('#citiesId');
            $CITYS              .empty();
            var countryId       = $(this).val();
            $.ajax({
                type            : "POST",
                url             : "{{route('coursati.countries.cities')}}",
                dataType        : "json",
                data: {
                    'country_id': countryId,
                    '_token'    : '{{csrf_token()}}'
                },
                success         : function (data) {
                    $CITYS      .html(data);
                }
            });
        });
    </script>

@endsection
