@foreach($categories as $category)
    <li class="list-group-item">
       <span class="suggest-title">{{$category->title}}</span>
        <p>{{$category->parentstring}}</p>
        <a>Select</a>
    </li>
@endforeach