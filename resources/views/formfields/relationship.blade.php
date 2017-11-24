{{--{{ dd($options) }}--}}
@if(isset($options->model) && isset($options->type))

	@if(class_exists($options->model))

		@php $relationshipField = @$options->column @endphp

		@if($options->type == 'belongsTo')

			@if(isset($view) && ($view == 'browse' || $view == 'read'))

				@php
					$relationshipData = (isset($data)) ? $data : $dataTypeContent;
                    dump($dataTypeContent);
					$model = app($options->model);
            		$query = $model::find($relationshipData->{$options->column});
            	@endphp

            	@if(isset($query))
					<p>{{ $query->{$options->label} }}</p>
				@else
					<p>No results</p>
				@endif

			@else

				<select class="form-control select2" name="{{ $relationshipField }}">
					@php
						$model = app($options->model);
	            		$query = $model::all();
                        $role_id = Auth::user()->role_id;
	            	@endphp
                    @if($role_id == 1)
                        @foreach($query as $relationshipData)
                            <option value="{{ $relationshipData->{$options->key} }}" @if($dataTypeContent->{$relationshipField} == $relationshipData->{$options->key}){{ 'selected="selected"' }}@endif>{{ $relationshipData->{$options->label} }}</option>
                        @endforeach
                    @else
                        @php
                            switch ($role_id) {
                                case 2:
                                    $name_role = DB::table('roles')->whereNotIn('id', ['1'])->pluck('display_name', 'id')->toArray();
                                    break;
                                case 3:
                                    $name_role = DB::table('roles')->whereNotIn('id', ['1,2'])->pluck('display_name', 'id')->toArray();
                                    break;
                                case 4:
                                    $name_role = DB::table('roles')->whereNotIn('id', ['1,2,3'])->pluck('display_name', 'id')->toArray();
                                    break;
                                case 5:
                                    $name_role = DB::table('roles')->whereNotIn('id', ['1,2,3,4,5'])->pluck('display_name', 'id')->toArray();
                                    break;
                            }
                        @endphp
                        @foreach ($name_role as $key => $item)
                            <option value="{{ $key }}" {{($dataTypeContent->{$relationshipField} == $key) ? 'selected' :  ''}}>{{ $item }}</option>
                        @endforeach
                    @endif
				</select>
			@endif

		@elseif($options->type == 'hasOne')

			@php

				$relationshipData = (isset($data)) ? $data : $dataTypeContent;

				$model = app($options->model);
        		$query = $model::where($options->column, '=', $relationshipData->id)->first();

			@endphp

			@if(isset($query))
				<p>{{ $query->{$options->label} }}</p>
			@else
				<p>None results</p>
			@endif

		@elseif($options->type == 'hasMany')

			@if(isset($view) && ($view == 'browse' || $view == 'read'))

				@php
					$relationshipData = (isset($data)) ? $data : $dataTypeContent;
					$model = app($options->model);
            		$selected_values = $model::where($options->column, '=', $relationshipData->id)->pluck($options->label)->all();
				@endphp

	            @if($view == 'browse')
	            	@php
	            		$string_values = implode(", ", $selected_values);
	            		if(strlen($string_values) > 25){ $string_values = substr($string_values, 0, 25) . '...'; }
	            	@endphp
	            	@if(empty($selected_values))
		            	<p>No results</p>
		            @else
	            		<p>{{ $string_values }}</p>
	            	@endif
	            @else
	            	@if(empty($selected_values))
		            	<p>No results</p>
		            @else
		            	<ul>
			            	@foreach($selected_values as $selected_value)
			            		<li>{{ $selected_value }}</li>
			            	@endforeach
			            </ul>
			        @endif
	            @endif

			@else

				@php
					$model = app($options->model);
            		$query = $model::where($options->column, '=', $dataTypeContent->id)->get();
				@endphp

				@if(isset($query))
					<ul>
						@foreach($query as $query_res)
							<li>{{ $query_res->{$options->label} }}</li>
						@endforeach
					</ul>

				@else
					<p>No results</p>
				@endif

			@endif

		@elseif($options->type == 'belongsToMany')

			@if(isset($view) && ($view == 'browse' || $view == 'read'))

				@php
					$relationshipData = (isset($data)) ? $data : $dataTypeContent;
	            	$selected_values = isset($relationshipData) ? $relationshipData->belongsToMany($options->model, $options->pivot_table)->pluck($options->label)->all() : array();
	            @endphp

	            @if($view == 'browse')
	            	@php
	            		$string_values = implode(", ", $selected_values);
	            		if(strlen($string_values) > 25){ $string_values = substr($string_values, 0, 25) . '...'; }
	            	@endphp
	            	@if(empty($selected_values))
		            	<p>No results</p>
		            @else
	            		<p>{{ $string_values }}</p>
	            	@endif
	            @else
	            	@if(empty($selected_values))
		            	<p>No results</p>
		            @else
		            	<ul>
			            	@foreach($selected_values as $selected_value)
			            		<li>{{ $selected_value }}</li>
			            	@endforeach
			            </ul>
			        @endif
	            @endif

			@else

				<select class="form-control select2" name="{{ $relationshipField }}[]" multiple>

			            @php
			            	$selected_values = isset($dataTypeContent) ? $dataTypeContent->belongsToMany($options->model)->pluck($options->key)->all() : array();
			                $relationshipOptions = app($options->model)->all();
			            @endphp

			            @foreach($relationshipOptions as $relationshipOption)
			                <option value="{{ $relationshipOption->{$options->key} }}" @if(in_array($relationshipOption->{$options->key}, $selected_values)){{ 'selected="selected"' }}@endif>{{ $relationshipOption->{$options->label} }}</option>
			            @endforeach

			    </select>

			@endif

		@endif

	@else

		cannot make relationship because {{ $options->model }} does not exist.

	@endif

@endif
