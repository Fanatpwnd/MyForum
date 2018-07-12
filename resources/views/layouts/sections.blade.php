
@can('update', new \App\Section) <!-- fuck -->
<script>
function hideEdit(id) {
    var x = document.getElementById("section"+id);
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
} 
</script>
@endcan
<h1 align="center" class="text-info">@lang('sections.section')</h1>
@foreach ($content as $item)
    <div style="padding: 10px;border-style: solid;border-width: 1px; margin-top: 2px; margin-left: 30px; margin-right: 30px;">
    <h3><a href='\Threads\{{$item->id}}'>{{ $item->name }}</a></h3>
    <p>{{ $item->desc }}</p>
    <p class='text-secondary'>@lang('sections.count'): {{$item->threads->where('is_delete', false)->count()}}</p>
    @can('delete', $item)
                <form action="\DeleteSection" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$item->id}}">
                <input type="submit" value="@lang('sections.delete')">
                </form>
    @endcan
    @can('update', $item)
                <input type="button" value="@lang('sections.edit')" onclick="hideEdit({{$item->id}})">
                <div class="container" id='section{{$item->id}}' style='display: none;'>
                <form action="\EditSection" method="post" >
                    @csrf
                    <input type="hidden" name="id" value="{{$item->id}}">
                    @lang('sections.name'): <input type="text" name="name" id="name" value="{{$item->name}}" required>
                    @lang('sections.desc'): <input type="text" name="desc" id="desc" value="{{$item->desc}}" required>
                    <input type="submit" value="@lang('sections.edit')">
                </form>
                </div>
    @endcan
    </div>
@endforeach

@can('create', new \App\Section) <!-- fuck -->
<div class='container' style='margin-top : 10px;'>
<form action="\AddSection" method="post">
    @csrf
    @lang('sections.name'): <input type="text" name="name" id="name" required>
    @lang('sections.desc'): <input type="text" name="desc" id="desc" required>
    <input type="submit" value="@lang('sections.add')">
</form>
</div>
@endcan
