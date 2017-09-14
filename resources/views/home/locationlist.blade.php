@foreach($categories as $category)
    <li class="list-group-item" data-location="{{$category->id}}" data-children="{{count($category->children)}}"> {{$category->title}} @if(count($category->children)>0)<span class="glyphicon glyphicon-arrow-right floatright"></span>@endif <span class="glyphicon floatright select-arrow"></span> </li>
@endforeach