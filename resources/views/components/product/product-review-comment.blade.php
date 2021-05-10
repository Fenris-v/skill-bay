<div class="Comment">
    <div class="Comment-column Comment-column_pict">
        <div class="Comment-avatar"></div>
    </div>
    <div class="Comment-column">
        <header class="Comment-header">
            <div>
                <strong class="Comment-title">{{ $review->name }}</strong>
                <span class="Comment-date">{{ $review->created_at->format('H:i \- d.m.Y') }}</span>
            </div>
        </header>
        <div class="Comment-content">{{ $review->comment }}</div>
    </div>
</div>
