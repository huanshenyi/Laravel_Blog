@if($target_user->id != \Auth::id())
<div>
    @if(\Auth::user()->hasStar($target_user->id))
    <button class="btn btn-info like-button" like-value="1" like-user="{{$target_user->id}}" type="button">フォロー外す</button>
    @else
    <button class="btn btn-info like-button" like-value="0" like-user="{{$target_user->id}}" type="button">フォロー</button>
    @endif
</div>
@endif