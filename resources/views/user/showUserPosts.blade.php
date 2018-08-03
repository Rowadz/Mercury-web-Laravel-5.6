@include('layouts.defaults')


@navBar(
  [
      'style' => 'grey darken-4 z-depth-4',
  ]
  )
@endnavBar
<div class="row" id="sortPostsUserProfile">
        <div class="col s12 m6">
            <form action="/posts/{{$user->name}}/" method="GET" id="sortingForm">
                {{-- @csrf --}}
                <div class="input-field col s12">
                        <select  id="sortOption">
                          <option value="" disabled selected>Choose your option</option>
                          <option value="Descending">Descending order Date</option>
                          <option value="Ascending">Ascending order Date</option>
                          <option value="comments">Number of comments</option>
                        </select>
                        <label>Via..</label>
                </div>
        </div>
        <div class="col s12 m6">
                <div class="input-field col s12">
                        <select  id="postsType">
                          <option value="" disabled selected>Choose your option</option>
                          <option value="Available">Available</option>
                          <option value="Archived">Archived</option>
                        </select>
                        <label>Show</label>
                      </div>
                      <div class="input-field col s12">
                    <button class="waves-effect waves-light btn" type="button" id="sortPostsUserProfileButton" >
                            Sort
                    </button>
                      </div>
                <input type="submit" value="" hidden>
            </div>  
        </form>      
</div>
<div class="row white-text">
    <h3>
        {{$sortType}} -  {{$postsType}} posts
    </h3>
</div>


{{ $posts->links('user.components.helperComponents.pagination', ['posts' => $posts]) }}
<div class="row">
    <div class="col s12 m12">
            @displayPosts(['posts' => $posts])
            @enddisplayPosts
    </div>
</div>
        
    
{{ $posts->links('user.components.helperComponents.pagination', ['posts' => $posts]) }}


@extends('layouts.defaultsBottom')


{{-- 

@section('content')
<div class="ui Stackable sixteen column grid centered" >
    <div class="row">
        <div class="ui form">
            <form action="/posts/{{$user->name}}/" method="GET" id="sortingForm">
                {{-- @csrf 
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
                    </div> 
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
@endsection --}}