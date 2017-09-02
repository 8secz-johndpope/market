<h1>Right</h1>
@foreach($categories as $category)
    <li class="list-group-item">{{$category->title}}</li>
    @endforeach