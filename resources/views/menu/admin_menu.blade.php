<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">

    @php
        if (Voyager::translatable($items)) {
            $items = $items->load('translations');
        }

    @endphp

    @foreach ($items as $item)

        @php
            $originalItem = $item;
            if (Voyager::translatable($item)) {
                $item = $item->translate($options->locale);
            }

            // TODO - still a bit ugly - can move some of this stuff off to a helper in the future.
            $listItemClass = [];
            $styles = null;
            $linkAttributes = null;

            if(url($item->link()) == url()->current())
            {
                array_push($listItemClass,'active');
            }

            // With Children Attributes
            if(!$originalItem->children->isEmpty())
            {
                foreach($originalItem->children as $children)
                {
                    if(url($children->link()) == url()->current())
                    {
                        array_push($listItemClass,'active');
                    }
                }
                $linkAttributes =  'href="#" class="m-menu__link m-menu__toggle"';
                array_push($listItemClass, 'dropdown');
            }
            else
            {
                $linkAttributes =  'href="' . url($item->link()) .'"';
            }

            // Permission Checker
            $self_prefix = str_replace('/', '\/', $options->user->prefix);
            $slug = str_replace('/', '', preg_replace('/^\/'.$self_prefix.'/', '', $item->link()));

            if ($slug != '') {
                // Get dataType using slug
                $dataType = $options->user->dataTypes->first(function ($value) use ($slug) {
                    return $value->slug == $slug;
                });

                if ($dataType) {
                    // Check if datatype permission exist
                    $exist = $options->user->permissions->first(function ($value) use ($dataType) {
                        return $value->key == 'browse_'.$dataType->name;
                    });
                } else {
                    // Check if admin permission exists
                    $exist = $options->user->permissions->first(function ($value) use ($slug) {
                        return $value->key == 'browse_'.$slug && is_null($value->table_name);
                    });
                }

                if ($exist) {
                    // Check if current user has access
                    if (!in_array($exist->key, $options->user->user_permissions)) {
                        continue;
                    }
                }
            }

        @endphp

        <li id="{{ mb_strtolower($item->title) }}" class="m-menu__item  m-menu__item--{{ (implode(" ", $listItemClass) == 'active') ? 'active' : 'submenu'  }}" aria-haspopup="true" {{ (implode(" ", $listItemClass) == 'active') ? '' : 'data-menu-submenu-toggle=hover'  }} {{($item->title == 'Tools' && Auth::user()->role_id != 1) ? 'style=display:none' : ''}} >
            <a {!! $linkAttributes !!} class = "m-menu__link">
                <i class="m-menu__link-icon {{ $item->icon_class }}"></i>
                <span class="m-menu__link-text">{{ $item->title }}</span>
                @if(!$originalItem->children->isEmpty())
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                @endif
            </a>
            @if(!$originalItem->children->isEmpty())
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    @include('voyager::menu.submenu', ['items' => $originalItem->children, 'options' => $options, 'innerLoop' => true])
                </div>
            @endif
        </li>

        @if($item->title == "Dashboard")
            <li class="m-menu__section">
                <h4 class="m-menu__section-text">
                    Components
                </h4>
                <i class="m-menu__section-icon flaticon-more-v3"></i>
            </li>
        @endif
    @endforeach
</ul>
