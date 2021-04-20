{{-- Иконка категории --}}

@props(["icon"])

<div class="CategoriesButton-icon">
    @include('components.icons.departments.' . $icon)
</div>
