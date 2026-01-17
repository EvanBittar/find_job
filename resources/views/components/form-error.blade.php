@props(['name'])

@error($name)
    <p class="text-red-500 text-xs mt-1"
    style="color: red; font-size: 12px; margin-top: 5px;"
    >{{$message}}</p>
@enderror