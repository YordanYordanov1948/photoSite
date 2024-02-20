<!DOCTYPE html>
<html>
<head>
    <title>New Contact Message</title>
</head>
<body>
    <p>You have received a new message from the contact form on your website:</p>
    <p><strong>Name:</strong> {{ $contactMessage['name'] }}</p>
    <p><strong>Email:</strong> {{ $contactMessage['email'] }}</p>
    <p><strong>Message:</strong> {{ $contactMessage['message'] }}</p>
</body>
</html>
