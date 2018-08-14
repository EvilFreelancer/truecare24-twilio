<!DOCTYPE html>
<html lang="en">
<head>
    <title>Click To Call Tutorial</title>
    <!-- We use Twitter Bootstrap as the default styling for our page-->
    <link rel="stylesheet"
          href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <!-- Include CSS for our third-party telephone input jQuery plugin-->
    <link rel="stylesheet" href="/vendor/intl-phone/css/intlTelInput.css">
</head>
<body>
<div class="container">
    <h1>Click To Call</h1>
    <p>Based on solution from official <a href="https://www.twilio.com/docs/voice/tutorials/click-to-call-php-laravel">demo
            application</a> by Twilio.</p>
    <hr>

    <!-- C2C contact form-->
    <div class="row">
        <div class="col-md-12">
            <form id="contactForm" role="form">
                <div class="form-group">
                    <h3>Call to Client</h3>
                    <ul class="help-block">
                        <li>When call icon is clicked, first Twilio calls the phone number #1 (Admin)</li>
                        <li>Once admin picked up the phone, the number #2 (provider) is called.</li>
                        <li>Both connected.</li>
                    </ul>
                </div>
                <label>Client's number</label>
                <div class="form-group">
                    <input class="form-control" type="text" name="userPhone" id="userPhone"
                           placeholder="+1 201-555-5555">
                </div>
                <button type="submit" class="btn btn-default">
                    Call to Client
                </button>
            </form>
        </div>
    </div>
</div>
<!-- Include page dependencies -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="/vendor/intl-phone/js/intlTelInput.min.js"></script>
<script src="/app.js"></script>
</body>
</html>
