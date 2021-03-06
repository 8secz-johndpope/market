<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Statistics for {{$advert->param('title')}}</h4>
</div>
<div class="modal-body">
    <table>

        <tr>
            <td>
                <table class="table">
                    <tr>  <td>Views</td></td> <td>{{$advert->param('views')}}</td><td>Listing views</td></td> <td>{{$advert->param('list_views')}}</td></tr>
                    <tr>  <td>Number of replies</td></td> <td>{{$advert->replies}}</td><td>Times bumped up</td></td> <td>@if($advert->has_param('bumped')){{$advert->param('bumped')}} @else <span>0</span> @endif</td></tr>
                    <tr>  <td>Created</td></td> <td>{{$advert->first_created()}}</td><td>Last posted</td></td> <td> {{$advert->posted()}}</td></tr>
                    <tr>  <td>Ad id</td></td> <td>{{$advert->id}}</td> <td> </td></td> <td></tr>

                </table>
            </td>
        </tr>

    </table>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>