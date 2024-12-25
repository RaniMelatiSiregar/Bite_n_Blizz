<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/contact.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
    <body>
        @include('public.layouts.header')
        <div class="contact-container">
            <div class="contact-info">
                <h2>Contact Us</h2>
                <p>Our mailing address is:</p>
                <p><strong>152A Charlotte Street,<br>Peterborough ON</strong></p>
                <p>Phone: <a href="tel:7057423221">705-742-3221</a></p>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="icon"><i class="fab fa-google"></i></a>
                </div>
            </div>
            <div class="contact-form">
                <p>Great vision without great people is irrelevant.<br>Let's work together.</p>
                <form action="#" method="POST">
                    <input type="text" name="name" placeholder="Enter your Name" required>
                    <input type="email" name="email" placeholder="Enter a valid email address" required>
                    <textarea name="message" placeholder="Enter your message" rows="5" required></textarea>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
        <footer class="py-5">
            @include('public.layouts.footer')
        </footer>
    </body>
</html>
