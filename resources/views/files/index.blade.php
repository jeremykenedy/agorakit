@extends('app')



@section('content')

    @include('partials.grouptab')


    <div class="tab_content">

        @include('partials.invite')

        <h2>{{trans('messages.files_in_this_group')}}

            @can('create-file', $group)
                <a class="btn btn-primary btn-xs" href="{{ action('FileController@create', $group->id ) }}">
                    <i class="fa fa-plus"></i>
                    {{trans('messages.create_file_button')}}
                </a>
            @endcan

            @can('create-file', $group)
                <a class="btn btn-primary btn-xs" href="{{ action('FileController@createFolder', $group->id ) }}">
                    <i class="fa fa-plus"></i>
                    {{trans('messages.create_folder_button')}}
                </a>
            @endcan

        </h2>




        <table class="table table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>{{trans('messages.name')}}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                @if (isset($file))
                    <td>
                        @if ($file->parent)
                            <a href="{{ action('FileController@show', [$group->id, $file->parent->id]) }}">UP </a>
                        @else
                            <a href="{{ action('FileController@index', [$group->id]) }}">UP </a>
                        @endif
                    </td>

                @endif

                @forelse( $files as $file )
                    <tr>
                        <td>
                            <a href="{{ action('FileController@show', [$group->id, $file->id]) }}"><img src="{{ action('FileController@thumbnail', [$group->id, $file->id]) }}"/></a>
                        </td>

                        <td>
                            <div class="ellipsis" style="max-width: 30em">
                                <a  href="{{ action('FileController@show', [$group->id, $file->id]) }}">{{ $file->name }}</a>
                            </div>
                        </td>



                        <td>
                            @can('edit', $file)
                                <a class="btn btn-default btn-xs" href="{{ action('FileController@edit', [$group->id, $file->id]) }}"><i class="fa fa-edit"></i>
                                    {{trans('messages.edit')}}
                                </a>
                            @endcan

                            @can('delete', $file)
                                <a class="btn btn-warning btn-xs" href="{{ action('FileController@destroyConfirm', [$group->id, $file->id]) }}"><i class="fa fa-trash"></i>
                                    {{trans('messages.delete')}}
                                </a>
                            @endcan

                        </td>

                        <td>
                            @unless (is_null ($file->user))
                                <a href="{{ action('UserController@show', $file->user->id) }}">{{ $file->user->name }}</a>
                            @endunless
                        </td>

                        <td>
                            {{ $file->created_at }}
                        </td>
                    </tr>

                @empty
                    {{trans('messages.nothing_yet')}}
                @endforelse

            </tbody>
        </table>


        <a class="btn btn-default btn-xs" href="{{ action('FileController@gallery', $group->id ) }}"><i class="fa fa-camera-retro "></i>{{trans('messages.show_gallery')}}</a>

    </div>


@endsection
