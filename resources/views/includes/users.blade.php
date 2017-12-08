{{--{{ dd($dataTypeContent->toArray()) }}--}}

<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Users view page
            </h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="#" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">
                    -
                </li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">
                                    Users
                                </span>
                    </a>
                </li>
                <li class="m-nav__separator">
                    -
                </li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">
                                    Users ID
                                </span>
                    </a>
                </li>
            </ul>
        </div>
        <div>
            <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                <a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                    <i class="la la-plus m--hide"></i>
                    <i class="la la-ellipsis-h"></i>
                </a>
                <div class="m-dropdown__wrapper">
                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                    <div class="m-dropdown__inner">
                        <div class="m-dropdown__body">
                            <div class="m-dropdown__content">
                                <ul class="m-nav">
                                    <li class="m-nav__section m-nav__section--first m--hide">
                                                <span class="m-nav__section-text">
                                                    Quick Actions
                                                </span>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-share"></i>
                                            <span class="m-nav__link-text">
                                                        Activity
                                                    </span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-chat-1"></i>
                                            <span class="m-nav__link-text">
																	Messages
																</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-info"></i>
                                            <span class="m-nav__link-text">
																	FAQ
																</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                            <span class="m-nav__link-text">
																	Support
																</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__separator m-nav__separator--fit"></li>
                                    <li class="m-nav__item">
                                        <a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
                                            Submit
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
