<div class="row" style="height: 500px; overflow-y: scroll;" id="theme-collection">
    @foreach ($themes as $theme)
        <div class="col-lg-4 col-sm-6">
            <label>
                <input type="radio" name="backgroundTheme" value="{{$theme->id}}" data-background="{{$theme->theme}}" data-scheme="{{$theme->color_scheme}}">
                <span class="haha-img"></span>
                {{$theme->theme_name ?? ''}}
              </label>
            <div class="thumbnail">
                <div class="thumb" style="cursor: pointer;">
                    <img src="/assets/uploads/themes/{{$theme->theme ?? ''}}" alt="{{$theme->theme_name ?? ''}}" class="img-fluid img-thumbnail theme-wrapper" data-themeid="{{$theme->id}}">
                </div>
            </div>
        </div>
    @endforeach
</div>
