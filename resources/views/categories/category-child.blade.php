<ul class="list-group">
    @foreach ($category->childrenRecursive as $child)
        <li class="list-group-item sort cursor-move" data-id="{{ $child->id }}" data-ordering="{{ $child->ordering }}">
            <span class="pull-left">
                <i class="fa fa-dot-circle-o" aria-hidden="true"></i>
                <i class="fa fa-dot-circle-o" aria-hidden="true"></i>
                @if ($item->image)
                    <img src="{{ asset($item->image) }}" alt="">
                @endif
                &nbsp&nbsp{{ $child->id }} : {{ $child->title }}
                &nbsp&nbsp&nbsp&nbsp
            </span>
            <span class="pull-left">
                <input type="checkbox" id="{{ $child->id }}" class="js-switch publish" {{ $child->published ? 'checked' : ''}}/>
            </span>
            <span class="pull-right">
                <a href="{{ url('/categories/edit/' . $child->id) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                <a href="{{ url('/categories/delete/' . $child->id) }}" class="delete btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>
            </span>
            @include('vendor.admin.site-bases.categories.category-child' , ['category' => $child])
        </li>
    @endforeach
</ul>
