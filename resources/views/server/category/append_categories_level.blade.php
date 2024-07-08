
    <h5>Select Category Level</h5>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-Createon1"><i class="bx bxs-categories"></i></span>
        </div>
        <select name="parent_id" id="parent_id" class="form-control" required>
            <option value="0"
                @isset($category['parent_id'])
                    @if ($category['parent_id'] == 0)
                        selected
                    @endif 
                @endisset>
                Main Category</option>
            @if (!empty($getCategories))
                @foreach ($getCategories as $item)
                    <option value="{{ $item['id'] }}"
                        @isset($category['parent_id'])
                            @if ($category['parent_id'] == $item['id'])
                                selected
                            @endif
                        @endisset>
                        &nbsp;-&gt;&nbsp;{{ $item['name'] }}
                    </option>
                    @if (!empty($item['subcategories']))
                        @foreach ($item['subcategories'] as $subcategory)
                            <option value="{{ $subcategory['id'] }}"
                                @isset($category)
                                    @if ($category['parent_id'] == $subcategory['id'])
                                        selected
                                    @endif
                                @endisset>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&nbsp;{{ $subcategory['name'] }}</option>
                                @if (!empty($subcategory['subcategories']))
                                    @foreach ($subcategory['subcategories'] as $sub_subcategory)
                                        <option value="{{ $sub_subcategory['id'] }}"
                                            @isset($category)
                                                @if ($category['parent_id'] == $sub_subcategory['id'])
                                                    selected
                                                @endif
                                            @endisset>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&nbsp;{{ $sub_subcategory['name'] }}</option>
                                    @endforeach
                                @endif
                        @endforeach
                    @endif
                @endforeach
            @else
                {{ 'Create Category First' }}

            @endif

        </select>
    </div>
