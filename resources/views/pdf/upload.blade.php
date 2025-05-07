<html>
<head>
    <title>PDF Upload</title>
</head>
<body>
    <h2>PDF अपलोड करें</h2>
    <form action="{{ route('pdf.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="pdf_file" accept="application/pdf" required>
        <button type="submit">Upload</button>
    </form>
</body>
</html>