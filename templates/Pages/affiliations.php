<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@400;500;600&display=swap');

.aff-page {
    font-family: 'Inter', sans-serif;
    background: #faf8f4;
}

.aff-hero-tag {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    padding: 48px 24px 24px;
}

.aff-hero-tag .line {
    flex: 1;
    height: 1px;
    background: #d4b87a;
    max-width: 60px;
}

.aff-hero-tag span {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 2.5px;
    color: #b48a37;
    text-transform: uppercase;
}

.aff-headline {
    text-align: center;
    padding: 0 24px 16px;
}

.aff-headline h2 {
    font-family: 'Playfair Display', serif;
    color: #1e2f5a;
    font-size: 36px;
    font-weight: 700;
    line-height: 1.25;
    margin: 0 0 16px;
}

.aff-headline p {
    color: #6b7a99;
    font-size: 15px;
    line-height: 1.8;
    max-width: 760px;
    margin: 0 auto;
}

.aff-divider {
    width: 48px;
    height: 3px;
    background: #b48a37;
    border-radius: 2px;
    margin: 0 auto 40px;
}

.aff-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
   /* padding: 0 40px 40px;
    max-width: 1200px;*/
    margin: 0 auto;
}

.aff-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #e8e2d6;
    border-left: 4px solid #b48a37;
    padding: 28px 26px;
    display: flex;
    gap: 20px;
    align-items: flex-start;
    transition: box-shadow 0.25s, transform 0.25s;
}

.aff-card:hover {
    box-shadow: 0 12px 36px rgba(30, 47, 90, 0.10);
    transform: translateY(-3px);
}

.aff-logo-circle {
    flex: 0 0 64px;
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background: #f4ead5;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.aff-logo-circle img {
    width: 42px;
    height: 42px;
    object-fit: contain;
}

.aff-card-body h4 {
    font-family: 'Playfair Display', serif;
    color: #1e2f5a;
    font-size: 17px;
    font-weight: 700;
    margin: 0 0 10px;
    line-height: 1.3;
}

.aff-card-body p {
    color: #6b7a99;
    font-size: 14px;
    line-height: 1.8;
    margin: 0;
}

.aff-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: #eef9f4;
    color: #0a7a48;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.5px;
    padding: 4px 12px;
    border-radius: 20px;
    margin-top: 12px;
}

/* TripAdvisor Section */

.trip-section-wrap {
    padding: 0 40px 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.trip-section {
    background: #fff;
    border-radius: 20px;
    border: 1px solid #e8e2d6;
    padding: 44px 48px;
    display: flex;
    gap: 40px;
    align-items: center;
}

.trip-logo-side {
    flex: 0 0 140px;
    text-align: center;
}

.trip-logo-side img {
    width: 130px;
    object-fit: contain;
}

.trip-divider {
    width: 1px;
    background: #e8e2d6;
    align-self: stretch;
    flex: 0 0 1px;
}

.trip-tag {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #f4ead5;
    color: #b48a37;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    padding: 5px 14px;
    border-radius: 20px;
    margin-bottom: 12px;
}

.trip-stars {
    font-size: 24px;
    color: #00aa6c;
    letter-spacing: 3px;
    margin-bottom: 10px;
}

.trip-section h3 {
    font-family: 'Playfair Display', serif;
    color: #1e2f5a;
    font-size: 26px;
    font-weight: 700;
    margin: 0 0 12px;
}

.trip-section p {
    color: #6b7a99;
    font-size: 14px;
    line-height: 1.85;
    margin: 0;
}

/* Review Cards Grid */

.trip-reviews-wrap {
    padding: 0 40px 60px;
    max-width: 1200px;
    margin: 0 auto;
}

.trip-reviews-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-top: 28px;
}

.trip-review-card {
    background: #fff;
    border: 1px solid #e8e2d6;
    border-top: 3px solid #00aa6c;
    border-radius: 16px;
    padding: 24px 22px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    transition: box-shadow 0.25s, transform 0.25s;
}

.trip-review-card:hover {
    box-shadow: 0 10px 30px rgba(30, 47, 90, 0.09);
    transform: translateY(-3px);
}

.trip-review-header {
    display: flex;
    align-items: center;
    gap: 12px;
}

