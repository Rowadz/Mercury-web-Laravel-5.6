@extends('layouts.app')
@section('content')
<div class="ui Stackable sixteen column grid centered" >
    <div class="row">
        <div class="ui form">
            <form action="/posts/{{$user->name}}/" method="GET" id="sortingForm">
                {{-- @csrf --}}
                <div class="inline fields">
                    <div class="field">
                        <label>Sort</label> 
                        <select  onchange="setUrlForSorting()" id="sortOption">
                            <option value="Descending">Descending order Date</option>
                            <option value="Ascending">Ascending order Date</option>
                            <option value="comments">Number of comments</option>
                        </select>
                    </div>
                    {{-- <input type="number" value="{{$user->id}}" hidden name="userId"> --}}
                    {{-- <div class="field">
                        <button class="ui right labeled icon button" type="submit" name="sortOptionButton">
                        <i class="right arrow icon"></i>
                            Sort
                        </button>
                    </div> --}}
                </div>
        </div>
        <div class="ui form">
            <div class="inline fields">
                <div class="field">
                    <label>
                        Show
                    </label>
                    <select onchange="setUrlForSortingAvailableArchived()" id="postsType">
                        <option value="Available">Available</option>
                        <option value="Archived">Archived</option>
                    </select>
                    <label>
                        Posts
                    </label>
                </div>

                <div class="field">
                    <button class="ui right labeled icon button" type="button" onclick="sortButton()">
                        <i class="right arrow icon"></i>
                            Show
                    </button>
                </div>
            </div>  
        </div>
        </form>      
    </div>
    <div class="row">
        <h3>
                {{$sortType}} -  {{$postsType}} posts
        </h3>
    </div>
</div>
{{ $posts->links('user.components.helperComponents.pagination', ['posts' => $posts]) }}
<div class=" column">
    <div class="ui link cards">
        @displayPosts(['posts' => $posts])
        @enddisplayPosts
    </div>
</div>
{{ $posts->links('user.components.helperComponents.pagination', ['posts' => $posts]) }}
@endsection