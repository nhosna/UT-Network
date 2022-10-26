


<div class="form-group row">
    <label for="role" class="col-md-4 col-form-label text-md-right">Super Privilege</label>

    <div class="col-md-6">

{{--        @foreach(['user','admin','super'] as $id => $role)--}}
{{--            <label for="{{$id}}">{{ucfirst($role)}}</label>--}}


{{--            <input type="radio" id="{{$id}}" name="role" value="{{ $role }}" {{$user->role===$role?'checked':''}}  >--}}


{{--        @endforeach--}}
{{--        --}}




        <label class="check-container">


            <input type="checkbox"   name="role" value="super"  {{$user->role==='super'?'checked':''}}>

            <span class="checkmark"></span>
        </label>



</div>
</div>