.trip-reviewer-avatar {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: #1e2f5a;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Playfair Display', serif;
    font-size: 16px;
    font-weight: 700;
    color: #fff;
    flex-shrink: 0;
}

.trip-reviewer-info h5 {
    font-family: 'Inter', sans-serif;
    font-size: 14px;
    font-weight: 600;
    color: #1e2f5a;
    margin: 0 0 2px;
}

.trip-reviewer-info span {
    font-size: 12px;
    color: #9aa5bb;
}

.trip-review-stars {
    color: #00aa6c;
    font-size: 14px;
    letter-spacing: 1px;
    flex-shrink: 0;
    margin-left: auto;
}

.trip-review-title {
    font-family: 'Playfair Display', serif;
    font-size: 15px;
    font-weight: 700;
    color: #1e2f5a;
    margin: 0;
    line-height: 1.35;
}

.trip-review-body {
    font-size: 13px;
    color: #6b7a99;
    line-height: 1.8;
    margin: 0;
    display: -webkit-box;
    -webkit-line-clamp: 5;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.trip-view-all-wrap {
    text-align: center;
    margin-top: 32px;
    padding-bottom: 20px;
}

.trip-view-all {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #fff;
    color: #1e2f5a;
    font-family: 'Inter', sans-serif;
    font-size: 14px;
    font-weight: 600;
    padding: 13px 32px;
    border-radius: 50px;
    border: 2px solid #1e2f5a;
    text-decoration: none;
    letter-spacing: 0.3px;
    transition: background 0.2s, color 0.2s, transform 0.2s;
}

.trip-view-all:hover {
    background: #1e2f5a;
    color: #fff;
    transform: translateY(-2px);
    text-decoration: none;
}

.trip-view-all svg {
    width: 16px;
    height: 16px;
    flex-shrink: 0;
}

/* Responsive */
@media (max-width: 991px) {
    .aff-grid {
        grid-template-columns: 1fr;
        padding: 0 20px 32px;
    }

    .aff-headline h2 {
        font-size: 28px;
    }

    .trip-section-wrap {
        padding: 0 20px 40px;
    }

    .trip-section {
        flex-direction: column;
        padding: 32px 28px;
        text-align: center;
        gap: 24px;
    }

    .trip-divider {
        width: 60px;
        height: 1px;
        align-self: auto;
        flex: 0 0 1px;
    }

    .trip-reviews-wrap {
        padding: 0 20px 40px;
    }

    .trip-reviews-grid {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 575px) {
    .trip-reviews-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 575px) {
    .aff-card {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .aff-headline h2 {
        font-size: 24px;
    }
}

/* ── Video Testimonial Section ── */

.vt-section {
    background: #faf8f4;
    padding: 60px 40px;
    max-width: 1200px;
    margin: 0 auto;
}

.vt-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-top: 40px;
}

.vt-card {
    position: relative;
    border-radius: 14px;
    overflow: hidden;
    cursor: pointer;
    background: #1e2f5a;
    border: 1px solid #e8e2d6;
    transition: transform 0.25s, box-shadow 0.25s;
}

.vt-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 36px rgba(30, 47, 90, 0.15);
}

.vt-thumb {
    width: 100%;
    aspect-ratio: 4/3;
    object-fit: cover;
    display: block;
    transition: opacity 0.25s;
}

.vt-card:hover .vt-thumb {
    opacity: 0.85;
}

.vt-play {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -60%);
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.92);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s, transform 0.2s;
}

.vt-card:hover .vt-play {
    background: #b48a37;
    transform: translate(-50%, -60%) scale(1.1);
}

.vt-play svg {
    width: 16px;
    height: 16px;
    fill: #1e2f5a;
    margin-left: 3px;
    transition: fill 0.2s;
}

.vt-card:hover .vt-play svg {
    fill: #fff;
}

.vt-info {
    padding: 12px 14px 14px;
    background: #fff;
}

