<?php
use Cake\Routing\Router;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tripadvisor Reviews PDF</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        h1 { text-align: center; }
        .review { margin-bottom: 20px; border-bottom: 1px solid #ddd; padding-bottom: 10px; }
        .review img { max-width: 100px; }
        .container { width: 90%; margin: auto; }
        .header { text-align: center; margin-bottom: 20px; }
        .header img { width: 200px; height: auto; }
        .border-top { border-top: 1px solid #ddd; margin-top: 20px; padding-top: 10px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        td { text-align: center; padding: 10px; }
        .reviewer { margin-bottom: 10px; }
        .reviewer img { border-radius: 50%; width: 30px; height: 30px; margin-right: 10px; vertical-align: middle; }
		.green {
    color: #00AA6C !important;
}
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <img src="<?= Router::url('/version1/image/trip-logo.png', true) ?>" alt="Trip Logo">
    </div>
	<table style="width: 100%; border-collapse: collapse;">
    <tr>
        <td style="white-space: nowrap;">
            <img src="<?= Router::url('/version1/image/circle-solid.svg', true) ?>" width="16" alt="circle">
			<img src="<?= Router::url('/version1/image/circle-solid.svg', true) ?>" width="16" alt="circle">
			<img src="<?= Router::url('/version1/image/circle-solid.svg', true) ?>" width="16" alt="circle">
			<img src="<?= Router::url('/version1/image/circle-solid.svg', true) ?>" width="16" alt="circle">
			<img src="<?= Router::url('/version1/image/circle-solid.svg', true) ?>" width="16" alt="circle">
			

        </td>
        <td style="padding-left: 2px; white-space: nowrap;">
            #949 of 2,172 Tours &amp; Activities in New Delhi
        </td>
    </tr>
    <tr>
        <td colspan="2">
            City Tours • Multi-day Tours • Historical &amp; Heritage Tours • Private Tours
        </td>
    </tr>
</table>
    <!-- Replace flexbox with table -->
    <table>
        <tr>
            <td><img src="<?= Router::url('/assets/image/journeys1.jpg', true) ?>" width="150" /></td>
            <td><img src="<?= Router::url('/assets/image/journeys2.jpg', true) ?>" width="150" /></td>
            <td><img src="<?= Router::url('/assets/image/journeys3.jpg', true) ?>" width="150" /></td>
            <td><img src="<?= Router::url('/assets/image/journeys4.jpg', true) ?>" width="150" /></td>
        </tr>
    </table>

    <?php foreach ($tripadvisorReviewList['tripAdvisor'] as $review): ?>
        <div class="border-top">
            <div class="reviewer">
                <img src="<?= Router::url('/assets/image/jen.jpg', true) ?>" alt="Reviewer">
                <strong><?= h($review['name']) ?></strong> - <span><?= h($review['place']) ?></span>
            </div>
            <strong><?= h($review['short_description']) ?></strong>
            <div><?= date("M Y", strtotime($review['review_date'])) ?></div>
            <p><?= h($review['long_description']) ?></p>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>
