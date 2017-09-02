@foreach($categories as $category)
    <li class="list-group-item">
        <a class="select-category-link">Select</a>

        <span class="suggest-title">{{$category->title}}</span>
        <p>{{$category->parentstring}}</p>
    </li>
@endforeach