.vt-info h5 {
    font-family: 'Playfair Display', serif;
    color: #1e2f5a;
    font-size: 14px;
    font-weight: 700;
    margin: 0 0 4px;
    line-height: 1.3;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.vt-country {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 11px;
    font-weight: 600;
    color: #b48a37;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.vt-country svg {
    width: 11px;
    height: 11px;
    stroke: #b48a37;
    fill: none;
}

.vt-view-all-wrap {
    text-align: center;
    margin-top: 36px;
}

.vt-view-all {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #1e2f5a;
    color: #fff;
    font-family: 'Inter', sans-serif;
    font-size: 14px;
    font-weight: 600;
    padding: 13px 32px;
    border-radius: 50px;
    text-decoration: none;
    letter-spacing: 0.3px;
    transition: background 0.2s, transform 0.2s;
}

.vt-view-all:hover {
    background: #b48a37;
    transform: translateY(-2px);
    color: #fff;
    text-decoration: none;
}

.vt-view-all svg {
    width: 16px;
    height: 16px;
    stroke: #fff;
    fill: none;
    flex-shrink: 0;
}

@media (max-width: 1199px) {
    .vt-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 767px) {
    .vt-section {
        padding: 40px 20px;
    }

    .vt-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 14px;
    }
}

@media (max-width: 480px) {
    .vt-grid {
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }
}
</style>

<!-- HERO SECTION -->
<section class="heroSection w-100 px-0 py-3">

    <div class="px-2 mx-2 px-md-5 mx-md-5">
        <?php echo $this->element('common/breadcrumb-ver2'); ?>
    </div>

    <div class="position-relative">
        <img
            src="<?= WEBROOT ?>assets/image/affilations.webp"
            alt="Elegant Journeys Affiliations"
            class="img-fluid d-block mx-auto"
        />
    </div>

</section>

