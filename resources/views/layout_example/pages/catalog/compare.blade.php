{{--Сравнение товаров--}}
@php
    $breadcrumbs = [
        [
            'name' => 'home',
            'link' => route('index'),
        ],
        [
            'name' => 'Сравнение товаров',
        ],
    ];
@endphp
@extends('layouts.layout')

@section('title', 'Catalog')

@section('meta_description', '')

@section('content')
    @include('layouts.blocks.breadcrumbs.breadcrumbs', ['title' => 'Сравнение товаров', 'breadcrumbs' => $breadcrumbs])

    <div class="Section">
        <div class="wrap">
            <article class="Article">
                <p>Разнообразный и богатый опыт постоянный количественный рост и сфера нашей активности обеспечивает
                    широкому кругу (специалистов) участие в формировании системы обучения кадров, соответствует насущным
                    потребностям. Идейные соображения высшего порядка, а также консультация с широким активом требуют
                    определения и уточнения соответствующий условий активизации.
                </p>
            </article>

            @include('pages.catalog.compare.index')
        </div>
    </div>
@endsection
