<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - Message</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">
    <div class="max-w-xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
        <h3 class="text-2xl font-semibold text-gray-700 mb-4">Message From</h3>

        <p class="mb-2"><strong class="font-medium">Name:</strong> <span class="text-gray-600">{{ $data->name }}</span></p>
        <p class="mb-2"><strong class="font-medium">Email:</strong> <span class="text-gray-600">{{ $data->email }}</span></p>
        <p class="mb-4"><strong class="font-medium">Message:</strong> <span class="text-gray-600">{!! str($data->message)->sanitizeHtml() !!}</span></p>

        <footer class="border-t border-gray-200 pt-4 mt-6 text-center text-sm text-gray-500">
            <p>© Copyright 2025 <a href="{{ url('/') }}" target="_blank" class="text-cyan-400 hover:underline" rel="noopener noreferrer">{{ config('app.name') }}</a> by <a href="{{ env('APP_OWNER_URL') }}" target="_blank" class="text-cyan-400 hover:underline" rel="noopener noreferrer">{{ env('APP_OWNER_NAME') }}</a>. All rights reserved.</p>
        </footer>
    </div>
</body>

</html>
