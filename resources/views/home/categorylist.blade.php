@foreach($categories as $category)
    <li class="list-group-item" data-category="{{$category->id}}">{{$category->title}} @if(count($category->children)>0)<span class="glyphicon glyphicon-arrow-right"></span>@endif</li>
    @endforeach