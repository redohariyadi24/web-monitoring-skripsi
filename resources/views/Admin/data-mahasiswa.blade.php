<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Laravel App</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <!-- Isi Sidebar di sini -->
        <a href="#" onclick="toggleSidebar()">Hide Sidebar</a>
    </div>

    <!-- Konten Utama -->
    <div class="content">
        <!-- Tombol untuk memunculkan/hide sidebar -->
        <button onclick="toggleSidebar()">Show/Hide Sidebar</button>
        <!-- Konten Utama di sini -->
    </div>

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
