
		<section class="categories">
		 	@foreach($base as $cat)
		 		<div class="table {{$cat->class}}">
		 			<h1>{{$cat->title}}</h1>
					 	<ul>
					 	@foreach($cat->children as $child)
					 		<li>{{$child->title}}</li>
					 	@endforeach
					 		<div class="read-more">
					 			<a href="#">more..</a>
					 		</div>
					 	</ul>
				 </div>
		 	@endforeach
		</section>
		<section class="spotligth">
		</section>