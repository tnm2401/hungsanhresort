<li >
    <i></i>
    <label>
        <input name=permission[] value="gallery_all"  data-id="gallery_all" type="checkbox" {{ checkedRole (old('permission',json_decode($role->permissions ?? '')),'gallery_all') }}/>
        <span class="label label-warning">Đối tác</span>
    </label>
    <ul >
        <li>
            <label>
                <input name="permission[]" value="gallery_add" class="hummingbird-end-node"
                    data-id="gallery_add" type="checkbox" {{ checkedRole (old('permission',json_decode($role->permissions ?? '')),'gallery_add') }}/>
                <span class="label label-primary">Thêm</span>
            </label>
        </li>
        <li>
            <label>
                <input name="permission[]" value="gallery_edit" class="hummingbird-end-node"
                    data-id="gallery_edit" type="checkbox" {{ checkedRole (old('permission',json_decode($role->permissions ?? '')),'gallery_edit') }}/>
                <span class="label label-primary">Sửa</span>
            </label>
        </li>
        <li>
            <label>
                <input name="permission[]" value="gallery_del" class="hummingbird-end-node"
                    data-id="gallery_del" type="checkbox" {{ checkedRole (old('permission',json_decode($role->permissions ?? '')),'gallery_del') }}/>
                <span class="label label-primary">Xóa</span>
            </label>
        </li>
    </ul>
</li>
