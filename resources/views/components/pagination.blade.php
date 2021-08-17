                                
    <div class="col-md-6 ">
       <span class="ml-3 mt-3">
        @if($model['last_page']==@$_REQUEST['page'])   
        Showing {{(($model['per_page']*$model['current_page']) - ($model['per_page'])+1)}} to {{$model['total']}} of {{ $model['total']}}
   
        @elseif(@$_REQUEST['page']==null &&$model['total']<11)
        
        @else
        Showing {{(($model['per_page']*$model['current_page']) - ($model['per_page'])+1)}} to {{ $model['per_page']*$model['current_page']}} of {{ $model['total']}}
        @endif
       </span>
    </div>

