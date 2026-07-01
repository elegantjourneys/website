<style>
   :root {
        --brand:       #25365C;
        --brand-light: #f9ecec;
        --dot-gap:     1.75rem;
        --radius:      14px;
        --marker-col:  40px;
        --dot-size:    16px;
        --dot-top-pad: 21px; /* padding-top on .timeline-marker */
    }

    /* ── Wrapper ─────────────────────────────────────── */
    .itinerary-wrapper {
        position: relative;
        display: flex;
        flex-direction: column;
        gap: var(--dot-gap);
        margin-top: 2rem;
    }

    /* ── Row ─────────────────────────────────────────── */
    .itinerary-row {
        display: flex;
        align-items: flex-start;
        position: relative; /* anchor for .timeline-segment */
    }

    .timeline-segment {
        position: absolute;
        left: calc(var(--marker-col) / 2 - 1px);
        top: 0;          /* JS will set this */
        height: 0;       /* JS will set this */
        width: 0;
        border-left: 2px dotted var(--brand);
        z-index: 0;
        pointer-events: none;
    }

     .timeline-line {
        position: absolute;
        left: 19px;
        top: 40px;
        bottom: 16px;
        width: 0;
        border-left: 2px dotted var(--brand);
        z-index: 0;
    }

    .timeline-marker {
        position: relative;
        width: 40px;
        display: flex;
        justify-content: center;
        align-items: start;
        flex-shrink: 0;
    }

    .timeline-step {
        width: 16px;
        height: 16px;
        background-color: var(--brand);
        border-radius: 50%;
        z-index: 1;
        margin-top: 22px;
    }

    /* ── Card ────────────────────────────────────────── */
    .itinerary-card {
        flex-grow: 1;
        border-radius: var(--radius);
        overflow: hidden;
        background: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
        transition: box-shadow .25s ease, transform .25s ease;
    }

    .itinerary-card:hover {
        box-shadow: 0 8px 24px rgba(171,42,47,.12), 0 2px 6px rgba(0,0,0,.06);
        transform: translateY(-2px);
    }

    /* ── Accordion button ────────────────────────────── */
    .itinerary-card .accordion-button {
        background: #fff;
        padding: 1.1rem 1.4rem;
        display: flex;
        align-items: baseline;
        gap: .5rem;
        border: none;
        box-shadow: none;
        flex-wrap: wrap;
    }

    .itinerary-card .accordion-button:not(.collapsed) {
        background: var(--brand-light);
        color: inherit;
        box-shadow: none;
    }

    .itinerary-card .accordion-button:focus {
        box-shadow: 0 0 0 3px rgba(171,42,47,.2);
    }

    .itinerary-card .accordion-button::after {
        filter: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23AB2A2F'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }

    /* ── Labels ──────────────────────────────────────── */
    .day-label {
        font-family: 'Playfair Display', serif;
        font-size: .78rem;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: var(--brand);
        white-space: nowrap;
        min-width: 70px;
    }

    .city-label {
        font-family: 'DM Sans', sans-serif;
        font-size: 1rem;
        font-weight: 600;
        color: #1a1a1a;
        line-height: 1.3;
    }

    .label-divider {
        width: 1px;
        height: 1.1em;
        background: #ddd;
        align-self: center;
        flex-shrink: 0;
    }

    /* ── Collapse body ───────────────────────────────── */
    .itinerary-card .accordion-collapse {
        border-top: 1px solid #f0ebe8;
    }

    .event-list {
        padding: 1rem 1.4rem 1.2rem;
        display: flex;
        flex-direction: column;
        gap: .6rem;
    }

    .event-item {
        position: relative;
        padding-left: 1.1rem;
        font-size: .93rem;
        line-height: 1.65;
        color: #444;
    }

    .event-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: .65em;
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: var(--brand);
        opacity: .6;
    }

    .event-item p { margin: 0; }
</style>
<div class="container py-5" style="max-width:720px;">

    <h4 class="mb-1" style="font-family:'Playfair Display',serif;font-size:1.55rem;color:#1a1a1a;">
        Your Itinerary
    </h4>
    <p class="text-muted mb-4" style="font-size:.9rem;">Day-by-day tour summary</p>

    <div class="itinerary-wrapper" id="itineraryAccordion">
        <div class="timeline-line"></div>

        <?php
        $plans     = $data['tour_summary']['itinerary_plans'];
        $lastIndex = count($plans) - 1;
        foreach ($plans as $idx => $itineraryPlans):
            $cityListForDay = array_column($itineraryPlans['cities'], 'name');
            $collapseId     = 'collapse_day_' . (int) $itineraryPlans['day'];
            $isLast         = ($idx === $lastIndex);
        ?>

        <div class="itinerary-row" data-idx="<?= $idx ?>">
            <?php if (!$isLast): ?>
                <span class="timeline-segment" id="seg_<?= $idx ?>"></span>
            <?php endif; ?>

            <div class="timeline-marker">
                <div class="timeline-step"></div>
            </div>
            <div class="accordion itinerary-card w-100">
                <h2 class="accordion-header m-0">
                    <button
                        class="accordion-button"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#<?= htmlspecialchars($collapseId) ?>"
                        aria-expanded="true"
                        aria-controls="<?= htmlspecialchars($collapseId) ?>"
                    >
                        <span class="day-label">Day <?= (int) $itineraryPlans['day'] ?></span>
                        <span class="label-divider mx-2"></span>
                        <span class="city-label"><?= htmlspecialchars(implode(' → ', $cityListForDay)) ?></span>
                    </button>
                </h2>

                <div id="<?= htmlspecialchars($collapseId) ?>" class="accordion-collapse collapse show">
                    <div class="event-list">
                        <?php foreach ($itineraryPlans['events'] as $itineraryEvent): ?>
                            <div class="event-item"><?= $itineraryEvent['description'] ?></div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
