<form method="post" enctype="multipart/form-data"
      @if($data=='update')
      action="{{route('admin.pages.'.$data,$page->id)}}"
      @else
      action="{{route('admin.pages.'.$data)}}"
    @endif>
    @csrf
    @if($data=='update')
        @method('PUT')
    @endif
    <div class="form-group">
        <label for="title">Page title</label>
        <input value="{{$data=='update'?$page->title:''}}" name="title" required type="text" class="form-control"
               id="title" placeholder="Enter title">
    </div>
    <div class="form-group">
        <label for="icon">Choose Icon</label>
        <input type="file" class="form-control" name="pic" id="icon" placeholder="Choose File">
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>
