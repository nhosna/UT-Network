

<div class="initialbar  firstinitial d-flex flex-wrap justify-content-center justify-content-md-start" >


    <span class="initialbarlabel mr-2">First name</span>


    <div class=" text-center ">
        <ul class="pagination pagination-lg d-flex flex-wrap  justify-content-center">

            <li class="initialbarall page-item @if(!Request::has('first')) active @endif">
                <a class="page-link" href="{{route($route,  [  'group'=>$group,   'last'=>Request::input('last')  ] )}}" >All</a>
            </li>

            @foreach(['a','b','c','d','e','f','g','h','i','j','k','l','m' , 'n','o','p','q','r','s','t','u','v','w','x','y','z'  ] as $letter)

                <li class="page-item  @if(Request::input('first')===$letter) active @endif  "><a class="page-link" href="{{route($route,['group'=>  $group  ,'first'=>$letter,'last'=>Request::input('last') ])}}">{{ucfirst($letter)}}</a></li>

            @endforeach

        </ul>

    </div>
</div>

