<ul class="m-menu__subnav">
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
               /* $linkAttributes =  'href="#' . str_slug($item->title, '-') .'-dropdown-element11" ' . ' class="m-menu__link m-menu__toggle"';
                array_push($listItemClass, 'dropdown');*/
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

        <li class="m-menu__item {{ (implode(" ", $listItemClass) == 'active') ? 'm-menu__item--parent' : ''  }}" aria-haspopup="true">
            <a {!! $linkAttributes !!} class = "m-menu__link ">
                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                </i>
                <span class="m-menu__link-text">
                    {{ $item->title }}
                </span>
            </a>
        </li>

    @endforeach
</ul>
