@extends('layouts.dashboard')

@section('title') Create Shriram-One Content @endsection
@section('page_pre_title') @endsection
@section('page_title') Create Shriram-One Content @endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            {!! Form::open(['url' => route('cms.sone.content.save'),'id' => 'saveContent' ]) !!}
            <div class="mb-3 mt-3">
                <div class="form-group ">
                    {!! Form::label('slug', 'Slug', ['class' => 'form-label']) !!}
                    <div>
                        {!! Form::text('slug', null, ['class' => 'form-control']) !!}
                    </div>
                    @if ($errors->has('slug'))
                    <div class="text-danger">
                        <p>{{ $errors->first('slug') }}</p>
                    </div>
                    @endif
                </div>
            </div>
            <div class="accordion" id="accordion-example">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-1">
                        <button class="accordion-button " type="button" data-bs-toggle="collapse"
                            data-bs-target="#banner" aria-expanded="true">
                            Banner
                        </button>
                    </h2>
                    <div id="banner" class="accordion-collapse collapse show" data-bs-parent="#accordion-example">
                        <div class="accordion-body pt-0">
                            <label class="form-check">
                                <input class="form-check-input" type="checkbox" name="bannerAcc" id="bannerAcc">
                                <span class="form-check-label">Banner</span>
                            </label>
                            <div class="mb-3" id="bannerAccShow">
                                <div class="form-group">
                                    {!! Form::label('title', 'Title', ['class' => 'form-label']) !!}
                                    <div>
                                        {!! Form::text('title', null, ['class' => 'form-control']) !!}
                                    </div>
                                    @if ($errors->has('title'))
                                    <div class="text-danger">
                                        <p>{{ $errors->first('title') }}</p>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::label('description', 'Description', ['class' => 'form-label']) !!}
                                    <div>
                                        {!! Form::text('description', null, ['class' => 'form-control']) !!}
                                    </div>
                                    @if ($errors->has('description'))
                                    <div class="text-danger">
                                        <p>{{ $errors->first('description') }}</p>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::label('imgUrl', 'imgUrl', ['class' => 'form-label']) !!}
                                    <div>
                                        {!! Form::text('imgUrl', null, ['class' => 'form-control']) !!}
                                    </div>
                                    @if ($errors->has('imgUrl'))
                                    <div class="text-danger">
                                        <p>{{ $errors->first('imgUrl') }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-2">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#contentCard" aria-expanded="false">
                            Content Card
                        </button>
                    </h2>
                    <div id="contentCard" class="accordion-collapse collapse" data-bs-parent="#accordion-example">
                        <div class="accordion-body pt-0">
                            <label class="form-check">
                                <input class="form-check-input" type="checkbox" name="contentCardAcc"
                                    id="contentCardAcc">
                                <span class="form-check-label">Content Card</span>
                            </label>
                            <div class="mb-3" id="contentCardAccShow">
                                <div class="form-group">
                                    {!! Form::label('title', 'Title', ['class' => 'form-label']) !!}
                                    <div>
                                        {!! Form::text('title', null, ['class' => 'form-control']) !!}
                                    </div>
                                    @if ($errors->has('title'))
                                    <div class="text-danger">
                                        <p>{{ $errors->first('title') }}</p>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::label('description', 'Description', ['class' => 'form-label']) !!}
                                    <div>
                                        {!! Form::text('description', null, ['class' => 'form-control']) !!}
                                    </div>
                                    @if ($errors->has('description'))
                                    <div class="text-danger">
                                        <p>{{ $errors->first('description') }}</p>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::label('imgUrl', 'imgUrl', ['class' => 'form-label']) !!}
                                    <div>
                                        {!! Form::text('imgUrl', null, ['class' => 'form-control']) !!}
                                    </div>
                                    @if ($errors->has('imgUrl'))
                                    <div class="text-danger">
                                        <p>{{ $errors->first('imgUrl') }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-3">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#carouselCard" aria-expanded="false">
                            Carousel Card
                        </button>
                    </h2>
                    <div id="carouselCard" class="accordion-collapse collapse" data-bs-parent="#accordion-example">
                        <div class="accordion-body pt-0">
                            <label class="form-check">
                                <input class="form-check-input" type="checkbox" name="carouselCardAcc"
                                    id="carouselCardAcc">
                                <span class="form-check-label">Carousel Card</span>
                            </label>
                            <div class="mb-3 accordian-sub-card" id="carouselCardAccShow">
                                <div class="form-group mb-3">
                                    {!! Form::label('title', 'Title', ['class' => 'form-label']) !!}
                                    <div>
                                        {!! Form::text('title', null, ['class' => 'form-control']) !!}
                                    </div>
                                    @if ($errors->has('title'))
                                    <div class="text-danger">
                                        <p>{{ $errors->first('title') }}</p>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    {!! Form::label('description', 'Description', ['class' => 'form-label']) !!}
                                    <div>
                                        {!! Form::text('description', null, ['class' => 'form-control']) !!}
                                    </div>
                                    @if ($errors->has('description'))
                                    <div class="text-danger">
                                        <p>{{ $errors->first('description') }}</p>
                                    </div>
                                    @endif
                                </div>
                                <div class="mb-3 accordianSubCard" id="carouselCardAccItems" index="0">
                                    <h4>Item 1</h4>
                                    <div class="form-group mb-3">
                                        {!! Form::label('image', 'image', ['class' => 'form-label']) !!}
                                        <div>
                                            {!! Form::text('image', null, ['class' => 'form-control']) !!}
                                        </div>
                                        @if ($errors->has('image'))
                                        <div class="text-danger">
                                            <p>{{ $errors->first('image') }}</p>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        {!! Form::label('alt', 'alt', ['class' => 'form-label']) !!}
                                        <div>
                                            {!! Form::text('alt', null, ['class' => 'form-control']) !!}
                                        </div>
                                        @if ($errors->has('alt'))
                                        <div class="text-danger">
                                            <p>{{ $errors->first('alt') }}</p>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        {!! Form::label('heading', 'heading', ['class' => 'form-label']) !!}
                                        <div>
                                            {!! Form::text('heading', null, ['class' => 'form-control']) !!}
                                        </div>
                                        @if ($errors->has('heading'))
                                        <div class="text-danger">
                                            <p>{{ $errors->first('heading') }}</p>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        {!! Form::label('text', 'text', ['class' => 'form-label']) !!}
                                        <div>
                                            {!! Form::text('text', null, ['class' => 'form-control']) !!}
                                        </div>
                                        @if ($errors->has('text'))
                                        <div class="text-danger">
                                            <p>{{ $errors->first('text') }}</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-4">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#contentList" aria-expanded="false">
                            Content List
                        </button>
                    </h2>
                    <div id="contentList" class="accordion-collapse collapse" data-bs-parent="#accordion-example">
                        <div class="accordion-body pt-0">
                            <label class="form-check">
                                <input class="form-check-input" type="checkbox" name="contentListAcc"
                                    id="contentListAcc">
                                <span class="form-check-label">Content List</span>
                            </label>

                            <div class="mb-3 accordian-sub-card" id="contentListAccShow">
                                <div class="form-group mb-3">
                                    {!! Form::label('heading', 'heading', ['class' => 'form-label']) !!}
                                    <div>
                                        {!! Form::text('heading', null, ['class' => 'form-control']) !!}
                                    </div>
                                    @if ($errors->has('heading'))
                                    <div class="text-danger">
                                        <p>{{ $errors->first('heading') }}</p>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    {!! Form::label('description', 'description', ['class' => 'form-label']) !!}
                                    <div>
                                        {!! Form::text('description', null, ['class' => 'form-control']) !!}
                                    </div>
                                    @if ($errors->has('description'))
                                    <div class="text-danger">
                                        <p>{{ $errors->first('description') }}</p>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    {!! Form::label('imgUrl', 'imgUrl', ['class' => 'form-label']) !!}
                                    <div>
                                        {!! Form::text('imgUrl', null, ['class' => 'form-control']) !!}
                                    </div>
                                    @if ($errors->has('imgUrl'))
                                    <div class="text-danger">
                                        <p>{{ $errors->first('imgUrl') }}</p>
                                    </div>
                                    @endif
                                </div>
                                <div class="mb-3 accordianSubCard" id="contentListAccItems">
                                    <div class="row">
                                        <div class="col-6">
                                            <h4>Item 1</h4>
                                        </div>
                                        <div class="col-6 text-right">
                                            <i class="ti ti-circle-plus circle-plus icon addListItem"></i>
                                        </div>
                                    </div>
                                    <div class="itemList" index='0'>
                                        <div class="form-group mb-3">
                                            {!! Form::label('title', 'title', ['class' => 'form-label']) !!}
                                            <div>
                                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                                            </div>
                                            @if ($errors->has('title'))
                                            <div class="text-danger">
                                                <p>{{ $errors->first('title') }}</p>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            {!! Form::label('description', 'description', ['class' => 'form-label']) !!}
                                            <div>
                                                {!! Form::text('description', null, ['class' => 'form-control']) !!}
                                            </div>
                                            @if ($errors->has('description'))
                                            <div class="text-danger">
                                                <p>{{ $errors->first('description') }}</p>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            {!! Form::label('imgUrl', 'imgUrl', ['class' => 'form-label']) !!}
                                            <div>
                                                {!! Form::text('imgUrl', null, ['class' => 'form-control']) !!}
                                            </div>
                                            @if ($errors->has('imgUrl'))
                                            <div class="text-danger">
                                                <p>{{ $errors->first('imgUrl') }}</p>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-footer">
                <a class="btn btn-light" href="{{ route('cms.users.list') }}">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-warning']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $("#saveContent").on('submit', function (event) {
        event.preventDefault();
        banner = {}
        contentCard = {}
        carouselCard = {}
        contentList = {}
        contentkeys = ["banner", "contentCard", "carouselCard", "contentList"]
        ContentValues_banCont = ["title", "description", "imgUrl"]
        ContentValues_Caro = ["title", "description", "image", "alt", "heading", "text"]
        ContentValues_Cont = ["heading", "description", "imgUrl", "title", "description", "imgUrl"]
        if ($("#bannerAcc").is(":checked")) {
            $.each(ContentValues_banCont, function (index, val) {
                banner[val] = $('#banner #' + val).val()
            });
        }
        if ($("#contentCardAcc").is(":checked")) {
            $.each(ContentValues_banCont, function (index, val) {
                contentCard[val] = $('#contentCard #' + val).val()
            });
        }
        if ($("#carouselCardAcc").is(":checked")) {
            carouselCard['items'] = [];
            $.each(ContentValues_Caro, function (index, val) {
                if (index > 1) {
                    carouselCard['items'][val] = $('#carouselCard #' + val).val()
                } else {
                    carouselCard[val] = $('#carouselCard #' + val).val()
                }
            });
        }

        if ($("#contentListAcc").is(":checked")) {
            let list = [];
            $.each(ContentValues_Cont, function (index, val) {
                if (index > 2) {
                    let data = $('#contentList #contentListAccItems #' + val).serializeArray();
                    list.push(data)
                } else {
                    contentList[val] = $('#contentList #' + val).val()
                }
            });

            let loopCount=list[0].length;
            let data_=[];
            for (let i=0; i<loopCount;i++) {	
                let loopData=list.map(j=>j[i]);
                let obj=loopData.reduce((a,b)=>{
                            a[b.name]=b.value;
                            return a;
                        },{});
                data_=[...data_,obj];
            }
            console.log(data_)
            contentList['items']=data_;

            let finalData = {};
let slug = $('#slug').val();

finalData.banner = banner;
finalData.contentCard = contentCard;
finalData.carouselCard = carouselCard;
finalData.contentList = contentList;

console.log('finalData', finalData);

let paydata = {
    '_token': $('meta[name="csrf-token"]').attr('content'),
    'content': [finalData],
    'slug': slug,
};

console.log(paydata);

$.ajax({
    url: "http://one-cms/soneContent/save",
    type: "POST",
    data: paydata,
    dataType: 'json',
    success: function (data) {
        console.log(data);
    },
    error: function (error) {
        console.log(error);
    }
});
        }
    });
</script>
@endsection