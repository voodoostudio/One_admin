{{--{{ dd($dataTypeContent->toArray()) }}--}}

<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Users view page
            </h3>
        </div>
    </div>
</div>
<div class="m-content">
    <div class="row">
        <div class="col-xl-12">
            <div class="m-portlet m-portlet--full-height">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                User
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <!--begin::Widget 14-->
                    <div class="m-widget4">
                        <div class="row">
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Name
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->name }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Middle name
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->middle_name }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Last name
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->last_name }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Email
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->email }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Civility
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\Civility::all() as $civility)
                                                {{ ($dataTypeContent->civility == $civility->reference) ? $civility->value : '' }}
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Langue de correspon.
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\UserLanguage::all() as $language)
                                                {{ ($dataTypeContent->lng_corres == $language->reference) ? $language->value : '' }}
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Etat civil
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_status)
                                                {{ ($dataTypeContent->civil_status == $civil_status->reference) ? $civil_status->value : '' }}
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Date de naissance
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->birth_date }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Lieu de naissance
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->birthplace }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Nationalité
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                {{ ($dataTypeContent->nationality == $nationality->reference) ? $nationality->value : '' }}
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Profession
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->profession }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Service
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->service }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Entreprise
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->business }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Site Internet
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->website }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Email type
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                {{ ($dataTypeContent->email_type == $email_type->reference) ? $email_type->value : '' }}
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Phone type
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\Phone::all() as $phone_type)
                                                {{ ($dataTypeContent->phone_type == $phone_type->reference) ? $phone_type->value : '' }}
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Country code
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->country_code }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Phone
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->phone }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Moy. de con. préféré
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                {{ ($dataTypeContent->preferred_means_contact == $contact->reference) ? $contact->value : '' }}
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Name
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->first_name_coup }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Middle name
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->middle_name_coup }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Last name
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->last_name_coup }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Email
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->email_coup }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Civility
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\Civility::all() as $civility)
                                                {{ ($dataTypeContent->civility_coup == $civility->reference) ? $civility->value : '' }}
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Langue de correspon.
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\UserLanguage::all() as $language)
                                                {{ ($dataTypeContent->lng_corres_coup == $language->reference) ? $language->value : '' }}
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Etat civil
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_status)
                                                {{ ($dataTypeContent->civil_status_coup == $civil_status->reference) ? $civil_status->value : '' }}
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Date de naissance
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->birth_date_coup }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Lieu de naissance
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->birthplace_coup }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Nationalité
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                {{ ($dataTypeContent->nationality_coup == $nationality->reference) ? $nationality->value : '' }}
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Profession
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->profession_coup }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Service
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->service_coup }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Entreprise
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->business_coup }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Site Internet
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->website_coup }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Email type
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                {{ ($dataTypeContent->email_type_coup == $email_type->reference) ? $email_type->value : '' }}
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Phone type
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\Phone::all() as $phone_type)
                                                {{ ($dataTypeContent->phone_type_coup == $phone_type->reference) ? $phone_type->value : '' }}
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Country code
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->country_code_coup }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Phone
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->phone_coup }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Moy. de con. préféré
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                {{ ($dataTypeContent->preferred_means_contact_coup == $contact->reference) ? $contact->value : '' }}
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Name
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->first_name_child }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Middle name
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->middle_name_child }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Last name
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->last_name_child }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Email
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->email_child }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Civility
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\Civility::all() as $civility)
                                                {{ ($dataTypeContent->civility_child == $civility->reference) ? $civility->value : '' }}
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Langue de correspon.
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\UserLanguage::all() as $language)
                                                {{ ($dataTypeContent->lng_corres_child == $language->reference) ? $language->value : '' }}
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Etat civil
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_status)
                                                {{ ($dataTypeContent->civil_status_child == $civil_status->reference) ? $civil_status->value : '' }}
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Date de naissance
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->birth_date_child }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Lieu de naissance
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->birthplace_child }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Nationalité
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                {{ ($dataTypeContent->nationality_child == $nationality->reference) ? $nationality->value : '' }}
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Profession
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->profession_child }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Service
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->service_child }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Entreprise
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->business_child }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Site Internet
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->website_child }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Email type
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                {{ ($dataTypeContent->email_type_child == $email_type->reference) ? $email_type->value : '' }}
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Phone type
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\Phone::all() as $phone_type)
                                                {{ ($dataTypeContent->phone_type_child == $phone_type->reference) ? $phone_type->value : '' }}
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Country code
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->country_code_child }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Phone
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->phone_child }}
                                        </span>
                                    </div>
                                </div>
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Moy. de con. préféré
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                {{ ($dataTypeContent->preferred_means_contact_child == $contact->reference) ? $contact->value : '' }}
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
