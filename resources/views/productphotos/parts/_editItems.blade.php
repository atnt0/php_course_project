@foreach($productPhotos as $key => $productPhoto)
    <div class="col-3" data-product-id="{{ $productPhoto->uuid }}" style="">
        <div class="cont_item"
             style="padding: 20px; position: relative;
             border: 1px solid rgb(204, 204, 204); background-color: #fff; cursor: grab;">
            <div class="image_wrap"
                 style="position: absolute; left: 0; top: 0; bottom: 0; overflow: hidden;display: contents;">
                <img src="{{ $dataProductPhotos[$key]['link'] }}"
                     title="{{ $dataProductPhotos[$key]['description_ru'] }}"
                     alt="{{ $dataProductPhotos[$key]['description_ru'] }}"
                     style="width: 100px; height: auto; max-height: 100px;">
            </div>
            <div class="actions_wrap"
                 style="position: absolute; right: 0; top: 0; bottom: 0; overflow: hidden; display: contents;">
                <a href="{{ route('product.photo.edit', $productPhoto['uuid']) }}"
                   class="btn btn-sm btn-primary">Edit</a>

                <form action="{{ route('product.photo.destroy', [$productPhoto->uuid]) }}" method="post"
                      style=" display: inline-block; ">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endforeach