<!-- AFFILIATIONS SECTION -->
<section class="aff-page">

    <div class="aff-hero-tag">
        <div class="line"></div>
        <span>Trusted Affiliations &amp; Certifications</span>
        <div class="line"></div>
    </div>

    <div class="aff-headline">
        <h2>Recognized by India's Leading<br>Tourism Organizations</h2>
        <p>
            Elegant Journeys proudly maintains affiliations with India's most respected tourism
            associations and government-recognized bodies. These partnerships reflect our commitment
            to professional excellence, responsible tourism, sustainability, and delivering
            exceptional travel experiences to travelers from around the world.
        </p>
    </div>
    <div class="aff-divider"></div>

    <div class="aff-grid mb-5">

        <!-- Ministry of Tourism -->
        <div class="aff-card">
            <div class="aff-logo-circle">
                <img src="<?= WEBROOT ?>version2/assets/images/experienced-tour-operator.png"
                     alt="Ministry of Tourism, Government of India">
            </div>
            <div class="aff-card-body">
                <h4>Ministry of Tourism, Government of India</h4>
                <p>
                    Recognized as an Approved Inbound Tour Operator by the Ministry of Tourism,
                    Government of India — reflecting our compliance with national tourism standards
                    and commitment to delivering safe, authentic and high-quality travel experiences.
                </p>
                <div class="aff-badge">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>
                    Government Approved
                </div>
            </div>
        </div>

        <!-- IATO -->
        <div class="aff-card">
            <div class="aff-logo-circle">
                <img src="<?= WEBROOT ?>version2/assets/images/elegant-journeys-iato-active-member-logo.png"
                     alt="Indian Association of Tour Operators IATO">
            </div>
            <div class="aff-card-body">
                <h4>Indian Association of Tour Operators (IATO)</h4>
                <p>
                    A proud member of IATO — India's premier association of professional tour
                    operators. Membership reflects our dedication to maintaining high standards of
                    service, transparency and professionalism throughout every stage of the travel
                    experience.
                </p>
                <div class="aff-badge">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    Active Member
                </div>
            </div>
        </div>

        <!-- FAITH -->
        <div class="aff-card">
            <div class="aff-logo-circle">
                <img src="<?= WEBROOT ?>version2/assets/images/faith-indian-tourism-hospitality-affiliation.png"
                     alt="FAITH Federation of Associations in Indian Tourism and Hospitality">
            </div>
            <div class="aff-card-body">
                <h4>FAITH</h4>
                <p>
                    Federation of Associations in Indian Tourism &amp; Hospitality — the collective
                    voice of India's travel and hospitality sector. Our association with FAITH keeps
                    us aligned with industry best practices and contributes to the continued growth
                    of sustainable tourism in India.
                </p>
                <div class="aff-badge">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    Industry Member
                </div>
            </div>
        </div>

        <!-- TOFT -->
        <div class="aff-card">
            <div class="aff-logo-circle">
                <img src="<?= WEBROOT ?>version2/assets/images/elegant-journeys-toft-sustainable-tourism-logo.png"
                     alt="TOFTigers Sustainable Tourism">
            </div>
            <div class="aff-card-body">
                <h4>TOFTigers</h4>
                <p>
                    Through our association with TOFTigers, we support responsible tourism and
                    conservation-focused travel. This affiliation reflects our commitment to
                    protecting India's natural heritage, supporting local communities and promoting
                    environmentally conscious travel experiences.
                </p>
                <div class="aff-badge">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 8C8 10 5.9 16.17 3.82 19.26A1 1 0 0 0 4.69 21h.86a1 1 0 0 0 .91-.59C7.71 17.23 12 13 21 13"/><path d="M17 8l3-3"/><path d="M17 8v5"/></svg>
                    Eco-Certified
                </div>
            </div>
        </div>

    </div>

    <!-- TripAdvisor -->
    <div class="trip-section-wrap">
        <div class="trip-section">

            <div class="trip-logo-side">
                <img src="<?= WEBROOT ?>version2/assets/images/tripadvisor-logo.png"
                     alt="TripAdvisor 5 Star Rating">
            </div>

            <div class="trip-divider"></div>

            <div>
                <div class="trip-tag">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    Traveler Reviews
                </div>
                <div class="trip-stars">★★★★★</div>
                <h3>Rated 5.0 on TripAdvisor</h3>
                <p>
                    The trust of our travelers is our greatest achievement. Elegant Journeys is proud
                    to maintain a 5.0 rating on TripAdvisor, reflecting consistently outstanding
                    service, expertly curated travel experiences, knowledgeable local guides, and
                    dedicated customer support from planning to journey completion.
                </p>
            </div>

        </div>
    </div>

    <!-- TripAdvisor Review Cards -->
    <div class="trip-reviews-wrap">

        <div class="trip-reviews-grid">

            <!-- Review 1 -->
            <div class="trip-review-card">
                <div class="trip-review-header">
                    <div class="trip-reviewer-avatar">E</div>
                    <div class="trip-reviewer-info">
                        <h5>Elizabeth R.</h5>
                        <span>Alexandria, VA, USA</span>
                    </div>
                    <div class="trip-review-stars">★★★★</div>
                </div>
                <p class="trip-review-title">Perfection  do not hesitate</p>
                <p class="trip-review-body">Visiting India was a lifelong dream. A friend recommended Elegant Journeys and our high expectations were exceeded. Mr. Vivek Wadhawan is extremely responsive and organizes incredible, customized trips. As a mother-daughter pair, the itinerary was perfection, the guides knowledgeable, and the Oberoi accommodations beyond wonderful. We felt safe and comfortable throughout.</p>
            </div>

            <!-- Review 2 -->
            <div class="trip-review-card">
                <div class="trip-review-header">
                    <div class="trip-reviewer-avatar">J</div>
                    <div class="trip-reviewer-info">
                        <h5>Jenny T.</h5>
                        <span>St Leonards, Australia</span>
                    </div>
                    <div class="trip-review-stars">★★★★</div>
                </div>
                <p class="trip-review-title">Beyond My Expectations</p>
                <p class="trip-review-body">Absolutely everything exceeded my expectations far and away more than I thought possible. Perfection from day 1 to day 14. Amazing itinerary, the best driver, wonderful guides, and sublime accommodation. If you plan to visit India, do yourself a favour and go with this company.</p>
            </div>

            <!-- Review 3 -->
            <div class="trip-review-card">
                <div class="trip-review-header">
                    <div class="trip-reviewer-avatar">N</div>
                    <div class="trip-reviewer-info">
                        <h5>Nir E.</h5>
                        <span>Austin, TX, USA</span>
                    </div>
                    <div class="trip-review-stars">★★★★★</div>
                </div>
                <p class="trip-review-title">Highly recommended — knowledgeable guides</p>
                <p class="trip-review-body">They arranged one of the best tours we ever had. The guides and driver were extremely knowledgeable, polite, and helpful. The service was excellent — they treat you like a maharaja, nothing is too much. Recommended hotels were great too. Not a single mistake on a two-week trip.</p>
            </div>

            <!-- Review 4 -->
            <div class="trip-review-card">
                <div class="trip-review-header">
                    <div class="trip-reviewer-avatar">L</div>
                    <div class="trip-reviewer-info">
                        <h5>L. Holland</h5>
                        <span>100+ countries traveled</span>
                    </div>
                    <div class="trip-review-stars">★★★★★</div>
                </div>
                <p class="trip-review-title">'Incredible' Experience in 'Incredible' India</p>
                <p class="trip-review-body">Having travelled to more than 100 countries, I can honestly say my experience in India organised through Elegant Journeys exceeded anything I have ever done before. All aspects were handled professionally and expertly. Our whole experience far exceeded expectations — continually checking throughout the trip.</p>
            </div>

            <!-- Review 5 -->
            <div class="trip-review-card">
                <div class="trip-review-header">
                    <div class="trip-reviewer-avatar">B</div>
                    <div class="trip-reviewer-info">
                        <h5>Billie E.</h5>
                        <span>Haifa, Israel</span>
                    </div>
                    <div class="trip-review-stars">★★★★★</div>
                </div>
                <p class="trip-review-title">A fantastic trip in Rajasthan</p>
                <p class="trip-review-body">The trip to Rajasthan with Elegant Journey was the best experience ever — I keep coming back with small variations and bring my friends. The hotels and food were outstanding. The car and driver were just like family — always on time, excellent drivers with cold water and snacks. Highly recommend for trips anywhere in India.</p>
            </div>

            <!-- Review 6 -->
            <div class="trip-review-card">
                <div class="trip-review-header">
                    <div class="trip-reviewer-avatar">J</div>
                    <div class="trip-reviewer-info">
                        <h5>John G.</h5>
                        <span>Perth, Australia</span>
                    </div>
                    <div class="trip-review-stars">★★★★★</div>
                </div>
                <p class="trip-review-title">Arrangements were meticulous — itinerary fantastic</p>
                <p class="trip-review-body">Cannot rate Elegant Journeys highly enough. This trip totally exceeded our very high expectations. A stress-free, luxurious armchair ride through India. The planning was meticulous and the suggested itinerary was fantastic. We have travelled with many luxury private travel companies but would certainly rate Elegant Journeys as the best of the best.</p>
            </div>

        </div>

        <div class="trip-view-all-wrap">
            <a class="trip-view-all" href="<?= WEBROOT ?>tripadvisor-review">
                Read All Reviews
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg>
            </a>
        </div>

    </div>

