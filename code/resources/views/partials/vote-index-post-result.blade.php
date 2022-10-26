
@if($type==='like')

    {{ $value  [0] }} likes & {{ $value[1] }} dislikes

@elseif($type==='percent')
    {{floor($value[0] ) }}% from {{ $value[1] }} votes


@elseif($type==='poll')
    {{ $value[1] }} votes

@endif

