@extends('base')

@section('title', $category->title_ru .' - '. 'Категория')

@section('main')
    <div class="row">
        <div class="col-12">
{{--            <h1 class="display-3">Category</h1>--}}
            <h2 class="display-5">{{ $category->title_ru }}</h2>
            @include('layouts.parts._flash-message')

            <div class="row mg-3">
                <div class="col">
                    <a href="{{ route('product.category.edit', [$category->id]) }}" class="btn btn-primary">Edit</a>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col">
                    <ul style="list-style: none; padding: 0;">
                    @for($i = 0, $j = count($dataCategory['breadcrumbs']) - 1; $i <= count($dataCategory['breadcrumbs']) - 1; $i++)
                        <li style=" display: inline-block; margin: 0px 10px 0px 0px; ">
                            @if( $i != $j )
                                <a href="{{ route('product.category.show', [$dataCategory['breadcrumbs'][$i]['id']]) }}"
                                   style=" display: block; padding: 0px 10px; background-color: #eee; color: #555; border: 1px solid #ccc; border-radius: 2px;">
                                    {{ $dataCategory['breadcrumbs'][$i]['title_ru'] }}
                                </a>
                            @elseif($i == $j)
                                <span style="padding: 1px 10px; background-color: unset; color: #333; border: 1px solid #ccc; border-radius: 2px; font-weight: bold;">
                                    {{ $dataCategory['breadcrumbs'][$i]['title_ru'] }}
                                </span>
                            @endif
                        </li>
                    @endfor
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <br>

    <div class="row">
        <div class="col col-12">

            <div class="row">
                <div class="col-2 text-right"><b>Title ru:</b></div>
                <div class="col-10">{{ $category->title_ru }}</div>
            </div>

            <div class="row">
                <div class="col-2 text-right"><b>Description ru:</b></div>
                <div class="col-10">
                    <p>{{ $category->description_ru }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-2 text-right"><b>Created at:</b></div>
                <div class="col-10">{{ $category->created_at }}</div>
            </div>

            <div class="row">
                <div class="col-2 text-right"><b>Updated at:</b></div>
                <div class="col-10">{{ $category->updated_at }}</div>
            </div>


        </div>
    </div>
    <br>



@endsection
