<ItemCreate>

    <div>
        <img if="{ item.url1 }" src="./img/{ item.url1 }" width="100" height="120">
        <img if="{ item.url2 }" src="./img/{ item.url2 }" width="100" height="120">
        <img if="{ item.url3 }" src="./img/{ item.url3 }" width="100" height="120">
        <img if="{ item.url4 }" src="./img/{ item.url4 }" width="100" height="120">

        <table class="table table-bordered">
            <tr>
                <td>商品名</td>
                <td><input type="text" value="{ item.name }" onchange="{ changeValue.bind(this,'name') }"></td>
            </tr>
            <tr>
                <td>値段</td>
                <td><input type="text" value="{ item.price }" onchange="{ changeValue.bind(this,'price') }"></td>
            </tr>
            <tr>
                <td>説明</td>
                <td><input type="text" value="{ item.description }" onchange="{ changeValue.bind(this,'description') }"></td>
            </tr>
            <!-- TODO ここにカテゴリーを移動(+ モーダルで表示) -->
            <!--<tr>-->
                <!--<td>カテゴリ</td>-->
                <!--<td><input type="text" value="{ item.category_id }"></td>-->
            <!--</tr>-->
            <tr>
                <td>サイズ</td>
                <td>
                    <select name="size" onchange="{ changeValue.bind(this,'size') }">
                        <option value="1">なし</option>
                        <option value="2">S</option>
                        <option value="3">M</option>
                        <option value="4">L</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>商品の状態</td>
                <td>
                    <select name="status" onchange="{ changeValue.bind(this,'status') }">
                        <option value="1">新品、未使用</option>
                        <option value="2">未使用に近い</option>
                        <option value="3">目立った傷や汚れなし</option>
                        <option value="4">やや傷や汚れあり</option>
                        <option value="5">傷や汚れあり</option>
                        <option value="6">全体的に状態が悪い</option>
                    </select>
                </td>
            </tr>
        </table>

        <button onclick="{ saveItem }">保存</button>
    </div>


    <!-- 大カテ -->
    <ul each="{ mainCategory in mainCategories }">
        <li onclick="{ openSubCategories.bind(this, mainCategory.id) }">
            { mainCategory.name }
        </li>
        <!-- 中カテ -->
        <ul each="{ subCategory in subCategories }" >
            <li if="{ subCategory.main_category_id === mainCategory.id }" onclick="{ openCategories.bind(this, subCategory.id) }">
                { subCategory.name }
            </li>
            <!-- 小カテ -->
            <ul each="{ category in categories }">
                <li if="{ category.sub_category_id === subCategory.id && category.main_category_id === mainCategory.id }" onclick="{ changeCategory.bind(this, category.id) }">
                    { category.name }
                </li>
            </ul>
        </ul>
    </ul>

<script>
    const SAVE_URL = '/api/item/save';
    const TAKE_SUB_CATEGORIES_URL = '/api/category/get_sub_category?id=';
    const TAKE_CATEGORIES_URL = '/api/category/get_category?id=';

    this.assign = {
        mainCategories: [],
    }

    this.subCategories = [];

    this.categories = [];

    this.ui = {

    };

    this.item = {
        name: "",
        price: "",
        description: "",
        category_id: "",
        size: 1,
        status: 1
    };

    this.on('mount', function() {
        // TODO APIで良くないか
        this.assign.mainCategories = mainCategories;
    });

    saveItem(){
      $(function(){
          $.ajax({
                url:SAVE_URL,
                type:'POST',
                data:this.item
            })
            .done( (data) => {
                console.log('save success!!!!');
                // アサイン方法変更
                this.item = data;
            })
            .fail( (data) => {
                console.log('save fail!!!!');
                console.log(data);
            })
            .always( (data) => {
                console.log('save finished');
            });
      }.bind(this));

    }

    changeValue(k, e){
        this.item[k] = e.target.value;

        console.log(this.item);
    }

    // TODO　全体的に選択の切り替えの動きを修正
    openSubCategories(k, e){
        $(function(){
            $.ajax({
                url:TAKE_SUB_CATEGORIES_URL + k,
                type:'GET',
            })
                .done( (data) => {
                    // アサイン方法変更
                    this.subCategories = data;
                    this.update();
                })
                .fail( (data) => {
                    console.log('fail!!!!');
                    console.log(data);
                })
                .always( (data) => {
                    console.log('openSubCategories finished');
                });
        }.bind(this));
    }

    openCategories(k, e){
        $(function(){
            $.ajax({
                url:TAKE_CATEGORIES_URL + k,
                type:'GET',
            })
                .done( (data) => {
                    console.log('done!!!!');
                    // アサイン方法変更
                    this.categories = data;
                    this.update();
                })
                .fail( (data) => {
                    console.log('fail!!!!');
                    console.log(data);
                })
                .always( (data) => {
                    console.log('openCategories finished');
                });
        }.bind(this));
    }

    changeCategory(v, e){
        this.item.category_id = v;
    }


</script>

</ItemCreate>