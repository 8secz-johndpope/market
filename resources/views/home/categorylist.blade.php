@foreach($categories as $category)
    <li class="list-group-item" data-category="{{$category->id}}" data-children="{{count($category->children)}}"> {{$category->title}} @if(count($category->children)>0)<span class="glyphicon glyphicon-arrow-right floatright"></span>@endif</li>
    @endforeach