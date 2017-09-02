@foreach($categories as $category)
    <li class="list-group-item">
       <h4>{{$category->title}}</h4>
        <p>{{$category->parentstring}}</p>
    </li>
@endforeach