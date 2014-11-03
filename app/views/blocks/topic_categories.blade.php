<ul class="list-group">
    @foreach($categories as $category)
        <li class="list-group-item">
            <a href="{{ route('topic.category.index', ['code' => rawurlencode($category->code)]) }}">{{{ $category->name }}}</a>
        </li>
    @endforeach
</ul>
