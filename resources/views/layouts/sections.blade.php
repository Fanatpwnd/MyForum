
    <h1 align="center" class="text-info">Sections</h1>
    @foreach ($content as $item)
        <div style="padding: 10px;border-style: solid;border-width: 1px; margin-top: 2px; margin-left: 30px; margin-right: 30px;">
        <h3><a href='\Threads\{{$item->id}}'>{{ $item->name }}</a></h3>
        <p>{{ $item->desc }}</p>
        <p class='text-secondary'>Thread count: {{$item->threads->where('is_delete', false)->count()}}</p>
        </div>
    @endforeach