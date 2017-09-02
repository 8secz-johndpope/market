@foreach($categories as $category)
    <li class="list-group-item" data-category="{{$category->id}}">{{$category->title}}</li>
    @endforeach