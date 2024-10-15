<form action="{{ route('file.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="file">Choose File</label>
        <input type="file" name="file" id="file">
    </div>
    <div>
        <button type="submit">Upload File</button>
    </div>
</form>
