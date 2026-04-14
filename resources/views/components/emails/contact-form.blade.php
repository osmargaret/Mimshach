<!DOCTYPE html>
<html>
<head>
    <title>New Contact Form Submission</title>
</head>
<body>
    <h2>New Contact Form Submission</h2>
    
    <p><strong>Name:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    @if(isset($data['subject']))
        <p><strong>Subject:</strong> {{ $data['subject'] }}</p>
    @endif
    <p><strong>Message:</strong></p>
    <p>{{ $data['message'] }}</p>
</body>
</html>