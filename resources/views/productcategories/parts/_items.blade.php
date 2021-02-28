
@foreach($categories as $category)
    <tr>
        <td>{{ $category->id }}</td>
{{--        <td>{{ $category->name }}</td>--}}
        <td>
            {{ mb_substr($category->title_ru, 0, 20) }}
            {{ mb_strlen($category->title_ru) > 20 ? "..." : "" }}
        </td>
        <td>
            {{ mb_substr($category->description_ru, 0, 20) }}
            {{ mb_strlen($category->description_ru) > 20 ? "..." : "" }}
        </td>
        <td>

        </td>
        <td>
            <a href="{{ route('product.category.show', [$category->id]) }}"
               class="btn btn-primary">View</a>
        </td>
    </tr>
@endforeach