</section>

<!-- VIDEO TESTIMONIAL SECTION -->
<section style="background:#faf8f4; padding-bottom: 60px;">
<div class="vt-section">

    <div class="aff-hero-tag" style="padding-top:0;">
        <div class="line"></div>
        <span>Guest Video Testimonials</span>
        <div class="line"></div>
    </div>

    <div class="aff-headline" style="padding-bottom:0;">
        <h2>Real Voices. Real Journeys.</h2>
        <p>
            Watch real travelers share their unforgettable experiences across India —
            from the Golden Triangle to Rajasthan and beyond.
        </p>
    </div>
    <div class="aff-divider"></div>

    <div class="vt-grid">

        <a class="vt-card" href="<?= WEBROOT ?>video-testimonial/alex-olga-luxury-india-tour-review">
            <img class="vt-thumb" src="https://www.elegantjourneys.com/repositery/video/image/1693112092_alex-olga-j.png" alt="Alex Olga J. India Tour Review">
            <div class="vt-play"><svg viewBox="0 0 24 24"><path d="M5 3l14 9-14 9V3z"/></svg></div>
            <div class="vt-info">
                <h5>Alex Olga J.</h5>
                <span class="vt-country"><svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>USA</span>
            </div>
        </a>

        <a class="vt-card" href="<?= WEBROOT ?>video-testimonial/clay-juan-luxury-india-tour-review">
            <img class="vt-thumb" src="https://www.elegantjourneys.com/repositery/video/image/clay.png" alt="Clay Y. Juan C. India Tour Review">
            <div class="vt-play"><svg viewBox="0 0 24 24"><path d="M5 3l14 9-14 9V3z"/></svg></div>
            <div class="vt-info">
                <h5>Clay Y. &amp; Juan C.</h5>
                <span class="vt-country"><svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>USA</span>
            </div>
        </a>

        <a class="vt-card" href="<?= WEBROOT ?>video-testimonial/doraliz-delis-luxury-india-tour-review">
            <img class="vt-thumb" src="https://www.elegantjourneys.com/repositery/video/image/doraliz.png" alt="Doraliz Delis O. India Tour Review">
            <div class="vt-play"><svg viewBox="0 0 24 24"><path d="M5 3l14 9-14 9V3z"/></svg></div>
            <div class="vt-info">
                <h5>Doraliz Delis O.</h5>
                <span class="vt-country"><svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>UAE / Puerto Rico</span>
            </div>
        </a>

        <a class="vt-card" href="<?= WEBROOT ?>video-testimonial/evelyn-c-luxury-india-tour-review">
            <img class="vt-thumb" src="https://www.elegantjourneys.com/repositery/video/image/evenly.png" alt="Evelyn C. India Tour Review">
            <div class="vt-play"><svg viewBox="0 0 24 24"><path d="M5 3l14 9-14 9V3z"/></svg></div>
            <div class="vt-info">
                <h5>Evelyn C.</h5>
                <span class="vt-country"><svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>USA</span>
            </div>
        </a>

        <a class="vt-card" href="<?= WEBROOT ?>video-testimonial/india-luxury-golden-triangle-tour-review-gemma-vincent">
            <img class="vt-thumb" src="https://www.elegantjourneys.com/repositery/video/image/gemma.png" alt="Gemma Vincent R. India Tour Review">
            <div class="vt-play"><svg viewBox="0 0 24 24"><path d="M5 3l14 9-14 9V3z"/></svg></div>
            <div class="vt-info">
                <h5>Gemma &amp; Vincent R.</h5>
                <span class="vt-country"><svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>Australia</span>
            </div>
        </a>

        <a class="vt-card" href="<?= WEBROOT ?>video-testimonial/luxury-golden-triangle-tour-india-review-graham-p-ling-p">
            <img class="vt-thumb" src="https://www.elegantjourneys.com/repositery/video/image/grahm.png" alt="Graham P. Ling P. India Tour Review">
            <div class="vt-play"><svg viewBox="0 0 24 24"><path d="M5 3l14 9-14 9V3z"/></svg></div>
            <div class="vt-info">
                <h5>Graham &amp; Ling P.</h5>
                <span class="vt-country"><svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>Australia</span>
            </div>
        </a>

        <a class="vt-card" href="<?= WEBROOT ?>video-testimonial/luxury-family-tour-india-review-hugh-elizabeth-s">
            <img class="vt-thumb" src="https://www.elegantjourneys.com/repositery/video/image/hugh.png" alt="Hugh Elizabeth S. Family India Tour Review">
            <div class="vt-play"><svg viewBox="0 0 24 24"><path d="M5 3l14 9-14 9V3z"/></svg></div>
            <div class="vt-info">
                <h5>Hugh &amp; Elizabeth S.</h5>
                <span class="vt-country"><svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>USA</span>
            </div>
        </a>

        <a class="vt-card" href="<?= WEBROOT ?>video-testimonial/india-luxury-tour-review-james-bonnie">
            <img class="vt-thumb" src="https://www.elegantjourneys.com/repositery/video/image/james.png" alt="James Bonnie P. India Tour Review">
            <div class="vt-play"><svg viewBox="0 0 24 24"><path d="M5 3l14 9-14 9V3z"/></svg></div>
            <div class="vt-info">
                <h5>James &amp; Bonnie P.</h5>
                <span class="vt-country"><svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>USA</span>
            </div>
        </a>

    </div>

    <div class="vt-view-all-wrap">
        <a class="vt-view-all" href="<?= WEBROOT ?>video-testimonial">
            View All Testimonials
            <svg viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg>
        </a>
    </div>

</div>
</section>