@foreach($categories as $category)
    <li class="list-group-item" data-category="{{$category->id}}">
        <a class="select-category-link" data-category="{{$category->id}}">Select</a>
        <span class="suggest-title">{{$category->title}}</span>
        <p>{{$category->parentstring}}</p>
    </li>
@endforeach