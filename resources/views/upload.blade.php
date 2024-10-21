<form action="{{ route('file.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
    <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="file">Choose File</label>
        <input type="file" name="file" id="file">
    </div>
    <div>
        <button type="submit">Upload File</button>
    </div>
</form>
