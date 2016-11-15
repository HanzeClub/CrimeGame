@extends('layouts.app')

@section('title', $page->name . ' Page')

@section('content')
    <p>
        Page name: {{ $page->name }}
    </p>
    @if(! $page->menuable)
        <p class="text-warning">
            This page can't be assigned to a menu item.
        </p>
    @elseif(! is_null($page->menu))
        <p>
            Belongs to <a href="{{ route('menus.show', $page->menu) }}">{{ $page->menu->name }}</a> menu.
        </p>
    @endif
    <p>
        Url to page is <a href="{{ route($page->route_name) }}">{{ $page->url }}</a>.
    </p>
    <p>
        Groups that have access to this page:
        {{ game()->getAllParentsFromGroup($page->group)->implode('name', ', ') }}.
    </p>
    <a href="{{ route('pages.edit', $page) }}" class="btn btn-primary">Edit page</a>
    <a href="{{ route('pages.index') }}" class="btn btn-default">Back to Pages</a>
@endsection
