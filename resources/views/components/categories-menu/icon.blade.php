{{-- Иконка категории --}}

@props(["node"])

<div class="CategoriesButton-icon">
    <img src="{{ $node->getIconUrl() }}" alt="{{ $node->icon }}"/>
</div>
